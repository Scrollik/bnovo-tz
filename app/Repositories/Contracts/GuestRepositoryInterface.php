<?php

namespace App\Repositories\Contracts;

use App\Data\GuestData;
use Illuminate\Support\Collection;

interface GuestRepositoryInterface
{
    public function getAll(): ?Collection;

    public function getByIdOrFail(int $id): GuestData;
}
