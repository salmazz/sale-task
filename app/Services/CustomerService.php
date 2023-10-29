<?php

namespace App\Services;

use App\Repositories\User\UserRepository;

class CustomerService{

    protected UserRepository $customerRepository;

    public function __construct(UserRepository $customerRepository)
    {

    }
}
