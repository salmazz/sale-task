<?php

namespace App\Services\Payment;

use App\Repositories\Order\OrderRepository;
use Symfony\Component\HttpFoundation\Response;

class CheckoutService
{
    protected OrderRepository $orderRepository;
    protected TaxesAndServiceStrategyService $taxesAndServiceStrategyService;
    protected ServiceChargeOnlyStrategyService $chargeOnlyStrategyService;

    public function __construct(OrderRepository $orderRepository, TaxesAndServiceStrategyService $taxesAndServiceStrategyService, ServiceChargeOnlyStrategyService $chargeOnlyStrategyService)
    {
        $this->orderRepository = $orderRepository;
        $this->taxesAndServiceStrategyService = $taxesAndServiceStrategyService;
        $this->chargeOnlyStrategyService = $chargeOnlyStrategyService;
    }

    /**
     * @param $request
     * @return array
     */
    public function pay($request)
    {
        $order = $this->orderRepository->find($request['order_id']);

        if (!$order) {
            return [
                'message' => 'Order not found.',
                'data' => [],
                'code' => Response::HTTP_NOT_FOUND
            ];
        }

        $total = $order->total; // Calculate the total based on order details

        // TODO Edit this with enum
        if ($request['checkout_option'] == 1) {
           $total = $this->taxesAndServiceStrategyService->calculateTotal($total);
        } elseif ($request['checkout_option'] == 2) {
           $total =  $this->chargeOnlyStrategyService->calculateTotal($total);
        }

        $order->update(['paid' => 1, 'total' => $total]);

        return [
            'message' => 'Checkout Done successfully.',
            'data' => ['total' => $total], // Wrap $total in an array
            'code' => Response::HTTP_OK
        ];
    }
}
