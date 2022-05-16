<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Contact;
use App\Medicine;

class HomepageController extends Controller
{
    public function index()
    {
        $products1 = Product::inRandomOrder()->limit(4)->get();
        $products2 = Product::inRandomOrder()->limit(4)->get();
        return view('home')->with(compact('products1', 'products2'));
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            $data = $request->all();
            $contact = new Contact;

            $contact->Name = $data['name'];
            $contact->Email = $data['email'];
            $contact->Subject = $data['subject'];
            $contact->Message = $data['message'];
            $contact->save();
            return redirect()->back()->with('flash_message_success', 'Message send Successfully!');
        }

        if ($request->isMethod('get')) {
            return view('contact');
        }
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function medicine()
    {
        $medicines = Medicine::with('images')->orderByDesc('id')->paginate(9);
        return view('medicines')->with('medicines', $medicines);
    }


    public function searchMedicine(Request $request)
    {

        $pagination = 9;

        $query = $request->search;
        $medicines = Medicine::with('images')->where('title', 'LIKE', "%$query%")->paginate($pagination);

        // dd($query);

        return view('medicines')->with('medicines', $medicines);
    }
}
