<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        // ketika mengklick author(user) atau category, title nya mengikut sesuai apa yg di klick
        // kalau ada category yang slug nya sama dengan request('category')
        // kalau misalkan ada title nya akan di timpa 

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        // ketika mengklick author(user) atau category, title nya mengikut sesuai apa yg di klick
        // kalau ada category yang slug nya sama dengan request('category')
        // kalau misalkan ada title nya akan di timpa 

        return view('posts', [
            "title" => "All Posts" . $title,
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))
                ->paginate(7)->withQueryString()
            //  pagination ini masih menggunakan tailwind, jadi kita cari di docs laravel dengan judul bootstrap
            //  atau bisa langsung ke App\Providers\AppServiceProvider dengan tambahin Paginator::useBootstrap(); dengan tambahin use Illuminate\Pagination\Paginator;
            // ketika dia selanjutnya atau sebelumnya tidak bisa di search, maka ditambahkan paginate()->withQueryString(); 
            // paginate() untuk halaman" berikut nya sesuai parameter yang di sediain
            // Post:: with di pindahkan ke model
            // kenapa disebutkan 2/3, karena yang di panggil itu adalah Author dan Category
            // ini bisa karena tidak ada nya routes model bainding kalau di with tidak bisa karena butuh author
            // atau bisa dibilang ini make eager load, untuk di web.php itu makai lazy eager loading
            // latest()->filter() filter sendiri itu dari nama function di models Post.php
            // dan request(['search]) itu sendiri dari nama paramaeter
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "post" => $post,
        ]);
    }
}
