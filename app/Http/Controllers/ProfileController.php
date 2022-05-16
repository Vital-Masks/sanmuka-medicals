<?php

namespace App\Http\Controllers;

use App\checkout;
use App\checkout_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $checkouts = checkout::where(['user_id' => Auth::user()->id])->with('products')->orderByDesc('created_at')->paginate(5);

        if ($user->roles->pluck('name')->contains('administrator')) {
            return redirect()->route('dashboard');
        } else {
            return view('profile')->with(compact('checkouts'));
        }
    }
}
