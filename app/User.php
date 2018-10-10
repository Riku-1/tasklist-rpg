<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rewards()
    {
      return $this->hasMany(Reward::class);
    }

    public function quests()
    {
      return $this->hasMany(Quest::class);
    }

    /**
     * ガチャチケを引数分増やす
     * @param  [type] $change_num_of_ticket
     * @return [description]
     */
    public function increaseTicket($change_num_of_ticket)
    {
      $gacha_ticket = $this->gacha_ticket;
      $gacha_ticket += $change_num_of_ticket;
      //ガチャチケの枚数は0以下にならない
      if ($gacha_ticket < 0) {
        $gacha_ticket = 0;
      }
      $this->gacha_ticket = $gacha_ticket;
      $this->save();
    }
}
