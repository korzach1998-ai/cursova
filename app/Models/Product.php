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
        'image',
        'category_id',
        'user_id',
    ];

    // Relationship: Product belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Product belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
