<?php


namespace App\Http\Controllers;

use App\Services\RatingService;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\ProductRatingResource;

class RatingController extends Controller
{
    protected $ratingService;
    

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    // Rate a product
    public function rateProduct(RatingRequest $request, $productId)
    {
        $validated = $request->validated();
        $rating = $this->ratingService->rateProduct($productId, $validated['rating']);

        return response()->json(['message' => 'Rating saved successfully!'], 200);
    }

    // Remove a rating
    public function removeRating($productId)
    {
        $rating = $this->ratingService->removeRating($productId);
        if ($rating) {
            return response()->json(['message' => 'Rating removed successfully!'], 200);
        }

        return response()->json(['error' => 'Rating not found'], 404);
    }

    // List products with ratings
    public function listProducts()
    {
        $products = $this->ratingService->listProductsWithRatings();
        return ProductRatingResource::collection($products);
    }
}
