<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Business\AbilitiesResolver;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        AbilitiesResolver::autorize('cart.index');
        Cart::restore(Auth::user()->email);
        Cart::store(Auth::user()->email);
        return Cart::content();
    }

    public function store(Product $product)
    {
        AbilitiesResolver::autorize('cart.store');
        $this->validate(request(), [
            'qty' => 'required|numeric|min:1'
        ]);

        Cart::restore(Auth::user()->email);
        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->nombre,
                'qty' => request('qty'),
                'price' => $product->precio,
                'weight' => 0,
            ]
        );
        Cart::store(Auth::user()->email);

        return Cart::content();
    }

    public function update($rowId)
    {
        AbilitiesResolver::autorize('cart.update');
        $this->validate(request(), [
            'qty' => 'required|numeric|min:1'
        ]);

        Cart::restore(Auth::user()->email);
        Cart::update($rowId, request('qty'));
        Cart::store(Auth::user()->email);
        return Cart::content();
    }

    public function destroy($rowId)
    {
        AbilitiesResolver::autorize('cart.destroy');
        Cart::restore(Auth::user()->email);
        Cart::remove($rowId);
        Cart::store(Auth::user()->email);
        return Cart::content();
    }
}
