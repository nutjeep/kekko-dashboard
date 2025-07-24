<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderData()
    {
        return view('pages.order.order_data');
    }
}
