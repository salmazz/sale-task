<?php

namespace App\Services;

use App\Http\Resources\Reservation\ReservationResource;
use App\Repositories\Reservation\ReservationRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ReservationService
{
    protected ReservationRepository $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function createReservation($request)
    {

        $existingReservation = $this->reservationRepository->scopeIsTableAvailableDuring($request['table_id'], $request['from_time'], $request['to_time']);

        if ($existingReservation) {
            return [
                'message' => 'Table is already reserved for the specified time',
                'data' => ["reservation" => new ReservationResource($existingReservation)],
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
        DB::beginTransaction();

        try {
            $this->reservationRepository->create($request);
            DB::commit();

            return [
                'message' => 'Reservation created successfully.',
                'data' => ["reservation" => new ReservationResource($existingReservation)],
                'code' => Response::HTTP_OK
            ];
        } catch (\Exception $e) {

            DB::rollBack();


            return [
                'message' => 'Transaction failed. Rollback performed.',
                'data' => [],
                'code' => Response::HTTP_EXPECTATION_FAILED
            ];
        }
    }

}
