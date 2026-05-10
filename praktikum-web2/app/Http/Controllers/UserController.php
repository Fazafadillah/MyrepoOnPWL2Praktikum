<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index($name = null)
    {
        // tidak pakai parameter
        // return view('greeting', ['name' => 'John Doe']);

        // pakai parameter
        return view('greeting', ['name' => $name]);
    }
    
}
