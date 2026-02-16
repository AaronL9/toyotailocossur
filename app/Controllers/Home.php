<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex(): string
    {
        return view('home');
    }
    public function getShowroom(): string
    {
        echo "hellow worlds";
    }
}