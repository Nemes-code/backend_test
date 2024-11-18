<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest

{
    public function authorize()
    {
        return true; // Adjust this if you want to restrict access
    }

    // Hii ni function kwa ajili ya limiting the user to rate only within the ranges which are 1 and 5
    public function rules()
    {
        return [
            'rating' => 'required|integer|between:1,5', 
        ];
    }
}