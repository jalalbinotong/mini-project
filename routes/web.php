<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\postController;
use App\Http\Controllers\Web\loginController;
use App\Http\Controllers\Web\notifController;
use App\Http\Controllers\Web\followController;
use App\Http\Controllers\Web\homeController;
use App\Http\Controllers\Web\profileController;
use App\Http\Controllers\Web\searchingController;

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
// view home
Route::get('/', [homeController::class, 'home'])->name('home');

// login dan register
Route::get('/register', [loginController::class, 'register'])->name('register');
Route::post('/register-user', [loginController::class, 'doneRegister'])->name('done_register');
Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login-user', [loginController::class, 'doneLogin'])->name('done_login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

//view searching
Route::get('/searching', [searchingController::class, 'searching'])->name('searching');
// detail post
Route::get('/seePost/{id}', [postController::class, 'detailPost'])->name('detail_post');

Route::middleware(['authenticate'])->group(function()
{
    // view following
    Route::get('/following', [followController::class, 'following'])->name('following');
    
    //untuk melakukan follow
    Route::post('/follow', [followController::class, 'followUser'])->name('follow.user');
    
    // komen reply di detail post
    Route::post('/comment/{id}', [postController::class, 'storeComment'])->name('comment');
    Route::delete('/comments/{id}', [postController::class, 'deleteComment'])->name('delete_comment');
    Route::post('/reply/{id}', [postController::class, 'storeReply'])->name('reply');
    Route::delete('/replies/{id}', [postController::class, 'deleteReply'])->name('delete_reply');

    // view semua di view profile
    Route::get('/profile', [profileController::class, 'profile'])->name('profile');
    Route::get('/EditProfile', [profileController::class, 'editProfile'])->name('edit_profile');
    Route::put('/profile/update', [profileController::class, 'update'])->name('update_profile');
    Route::get('/followings/{id}', [profileController::class, 'seeFollowings'])->name('see_followings');
    Route::get('/follower/{id}', [profileController::class, 'seeFollower'])->name('see_followers');

    // buat postingan
    Route::get('/formPost', [postController::class, 'createPost'])->name('create_post');
    Route::post('/done-create', [postController::class, 'doneCreate'])->name('done_create');

    // untuk like post dan like comment
    Route::post('/like-post', [PostController::class, 'likePost'])->name('like.post');
    Route::post('/like-comments', [PostController::class, 'likeComment'])->name('like.comment');

    // view notif
    Route::get('/myNotifikasi', [notifController::class, 'notif'])->name('notif');

    // view bookmarks
    Route::get('/myBookmarks', [postController::class, 'bookmark'])->name('bookmark_post');
    Route::post('/bookmark', [PostController::class, 'bookmarkPost'])->name('bookmark.post');
});