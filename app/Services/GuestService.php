<?php

namespace App\Services;

use App\Data\GuestData;
use App\Models\Guest;
use App\Repositories\Contracts\GuestRepositoryInterface;
use libphonenumber\PhoneNumberUtil;

class GuestService
{
    public function store(array $data): GuestData
    {
        if (empty($data['country'])) {
            $data['country'] = $this->getCountryByPhone($data['phone']);
        }

        $guest = Guest::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'country' => $data['country'],
        ]);

        return GuestData::from($guest);
    }

    public function update(array $data, Guest $guest): GuestData
    {
        if (isset($data['phone']) && empty($data['country'])) {
            $data['country'] = $this->getCountryByPhone($data['phone']);
        }

        $guest->update([
            'first_name' => $data['firstName'] ?? $guest->first_name,
            'last_name' => $data['lastName'] ?? $guest->first_name,
            'phone' => $data['phone'] ?? $guest->phone,
            'email' => $data['email'] ?? $guest->email,
            'country' => $data['country'] ?? $guest->country,
        ]);

        return GuestData::from($guest);
    }

    public function destroy(Guest $guest): bool
    {
        return $guest->deleteOrFail();
    }

    private function getCountryByPhone(string $phone): ?string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $number = $phoneUtil->parse($phone, null);

        return $phoneUtil->getRegionCodeForNumber($number);
    }
}
