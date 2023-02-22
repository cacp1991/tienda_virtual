<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Carrodecompras;

class CarritoComprasController extends Controller
{
    public function MostrarCarrito()
    {

        return view('kart.carritocompras');
    }

    public function loadCartByUser(User $user)
    {

        $customer = $user->load('CarritoCompras')->get();
        return response()->json(['shopping_cart' => $user], 200);
    }


    public function getAllCarrodecompras(Carrodecompras $cart)
    {
        $cart = Carrodecompras::with('Product', 'Category')->get();
        // // dd($cart);
        return response()->json(['cart' => $cart], 200);
    }

    public function addToCart(Request $request)
    {
        try {
            $cart = new Carrodecompras($request->all());
            $cart->save();
            return back()->with('success', 'Product added successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteItem(Carrodecompras $cart)
    {
        $cart->delete();
        return response()->json([], 204);
    }
}
