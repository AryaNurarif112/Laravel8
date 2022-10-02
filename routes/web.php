<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Arya Nurarif",
        "email" => "aryanurarrif@gmail.com",
        "image" => "arya.jpeg"
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all(),
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// middelleware('guest) = halaman login hanya bisa di akses yang belum di authentication
// jangan lupa untuk RouteServiceProvider dibikin public const HOME = '/';
// ->name('login') sendiri itu berada di App->http->middleware->authenticate dan isi nya eturn route('login');
// jadi kita perlu isi dengna ->name('login')
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Route model binding -> customizing the key
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])
    ->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
// https://github.com/cviebrock/eloquent-sluggable
