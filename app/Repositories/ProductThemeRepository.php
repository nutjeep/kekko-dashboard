<?php

namespace App\Repositories;

use App\Models\ProductTheme;

class ProductThemeRepository extends BaseRepository 
{
   public function __construct(ProductTheme $model) 
   {
      parent::__construct($model);
   }
}