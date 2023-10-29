<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Meal\MealCollection;
use App\Services\MealService;

class MealController extends Controller
{
    public MealService $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listMenuItems() {
        $response = $this->mealService->listItems();

        return jsonResponse($response['message'],["meals" => $response['data']['meals']] ,$response['code']);
    }
}
