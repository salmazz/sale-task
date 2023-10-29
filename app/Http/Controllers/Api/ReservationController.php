<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\ReserveTableRequest;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    public ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function reserveTable(ReserveTableRequest $request)
    {
        $response =  $this->reservationService->createReservation($request->validated());

        return  jsonResponse($response['message'] ,['reservation' => $response['data']['reservation']], $response['code']);
    }
}
