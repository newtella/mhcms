<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'name', 'body', 'slug', 'excerpt', 'user_id', 'imageurl', 'category_id', 'status', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comment()
    {
        return $this->belongsToMany(Comment::class);
    }

    

}
