@extends("layouts.app")
@section("page title") Tasks @endSection

@section("content")
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">Tasks Dashboard</h1>
    <div>
    <a href="{{ route("tasks.create") }}" class="btn btn-primary px-4 shadow-sm">
        Create New Task
    </a>
    <a href="{{ route("tasks.deleted") }}" class="btn btn-warning px-4 shadow-sm">
        Deleted Tasks
    </a>
    </div>
</div>

<div class="d-flex  align-items-center mb-4">
@for($page = 1; $page <= $pages; $page++)
    <a href="{{ route("tasks.index", ["page" => $page]) }}" class="btn btn-outline-secondary px-3 shadow-sm me-1 mb-3">
        {{ $page }}
    </a>
@endfor
</div>

<div class="main-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th scope="col" class="ps-3">#ID</th>
                    <th scope="col">Title</th>
                    <!--th scope="col">Creator</th-->
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Due Date</th>
                    <th scope="col" class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td class="fw-bold text-secondary ps-3">{{ $task['id'] }}</td>
                        <td><span class="fw-semibold text-dark">{{ $task['title'] }}</span></td>
                        <!--td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2" style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; font-size: 0.7rem;">
                                    {{ strtoupper(substr($task['creator'], 0, 2)) }}
                                </div>
                                {{ $task['creator'] }}
                            </div>
                        </td-->
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border">{{ $task['priority'] }}</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $task['status'] == 'yes' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3">
                                {{ $task['status'] }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $task['due_date'] }}</td>
                        <td class="text-end pe-3">
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route("tasks.show", ["task" =>$task['id']]) }}" class="btn btn-link text-success p-1 ms-1 text-decoration-none">
                                    Show
                                </a>
                                <a href="{{ route("tasks.edit", ["task" =>$task['id']]) }}" class="btn btn-link text-warning p-1 ms-1 text-decoration-none">
                                    Edit
                                </a>
                                <a href="{{ route("tasks.delete", ["task" =>$task['id']]) }}" class="btn btn-link text-danger p-1 ms-1 text-decoration-none">
                                    Delete
                                </a>
                                
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection