<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Images;
use App\ProductSize;

class ShopController extends Controller
{
    public function index(){

        $pagination = 9;
        
        $categories = Category::all();

        if(request()->category){
            $products = Product::with('images')->where('category_id', request()->category)->paginate($pagination);
            $categoryName = optional($categories->where('id', request()->category)->first())->name;
        }
        else{
            $products = Product::with('images')->orderByDesc('id')->paginate($pagination);
            $categoryName = 'Featured';
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            ]);
    }


    public function show($id){
        $product = Product::where('id', $id)->with('images','sizes')->firstOrFail();
        $mightAlsoLike = Product::with('images')->where('category_id', '!=', $product->category_id)->mightAlsoLike()->get();
        return view('product')
        ->with(compact('product','mightAlsoLike'));
    }

    public function search(Request $request){

        $pagination = 9;
        
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $searchName = 'Search Product';
     
        $query = $request->search;
        $products = Product::with('images')->where('title','LIKE', "%$query%")->paginate($pagination);

        // dd($products);
        
        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'searchName' => $searchName,
            'subcategories' => $subcategories
            ]);
    }
}
