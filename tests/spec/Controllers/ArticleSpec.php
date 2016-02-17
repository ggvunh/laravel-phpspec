<?php

namespace spec\App\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use PhpSpec\Laravel\LaravelObjectBehavior;
use App\User;
use Illuminate\Support\Facades\Artisan;

class ArticleSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Controllers\Article');
    }

    function it_converts_plain_text_to_html_paragraphs()
    {
        $this->toHtml("Hi, there")->shouldReturn("<p>Hi, there</p>");
    }

    function it_encrypts_a_string()
    {
        $this->encrypt('123')->shouldBeString();
        $string = $this->encrypt('password')->getWrappedObject();
        Artisan::call('migrate');
        $user = User::find(1);
        dump($user);

    }
}
