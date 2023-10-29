<?php

namespace App\Repositories\Menu\Eloquent;

use App\Models\Meal;
use App\Repositories\Menu\MealRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MealRepositoryEloquent extends BaseRepository implements MealRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Meal::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
