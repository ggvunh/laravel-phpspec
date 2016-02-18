<?php

namespace spec\App\Http\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tests\SpecTest;
use App\Category;
class CategoryControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\CategoryController');
    }
}
