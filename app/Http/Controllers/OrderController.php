<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Business\AbilitiesResolver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        AbilitiesResolver::autorize('orders.index');
        $orders = Order::when(Auth::user()->role === 'cliente', function ($query) {
            $query->where('user_id', Auth::id())->orderBy('id', 'desc');
        })->paginate(10);

        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            AbilitiesResolver::autorize('orders.store');
            $user = Auth::user();
            Cart::restore($user->email);

            $order = Order::create([
                'order_code' => 'ORD_' . time(),
                'customer_name' => $request->customer_name,
                'customer_ap_paterno' => $request->customer_ap_paterno,
                'customer_ap_materno' => $request->customer_ap_materno,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_email' => $user->email,
                'customer_note' => $request->customer_note,
                'payment_method' => $request->payment_method,
                'subtotal' => Cart::subtotal(),
                'tax' => Cart::tax(),
                'total' => Cart::total(),
                'status' => 'pending',
                'user_id' => $user->id,
            ]);

            if (Cart::count() === 0) {
                return response()->json([
                    'message' => 'No hay productos en el carrito',
                ], 400);
            }

            Cart::content()->each(function ($item) use ($order) {
                $order->orderDetails()->create([
                    'product_name' => $item->name,
                    'product_price' => $item->price,
                    'product_qty' => $item->qty,
                    'product_subtotal' => $item->subtotal,
                ]);
            });

            Cart::destroy();

            DB::commit();

            $order->load('orderDetails');

            return new OrderResource($order);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Ocurrió un error al realizar el pedido',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
