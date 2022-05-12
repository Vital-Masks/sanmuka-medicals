<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Images;
use App\Brands;
use App\ProductSize;
use Facade\FlareClient\Stacktrace\File;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;

        $products = Product::orderByDesc('id')->paginate($pagination);
        return view('admin.products')->with('products', $products);
    }



    /// Add Product
    ////////////////////////////////////////////////////////////////
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'ProductTitle' => 'required|max:255',
                'BrandName' => 'required',
                'MainCategoryName' => 'required',
                'inputDescription' => 'required',
            ]);

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $product = new Product;
            $product->category_id = $data['MainCategoryName'];
            $product->brand_id = $data['BrandName'];
            $product->title = $data['ProductTitle'];
            $product->discount = $data['discount'];
            $product->slug = strtolower($data['ProductTitle']);
            $product->description = $data['inputDescription'];

            $product->save();
            $pId = Product::pluck('id')->last();

            //upload multi image
            if ($request->hasFile('image')) {
                $image_array = $request->file('image');

                $image_ext = $image_array->getClientOriginalExtension();
                $filename = rand(111, 99999) . "." . $image_ext;
                $folder = '/img/products/';
                $destinationPath = public_path($folder);
                $filePath = $folder . $filename;

                $image_array->move($destinationPath, $filename);

                $images = new Images();
                $images->ImageName = $filePath;
                $images->product_id = $pId;
                $images->save();
            } else {
                $images = new Images();
                $images->ImageName = "/img/products/noimage.png";
                $images->product_id = $pId;
                $images->save();
            }

            //price & sice
       
            if ($request->filled('price1')) {
                $size = new ProductSize();
                $size->product_id = $pId;
                $size->size = $data['size1'];
                $size->price = filter_var($data['price1'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            if ($request->filled('price2')) {
                $size = new ProductSize();
                $size->product_id = $pId;
                $size->size = $data['size2'];
                $size->price = filter_var($data['price2'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            if ($request->filled('price3')) {
                $size = new ProductSize();
                $size->product_id = $pId;
                $size->size = $data['size3'];
                $size->price = filter_var($data['price3'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            return redirect()->back()->with('flash_message_success', 'Product added Successfully!');
        }

        $categories = Category::get();

        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
        }

        $brands = Brands::get();
        $brands_dropdown = "<option selected disabled>Select</option>";
        foreach ($brands as $brand) {
            $brands_dropdown .= "<option value='" . $brand->id . "'>" . $brand->name . "</option>";
        }

        return view('admin.addProduct')->with(compact('categories_dropdown', 'brands_dropdown'));
    }


    //// Edit Product
    ////////////////////////////////////////////////////////////////
    public function editProduct(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            Product::where(['id' => $id])->update([
                'category_id' => $data['MainCategoryName'],
                'title' => $data['ProductTitle'],
                'slug' => strtolower($data['ProductTitle']),
                'description' => $data['inputDescription']
            ]);

            if ($request->hasFile('image')) {
                $image_array = $request->file('image');

                $image_ext = $image_array->getClientOriginalExtension();
                $filename = rand(111, 99999) . "." . $image_ext;
                $folder = '/img/products/';
                $destinationPath = public_path($folder);
                $filePath = $folder . $filename;

                $image_array->move($destinationPath, $filename);

                $images = new Images();
                $images->ImageName = $filePath;
                $images->product_id = $id;
                $images->save();
            } else {
                $images = new Images();
                $images->ImageName = "/img/products/noimage.png";
                $images->product_id = $id;
                $images->save();
            }

            //price & sice
            if ($request->filled('price1')) {
                ProductSize::where(['id' => $data['sizeId1']])->update([
                    'size' => $data['size1'],
                    'price' => $data['price1'],
                ]);
            }

            if ($request->filled('price2')) {
                ProductSize::where(['id' => $data['sizeId2']])->update([
                    'size' => $data['size2'],
                    'price' => $data['price2'],
                ]);
            }

            if ($request->filled('price3')) {
                ProductSize::where(['id' => $data['sizeId3']])->update([
                    'size' => $data['size3'],
                    'price' => $data['price3'],
                ]);
            }

            return redirect()->back()->with('flash_message_success', 'Product updated Successfully!');
        }

        $productDetail = Product::where(['id' => $id])->first();

        $images = Images::where(['product_id' => $id])->get();

        $categories = Category::get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $productDetail->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
        }

        $brands = Brands::get();
        $brands_dropdown = "<option selected disabled>Select</option>";
        foreach ($brands as $brand) {
            if ($brand->id == $productDetail->brand_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $brands_dropdown .= "<option value='" . $brand->id . "' " . $selected . ">" . $brand->name . "</option>";
        }

        $sizes = ProductSize::where(['product_id' => $id])->orderBy('created_at', 'desc')->get();

        return view('admin.addProduct')
            ->with(compact('productDetail', 'categories_dropdown', 'images',  'brands_dropdown', 'sizes'));
    }


    //// Delete Product
    ////////////////////////////////////////////////////////////////
    public function deleteProduct($id = null)
    {
        if (!empty($id)) {
            $product = Product::where(['id' => $id])->firstOrFail();

            $productImages = $product->images()->get();
            $productImagesArray = $productImages->toArray();
            foreach ($productImagesArray as $image) {
                $img =  $image['ImageName'];
                if (file_exists(public_path() . $img)) {
                    unlink(public_path() . $img);
                }
            }

            $product->images()->delete();
            $product->sizes()->delete();
            $product->delete();
            return redirect()->route('ManageProducts')->with('flash_message_success', 'Product deleted Successfully!');
        }
    }

    //// Delete Image
    ////////////////////////////////////////////////////////////////
    public function deleteImage($id = null)
    {
        if (!empty($id)) {
            $image = Images::where(['id' => $id])->firstOrFail();
            $filename = $image->ImageName;
            if (file_exists(public_path() . $filename)) {
                unlink(public_path() . $filename);
            }
            Images::where(['id' => $id])->delete();

            return redirect()->back()->with('flash_message_success', 'Image deleted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $img = Images::where(['product_id' => $id])->first();
        $images = Images::where(['product_id' => $id])->get();
        $sizes = ProductSize::where(['product_id' => $id])->get();
        return view('admin.productDetail')
            ->with(compact('product', 'images', 'img', 'sizes'));
    }
}
