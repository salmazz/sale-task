<?php

namespace App\Repositories\Table\Eloquent;

use App\Models\Table;
use App\Repositories\Table\TableRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TableRepositoryEloquent extends BaseRepository implements TableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Table::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
