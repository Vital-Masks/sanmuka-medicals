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
            $validated = $request->validate([
                'ProductTitle' => 'required|max:20',
                'BrandName' => 'required',
                'MainCategoryName' => 'required',
                'dosage' => 'required|max:20',
                'age' => 'required|max:20',
                'disease' => 'required|max:20',
                'description' => 'required',
            ]);

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
            // else {
            //     $images = new MedicinesImages();
            //     $images->ImageName = "/img/products/noimage.png";
            //     $images->product_id = $pId;
            //     $images->save();
            // }
            return redirect()->back()->with('flash_message_success', 'Medicine added Successfully!');
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

        return view('admin.addMedicine')->with(compact('categories_dropdown', 'brands_dropdown'));
    }

    //// Edit Product
    ////////////////////////////////////////////////////////////////
    public function editMedicine(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
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
                // $array_len = count($image_array);

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
                }

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

        $productDetail = Medicine::where(['id' => $id])->first();

        $images = MedicinesImages::where(['medicine_id' => $id])->get();

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

        return view('admin.addMedicine')
            ->with(compact('productDetail', 'categories_dropdown', 'images',  'brands_dropdown'));
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
        $product = Medicine::where('id', $id)->firstOrFail();
        $img = MedicinesImages::where(['medicine_id' => $id])->first();
        $images = MedicinesImages::where(['medicine_id' => $id])->get();
        return view('admin.medicineDetail')
            ->with(compact('product', 'images', 'img'));
    }




    // client
    public function clientIndex()
    {
        $medicines = Medicine::with('images')->orderByDesc('id')->paginate(9);
        return view('medicines')->with('medicines', $medicines);
    }

    public function search(Request $request)
    {

        $pagination = 9;

        $query = $request->search;
        $medicines = Medicine::with('images')->where('title', 'LIKE', "%$query%")->paginate($pagination);

        // dd($query);

        return view('medicines')->with('medicines', $medicines);
    }
}
