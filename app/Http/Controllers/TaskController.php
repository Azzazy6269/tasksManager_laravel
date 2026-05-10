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

    public function show($slug)
    {
        $task = Task::with('user')->where('slug', $slug)->firstOrFail();
        $users = User::all();
        $comments = Comment::where(['commentable_id'=>$task->id, 'commentable_type'=>'App\Models\Task'])->with('user')->get();
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
        return redirect()->route('tasks.show', $task);
    }

    public function edit($slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
        $users = User::all();
        return view("tasks.edit", ["task" => $task], ["users" => $users]);
    }

    public function update(UpdateTaskRequest $request, $slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
        $validated = $request->validated();
        if (isset($validated['tags'])) {
            $validated['tags'] = explode(',', $validated['tags']);
        }
        if (isset($validated['labels'])) {
            $validated['labels'] = explode(',', $validated['labels']);
        }
        Task::where("id", $task->id)->update($validated);
        return redirect()->route('tasks.show', $task);
    }

    public function delete($slug){
        $task = Task::where('slug', $slug)->firstOrFail();
        return view("tasks.destroy", ["task" => $task]);
    }

    public function destroy($slug){
        $task = Task::where('slug', $slug)->firstOrFail();
        $task->delete();
        return redirect()->route("tasks.index");
    }

    public function getDeleted(Request $request){
        $tasks = Task::onlyTrashed()->paginate(10);
        return view("tasks.deleted", ["tasks" => $tasks]);
    }
    
    public function restore($slug)
    {
        $task = Task::withTrashed()->where('slug', $slug)->firstOrFail();
        $task->restore();
        return redirect()->route('tasks.deleted');
    }
}