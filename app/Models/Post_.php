<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Posts Pertama",
            "slug" => "judul-posts-pertama",
            "author" => "Arya Nurarif",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio ipsum iste unde adipisci commodi facilis tempore repellat incidunt deserunt culpa. Nostrum suscipit fugit nulla mollitia cum sint, ea ipsum inventore?"
        ],
        [
            "title" => "Judul Posts Kedua",
            "slug" => "judul-posts-kedua",
            "author" => "Dodi Ferdi",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum laudantium quos nobis atque, deserunt eius. Unde accusantium, quos veniam repellat, aperiam obcaecati eius amet nisi facilis aliquid temporibus! Soluta quisquam adipisci dolores quo nesciunt eos nam reiciendis animi provident harum consectetur, aliquam quidem sit nostrum eius omnis aliquid. Quam illum quae consequuntur vel quos. Doloribus distinctio, iusto molestiae labore possimus officia blanditiis maxime deleniti? Sunt molestias autem doloremque adipisci, incidunt harum, quibusdam esse atque nisi rem sit, quas facere ullam itaque? Laudantium distinctio nulla mollitia perspiciatis officia sed repellendus, itaque quos corporis laboriosam aut dolore. Nemo, cupiditate? Reiciendis, optio non."
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
