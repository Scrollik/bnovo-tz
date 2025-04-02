<?php

namespace App\Http\Resources;

use App\Data\GuestData;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="GuestResource",
 *     @OA\Property(property="id",type="integer",format="int64",default=1),
 *     @OA\Property(property="firstName",type="string",default="test"),
 *     @OA\Property(property="lastName",type="string",default="test"),
 *     @OA\Property(property="email",type="string",default="test@test.ru"),
 *     @OA\Property(property="phone",type="string",default="+79998887766"),
 *     @OA\Property(property="country",type="string",default="ru"),
 * )
 * @mixin GuestData
 */
class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
        ];
    }
}
