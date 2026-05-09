<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());

        return redirect()->route('tasks.show', ['task' => $comment->task_id]);
    }
}
