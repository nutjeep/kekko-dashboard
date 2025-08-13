<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\TransactionRepository;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
   protected $transactionRepository;

   public function __construct(TransactionRepository $transactionRepository)
   {
      $this->transactionRepository = $transactionRepository;
   }
   
   public function index()
   {
      $transactions = $this->transactionRepository->get();
      return view('pages.transaction.index', compact('transactions'));
   }

   public function store(Request $request)
   {
      try {
         $this->transactionRepository->create($request->all());
         return redirect()->back()->with('success', 'Data Pesanan Berhasil Diubah!');
      }
      catch (ValidationException $e) {
         Log::error("Error Create Transaction: " . $e->validator->errors());
         return back()->withErrors($e->validator)->withInput();
      }
   }
}
