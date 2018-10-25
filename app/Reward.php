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

    /**
     * 所持しているアイテムを$num_increased増やす。$num_increasedを負にすれば減少
     * @param  [type] $num_increased [description] アイテム増加数
     * @return [type] $num_owned [description] 増加後のアイテム所持数
     */
    public function increaseNumOwned($num_increased)
    {
      $num_owned = $this->num_owned + $num_increased;
      //$num_ownedの値は負を許可しない。0以下の場合は0に直す
      if ($num_owned < 0) {
        $num_owned = 0;
      }
      return $num_owned;
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
          return 'レアリティはS,A,B,Cのみしか許可されていません';
          break;
      }
    }
}
