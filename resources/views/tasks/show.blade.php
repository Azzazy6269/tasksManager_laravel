@extends("layouts.app")
@section("page title", "Task Details")

@section("content")
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-dark">Task Details</h1>
            <a href="{{ route("tasks.index") }}" class="btn btn-outline-secondary px-4 shadow-sm">
                Back to List
            </a>
        </div>

        <div class="main-card shadow-sm p-4">
            <h3 class="fw-bold text-primary mb-4 pb-3 border-bottom">{{ $task['title'] }}</h3>

            <div class="row mb-4">
                <div class="col-sm-6 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Creator</span>
                    <span class="fw-medium text-dark">{{ $task->user['name']}}</span>
                </div>
                <div class="col-sm-6 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Assigned To</span>
                    <span class="fw-medium text-dark">{{ $task['assigned_to'] }}</span>
                </div>
            </div>

            <div class="row bg-light rounded p-3 mb-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Priority</span>
                    <span class="fw-medium text-dark">{{ $task['priority'] }}</span>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Status</span>
                    <span class="fw-medium text-dark">{{ $task['status'] }}</span>
                </div>
                <div class="col-md-4">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Completed</span>
                    <span class="badge {{ $task['completed'] ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} rounded-pill px-3">
                        {{ $task['completed'] ? 'Yes' : 'No' }}
                    </span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-4 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Board Column</span>
                    <span class="fw-medium text-dark">{{ $task['board_column'] }}</span>
                </div>
                <div class="col-sm-4 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Project ID</span>
                    <span class="fw-medium text-dark">#{{ $task['project_id'] }}</span>
                </div>
                <div class="col-sm-4 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Due Date</span>
                    <span class="fw-medium text-dark">{{ $task['due_date'] }}</span>
                </div>
            </div>

            <div class="mb-4">
                <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Description</span>
                <div class="p-3 bg-light border-0 rounded text-dark">
                    {{ $task['description'] }}
                </div>
            </div>

            <div class="row mb-4 border-bottom pb-4">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Tags</span>
                    <div class="text-dark fw-medium">
                        @if(!empty($task['tags']))
                            {{ implode($task['tags']) }}
                        @else
                            <span class="text-muted fst-italic">No tags</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Labels</span>
                    <div class="text-dark fw-medium">
                        @if(!empty($task['labels']))
                            {{ implode($task['labels']) }}
                        @else
                            <span class="text-muted fst-italic">No labels</span>
                        @endif
                    </div>
                </div>
            </div>

            
            <div class="mb-4">
                @foreach($comments as $comment)
                <div class="mb-3 p-3 bg-light rounded">
                    <label class="form-label">{{ $users->find($comment['user_id'])->name }} : </label>
                    <text class="">{{ $comment['content'] }}</text>
                    <span class="d-block text-muted small">{{ $comment['created_at'] }}</span>
                </div>
                @endforeach
            </div>
            <form class="d-flex gap-2" action="{{ route("comment.store") }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="commentable_id" value="{{ $task['id'] }}">
                <input type="hidden" name="commentable_type" value="App\Models\Task">
                <select name="user_id" class="form-select mb-2" required>
                    <option value=""  disabled selected>Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control mb-2" placeholder="Add a comment..." name="content">
                <button type="submit" class="btn btn-primary px-4">Add Comment</button>
            </form>
            <!-- ACTIONS -->
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route("tasks.index") }}" class="btn btn-outline-secondary px-4">Back</a>
                <a href="{{ route("tasks.edit", $task['id']) }}" class="btn btn-warning px-4 shadow-sm text-dark fw-bold">Edit Task</a>
            </div>

        </div>
    </div>
</div>
@endsection