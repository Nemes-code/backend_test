<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product_id', 
        'rating', 
        'rating_datetime',
    ];
    

    /**
     * Get the user that owns the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the rating belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}