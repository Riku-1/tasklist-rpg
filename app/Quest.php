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

  public function monsters()
  {
    return $this->hasMany(Monster::class);
  }

  /**
   * クエストに所属する最後尾のモンスターのorderを取得する
   * @return [type] int [description] クエスト内モンスターのorder最大値
   */
  public function getLastOrder()
  {
    $last_monster = $this->monsters()->orderBy('order', 'desc')->first();
    if ($last_monster) {
      $last_order = $last_monster->order;
    }else {
      //クエストにモンスターが存在しない場合は0を返す
      $last_order = 0;
    }

    return $last_order;
  }

  /**
   * クエストの進行度を計算する。
   * 進行度 = 全モンスターの残りHP / 全モンスターの最大HP
   * @return [type] string $progress [description]
   */
  public function calcQuestProgress()
  {
    $monsters = $this->monsters()->paginate(100);
    $all_hp = 0;
    $remaing_hp = 0;
    foreach ($monsters as $monster) {
      $all_hp += 100;
      $remaing_hp += $monster->hp;
    }

    $progress = $remaing_hp . '/' . $all_hp;
    return $progress;
  }
}
