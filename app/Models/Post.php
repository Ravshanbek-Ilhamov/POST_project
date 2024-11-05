<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'text',
        'image_path',
        'likes',
        'dislikes',
        'number_view'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }   

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeOrDislike::class)->where('value', 1);
    }
    
    public function dislikes()
    {
        return $this->hasMany(LikeOrDislike::class)->where('value', 0);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }
}
