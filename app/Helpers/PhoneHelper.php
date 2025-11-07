<?php

namespace App\Helpers;

class PhoneHelper
{
    public static function formatPhone(?string $phone): ?string
    {
        if (!$phone) return null;

        $phone = preg_replace('/\D/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '+381' . substr($phone, 1);
        } elseif (substr($phone, 0, 3) !== '381') {
            $phone = '+381' . $phone;
        } else {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
