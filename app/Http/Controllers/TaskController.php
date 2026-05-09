<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::whereNull('deleted_at')->paginate(10);
        return view("tasks.index", ["tasks" => $tasks]);
    }

    public function show($id)
    {
        $task = Task::with('user')->findorfail($id);
        $users = User::all();
        $comments = Comment::where(['commentable_id'=>$id, 'commentable_type'=>'App\Models\Task'])->with('user')->get();
        return view("tasks.show", ["task" => $task, "users" => $users, "comments" => $comments]);
    }

    public function create()
    {
        $users = User::all();
        return view("tasks.create", ["users" => $users]);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        if (isset($validated['tags'])) {
            $validated['tags'] = explode(',', $validated['tags']);
        }
        if (isset($validated['labels'])) {
            $validated['labels'] = explode(',', $validated['labels']);
        }
        $task =Task::create($validated);
        return redirect()->route('tasks.show', $task['id']);
    }

    public function edit($id)
    {
        $task = Task::findorfail($id);
        $users = User::all();
        return view("tasks.edit", ["task" => $task], ["users" => $users]);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findorfail($id);
        $validated = $request->validated();
        if (isset($validated['tags'])) {
            $validated['tags'] = explode(',', $validated['tags']);
        }
        if (isset($validated['labels'])) {
            $validated['labels'] = explode(',', $validated['labels']);
        }
        Task::where("id", $id)->update($validated);
        return redirect()->route('tasks.show', $task['id']);
    }

    public function delete($id){
        $task = Task::findorfail($id);
        return view("tasks.destroy", ["task" => $task]);
    }

    public function destroy($id){
        $task = Task::findorfail($id);
        $task->delete();
        return redirect()->route("tasks.index");
    }

    public function getDeleted(Request $request){
        $tasks = Task::onlyTrashed()->get();
        $tasksCount = $tasks->count();
        $pages = ceil($tasksCount / 10);
        $page = $request->query('page',1);
        $tasks = Task::onlyTrashed()->skip(($page - 1) * 10)->take(10)->get();
        return view("tasks.deleted", ["tasks" => $tasks, "pages" => $pages]);
    }
    
    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.deleted');
    }
}