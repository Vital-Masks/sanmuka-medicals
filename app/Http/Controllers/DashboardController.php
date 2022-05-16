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
        $allOrders = Prescription::get();
        $checkouts = checkout::orderBydesc('id')->where(['viewed' => '0'])->paginate(20);
        $deliveries = checkout::orderBydesc('id')->where(['delivered' => '0'])->paginate(20);

        return view('admin.dashboard')->with(compact('checkouts', 'deliveries','allOrders'));
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
        $checkouts = checkout::orderBydesc('id')->paginate(20);

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
        $allOrders = Prescription::get();
        $orders = Prescription::orderBydesc('id')->where(['viewed' => '0'])->paginate(20);
        $deliveries = Prescription::orderBydesc('id')->where(['delivered' => '0'])->paginate(20);
        $all = false;
        return view('admin.orderByPrescription')->with(compact('orders', 'deliveries','all','allOrders'));
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
        $orders = Prescription::orderBydesc('id')->paginate(20);
        $all = true;
        return view('admin.allPrescriptionOrders')->with(compact('orders','all'));
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
