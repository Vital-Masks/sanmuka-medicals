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
        $subcategories = SubCategory::all();

        if(request()->category){
            $products = Product::with('images')->where('category_id', request()->category)->paginate($pagination);
            $categoryName = optional($categories->where('id', request()->category)->first())->name;
        }elseif(request()->subcategory){
            $products = Product::with('images')->where('sub_category_id', request()->subcategory)->paginate($pagination);
            $categoryName = optional($subcategories->where('id', request()->subcategory)->first())->name;
        }
        else{
            $products = Product::with('images')->orderByDesc('id')->paginate($pagination);
            $categoryName = 'Featured';
        }

        // echo "<pre>"; print_r($products->categories->name); die;

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'subcategories' => $subcategories
            ]);
    }


    public function show($id){
        $product = Product::where('id', $id)->firstOrFail();
        $mightAlsoLike = Product::with('images')->where('category_id', '!=', $product->category_id)->mightAlsoLike()->get();
        $img = Images::where(['product_id' => $id])->first();
        $images = Images::where(['product_id' => $id])->get();
        $sizes = ProductSize::where(['product_id' => $id])->get();
        return view('product')
        ->with(compact('product','mightAlsoLike', 'images','img','sizes'));
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
