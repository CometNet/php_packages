<?php

namespace Huixing\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use Huixing\Admin\App;

class Admin extends Facade {

    protected static function getFacadeAccessor()
    {
        return App::class;
    }
}
