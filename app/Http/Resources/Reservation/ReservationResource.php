<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Tables\TableResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            "table" => new TableResource($this->table) ?? '',
            "customer" => new CustomerResource($this->customer) ?? '',
            "from_time" => $this->from_time,
            "to_time" => $this->to_time,
        ];
    }
}
