<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
   protected $guarded = [];

   const TYPES = [
      'printed' => 'Undangan Cetak',
      'digital' => 'Undangan Digital',
   ];
}
