<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardCategory extends Model
{
    protected $fillable = ['user_id', 'reward_name', 'rarity'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
