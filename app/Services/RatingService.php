<?php

namespace App\Services;

use App\Repositories\RatingRepository;
use App\Models\UserRating;
use Illuminate\Support\Facades\Auth;

class RatingService

{
    protected $ratingRepo;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepo = $ratingRepo;
    }

    // Handle rating or updating a rating
    public function rateProduct($productId, $rating)
    {
        $user = Auth::user();
        $data = [
            'product_id' => $productId,
            'rating' => $rating
        ];

        return $this->ratingRepo->createOrUpdate($data);
    }

    // Remove a rating
    public function removeRating($productId)
    {
        return $this->ratingRepo->deleteByProductId($productId);
    }

    // List products with ratings
    public function listProductsWithRatings()
    {
        return $this->ratingRepo->getAllProductsWithRatings();
    }
}