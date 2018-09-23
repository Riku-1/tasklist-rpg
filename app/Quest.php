<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
  protected $fillable = ['user_id', 'quest_name', 'quest_overview', 'enemy_name', 'enemy_overview', 'level', 'reward_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function reward()
  {
    return $this->belongsTo(Reward::class);
  }

  public function lesser_enemies()
  {
    return $this->hasMany(LesserEnemy::class);
  }
}
