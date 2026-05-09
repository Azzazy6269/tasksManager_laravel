@extends("layouts.app")
@section("page title", "Create Task")

@section("content")
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold text-dark mb-1">Create New Task</h1>
                    <p class="text-muted mb-0">Fill in the details below to create a task.</p>
                </div>

                <a href="{{ route("tasks.index") }}"
                   class="btn btn-light border shadow-sm px-4 rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Cancel
                </a>
            </div>

            <!-- Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Top Accent -->
                <div style="height: 6px; background: linear-gradient(to right, #0d6efd, #6f42c1);"></div>

                <div class="card-body p-5">

                    <form method="post" action="{{ route("tasks.store") }}">
                        @csrf

                        <div class="row g-5">

                            <!-- Left Side -->
                            <div class="col-md-6">

                                <div class="mb-4">
                                    <h5 class="fw-bold text-primary mb-1">Basic Information</h5>
                                    <small class="text-muted">Main task information</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Title</label>
                                    <input type="text"
                                           class="form-control custom-input @error('title') is-invalid @enderror"
                                           name="title"
                                           placeholder="Enter task title"
                                           value="{{ old('title') }}"
                                           required/>

                                    <div class="invalid-feedback">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Creator</label>

                                    <select class="form-select custom-input @error('user_id') is-invalid @enderror"
                                            name="user_id">

                                        @foreach ($users as $user)
                                            <option value="{{ $user['id'] }}"
                                                {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                                                {{ $user['name'] }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Assigned To</label>

                                    <input type="text"
                                           class="form-control custom-input @error('assigned_to') is-invalid @enderror"
                                           name="assigned_to"
                                           placeholder="Assign task to"
                                           value="{{ old('assigned_to') }}"/>

                                    <div class="invalid-feedback">
                                        @error('assigned_to')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <!-- Right Side -->
                            <div class="col-md-6">

                                <div class="mb-4">
                                    <h5 class="fw-bold text-primary mb-1">Task Details</h5>
                                    <small class="text-muted">Manage task workflow</small>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label fw-semibold">Priority</label>

                                        <input type="text"
                                               class="form-control custom-input @error('priority') is-invalid @enderror"
                                               name="priority"
                                               placeholder="Urgent / High"/>

                                        <div class="invalid-feedback">
                                            @error('priority')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label fw-semibold">Status</label>

                                        <input type="text"
                                               class="form-control custom-input @error('status') is-invalid @enderror"
                                               name="status"
                                               placeholder="Open / Closed"/>

                                        <div class="invalid-feedback">
                                            @error('status')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Board Column</label>

                                    <select class="form-select custom-input @error('board_column') is-invalid @enderror"
                                            name="board_column">
                                        <option {{ old('board_column') == "To Do" ? 'selected' : '' }} value="To Do">To Do</option>
                                        <option {{ old('board_column') == "In Progress" ? 'selected' : '' }} value="In Progress">In Progress</option>
                                        <option {{ old('board_column') == "Done" ? 'selected' : '' }} value="Done">Done</option>
                                        <option {{ old('board_column') == "Backlog" ? 'selected' : '' }} value="Backlog">Backlog</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label fw-semibold">Project ID</label>

                                        <input type="number"
                                               class="form-control custom-input @error('project_id') is-invalid @enderror"
                                               name="project_id"
                                               placeholder="ID"/>

                                        <div class="invalid-feedback">
                                            @error('project_id')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4">
                                        <label class="form-label fw-semibold">Due Date</label>

                                        <input type="date"
                                               class="form-control custom-input @error('due_date') is-invalid @enderror"
                                               name="due_date"/>

                                        <div class="invalid-feedback">
                                            @error('due_date')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="my-5">
                            <hr class="opacity-10">
                        </div>

                        <!-- Bottom Section -->
                        <div class="row">

                            <div class="col-12 mb-4">
                                <label class="form-label fw-semibold">Description</label>

                                <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                          name="description"
                                          rows="5"
                                          placeholder="Add some details..."></textarea>

                                <div class="invalid-feedback">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Tags</label>

                                <input type="text"
                                       class="form-control custom-input @error('tags') is-invalid @enderror"
                                       name="tags"
                                       placeholder="e.g. backend, api"/>

                                <div class="invalid-feedback">
                                    @error('tags')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <small class="text-muted">Separate tags with commas</small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Labels</label>

                                <input type="text"
                                       class="form-control custom-input @error('labels') is-invalid @enderror"
                                       name="labels"
                                       placeholder="e.g. urgent, bug"/>

                                <div class="invalid-feedback">
                                    @error('labels')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <small class="text-muted">Separate labels with commas</small>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-semibold">Completed</label>

                                <select class="form-select custom-input @error('completed') is-invalid @enderror"
                                        name="completed">

                                    <option {{ old('completed') == 0 ? 'selected' : '' }} value="0">No</option>
                                    <option {{ old('completed') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                </select>

                                <div class="invalid-feedback">
                                    @error('completed')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="d-grid mt-4">
                            <button type="submit"
                                    class="btn btn-primary py-3 rounded-3 fw-bold shadow-sm create-btn">
                                Create Task
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body{
        background: #f4f7fb;
    }

    .custom-input{
        border: 1px solid #e5e7eb !important;
        background: #f9fafb !important;
        border-radius: 14px !important;
        padding: 14px 16px !important;
        transition: all .25s ease;
        box-shadow: none !important;
    }

    .custom-input:focus{
        background: #fff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 4px rgba(13,110,253,.12) !important;
    }

    .form-label{
        color: #374151;
        margin-bottom: 8px;
    }

    .card{
        background: #fff;
    }

    .create-btn{
        transition: all .25s ease;
        font-size: 1rem;
        letter-spacing: .4px;
    }

    .create-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(13,110,253,.18) !important;
    }

    hr{
        border-color: #dee2e6;
    }
</style>
@endsection