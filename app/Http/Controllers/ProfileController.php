<?php

namespace App\Http\Controllers;

use App\checkout;
use App\checkout_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $checkout = checkout::where(['user_id' => Auth::user()->id])->with('products')->first();

        if ($user->roles->pluck('name')->contains('administrator')) {
            return redirect()->route('dashboard');
        } else {
            return view('profile')->with(compact('checkout'));
        }
    }
}
