<?php

namespace App\Services;

use App\Events\CustomersAddedToWaitingList;
use App\Http\Resources\Meal\MealCollection;
use App\Http\Resources\Tables\TableCollection;
use App\Http\Resources\Tables\TableResource;
use App\Repositories\Table\TableRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class TableService{

    protected TableRepository $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function checkAvailability($request)
    {
        $tableAvailable = $this->getAvailableTables($request);

        if ($tableAvailable->count() > 0) {
            $response['data'] = ["tables" => new TableCollection($tableAvailable)];
            $response['message'] = "Tables Retrieved";
            $response['code'] =  \Symfony\Component\HttpFoundation\Response::HTTP_OK;

        } else {
          if($request->waiting_list == true){
                event(new CustomersAddedToWaitingList( $request->customer_id, $request->capacity, $request->from_time, $request->to_time));
            }

            $response['data'] = null;
            $response['message'] = "No Tables Available now";
            $response['code'] =  \Symfony\Component\HttpFoundation\Response::HTTP_OK;
        }
        return $response;
    }

    public function getAvailableTables($request){
        $fromTime = Carbon::parse($request->fromTime);
        $toTime = Carbon::parse($request->toTime);
        return $this->tableRepository
            ->where('capacity', '>=', $request->capacity)
            ->whereDoesntHave('reservations', function ($q) use ($toTime, $fromTime) {
                $q->where('from_time', '<', $fromTime)
                    ->where('to_time', '>', $toTime);
            })
            ->get();
    }
}
