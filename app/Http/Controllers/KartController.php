<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;

class KartController extends Controller
{
    public function mostrarCarrito(){

        return view ('kart.index');
    }
}
