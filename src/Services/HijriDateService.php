<?php

namespace OmarMokhtar\HijriDate\Services;

use Illuminate\Support\Facades\Cache;
use OmarMokhtar\HijriDate\Clients\AladhanClient;
use OmarMokhtar\HijriDate\Support\DateParser;

class HijriDateService
{
    public function todayHijri()
    {
        return Cache::remember(
            'hijri_today',
            config('hijri-date.cache_ttl'),
            fn() => app(AladhanClient::class)
                ->gregorianToHijri(now()->format('d-m-Y'))
        );
    }

    public function fromGregorian($date, ?string $timezone = null)
    {
        $carbon = DateParser::parse($date, $timezone);

        return app(AladhanClient::class)
            ->gregorianToHijri($carbon->format('d-m-Y'));
    }

    public function fromHijri(int $day, int $month, int $year)
    {
        $date = "{$day}-{$month}-{$year}";

        return app(AladhanClient::class)
            ->hijriToGregorian($date);
    }

    public function parse($date, ?string $type = null, ?string $timezone = null)
    {
        if ($type === 'hijri') {
            if (is_array($date)) {
                return $this->fromHijri(
                    $date['day'],
                    $date['month'],
                    $date['year']
                );
            }

            return $this->fromHijriString($date);
        }

        if (is_array($date)) {
            return $this->fromHijri(
                $date['day'],
                $date['month'],
                $date['year']
            );
        }

        if (preg_match('/^\d{1,2}[\/\-]\d{1,2}[\/\-]\d{3,4}$/', $date)) {
            $parts = preg_split('/[\/\-]/', $date);
            $year = (int)$parts[2];
            if ($year > 1300) {
                return $this->fromHijriString($date);
            }
        }

        return $this->fromGregorian($date, $timezone);
    }


    public function fromHijriString(string $date)
    {
        $date = str_replace('-', '/', $date);
        $parts = explode('/', $date);

        if (count($parts) !== 3) {
            throw new \Exception("Invalid Hijri date format. Use d/m/Y or d-m-Y");
        }

        [$day, $month, $year] = $parts;

        return $this->fromHijri((int)$day, (int)$month, (int)$year);
    }
}
