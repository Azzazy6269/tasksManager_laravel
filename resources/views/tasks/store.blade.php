@extends("layouts.app")
@section("page title", "Task Saved")

@section("content")
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-success">Task Saved Successfully ✅</h1>
        </div>

        <div class="main-card shadow-sm p-4 border-top border-success border-4">
            <h3 class="fw-bold text-dark mb-4 pb-3 border-bottom">{{ $task['title'] }}</h3>

            <div class="row mb-4">
                <div class="col-sm-6 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Creator</span>
                    <span class="fw-medium text-dark">{{ $task['user_id'] }}</span>
                </div>
                <div class="col-sm-6 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Assigned To</span>
                    <span class="fw-medium text-dark">{{ $task['assigned_to'] ?? 'N/A' }}</span>
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
                    <span class="fw-medium text-dark">{{ $task['board_column'] ?? 'N/A' }}</span>
                </div>
                <div class="col-sm-4 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Project ID</span>
                    <span class="fw-medium text-dark">{{ $task['project_id'] ?? 'N/A' }}</span>
                </div>
                <div class="col-sm-4 mb-3">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-1">Due Date</span>
                    <span class="fw-medium text-dark">{{ $task['due_date'] }}</span>
                </div>
            </div>

            <div class="mb-4">
                <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Description</span>
                <div class="p-3 bg-light border-0 rounded text-dark">
                    {{ $task['description'] ?? 'No description' }}
                </div>
            </div>

            <div class="row mb-4 border-bottom pb-4">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Tags</span>
                    <div class="text-dark fw-medium">
                        @if(!empty($task['tags']))
                            {{ implode(', ', json_decode($task['tags'])) }}
                        @else
                            <span class="text-muted fst-italic">No tags</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <span class="d-block text-muted small text-uppercase fw-semibold mb-2">Labels</span>
                    <div class="text-dark fw-medium">
                        @if(!empty($task['labels']))
                            {{ $task['labels']}}
                        @else
                            <span class="text-muted fst-italic">No labels</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <span class="d-block text-muted small text-uppercase fw-semibold mb-3">Comments</span>
                @if(!empty($task['comments']))
                    <ul class="list-group list-group-flush border rounded">
                        @foreach($task['comments'] as $comment)
                            <li class="list-group-item bg-light border-0 mb-1 rounded">{{ $comment }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted fst-italic">No comments</p>
                @endif
            </div>

            <!-- ACTIONS -->
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route("tasks.index") }}" class="btn btn-outline-secondary px-4">Back</a>
                <a href="{{ route("tasks.show", $task['id']) }}" class="btn btn-outline-primary px-4">View</a>
                <a href="{{ route("tasks.edit", $task['id']) }}" class="btn btn-warning px-4 shadow-sm text-dark fw-bold">Edit</a>
            </div>

        </div>
    </div>
</div>
@endsection