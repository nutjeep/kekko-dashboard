<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductPackageRepository;
use Illuminate\Validation\ValidationException;

class ProductPackageController extends Controller
{
   protected $productPackageRepository;

   public function __construct(ProductPackageRepository $productPackageRepository)
   {
      $this->productPackageRepository = $productPackageRepository;
   }

   public function index()
   {
      $packages = $this->productPackageRepository->get();
      return view('pages.product.package.index', compact('packages'));
   }

   public function store(Request $request)
   {
      try {
         DB::beginTransaction();

         $this->productPackageRepository->create($request->all());

         DB::commit();
         return redirect()->back()->with('success', 'Paket berhasil dibuat!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Create Product Package: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function edit($id)
   {
      $package = $this->productPackageRepository->find($id);
      return $package;
   }

   public function update(Request $request, $id)
   {
      try {
         DB::beginTransaction();

         $this->productPackageRepository->update($id, $request->all());

         DB::commit();

         return redirect()->back()->with('success', 'Paket berhasil diubah!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Update Product Package: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }  
   }
}
