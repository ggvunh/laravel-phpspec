<?php

namespace App\Controllers;

class Article
{
    public function toHtml($argument1)
    {
        return "<p>Hi, there</p>";
    }

    public function encrypt($arg)
    {
        return bcrypt($arg);
    }
}
