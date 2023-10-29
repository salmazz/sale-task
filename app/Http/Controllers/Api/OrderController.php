<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Meal\MealCollection;
use App\Services\OrderService;

class OrderController extends Controller
{
    public OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param StoreOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function placeOrder(StoreOrderRequest $request)
    {
        $response = $this->orderService->placeOrder($request->validated());
        return jsonResponse($response['message'], $response['data'], $response['code']);
    }
}
