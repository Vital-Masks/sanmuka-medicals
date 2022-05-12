<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->get(4);
        return view('home')->with(compact('products'));
    }

    public function privacy()
    {
        dd('hello');
        return view('privacy');
    }

    public function condition()
    {
        return view('conditions');
    }

    public function delivery()
    {
        return view('delivery-decription');
    }
}
