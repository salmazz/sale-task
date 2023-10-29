<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "table_id" => $this->table_id,
            "reservation_id" => $this->reservation_id,
            "customer_id" => new CustomerResource($this->customer),
            "user_id" => new UserResource($this->user),
            "total" => $this->total,
            "paid" => $this->paid,
            "date" => $this->date,
        ];
    }
}
