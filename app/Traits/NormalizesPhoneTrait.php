<?php

namespace App\Traits;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

trait NormalizesPhoneTrait
{
    protected function normalizePhone(string $phone): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsedNumber = $phoneUtil->parse($phone, null);

        return $phoneUtil->format($parsedNumber, PhoneNumberFormat::E164);
    }
}
