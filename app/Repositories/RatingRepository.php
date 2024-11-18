<?php

namespace App\Repositories;

use App\Interfaces\RatingInterface;
use App\Models\UserRating;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RatingRepository implements RatingInterface
{
    // Create or update a rating
    public function createOrUpdate(array $data)
    {
        $user = Auth::user();
        $userRating = UserRating::where('user_id', $user->id)
            ->where('product_id', $data['product_id'])
            ->first();

        if ($userRating) {
            // Update the existing rating
            $userRating->rating = $data['rating'];
            $userRating->rating_datetime = now();
            $userRating->save();
            return $userRating;
            
        } else {
            // Create a new rating
            return UserRating::create([
                'user_id' => $user->id,
                'product_id' => $data['product_id'],
                'rating' => $data['rating'],
                'rating_datetime' => now(),
            ]);
        }
    }

    // Delete a rating by product ID
    public function deleteByProductId(int $productId)
    {
        $user = Auth::user();
        $userRating = UserRating::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($userRating) {
            $userRating->delete();
            return $userRating;
        }

        return null;
    }

    // Get all products with their ratings and the user's rating
    public function getAllProductsWithRatings()
    {
        return Product::with(['userRatings' => function($query) {
            $query->where('user_id', Auth::id());
        }])
        ->withAvg('userRatings as average_rating', 'rating')
        ->get();
    }

    // Get a product by its ID with ratings and the user's rating
    public function getProductById(int $productId)
    {
        return Product::with(['userRatings' => function($query) {
            $query->where('user_id', Auth::id());
        }])
        ->withAvg('userRatings as average_rating', 'rating')
        ->find($productId);
    }
}
