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
    ];
    

    /**
     * Get the ratings for the product.
     */
    public function ratings()
    {
        return $this->hasMany(UserRating::class);
    }

     public function userRatings()
    {
        return $this->hasMany(UserRating::class, 'product_id');
    }
}
