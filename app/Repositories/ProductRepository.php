<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductTheme;
use App\Models\ProductPackage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository
{
   private ProductTheme $productTheme;
   private ProductPackage $productPackage;

   public function __construct(Product $model, ProductTheme $productTheme, ProductPackage $productPackage) 
   {
      parent::__construct($model);
      $this->productTheme = $productTheme;
      $this->productPackage = $productPackage;
   }

   public function getProductThemes()
   {
      try {
         return Cache::remember('product_themes', 3600, function () {
            return $this->productTheme->all();
         });
      } catch (\Exception $e) {
         Log::error("Failed to get product themes: " . $e->getMessage());
         return new Collection();
      }
   }

   public function getProductPackages()
   {
      try {
         return $this->productPackage->all();
      } catch (\Exception $e) {
         Log::error("Failed to get product packages: " . $e->getMessage());
         return new Collection();
      }
   }

   public function getActiveProducts(): Collection
   {
      return $this->model->where('is_active', true)->get();
   }

   public function getProductTypes(): array
   {
      return ProductType::TYPES;
   }
}