<?php

namespace App\Interfaces;

interface RatingInterface

{
    /**
     * Create or update a rating for a product.
     *
     * @param array $data
     * @return object
     */
    public function createOrUpdate(array $data);

    /**
     * Delete a rating by product ID.
     *
     * @param int $productId
     * @return object|null
     */
    public function deleteByProductId(int $productId);

    /**
     * Get all products with their ratings and the user's rating.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProductsWithRatings();

    /**
     * Get a product by its ID with ratings and the user's rating.
     *
     * @param int $productId
     * @return \App\Models\Product|null
     */
    public function getProductById(int $productId);
}