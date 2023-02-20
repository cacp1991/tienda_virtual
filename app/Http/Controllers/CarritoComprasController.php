<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoComprasController extends Controller
{
    public function MostrarCarrito(){

        return view ('kart.carritocompras');
    }
}
