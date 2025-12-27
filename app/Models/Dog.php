<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
  protected $fillable = [
    'name',
    'age',
    'color',
    'favorite_food',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
