<?php

namespace Tests;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Illuminate\Support\Facades\Artisan;


class SpecTest extends LaravelObjectBehavior
{
    function letGo()
    {
        Artisan::call('migrate');
    }
}
