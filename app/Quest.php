<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
  protected $fillable = ['user_id', 'name', 'level'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
