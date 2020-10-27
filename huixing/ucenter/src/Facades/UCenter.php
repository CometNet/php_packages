<?php

namespace Huixing\UCenter\Facades;

use Illuminate\Support\Facades\Facade;
use Huixing\UCenter\App;


class UCenter extends Facade {

    protected static function getFacadeAccessor()
    {
        return App::class;
    }
}
