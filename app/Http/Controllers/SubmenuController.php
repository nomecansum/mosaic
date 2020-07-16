<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    function create()
    {
        return view('submenus.lock');
    }
}
