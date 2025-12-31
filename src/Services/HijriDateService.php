<?php

namespace OmarMokhtar\HijriDate\Services;

use Illuminate\Support\Facades\Cache;
use OmarMokhtar\HijriDate\Support\HijriConverter;
use OmarMokhtar\HijriDate\Support\DateParser;

class HijriDateService
{
    protected HijriConverter $converter;

    public function __construct()
    {
        $this->converter = new HijriConverter();
    }

    public function todayHijri()
    {
        return Cache::remember(
            'hijri_today',
            config('hijri-date.cache_ttl'),
            fn() => $this->converter->gregorianToHijri(now())
        );
    }

    public function fromGregorian($date, ?string $timezone = null)
    {
        $carbon = DateParser::parse($date, $timezone);
        return $this->converter->gregorianToHijri($carbon);
    }

    public function fromHijri(int $day, int $month, int $year)
    {
        return $this->converter->hijriToGregorian($day, $month, $year);
    }

    public function fromHijriString(string $date)
    {
        $date = str_replace('-', '/', $date);
        $parts = explode('/', $date);

        if (count($parts) !== 3) {
            throw new \Exception("Invalid Hijri date format. Use DD/MM/YYYY or YYYY/MM/DD");
        }

        if ((int)$parts[0] > 31) {
            [$year, $month, $day] = $parts;
        } else {
            [$day, $month, $year] = $parts;
        }

        return $this->fromHijri((int)$day, (int)$month, (int)$year);
    }

    public function parse($date, ?string $type = null, ?string $timezone = null)
    {
        if ($type === 'hijri') {
            if (is_array($date)) {
                return $this->fromHijri($date['day'], $date['month'], $date['year']);
            }
            return $this->fromHijriString($date);
        }

        if (is_array($date)) {
            return $this->fromHijri($date['day'], $date['month'], $date['year']);
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
}
