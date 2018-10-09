<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
  protected $fillable = ['quest_id', 'monster_name', 'monster_overview', 'level', 'order'];

  public function quest()
  {
    return $this->belongsTo(Quest::class);
  }

  /**
   * モンスターのレベルに応じて表示する画像パスを選択する
   * @param  [type] int $monster_level
   * @return [type] string:image_path
   */
  public function choiceImageFromLevel()
  {
    switch ($this->level) {
      case 0:
        return 'image/ttm_ori163.png';
        break;
      case 1:
        return 'image/ttm_ori182.png';
        break;
      case 2:
        return 'image/ttm_ori183.png';
        break;
      case 3:
        return 'image/ttm_ori156.png';
        break;
      default:
        return 'image/ttm_ori108.png';
        break;
    }
  }
}
