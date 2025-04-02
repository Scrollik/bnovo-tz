<?php

namespace App\Repositories;

use App\Data\GuestData;
use App\Models\Guest;
use App\Repositories\Contracts\GuestRepositoryInterface;
use Illuminate\Support\Collection;

class GuestRepository implements GuestRepositoryInterface
{
    public function getAll(): ?Collection
    {
        return GuestData::collect(Guest::all());
    }

    public function getByIdOrFail(int $id): GuestData
    {
        return GuestData::from(Guest::findOrFail($id));
    }
}
