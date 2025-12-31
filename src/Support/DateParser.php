<?php
namespace OmarMokhtar\HijriDate\Support;

use Carbon\Carbon;
use DateTime;
use OmarMokhtar\HijriDate\Exceptions\InvalidDateException;

class DateParser
{
    public static function parse($date, ?string $timezone = null): Carbon
    {
        if ($date instanceof Carbon) {
            return $date;
        }

        if ($date instanceof DateTime) {
            return Carbon::instance($date);
        }

        if (is_string($date)) {
            $date = str_replace('/', '-', $date);

            try {
                return Carbon::createFromFormat(
                    'd-m-Y',
                    $date,
                    $timezone
                );
            } catch (\Exception $e) {
                throw new InvalidDateException('Invalid Gregorian date format.');
            }
        }

        throw new InvalidDateException('Unsupported date type.');
    }
}
