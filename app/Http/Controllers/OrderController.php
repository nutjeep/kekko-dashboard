<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
   protected $orderRepository;

   public function __construct(OrderRepository $orderRepository)
   {
      $this->orderRepository = $orderRepository;
   }

   public function index()
   {
      // $orders = $this->orderRepository->getOrder();
      return view('pages.order.index');
   }

   public function show($id)
   {
      return view('pages.order.show');
   }

   public function edit()
   {
      return view('pages.order.edit');
   }

   public function orderData()
   {
      return view('pages.order.order_data');
   }

   public function sendOrderData(Request $request)
   {

   }
}
