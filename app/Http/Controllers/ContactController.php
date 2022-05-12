<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = Contact::orderBydesc('id')->where(['Viewed' => '0'])->get();
        return view('admin.contacts')->with(compact('contact'));
    }

    public function Message($id){
        Contact::where(['id' => $id])->update([
            'Viewed' => '1',
        ]);

        $message = Contact::where(['id' => $id])->first(); 
        return view('admin.ViewMessage')->with(compact('message'));
    }

    public function AllMessage(){
        $contact = Contact::orderBydesc('id')->get();
        return view('admin.contacts')->with(compact('contact'));
    }
}
