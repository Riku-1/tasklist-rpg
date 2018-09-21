<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = ['user_id', 'reward_name', 'rarity'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function increaseNumOwned($num_increased)
    {
      //引数に負の値も可
      $consumed_num_owned = $this->num_owned + $num_increased;
      $this->num_owned = $consumed_num_owned;
      $this->save();

    }

    public function convertRarityValueIntoChar()
    {
      $rarity_value = $this->rarity;
      switch ($rarity_value) {
        case 0:
          return 'C';
          break;

        case 1:
          return 'B';
          break;

        case 2:
          return 'A';
          break;

        case 3:
          return 'S';
          break;

        default:
          // エラー処理がわからないので暫定措置
          return 'レアリティはS,A,B,Cのみしか許可されていません';
          break;
      }
    }
}