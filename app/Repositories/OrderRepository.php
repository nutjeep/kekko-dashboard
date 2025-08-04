<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Order;

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
}