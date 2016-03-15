<?php

namespace Tests;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Illuminate\Support\Facades\Artisan;

class SpecTest extends LaravelObjectBehavior
{
    function let()
    {
        Artisan::call('migrate');
    }

    function letGo()
    {
        Artisan::call('migrate:reset');
    }

    public function getMatchers()
    {
        return [
            'haveKeyMatchValue' => function ($subject, $key, $values) {

                return json_decode($subject)->$key == $values;
            },
            'haveKey' => function ($subject, $key) {

                return property_exists(json_decode($subject), $key);
            },
            'equal' => function ($subject, $expect, $result) {

                return $expect == $result;
            }
        ];
    }
}
