<?php

namespace App\Repositories\Reservation;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TestRepository.
 *
 * @package namespace App\Repositories;
 */
interface ReservationRepository extends RepositoryInterface
{
    public function scopeIsTableAvailableDuring( $tableId, $fromTime, $toTime,);
}
