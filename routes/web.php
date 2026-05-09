<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/tasks", [TaskController::class, "index"])->name("tasks.index");
Route::get("/tasks/deleted", [TaskController::class, "getDeleted"])->name("tasks.deleted");
Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create");
Route::post("/tasks/store", [TaskController::class, "store"])->name("tasks.store");
Route::get("/tasks/{task}", [TaskController::class, "show"])->name("tasks.show");
Route::get("/tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
Route::put("/tasks/{task}/update", [TaskController::class, "update"])->name("tasks.update");
Route::get("/tasks/{task}/delete", [TaskController::class, "delete"])->name("tasks.delete");
Route::delete("/tasks/{task}/destroy", [TaskController::class, "destroy"])->name("tasks.destroy");
Route::patch("/tasks/{task}/restore", [TaskController::class, "restore"])->name("tasks.restore");

