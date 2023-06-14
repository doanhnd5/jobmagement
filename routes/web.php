<?php

use Illuminate\Support\Facades\Route;
use App\Libs\SessionManager;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/detail/{id?}', [App\Http\Controllers\HomeController::class, 'getDetailJob'])->name('detail');
Route::post('/home/search', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');
Route::get('/job/list/{id?}', [App\Http\Controllers\HomeController::class, 'getJobList'])->name('get_job_list');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.login');
Route::post('/change_password', [App\Http\Controllers\LoginController::class, 'changePassword'])->name('login.change_password');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('auth_user');
Route::get('/candidates', [App\Http\Controllers\CadidatesController::class, 'index'])->name('candidates')->middleware('auth_user');
Route::post('/confirm', [App\Http\Controllers\CadidatesController::class, 'confirm'])->name('confirm')->middleware('auth_user');
Route::post('/update_remark', [App\Http\Controllers\CadidatesController::class, 'updateRemark'])->name('remark')->middleware('auth_user');
Route::post('/change_contact_status', [App\Http\Controllers\CadidatesController::class, 'changeContactStatus'])->name('change_contact_status')->middleware('auth_user');
Route::post('/candidates/search', [App\Http\Controllers\CadidatesController::class, 'search'])->name('candidates.search')->middleware('auth_user');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');


Route::get('/job', [App\Http\Controllers\JobListController::class, 'index'])->name('job_list')->middleware('auth_user');
Route::post('/delete', [App\Http\Controllers\JobListController::class, 'delete'])->name('delete')->middleware('auth_user');
Route::post('/search', [App\Http\Controllers\JobListController::class, 'search'])->name('search')->middleware('auth_user');
Route::get('/create/{id?}', [App\Http\Controllers\CreateJobWorkController::class, 'index'])->name('create.index')->middleware('auth_user');
Route::post('/regist', [App\Http\Controllers\CreateJobWorkController::class, 'regist'])->name('regist')->middleware('auth_user');

Route::get('/post/list', [App\Http\Controllers\PostListController::class, 'getPostList'])->name('post.list');
Route::get('/post/detail/{id?}', [App\Http\Controllers\PostListController::class, 'getPostDetail'])->name('post.detail');
Route::get('/post', [App\Http\Controllers\PostListController::class, 'index'])->name('post_list')->middleware('auth_user');
Route::post('/post/delete', [App\Http\Controllers\PostListController::class, 'delete'])->name('post.delete')->middleware('auth_user');
Route::post('/post/search', [App\Http\Controllers\PostListController::class, 'search'])->name('post.search')->middleware('auth_user');
Route::get('/post/create/{id?}', [App\Http\Controllers\CreatePostController::class, 'index'])->name('post.create')->middleware('auth_user');
Route::post('/post/regist', [App\Http\Controllers\CreatePostController::class, 'regist'])->name('post.regist')->middleware('auth_user');
Route::post('/post/publish', [App\Http\Controllers\PostListController::class, 'publish'])->name('post.publish')->middleware('auth_user');

Route::get('/apply/{id?}', [App\Http\Controllers\ApplyController::class, 'index'])->name('apply');
Route::post('/apply', [App\Http\Controllers\ApplyController::class, 'apply'])->name('apply.create');



