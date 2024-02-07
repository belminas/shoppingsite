<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $quarded =[];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_post'); 
    }

    protected $fillable = [
        'image',
        'title',
        'price',
        'description', 
        'tags',
        'amount',
    ];

    public function getImageUrlAttribute()
{
    if ($this->image) {
        return asset('storage/' . $this->image);
    }

    // Return a default image if none is set
    return asset('path/to/default/image.jpg');
}
}
