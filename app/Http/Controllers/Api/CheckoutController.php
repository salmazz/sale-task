<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\CheckoutRequest;
use App\Services\Payment\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(CheckoutRequest $request) {

        $response = $this->checkoutService->pay($request->validated());

        return jsonResponse($response['message'], $response['data'], $response['code']);
    }
}
