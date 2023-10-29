<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CheckAvailabiltyRequest;
use App\Http\Resources\Tables\TableCollection;
use App\Services\TableService;
use Symfony\Component\HttpFoundation\Response;

class TableController extends Controller
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function checkAvailability(CheckAvailabiltyRequest $request)
    {
        $response = $this->tableService->checkAvailability($request);

        return  jsonResponse( $response['message'], $response['data'], $response['code']);
    }
}
