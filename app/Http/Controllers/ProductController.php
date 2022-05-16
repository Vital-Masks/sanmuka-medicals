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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 20;

        $products = Product::orderByDesc('id')->paginate($pagination);
        return view('admin.products')->with('products', $products);
    }



    /// Add Product
    ////////////////////////////////////////////////////////////////
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'ProductTitle' => 'required|max:50',
                    'BrandName' => 'required',
                    'MainCategoryName' => 'required',
                    'inputDescription' => 'required|max:250',
                    'image' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
                ],
                [
                    'image.mimes' => 'Please select a jpg,png,jpeg format',
                ]
            );

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
        $brands = Brands::get();

        return view('admin.addProduct')->with(compact('categories', 'brands'));
    }


    //// Edit Product
    ////////////////////////////////////////////////////////////////
    public function editProduct(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate(
                [
                    'ProductTitle' => 'required|max:50',
                    'BrandName' => 'required',
                    'MainCategoryName' => 'required',
                    'inputDescription' => 'required|max:250',
                    'image' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
                ],
                [
                    'image.mimes' => 'Please select a jpg,png,jpeg format',
                ]
            );

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            Product::where(['id' => $id])->update([
                'category_id' => $data['MainCategoryName'],
                'brand_id' => $data['BrandName'],
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
            }

            //price & sice
            if ($request->filled('price1') && $request->has('sizeId1')) {
                ProductSize::updateOrCreate(
                    ['id' => $data['sizeId1']],
                    [
                        'size' => $data['size1'],
                        'price' => filter_var($data['price1'], FILTER_SANITIZE_NUMBER_INT),
                        'product_id' => $id
                    ]
                );
            }else{
                $size = new ProductSize();
                $size->product_id = $id;
                $size->size = $data['size1'];
                $size->price = filter_var($data['price1'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            if ($request->filled('price2') && $request->has('sizeId2')) {
                ProductSize::updateOrCreate(
                    ['id' => $data['sizeId2']],
                    [
                        'size' => $data['size2'],
                        'price' => filter_var($data['price2'], FILTER_SANITIZE_NUMBER_INT),
                        'product_id' => $id
                    ]
                );
            }else{
                $size = new ProductSize();
                $size->product_id = $id;
                $size->size = $data['size2'];
                $size->price = filter_var($data['price2'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            if ($request->filled('price3') && $request->has('sizeId3')) {
                ProductSize::updateOrCreate(
                    ['id' => $data['sizeId3']],
                    [
                        'size' => $data['size3'],
                        'price' => filter_var($data['price3'], FILTER_SANITIZE_NUMBER_INT),
                        'product_id' => $id
                    ]
                );
            }else{
                $size = new ProductSize();
                $size->product_id = $id;
                $size->size = $data['size3'];
                $size->price = filter_var($data['price3'], FILTER_SANITIZE_NUMBER_INT);
                $size->save();
            }

            return redirect()->back()->with('flash_message_success', 'Product updated Successfully!');
        }

        $productDetail = Product::where(['id' => $id])->with('brand', 'category', 'sizes', 'images')->first();
        $categories = Category::get();
        $brands = Brands::get();
        return view('admin.addProduct')
            ->with(compact('productDetail', 'categories', 'brands'));
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
        $product = Product::where('id', $id)->with('images', 'sizes')->firstOrFail();
        return view('admin.productDetail')
            ->with(compact('product'));
    }
}
