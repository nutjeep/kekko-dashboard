<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class OrderRepository extends BaseRepository 
{
   public function __construct(Order $model) 
   {
      parent::__construct($model);
   }

   public function getOrder()
   {
      return $this->model->orderBy('created_at', 'desc')->get();
   }

   public function getStatuses()
   {
      return Order::STATUSES;
   }

   public function getEmployees()
   {
      return User::where('role_id', 2)
        ->select('id', 'name', 'nickname')
        ->get();
   }

   public function getProductDigitalInvitations()
   {
      $data = Product::where('type', 'digital')
         ->where('is_active', true)
         ->select('id', 'name')
         ->orderBy('name', 'asc')
         ->get();

      return $data ?? [];
   }

   public function getProductPrintedInvitations()
   {
      $data = Product::where('type', 'printed')
         ->where('is_active', true)
         ->select('id', 'name')
         ->get();

      return $data ?? [];
   }
}