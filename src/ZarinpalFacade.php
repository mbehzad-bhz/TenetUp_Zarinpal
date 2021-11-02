<?php


namespace TenetUp\Zarinpal;


use Illuminate\Support\Facades\Facade;

class ZarinpalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zarinpal';
    }
}
