<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController,UIController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Post
Route::get('/', [App\Http\Controllers\PostController::class,'index'])->name('news.feed');
Route::get('/posts/{id}/edit', [App\Http\Controllers\PostController::class,'edit'])->name('posts.edit');
Route::post('/posts', [App\Http\Controllers\PostController::class,'store'])->name('posts.store');
Route::put('/posts/{id}', [App\Http\Controllers\PostController::class,'update'])->name('posts.update');
Route::delete('/posts/{id}', [App\Http\Controllers\PostController::class,'destroy'])->name('posts.destroy');



Route::get('/posts/{id}/details',[App\Http\Controllers\PostController::class,'postdetail'])->name('postdetail');

Route::post('/post/comment/{id}',[App\Http\Controllers\CommentController::class,'comment'])->name('comments.store');
Route::get('/post/comment/{id}/edit',[App\Http\Controllers\CommentController::class,'commentedit'])->name('comments.edit');
Route::put('/post/comment/{id}',[App\Http\Controllers\CommentController::class,'commentupdate'])->name('comments.update');
Route::delete('/post/comment/{id}/delete',[App\Http\Controllers\CommentController::class,'commentdelete']);

// Admin
Route::group(['prefix'=>'admin','middleware'=>['auth','isAdmin']],function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
    Route::resource('/users',App\Http\Controllers\Admin\UserController::class);
    Route::resource('/posts',App\Http\Controllers\Admin\PostController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
