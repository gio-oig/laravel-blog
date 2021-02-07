<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Models\Address;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/users', function () {
    // $addreses = Address::with('user')->get();
    // $users = User::doesntHave('posts')->get();
    // dd($users);

    // return view('users.index',compact('users'));
// });

// Route::get('/post', function () {
    // $tag = Tag::first();
    // $post = Post::with('tags')->first();
    // $posts = Post::with(['tags','user'])->get();

    // $post->tags()->detach($tag);
    // dd($posts);
//     return view('posts.index', compact('posts'));
// });

Route::get('/', [PageController::class, 'home'])->name('index');


Route::name('front.')->prefix('front')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('index');
    Route::get('post/{slug}', [PageController::class, 'singlePost'])->name('post');
    Route::get('category/{slug}', [PageController::class, 'singleCategory'])->name('category');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
});



Route::post('/custom/register', [AuthController::class, 'register'])
->name('auth.custom.register')
->middleware('guest');

Route::post('/custom/login', [AuthController::class, 'login'])
->name('auth.custom.login')
->middleware('guest');

Route::post('/custom/reset-password', [AuthController::class, 'resetPassword'])->name('auth.custom.reset-passowrd');


Route::post('/custom/logout', [AuthController::class, 'logout'])
->name('auth.custom.logout')
->middleware('auth');

