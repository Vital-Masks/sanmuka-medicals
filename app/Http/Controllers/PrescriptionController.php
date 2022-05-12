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
            $request->validate([
                'firstName' => 'required|max:20',
                'lastName' => 'required|max:20',
                'nic' => 'required|regex: /^\d{9}[VvXx]$/',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'required|email',
                'address' => 'required',
                'image' => 'required',
            ]);

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
