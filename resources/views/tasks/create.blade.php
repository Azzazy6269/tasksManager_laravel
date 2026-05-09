@extends("layouts.app")
@section("page title", "Create Task")

@section("content")
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-dark">Create New Task</h1>
            <a href="{{ route("tasks.index") }}" class="btn btn-outline-secondary px-4 shadow-sm">
                Cancel
            </a>
        </div>

        <div class="main-card shadow-sm p-4">
            <form method="post" action="{{ route("tasks.store") }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary fw-bold mb-3">Basic Information</h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" class="form-control bg-light border-0 p-2" name="Title" placeholder="Enter task title" required/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Creator</label>
                            <select class="form-select bg-light border-0 p-2" name="User_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Assigned To</label>
                            <input type="text" class="form-control bg-light border-0 p-2" name="Assigned_to" placeholder="Assign task to"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary fw-bold mb-3">Task Details</h5>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold">Priority</label>
                                <input type="text" class="form-control bg-light border-0 p-2" name="Priority" placeholder="Urgent / High..."/>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <input type="text" class="form-control bg-light border-0 p-2" name="Status" placeholder="Yes / No"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Board Column</label>
                            <select class="form-select bg-light border-0 p-2" name="Board_column">
                                <option value="To Do">To Do</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                                <option value="Backlog">Backlog</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold">Project ID</label>
                                <input type="number" class="form-control bg-light border-0 p-2" name="Project_id" placeholder="ID"/>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-semibold">Due Date</label>
                                <input type="date" class="form-control bg-light border-0 p-2" name="Due_date"/>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control bg-light border-0" name="Description" rows="3" placeholder="Add some details..."></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tags</label>
                        <input type="text" class="form-control bg-light border-0 p-2" name="Tags" placeholder="e.g. django, backend"/>
                        <small class="text-muted fs-small mt-1 d-block">Separate tags with commas</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Labels</label>
                        <input type="text" class="form-control bg-light border-0 p-2" name="Labels" placeholder="e.g. urgent, bug"/>
                        <small class="text-muted fs-small mt-1 d-block">Separate labels with commas</small>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label fw-semibold">Completed</label>
                        <select class="form-select bg-light border-0 p-2" name="Completed">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection