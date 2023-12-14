<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

Route::get('/admin/users/index',[AdminController::class,'usersIndex'])->name('users.index');
Route::get('/admin/users/{id}',[AdminController::class,'usersDestroy'])->name('users.destroy');
Route::get('/admin/users/edit/{id}',[AdminController::class,'usersEdit'])->name('users.edit');
Route::get('/admin/users/store/{id}',[AdminController::class,'usersUpdate'])->name('users.update');

?>
