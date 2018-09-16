<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function to_register()
    {
        return view('home.register');
    }

    public function do_register(Request $request)
    {
        dd($request->all());
    }
}
