<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // run = php artisan migrate:fresh --seed "untuk menjalankan database lebih fresh(kosong) 
        // namun dikarenakan database nya dimasukin ke Seeder.php jadi tidak fresh(kosong)

        User::create([
            'name' => 'Arya Nurarif',
            'username' => 'Muhammad Arya Nurarif',
            'email' => 'aryanurarif1@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        // User::create([
        //     'name' => 'Aminah Khansa',
        //     'email' => 'aminahkhansa@gmail.com',
        //     'password' => bcrypt('12345'),
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Ini Judul pertama',
        //     'body' => 'Ini Judul pertama yang ada',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Ini Judul kedua',
        //     'body' => 'Ini Judul kedua yang ada',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Ini Judul ketiga',
        //     'body' => 'Ini Judul ketiga yang ada',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Ini Judul keempat',
        //     'body' => 'Ini Judul keempat yang ada',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
