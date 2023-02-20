<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }

    //vista de home principal despues de login

    public function index()
    {
        return view('principal.index');
    }
}
