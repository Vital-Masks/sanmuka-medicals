<?php

namespace App\Http\Controllers;

use App\Product;
use App\checkout;
use App\checkout_product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->back()->with('auth_error', 'You need to Login/Register before make an order.');
        }
        try {
            $request->validate([
                'firstName' => 'required|max:20',
                'lastName' => 'required|max:20',
                'nic' => 'required|regex: /^\d{9}[VvXx]$/',
                'phoneNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'required|email',
                'address' => 'required',
                'city' => 'required',
            ]);

          
            $order = checkout::create([
                'user_id' => Auth::user()->id,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'nic' => $request->nic,
                'phone' => $request->phoneNumber,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip,
                'orderNotes' => $request->message,
            ]);

            foreach (Cart::content() as $item) {
                checkout_product::create([
                    'checkout_id' => $order->id,
                    'product_id' => $item->model->id,
                    'qty' => $item->qty,
                    'subtotal' => $item->subtotal,
                    'size' => $item->options->size,
                ]);
            }
            Cart::destroy();
            return redirect()->route('confirmation', ['id' => $order->id]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function confirmation($id)
    {
        $checkout = checkout::where(['id' => $id])->first();
        $checkout_product = checkout_product::where(['checkout_id' => $id])->get();
        return view('confirmation')->with(compact('checkout', 'checkout_product'));;
    }
}
