<?php

namespace App\Http\Controllers\Frontend;

use App\Models\order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    function myAccount(){
        $orders = order::with('orderItems.product:id,title')->where('customer_id', auth('customer')->id())->get();
        // dd($orders);
        return view('frontend.MyAccount', compact('orders'));
    }

    function downloadInvoice($id){
        // return view('frontend.invoice');
        $order = order::with('orderItems.product:id,title')->where('id',$id)->where('customer_id', auth('customer')->id())->first();
        $data = compact('order');
        $pdf = Pdf::loadView('frontend.invoice', $data);
        return $pdf->download('my-order.pdf');
    }
}
