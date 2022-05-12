<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\checkout;
use App\checkout_product;
use App\Prescription;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function getResentOrders()
    {
        $checkouts = checkout::orderBydesc('id')->where(['viewed' => '0'])->get();
        $deliveries = checkout::orderBydesc('id')->where(['delivered' => '0'])->get();

        return view('admin.dashboard')->with(compact('checkouts', 'deliveries'));
    }

    public function checkoutdetails(Request $request, $id = null)
    {
        checkout::where(['id' => $id])->update([
            'viewed' => '1',
        ]);

        $checkoutdetail = checkout::with('products')->where(['id' => $id])->first();
        return view('admin.checkoutdetail')->with(compact('checkoutdetail'));
    }

    public function checkoutall()
    {
        $checkouts = checkout::orderBydesc('id')->get();

        return view('admin.allOrders')->with(compact('checkouts'));
    }

    public function delivered($id)
    {
        checkout::where(['id' => $id])->update([
            'delivered' => '1',
        ]);

        return redirect()->back()->with('flash_message_success', 'Delivered Successfully!');
    }

    //// Delete Product
    ////////////////////////////////////////////////////////////////
    public function checkoutdelete($id = null)
    {
        if (!empty($id)) {
            $checkout = checkout::find($id);
            $checkout->delete();
            return redirect()->back()->with('flash_message_success', 'Checkout deleted Successfully!');
        }
    }

    public function prescriptionOrders()
    {
        $orders = Prescription::orderBydesc('id')->where(['viewed' => '0'])->get();
        $deliveries = Prescription::orderBydesc('id')->where(['delivered' => '0'])->get();
        return view('admin.orderByPrescription')->with(compact('orders', 'deliveries'));
    }

    public function prescriptionDetails(Request $request, $id = null)
    {
        Prescription::where(['id' => $id])->update([
            'viewed' => '1',
        ]);

        $prescriptionDetails = Prescription::where(['id' => $id])->first();
        return view('admin.prescriptionDetail')->with(compact('prescriptionDetails'));
    }

    public function prescriptionAll()
    {
        $orders = Prescription::orderBydesc('id')->get();

        return view('admin.orderByPrescription')->with(compact('orders'));
    }

    public function prescriptionDelivered($id)
    {
        Prescription::where(['id' => $id])->update([
            'delivered' => '1',
        ]);

        return redirect()->back()->with('flash_message_success', 'Delivered Successfully!');
    }

    public function prescriptionDelete($id = null)
    {
        if (!empty($id)) {
            $prescription = Prescription::find($id);
            $filename = $prescription->image;
            if (file_exists(public_path() . $filename)) {
                unlink(public_path() . $filename);
            }
            $prescription->delete();
            return redirect()->back()->with('flash_message_success', 'Checkout deleted Successfully!');
        }
    }
}
