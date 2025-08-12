<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductRepository;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
   protected $productRepository;

   public function __construct(ProductRepository $productRepository)
   {
      $this->productRepository = $productRepository;
   }

   public function index()
   {
      $products = $this->productRepository->get();
      $product_themes = $this->productRepository->getProductThemes();
      $product_packages = $this->productRepository->getProductPackages();
      $product_types = $this->productRepository->getProductTypes();

      return view('pages.product.index', compact('products', 'product_themes', 'product_packages', 'product_types'));
   }

   public function store(Request $request)
   {
      try {
         DB::beginTransaction();

         $this->productRepository->create($request->all());

         DB::commit();
         return redirect()->back()->with('success', 'Produk berhasil dibuat!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Create Product: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function edit($id)
   {
      $product = $this->productRepository->find($id);
      return $product;
   }

   public function update(Request $request, $id)
   {
      try {
         DB::beginTransaction();

         $this->productRepository->update($id, $request->all());

         DB::commit();

         return redirect()->back()->with('success', 'Produk berhasil diubah!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Update Product: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }  
   }
}
