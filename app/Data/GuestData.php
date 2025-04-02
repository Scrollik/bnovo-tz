<?php

namespace App\Data;

use App\Models\Guest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Concerns\WithDeprecatedCollectionMethod;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class GuestData extends Data
{
    use WithDeprecatedCollectionMethod;
    public function __construct(
        public ?int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $country,
    )
    {
    }

    public static function fromModel(Guest $guest): self
    {
        return new self(
            $guest->id,
            $guest->first_name,
            $guest->last_name,
            $guest->email,
            $guest->phone,
            $guest->country,
        );
    }
}
