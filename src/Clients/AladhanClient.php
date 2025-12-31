<?php

namespace OmarMokhtar\HijriDate\Clients;

use Illuminate\Support\Facades\Http;

class AladhanClient
{
    public function gregorianToHijri(string $date)
    {
        return Http::get('https://api.aladhan.com/v1/gToH', [
            'date' => $date
        ])['data']['hijri'];
    }

    public function hijriToGregorian(string $date)
    {
        return Http::get('https://api.aladhan.com/v1/hToG', [
            'date' => $date
        ])['data']['gregorian'];
    }
}
