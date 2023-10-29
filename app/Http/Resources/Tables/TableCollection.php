<?php

namespace App\Http\Resources\Tables;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TableCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
