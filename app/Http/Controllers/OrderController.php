<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderDataService;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
   protected $orderRepository;

   public function __construct(OrderRepository $orderRepository)
   {
      $this->orderRepository = $orderRepository;
   }

   public function index()
   {
      $orders = $this->orderRepository->getOrder();
      return view('pages.order.index', compact('orders'));
   }

   public function show($id)
   {
      return view('pages.order.show');
   }

   public function edit($id)
   {
      $statuses = $this->orderRepository->getStatuses();
      $order = $this->orderRepository->find($id);
      $employees = $this->orderRepository->getEmployees();
      return view('pages.order.edit', compact('order', 'statuses', 'employees'));
   }

   public function update(Request $request, $id)
   {
      try {
         $order_data = OrderDataService::prepareOrderData($request);
         $this->orderRepository->update($id, $order_data);
         
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Diubah!');
      }
      catch (ValidationException $e) {
         Log::error("Error Update Order: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function orderData()
   {
      return view('pages.order.order_data');
   }

   public function sendOrderData(Request $request)
   {
      try {
         $order_data = OrderDataService::prepareOrderData($request);
         $this->orderRepository->create($order_data);
         
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Dikirim!');
      }
      catch (ValidationException $e) {
         Log::error("Error Sending Order Data: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }
}
