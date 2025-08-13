<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderDataService;
use Illuminate\Support\Facades\DB;
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
      $back_button = true;
      $back_button_route = route('order');
      return view('pages.order.edit', 
         compact('order', 'statuses', 'employees', 'back_button', 'back_button_route'));
   }

   public function update(Request $request, $id)
   {
      try {
         DB::beginTransaction();

         $order_data = OrderDataService::prepareOrderData($request);
         $this->orderRepository->update($id, $order_data);

         DB::commit();
         
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Diubah!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Update Order: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function orderData()
   {
      $digital_invitations = $this->orderRepository->getDigitalInvitations();

      return view('pages.order.order_data', compact('digital_invitations'));
   }

   public function sendOrderData(Request $request)
   {
      try {
         DB::beginTransaction();

         $order_data = OrderDataService::prepareOrderData($request);
         $this->orderRepository->create($order_data);
         
         DB::commit();
         
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Dikirim!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Sending Order Data: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function getOrderById($id)
   {
      $order = $this->orderRepository->find($id);
      return $order;
   }
}
