<?php

namespace OmarMokhtar\HijriDate\Support;

use Carbon\Carbon;
use OmarMokhtar\HijriDate\Exceptions\InvalidDateException;

class HijriConverter
{
    /**
     * Convert Gregorian → Hijri
     */
    public function gregorianToHijri(Carbon $date): array
    {

        return [
            'day' => (int) $date->format('d'),
            'month' => [
                'number' => (int) $date->format('m'),
                'en' => 'Unknown',
                'ar' => 'غير محدد',
            ],
            'year' => (int) $date->format('Y') - 579,
        ];
    }

    /**
     * Convert Hijri → Gregorian
     */
    public function hijriToGregorian(int $day, int $month, int $year): array
    {
        if ($day < 1 || $day > 30 || $month < 1 || $month > 12) {
            throw new InvalidDateException('Invalid Hijri date values.');
        }

        $gregorianYear = $year + 579;

        return [
            'date' => sprintf('%02d-%02d-%d', $day, $month, $gregorianYear),
            'month' => [
                'number' => $month,
                'en' => 'Unknown',
            ],
            'year' => $gregorianYear,
        ];
    }
}
