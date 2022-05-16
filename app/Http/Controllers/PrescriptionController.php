<?php

namespace App\Http\Controllers;

use App\Prescription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('prescription');
    }

    public function post(Request $request)
    {
        try {
            $request->validate(
                [
                    'firstName' => 'required|max:50',
                    'lastName' => 'required|max:50',
                    'nic' => 'required|regex: /^\d{9}[VvXx]$/', // /^[0-9]{7}[0][0-9]{4}$/
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:13',
                    'email' => 'required|email',
                    'address' => 'required|max:25',
                    'orderNotes' => 'max:250',
                    'image' => 'required|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                ],
                [
                    'firstName.required' => 'Please enter First Name',
                    'lastName.required' => 'Please enter Last Name',
                    'nic.required' => 'Please enter nic',
                    'phone.required' => 'Please enter Phone Number',
                    'email.required' => 'Please enter Email',
                    'address.required' => 'Please enter Address',
                    'phoneNumber.min' => 'The number must be at least 9 values',
                    'phoneNumber.max' => 'The number cant exceed 13 values',
                ]
            );

            if ($request->hasFile('image')) {
                $image_array = $request->file('image');
                $image_ext = $image_array->getClientOriginalExtension();
                $filename = rand(111, 99999) . "." . $image_ext;
                $folder = '/img/prescriptions/';
                $destinationPath = public_path($folder);
                $filePath = $folder . $filename;
                $image_array->move($destinationPath, $filename);
            }

            Prescription::create([
                'user_id' => Auth::user()->id,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'nic' => $request->nic,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'orderNotes' => $request->orderNotes,
                'image' => $filePath
            ]);


            return redirect()->back()->with('success_message', 'Prescription uploaded successfully! we will contact you shortly');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
