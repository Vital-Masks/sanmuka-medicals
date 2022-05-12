<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brands;

class BrandsController extends Controller
{
    public function index()
    {
        $pagination = 10;

        $brands = Brands::orderByDesc('id')->paginate($pagination);
        return view('admin.brands')->with('brands', $brands);
    }

    public function addBrand(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'BrandName' => 'required|max:20',
            ]);
            $data = $request->all();
            $brand = new Brands;
            $brand->name = $data['BrandName'];
            $brand->slug = strtolower($data['BrandName']);
            $brand->save();
            return redirect()->back()->with('flash_message_success', 'Brands added Successfully!');
        }

        $pagination = 10;
        $brands = Brands::orderByDesc('id')->paginate($pagination);
        return view('admin.brands')->with('brands', $brands);
    }

    ////Edit Category
    public function editBrand(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'BrandName' => 'required|max:20',
            ]);

            $data = $request->all();
            Brands::where(['id' => $id])->update([
                'name' => $data['BrandName'], 'slug' => strtolower($data['BrandName'])
            ]);
            return redirect()->back()->with('flash_message_success', 'Category updated Successfully!');
        } else {
            $brandDetails = Brands::where(['id' => $id])->first();
            $brands = Brands::orderByDesc('id')->paginate(10);
            return view('admin.brands', ['brands' => $brands])->with(compact('brandDetails'));
        }
    }


    public function deleteBrand($id = null)
    {
        if (!empty($id)) {
            Brands::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Brand deleted Successfully!');
        }
    }
}
