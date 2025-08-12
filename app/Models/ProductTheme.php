<?php

namespace App\Models;

use App\Traits\FormattedDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTheme extends Model
{
   use SoftDeletes, FormattedDate;
   
   protected $guarded = [
      'id', 'created_at', 'updated_at', 'deleted_at'
   ];
}
