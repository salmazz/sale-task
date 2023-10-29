<?php

namespace App\Services;

use App\Events\DecreaseAmountMealEveryOrder;
use App\Http\Resources\Order\OrderResource;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Menu\MealRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\Table\TableRepository;
use App\Repositories\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    protected OrderRepository $orderRepository;
    protected CustomerRepository $customerRepository;
    protected UserRepository $userRepository;
    protected TableRepository $tableRepository;
    protected MealRepository $mealRepository;
    protected OrderDetailRepository $orderDetailRepository;


    public function __construct(OrderRepository $orderRepository,
                                TableRepository $tableRepository, CustomerRepository $customerRepository,
                                UserRepository  $userRepository, MealRepository $mealRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->tableRepository = $tableRepository;
        $this->customerRepository = $customerRepository;
        $this->userRepository = $userRepository;
        $this->mealRepository = $mealRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function placeOrder($request)
    {
        $table = $this->tableRepository->find($request['table_id']);
        $customer = $this->customerRepository->find($request['customer_id']);
        $user = $this->userRepository->find($request['user_id']);

        if (!$table || !$customer || !$user) {
            $response['data'] = [];
            $response['message'] = 'Table, customer, or user not found.';
            $response['code'] = Response::HTTP_NOT_FOUND;
        }

        $total = 0;
        $order = $this->createOrder($table, $customer, $user, $request['reservation_id'], $total, $request['order_items']);

        if (!$order) {
            $response['data'] = [];
            $response['message'] = 'Failed to create an order..';
            $response['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }


        $response['data'] = ["Order" => new OrderResource($order)];
        $response['message'] = 'Order placed successfully.';
        $response['code'] = Response::HTTP_OK;

        return $response;
    }

    private function createOrder($table, $customer, $user, $reservationId, $total, $orderItems)
    {
        $order = $this->orderRepository->create([
            'table_id' => $table->id,
            'reservation_id' => $reservationId,
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'total' => 0, // Initialize the total as 0
            'paid' => false,
            'date' => now(),
        ]);

        $total = $this->createOrderDetails($order, $orderItems); // Pass $total by reference

        // Update the order with the calculated total
        $order->total = $total;
        $order->save();

        return $order;
    }

    private function createOrderDetails($order, $orderItems)
    {
        $total = 0; // Initialize the total outside the loop

        foreach ($orderItems as $item) {
            $mealId = $item['meal_id'];
            $quantity = $item['quantity']; // Assuming you have a quantity field in the request

            $meal = $this->mealRepository->find($mealId);

            if ($meal) {
                $amountToPay = $meal->price * $quantity;
                $total += $amountToPay;


                // Insert the order details into the database
                $this->orderDetailRepository->create([
                    'order_id' => $order->id,
                    'meal_id' => $mealId,
                    'quantity' => $quantity,
                    'amount_to_pay' => $amountToPay,
                ]);
            }
        }

        event(new DecreaseAmountMealEveryOrder($order->id));

        return $total;
    }
}
