<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductRatingResource extends JsonResource
{
    public function toArray($request)
    {
        $userRating = $this->getUserRating();

        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'average_rating' => $this->average_rating,
            'user_rating' => $userRating ? $userRating->rating : null,
            'time_passed' => $this->calculateTimePassed($userRating),
            'active_time' => $this->getActiveTimeStatus($userRating),
        ];
    }

    /**
     * Get the user's rating if available
     *
     * @return mixed
     */
    private function getUserRating()
    {
        return $this->userRatings && $this->userRatings->isNotEmpty()
            ? $this->userRatings->first()
            : null;
    }

    /**
     * Calculate the time passed since the user's rating.
     *
     * @param mixed $userRating
     * @return string|null
     */
    private function calculateTimePassed($userRating)
    {
        if (!$userRating) return null;

        $ratingDatetime = Carbon::parse($userRating->rating_datetime);
        return $this->formatTimePassed($ratingDatetime->diffInSeconds(now()));
    }

    /**
     * Determine if the rating is still active.
     *
     * @param mixed $userRating
     * @return string
     */
    private function getActiveTimeStatus($userRating)
    {
        if (!$userRating) return 'inactive';

        $ratingDatetime = Carbon::parse($userRating->rating_datetime);
        return $ratingDatetime->diffInSeconds(now()) <= 30 * 60 ? 'active' : 'inactive';
    }

    /**
     * Format the time passed into a human-readable format.
     *
     * @param int $seconds
     * @return string
     */
    private function formatTimePassed($seconds)
    {
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);

        $seconds %= 60;
        $minutes %= 60;
        $hours %= 24;

        $timeParts = [];

        if ($days > 0) $timeParts[] = "{$days} days";
        if ($hours > 0) $timeParts[] = "{$hours} hours";
        if ($minutes > 0) $timeParts[] = "{$minutes} minutes";
        if ($seconds > 0) $timeParts[] = "{$seconds} seconds";

        return implode(', ', $timeParts);
    }
}
