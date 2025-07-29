<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderDataService;
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
      // $customer_name = $request->customer_name;
      // $customer_phone = $request->customer_phone;

      // $digital_invitation = [
      //    'theme' => $request->digital_theme ?? null,
      //    'package' => $request->digital_package ?? null,
      // ];
      // $printed_invitation = [
      //    'type' => $request->printed_type ?? null,
      //    'quantity' => $request->printed_quantity ?? 0,
      // ];

      // $order_information = [
      //    'first_come' => $request->first_come ?? null,
      //    'invitation_type' => $request->invitation_type ?? null,
      //    'digital_invitation' => $digital_invitation,
      //    'printed_invitation' => $printed_invitation,
      // ];

      // $groom_bride_data = [
      //    'groom' => [
      //       'name' => $request->groom_name ?? null,
      //       'nickname' => $request->groom_nickname ?? null,
      //       'father_name' => $request->groom_father_name ?? null,
      //       'mother_name' => $request->groom_mother_name ?? null,
      //       'number_child' => $request->groom_number_child ?? null,
      //       'address' => $request->groom_address ?? null,
      //       'phone' => $request->groom_phone ?? null,
      //       'instagram' => $request->groom_instagram ?? null,
      //    ],
      //    'bride' => [
      //       'name' => $request->bride_name ?? null,
      //       'nickname' => $request->bride_nickname ?? null,
      //       'father_name' => $request->bride_father_name ?? null,
      //       'mother_name' => $request->bride_mother_name ?? null,
      //       'number_child' => $request->bride_number_child ?? null,
      //       'address' => $request->bride_address ?? null,
      //       'phone' => $request->bride_phone ?? null,
      //       'instagram' => $request->bride_instagram ?? null,
      //    ],
      //    'others' => [
      //       'link_gdrive' => $request->link_gdrive ?? null,
      //       'backsound_music' => $request->backsound_music ?? null,
      //       'notes' => $request->notes ?? null,
      //    ],
      // ];

      // $agenda_data = [
      //    'akad' => [
      //       'date' => $request->akad_date ?? null,
      //       'time' => $request->akad_time ?? null,
      //       'place' => $request->akad_place ?? null,
      //       'maps' => $request->akad_maps ?? null,
      //    ],
      //    'resepsi' => [
      //       'date' => $request->resepsi_date ?? null,
      //       'time' => $request->resepsi_time ?? null,
      //       'place' => $request->resepsi_place ?? null,
      //       'maps' => $request->resepsi_maps ?? null,
      //    ],
      //    'ngunduh_mantu' => [
      //       'date' => $request->ngunduh_mantu_date ?? null,
      //       'time' => $request->ngunduh_mantu_time ?? null,
      //       'place' => $request->ngunduh_mantu_place ?? null,
      //       'maps' => $request->ngunduh_mantu_maps ?? null,
      //    ],
      // ];

      // $order_data = [
      //    'customer_name' => $customer_name,
      //    'customer_phone' => $customer_phone,
      //    'order_information' => $order_information,
      //    'groom_bride_data' => $groom_bride_data,
      //    'agenda_data' => $agenda_data,
      // ];

      // dd($order_data);

      try {
         $order_data = OrderDataService::prepareOrderData($request);
         $this->orderRepository->create($order_data);
         
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Dikirim!');
      }
      catch (ValidationException $e) {
         return back()->withErrors($e->validator)->withInput();
      }

      // $orderData = OrderDataService::prepareOrderData($request);
      // $this->orderRepository->create($orderData);
      // return redirect()->back()->with('success', 'Data Pesanan Berhasil Dikirim!');
   }
}
