<?php

namespace App\Http\Resources\Meal;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "price" => $this->price,
            "description" => $this->description,
            "available_quantity" => $this->available_quantity,
            "discount" => $this->discount,
        ];
    }
}
