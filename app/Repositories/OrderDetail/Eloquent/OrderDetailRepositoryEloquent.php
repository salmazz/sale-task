<?php

namespace App\Repositories\OrderDetail\Eloquent;

use App\Models\OrderDetail;
use App\Repositories\OrderDetail\OrderDetailRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderDetailRepositoryEloquent extends BaseRepository implements OrderDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderDetail::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
