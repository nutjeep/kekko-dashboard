<?php

namespace App\Repositories;

use App\Models\ProductPackage;

class ProductPackageRepository extends BaseRepository 
{
   public function __construct(ProductPackage $model) 
   {
      parent::__construct($model);
   }
}