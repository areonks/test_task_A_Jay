<?php

namespace App\Repositories;
interface ClientRepositoryInterface
{
    public function getAllSearchedUsing($request);

    public function post($request);

}
