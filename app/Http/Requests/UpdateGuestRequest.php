<?php

namespace App\Http\Requests;

use App\Rules\CountryRule;
use App\Rules\PhoneRule;
use App\Traits\NormalizesPhoneTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
* @OA\RequestBody(
 *     request="UpdateGuestRequest",
 *     required=true,
 *     @OA\JsonContent(
 *         allOf={
 *             @OA\Schema(
 *                 @OA\Property(property="firstName", type="string"),
 *                 @OA\Property(property="lastName", type="string"),
 *                 @OA\Property(property="phone", type="string", default="+79998887766"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="country", type="string", default="RU"),
 *             )
 *         }
 *     )
 * )
 */
class UpdateGuestRequest extends FormRequest
{
    use NormalizesPhoneTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => $this->normalizePhone($this->input('phone')),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'phone' => ['nullable', 'string', 'unique:guests,phone', new PhoneRule()],
            'email' => 'nullable|email|unique:guests,email',
            'country' => ['nullable', new CountryRule()],
        ];
    }
}
