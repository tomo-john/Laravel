<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    protected $fillable = [
      'name',
      'cost',
      'color',
      'quantity',
      'memo',
    ];
}
