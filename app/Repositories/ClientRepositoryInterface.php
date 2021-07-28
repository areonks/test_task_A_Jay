<?php

namespace App\Repositories;
interface ClientRepositoryInterface
{
    public function getAll($searchParams);

    public function create($newClient);

}
