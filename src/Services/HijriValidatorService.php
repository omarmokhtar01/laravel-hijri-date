<?php

namespace OmarMokhtar\HijriDate\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HijriValidatorService
{
    protected HijriDateService $hijri;

    public function __construct(HijriDateService $hijri)
    {
        $this->hijri = $hijri;
    }

    public function validateToday()
    {
        $local = $this->hijri->todayHijri();

        $external = $this->getExternalHijriDate();

        if ($local['day'] != $external['day'] ||
            $local['month']['number'] != $external['month']['number'] ||
            $local['year'] != $external['year']
        ) {
            Log::warning('Hijri date mismatch!', [
                'local' => $local,
                'external' => $external
            ]);
        }

        return $local;
    }

    protected function getExternalHijriDate()
    {
        $response = Http::get('http://api.aladhan.com/v1/gToH', [
            'date' => now()->format('d-m-Y')
        ]);

        $data = $response->json()['data']['hijri'];

        return [
            'day' => (int)$data['day'],
            'month' => [
                'number' => (int)$data['month']['number'],
                'en' => $data['month']['en'],
                'ar' => $data['month']['ar']
            ],
            'year' => (int)$data['year']
        ];
    }
}
