<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;

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

    public function store(Request $request)
    {
        $task = [
            "title" => $request->Title,
            "user_id" => $request->User_id,
            "priority" => $request->Priority,
            "status" => $request->Status,
            "due_date" => $request->Due_date,
            "project_id" => $request->Project_id ?? null,
            "board_column" => $request->Board_column ?? "To Do",
            "description" => $request->Description ?? "",
            "completed" => $request->Completed ? true : false,
            "tags" => $request->Tags ? explode(',', $request->Tags) : [],
            "assigned_to" => $request->Assigned_to ?? null,
            "labels" => $request->Labels ? explode(',', $request->Labels) : []
        ];

        $task =Task::create($task);
        $creator = User::findorfail($task['user_id']);
        return view("tasks.show", ["task" => $task], ["creator" => $creator]);
    }

    public function edit($id)
    {
        $task = Task::findorfail($id);
        $users = User::all();
        return view("tasks.edit", ["task" => $task], ["users" => $users]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findorfail($id);

        $updatedTask = [
        "id" => $id,
        "title" => $request->Title,
        "user_id" => $request->User_id,
        "priority" => $request->Priority,
        "status" => $request->Status,
        "due_date" => $request->Due_date,
        "project_id" => $request->Project_id ?? $task["project_id"],
        "board_column" => $request->Board_column ?? $task["board_column"],
        "description" => $request->Description ?? $task["description"],
        "completed" => $request->Completed ? true : false,
        "tags" => $request->Tags ? explode(',', $request->Tags) : $task["tags"],
        "assigned_to" => $request->Assigned_to ?? $task["assigned_to"],
        "labels" => $request->Labels ? explode(',', $request->Labels) : $task["labels"]
        ];

        Task::where("id", $id)->update($updatedTask);
        $creator = User::findorfail($updatedTask['user_id']);
        return view("tasks.update", ["task" => $updatedTask], ["creator" => $creator]);
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