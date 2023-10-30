<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\Eloquent\CustomerRepositoryEloquent;
use App\Repositories\Invoice\Eloquent\InvoiceRepositoryEloquent;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Menu\Eloquent\MealRepositoryEloquent;
use App\Repositories\Menu\MealRepository;
use App\Repositories\Order\Eloquent\OrderRepositoryEloquent;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderDetail\Eloquent\OrderDetailRepositoryEloquent;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\Reservation\Eloquent\ReservationRepositoryEloquent;
use App\Repositories\Reservation\ReservationRepository;
use App\Repositories\Table\Eloquent\TableRepositoryEloquent;
use App\Repositories\Table\TableRepository;
use App\Repositories\User\Eloquent\UserRepositoryEloquent;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Reservation Repository
        $this->app->bind(ReservationRepository::class,
            ReservationRepositoryEloquent::class);

        // Table Repository
        $this->app->bind(TableRepository::class,
            TableRepositoryEloquent::class);

        // Meal Repository
        $this->app->bind(MealRepository::class,
            MealRepositoryEloquent::class);

        // Customer Repository
        $this->app->bind(CustomerRepository::class,
            CustomerRepositoryEloquent::class);


        // User Repository
        $this->app->bind(UserRepository::class,
            UserRepositoryEloquent::class);

        // Order Repository
        $this->app->bind(OrderRepository::class,
            OrderRepositoryEloquent::class);

        // Meal Repository
        $this->app->bind(OrderDetailRepository::class,
            OrderDetailRepositoryEloquent::class);


        // Invoice Repository
        $this->app->bind(InvoiceRepository::class,
            InvoiceRepositoryEloquent::class);
    }
}
