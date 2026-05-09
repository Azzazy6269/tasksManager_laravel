<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable =[
        'title',
        'user_id',
        'priority',
        'status',
        'due_date',
        'project_id',
        'board_column',
        'description',
        'completed',
        'tags',
        'assigned_to',
        'labels'
    ];
    protected $casts = [
        'tags' => 'array',
        'labels' => 'array',
        'completed' => 'boolean',
    ];
}


?>