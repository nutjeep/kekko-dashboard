<?php

namespace App\Repositories;

use App\Models\Transactions;

class TransactionRepository extends BaseRepository 
{
   public function __construct(Transactions $model) 
   {
      parent::__construct($model);
   }
}