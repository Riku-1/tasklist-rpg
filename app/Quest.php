<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
  protected $fillable = ['user_id', 'quest_name', 'quest_overview'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
