<?php

namespace App\Repositories\Reservation\Eloquent;

use App\Models\Reservation;
use App\Repositories\Reservation\ReservationRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReservationRepositoryEloquent extends BaseRepository implements ReservationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reservation::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function scopeIsTableAvailableDuring($tableId,$fromTime, $toTime,)
    {
        return $this->model->where('table_id', $tableId)
            ->where(function ($query) use ($fromTime, $toTime) {
                $query->where(function ($q) use ($fromTime, $toTime) {
                    $q->where('from_time', '>=', $fromTime)
                        ->where('from_time', '<', $toTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->where('to_time', '>', $fromTime)
                        ->where('to_time', '<=', $toTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->where('from_time', '<', $fromTime)
                        ->where('to_time', '>', $toTime);
                });
            })->first();
    }
}
