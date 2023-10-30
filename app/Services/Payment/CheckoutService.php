<?php

namespace App\Services\Payment;

use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckoutService
{
    protected OrderRepository $orderRepository;
    protected InvoiceRepository $invoiceRepository;
    protected TaxesAndServiceStrategyService $taxesAndServiceStrategyService;
    protected ServiceChargeOnlyStrategyService $chargeOnlyStrategyService;

    public function __construct(OrderRepository $orderRepository, TaxesAndServiceStrategyService $taxesAndServiceStrategyService, ServiceChargeOnlyStrategyService $chargeOnlyStrategyService, InvoiceRepository $invoiceRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->taxesAndServiceStrategyService = $taxesAndServiceStrategyService;
        $this->chargeOnlyStrategyService = $chargeOnlyStrategyService;

    }

    public function pay($request)
    {
        $order = $this->orderRepository->find($request['order_id']);

        if (!$order) {
            return $this->getResponse('Order not found', Response::HTTP_NOT_FOUND);
        }

        if ($order->isPaid()) {
            return $this->getResponse('Order is already paid', Response::HTTP_OK, ['total' => number_format($order->total, 2)]);
        }

        $total = $this->calculateTotal($order, $request['checkout_option']);

        $invoice = $this->createInvoice($order, $total);

        $this->updateOrderAndMarkPaid($order, $invoice->total);

        return $this->getResponse('Checkout Done successfully', Response::HTTP_OK, ['total' => $total]);
    }

    private function getResponse($message, $code, $data = [])
    {
        return [
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }

    private function calculateTotal($order, $checkoutOption)
    {
        $total = number_format($order->total, 2);

        if ($checkoutOption == 1) {
            return $this->taxesAndServiceStrategyService->calculateTotal($total);
        } elseif ($checkoutOption == 2) {
            return $this->chargeOnlyStrategyService->calculateTotal($total);
        }

        return $total;
    }

    private function createInvoice($order, $total)
    {
        return $this->invoiceRepository->firstOrCreate([
            'order_id' => $order->id,
            'user_id' => Auth::user()->id,
            'customer_id' => $order->customer_id,
            'total' => $total
        ]);
    }

    private function updateOrderAndMarkPaid($order, $total)
    {
        $order->update(['paid' => 1, 'total' => $total]);
    }
}
