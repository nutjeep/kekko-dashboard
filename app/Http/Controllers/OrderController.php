<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderDataService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
   protected $orderRepository;
   protected $transactionRepository;

   public function __construct(OrderRepository $orderRepository, TransactionRepository $transactionRepository)
   {
      $this->orderRepository = $orderRepository;
      $this->transactionRepository = $transactionRepository;
   }

   public function index()
   {
      $orders = $this->orderRepository->getOrder();
      $employees = $this->orderRepository->getEmployees();
      $statuses = $this->orderRepository->getStatuses();

      return view('pages.order.index',
         compact('orders', 'employees', 'statuses'));
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
      $product_digital_invitations = $this->orderRepository->getProductDigitalInvitations();
      $back_button = true;
      $back_button_route = route('order');

      return view('pages.order.edit', 
         compact('order', 'statuses', 'employees', 'back_button', 'back_button_route', 'product_digital_invitations'));
   }

   public function update(Request $request, $id)
   {
      try {
         DB::beginTransaction();

         $order_data = OrderDataService::prepareOrderData($request);

         $this->orderRepository->update($id, $order_data);
         $order = $this->orderRepository->find($id);
         
         if($request->action == 'update_and_transaction') {
            $transaction_data = [
               'order_id' => $id,
               'order_date' => $order->order_date ?? $order->created_at,
               'due_date' => $request->due_date ?? null,
               'total_amount' => $request->total_price ?? null,
               'status' => 'pending'
            ];

            $this->transactionRepository->create($transaction_data);
         }

         DB::commit();

         $message = $request->action === 'update_and_transaction' 
            ? 'Data Pesanan berhasil diupdate dan Transaksi Berhasil dibuat' 
            : 'Data Pesanan berhasil diupdate';

         
         return redirect()->back()->with('success', $message);
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Update Order: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function orderData()
   {
      $digital_invitations = $this->orderRepository->getProductDigitalInvitations();

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
