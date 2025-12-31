<?php
namespace OmarMokhtar\HijriDate\Facades;

use Illuminate\Support\Facades\Facade;

class HijriDate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \OmarMokhtar\HijriDate\Services\HijriDateService::class;
    }
}
