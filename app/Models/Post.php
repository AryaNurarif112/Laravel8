<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; //eloquent sluggable

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    // protected $fillable = ['title', 'excerpt', 'body'];
    protected $guarded = ['id'];
    protected $with = ['category', 'author'];
    // ditambahkan with sesudah Post:: agar tidak ada nya N+1 atau bisa dibilang tidak mengquery lebih dari 2/3.

    // awalnya harus make scope, karena dia mencari scope
    public function scopeFilter($query, array $filters) //pencarian agar lebih kompleks/author
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' .  $search . '%')
                ->orWhere('body', 'like', '%' .  $search . '%');
        });
        // $filters itu berada antara models dan controller
        // cari berdasarkan judul, like(pencarian) . join request dengan method search
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
            // melakukan join table category, query whereHas punya relationship: category, author
            // lalu menggunakan use sesudah function sesuai paramater
        });

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
        //user_id sendiri itu berada di folder migrations dengan nama create_posts_table
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
