<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductThemeRepository;

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

   }
}
