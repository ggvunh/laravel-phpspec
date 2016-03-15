<?php

namespace spec\App\Http\Controllers;

use Prophecy\Argument;
use Tests\SpecTest;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryControllerSpec extends SpecTest
{

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\CategoryController');
    }

    function it_is_create_error(Request $request)
    {
        // tests no input
        $request->all()->willReturn([]);

        $res = $this->store($request);
        $result = json_decode($res->getContent()->getWrappedObject());
        $res->getStatuscode()->shouldReturn(400);
        $res->getContent()->shouldHaveKey('errors');
        $res->getContent()->shouldEqual('The name field is required.', $result->errors->name[0]);
        $res->getContent()->shouldEqual('The name field is required.', $result->message);

        // test input is null
        $request->all()->willReturn([
            'name' => ''
        ]);

        $res = $this->store($request);
        $result = json_decode($res->getContent()->getWrappedObject());
        $res->getStatuscode()->shouldReturn(400);
        $res->getContent()->shouldHaveKey('errors');
        $res->getContent()->shouldEqual('The name field is required.', $result->errors->name[0]);
        $res->getContent()->shouldEqual('The name field is required.', $result->message);

        // test unique name
        $category = factory(Category::class)->create();
        $request->all()->willReturn([
            'name' => $category->name
        ]);

        $res = $this->store($request);
        $result = json_decode($res->getContent()->getWrappedObject());
        $res->getStatuscode()->shouldReturn(400);
        $res->getContent()->shouldHaveKey('errors');
        $res->getContent()->shouldEqual('The name has already been taken.', $result->errors->name[0]);
        $res->getContent()->shouldEqual('The name has already been taken.', $result->message);
    }

    function it_should_be_create_success(Request $request)
    {
        $request->all()->willReturn([
            'name'        => 'nguyen',
        ]);

        $res = $this->store($request);
        $result = json_decode($res->getContent()->getWrappedObject());
        $res->getStatuscode()->shouldReturn(201);
        $res->getContent()->shouldEqual('nguyen', $result->entities[0]->name);
        $res->getContent()->shouldEqual(null, $result->entities[0]->description);
        $res->getContent()->shouldHaveKey('entities');
        $res->getContent()->shouldHaveKey('meta');
        $res->getContent()->shouldHaveKey('version');
    }
}
