<?php

namespace App\Repositories;
interface ClientRepositoryInterface
{
    public function getSearched($request);

    public function post($request);

}
