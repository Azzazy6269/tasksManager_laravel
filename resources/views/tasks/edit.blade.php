@extends("layouts.app")
@section("page title", "Edit Task")

@section("content")
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-dark">Edit Task <span class="text-primary text-opacity-50">#{{ $task['id'] }}</span></h1>
            <a href="{{ route("tasks.index") }}" class="btn btn-outline-secondary px-4 shadow-sm">
                Cancel
            </a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="main-card shadow-sm p-4 border-top border-primary border-4">
            <form method="post" action="{{ route("tasks.update", $task['id']) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary fw-bold mb-3">Task Overview</h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small uppercase">Title</label>
                            <input type="text" class="form-control border-0 bg-light p-2" name="title" value="{{ $task['title'] }}" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small uppercase">Creator</label>
                            <select class="form-select border-0 bg-light p-2" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user['id'] }}" {{ $task['user_id'] == $user['id'] ? 'selected' : '' }}>{{ $user['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small uppercase">Assigned To</label>
                            <input type="text" class="form-control border-0 bg-light p-2" name="assigned_to" value="{{ $task['assigned_to'] }}" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary fw-bold mb-3">Configuration</h5>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold text-muted small uppercase">Priority</label>
                                <input type="text" class="form-control border-0 bg-light p-2" name="priority" value="{{ $task['priority'] }}" />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold text-muted small uppercase">Status</label>
                                <input type="text" class="form-control border-0 bg-light p-2" name="status" value="{{ $task['status'] }}" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small uppercase">Board Column</label>
                            <select class="form-select border-0 bg-light p-2" name="board_column">
                                <option value="To Do" {{ $task['board_column'] == 'To Do' ? 'selected' : '' }}>To Do</option>
                                <option value="In Progress" {{ $task['board_column'] == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Done" {{ $task['board_column'] == 'Done' ? 'selected' : '' }}>Done</option>
                                <option value="Backlog" {{ $task['board_column'] == 'Backlog' ? 'selected' : '' }}>Backlog</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold text-muted small uppercase">Project ID</label>
                                <input type="number" class="form-control border-0 bg-light p-2" name="project_id" value="{{ $task['project_id'] }}" />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold text-muted small uppercase">Due Date</label>
                                <input type="date" class="form-control border-0 bg-light p-2" name="due_date" value="{{ $task['due_date'] }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small uppercase">Description</label>
                    <textarea class="form-control border-0 bg-light" name="description" rows="3">{{ $task['description'] }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted small uppercase">Tags</label>
                        <input type="text" class="form-control border-0 bg-light p-2" name="tags" value="{{ implode(',', $task['tags']) }}" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted small uppercase">Labels</label>
                        <input type="text" class="form-control border-0 bg-light p-2" name="labels" value="{{ implode(',', $task['labels']) }}" />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label fw-semibold text-muted small uppercase">Completed</label>
                        <select class="form-select border-0 bg-light p-2" name="completed">
                            <option value="0" {{ !$task['completed'] ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $task['completed'] ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning py-3 fw-bold shadow-sm">Update Task Information</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection