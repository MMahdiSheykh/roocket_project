<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'inventory',
        'view_count'
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
