<?php


namespace Tomeet\Uploader\Facades;


use Illuminate\Support\Facades\Facade;

class Uploader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'uploader';
    }
}
