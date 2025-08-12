<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductThemeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductThemeController extends Controller
{
   protected $productThemeRepository;

   public function __construct(ProductThemeRepository $productThemeRepository)
   {
      $this->productThemeRepository = $productThemeRepository;
   }

   public function index()
   {
      $themes = $this->productThemeRepository->get();
      return view('pages.product.theme.index', compact('themes'));
   }

   public function store(Request $request)
   {
      try {
         DB::beginTransaction();

         $this->productThemeRepository->create($request->all());

         DB::commit();
         return redirect()->back()->with('success', 'Tema berhasil dibuat!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Create Product Theme: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }

   public function edit($id)
   {
      $theme = $this->productThemeRepository->find($id);
      return $theme;
   }

   public function update(Request $request, $id)
   {
      try {
         DB::beginTransaction();

         $this->productThemeRepository->update($id, $request->all());

         DB::commit();

         return redirect()->back()->with('success', 'Tema berhasil diubah!');
      }
      catch (ValidationException $e) {
         DB::rollBack();
         Log::error("Error Update Product Theme: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }  
   }
}
