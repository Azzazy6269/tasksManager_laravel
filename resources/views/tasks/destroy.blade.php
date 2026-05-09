@extends("layouts.app")
@section("page title", "Task Deleted")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="main-card text-center py-5">
            <div class="mb-4">
                <div class="bg-danger-subtle text-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11.5 15a.5.5 0 0 1-.5-.5V2.707l1.354 1.357a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L10 2.707V14.5a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H7a.5.5 0 0 1 0 1h-3.5v10H10V15h1.5z"/>
                        <path d="M14 3a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-11A.5.5 0 0 1 2 3h12zM2 2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                    </svg>
                </div>
            </div>
            <h2 class="fw-bold text-danger mb-3">Are you sure?</h2>
            <h2 class="fw-bold text-danger mb-3">Don't worry, deleted tasks can be returned</h2>
        <div class="d-flex align-items-center justify-content-sm-center mb-4">
            <form method="post" action="{{ route("tasks.destroy",["task"=>$task['id']]) }}" class="d-inline" >
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger p-1 ms-1 text-decoration-none">Delete</button>
            </form>
            
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center m-2">
                <a href="{{ route("tasks.index") }}" class="btn btn-primary px-5 shadow-sm">
                    Return to Dashboard
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection