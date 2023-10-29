<?php

namespace App\Services;

use App\Http\Resources\Meal\MealCollection;
use App\Repositories\Menu\MealRepository;

class MealService
{

    protected MealRepository $mealRepository;

    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    /**
     * @return array
     */
    public function listItems()
    {
        $meals = $this->mealRepository->where('available_quantity', '>', 0)->get();
        if ($meals->isNotEmpty()) {
            $response['data'] = ["meals" => new MealCollection($meals)];
            $response['message'] = 'Meals with negative available quantities found.';
            $response['code'] = \Symfony\Component\HttpFoundation\Response::HTTP_OK;
        } else {
            $response['data'] = null;
            $response['message'] = 'No meals with negative available quantities found.';
            $response['code'] = \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED;
        }

        return $response;
    }
}
