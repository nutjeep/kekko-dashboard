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
      return User::where('role_id', 2)->get();
   }

   public function getProductDigitalInvitations()
   {
      $digital_products = Product::where('type', 'digital')
         ->where('is_active', true)
         ->orderBy('name', 'asc')
         ->get();

      return $digital_products ?? [];
   }

   public function getProductPrintedInvitations()
   {
      $printed_products = Product::where('type', 'printed')
         ->where('is_active', true)
         ->get();

      return $printed_products ?? [];
   }
}