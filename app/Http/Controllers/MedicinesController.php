<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brands;
use App\Medicine;
use App\MedicinesImages;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index()
    {
        $pagination = 10;

        $products = Medicine::orderByDesc('id')->paginate($pagination);
        return view('admin.medicines')->with('products', $products);
    }

    /// Add Product
    ////////////////////////////////////////////////////////////////
    public function addMedicine(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate(
                [
                    'ProductTitle' => 'required|max:50',
                    'BrandName' => 'required',
                    'MainCategoryName' => 'required',
                    'dosage' => 'required|max:20',
                    'age' => 'required|max:20',
                    'disease' => 'required|max:30',
                    'description' => 'required|max:250',
                    'image' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
                ],
                [
                    'image.mimes' => 'Please select a jpg,png,jpeg format',
                ]
            );

            $data = $request->all();

            $product = new Medicine;
            $product->title = $data['ProductTitle'];
            $product->brand_id = $data['BrandName'];
            $product->category_id = $data['MainCategoryName'];
            $product->dosage = $data['dosage'];
            $product->age = $data['age'];
            $product->disease = $data['disease'];
            $product->description = $data['description'];

            $product->save();
            $pId = Medicine::pluck('id')->last();

            //upload multi image
            if ($request->hasFile('image')) {
                $image_array = $request->file('image');

                $image_ext = $image_array->getClientOriginalExtension();
                $filename = rand(111, 99999) . "." . $image_ext;
                $folder = '/img/medicines/';
                $destinationPath = public_path($folder);
                $filePath = $folder . $filename;

                $image_array->move($destinationPath, $filename);

                $images = new MedicinesImages();
                $images->ImageName = $filePath;
                $images->medicine_id = $pId;
                $images->save();
            }
            return redirect()->back()->with('flash_message_success', 'Medicine added Successfully!');
        }

        $categories = Category::get();
        $brands = Brands::get();
        return view('admin.addMedicine')->with(compact('categories', 'brands'));
    }

    //// Edit Product
    ////////////////////////////////////////////////////////////////
    public function editMedicine(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate(
                [
                    'ProductTitle' => 'required|max:50',
                    'BrandName' => 'required',
                    'MainCategoryName' => 'required',
                    'dosage' => 'required|max:20',
                    'age' => 'required|max:20',
                    'disease' => 'required|max:30',
                    'description' => 'required|max:250',
                    'image' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
                ],
                [
                    'image.mimes' => 'Please select a jpg,png,jpeg format',
                ]
            );

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Medicine::where(['id' => $id])->update([
                'title' => $data['ProductTitle'],
                'category_id' => $data['MainCategoryName'],
                'brand_id' => $data['BrandName'],
                'dosage' => $data['dosage'],
                'age' => $data['age'],
                'disease' => $data['disease'],
                'description' => $data['description']
            ]);

            //upload multi image
            if ($request->hasFile('image')) {
                $image_array = $request->file('image');


                $image_ext = $image_array->getClientOriginalExtension();
                $filename = rand(111, 99999) . "." . $image_ext;
                $folder = '/img/medicines/';
                $destinationPath = public_path($folder);
                $filePath = $folder . $filename;

                $image_array->move($destinationPath, $filename);

                $images = new MedicinesImages();
                $images->ImageName = $filePath;
                $images->medicine_id = $id;
                $images->save();

                // for ($i = 0; $i < $array_len; $i++) {
                //     $image_array = $request->file('image');

                //     $image_ext = $image_array->getClientOriginalExtension();
                //     $filename = rand(111, 99999) . "." . $image_ext;
                //     $folder = '/img/medicines/';
                //     $destinationPath = public_path($folder);
                //     $filePath = $folder . $filename;

                //     $image_array->move($destinationPath, $filename);

                //     $images = new MedicinesImages();
                //     $images->ImageName = $filePath;
                //     $images->medicine_id = $id;
                //     $images->save();
                // }
            }

            return redirect()->back()->with('flash_message_success', 'Medicine updated Successfully!');
        }

        $productDetail = Medicine::where(['id' => $id])->with('brand', 'category', 'images')->first();

        $categories = Category::get();
        $brands = Brands::get();
    
        return view('admin.addMedicine')
            ->with(compact('productDetail', 'categories',  'brands'));
    }


    //// Delete Product
    ////////////////////////////////////////////////////////////////
    public function deleteMedicine($id = null)
    {
        if (!empty($id)) {
            $product = Medicine::where(['id' => $id])->firstOrFail();

            $productImages = $product->images()->get();
            $productImagesArray = $productImages->toArray();
            foreach ($productImagesArray as $image) {
                $img =  $image['ImageName'];
                if (file_exists(public_path() . $img)) {
                    unlink(public_path() . $img);
                }
            }

            $product->images()->delete();
            $product->delete();
            return redirect()->route('ManageMedicines')->with('flash_message_success', 'Product deleted Successfully!');
        }
    }

    //// Delete Image
    ////////////////////////////////////////////////////////////////
    public function deleteImage($id = null)
    {
        if (!empty($id)) {
            $image = MedicinesImages::where(['id' => $id])->firstOrFail();
            $filename = $image->ImageName;
            if (file_exists(public_path() . $filename)) {
                unlink(public_path() . $filename);
            }
            MedicinesImages::where(['id' => $id])->delete();

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
        $product = Medicine::where('id', $id)->with('images')->firstOrFail();
        return view('admin.medicineDetail')
            ->with(compact('product'));
    }
}
