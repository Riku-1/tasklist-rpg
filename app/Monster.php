<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
  protected $fillable = ['quest_id', 'monster_name', 'monster_overview', 'level', 'reward_id', 'order'];

  public function quest()
  {
    return $this->belongsTo(Quest::class);
  }

  public function reward()
  {
    return $this->belongsTo(Reward::class);
  }
}
