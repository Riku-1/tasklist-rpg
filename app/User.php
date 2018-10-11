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
     * 報酬の見本を作成する
     * 新規ユーザーを作成したとき初期データを作成するために呼び出される
     * @return [type] [description]
     */
    public function createSampleRewards()
    {
      $sample_rewards = [];
      $sample_rewards[] = [
        'reward_name' => 'これはサンプル報酬です',
        'rarity' => 0,
      ];
      $sample_rewards[] = [
        'reward_name' => 'アイス',
        'rarity' => 1,
      ];
      $sample_rewards[] = [
        'reward_name' => '旅行する',
        'rarity' => 3,
      ];
      foreach ($sample_rewards as $sample_reward) {
        $this->rewards()->create([
          'reward_name' => $sample_reward['reward_name'],
          'rarity' => $sample_reward['rarity'],
        ]);
      }
    }

    /**
     * クエストの見本を作成する
     * @return [type] [description]
     */
    public function createSampleQuests()
    {
      $this->quests()->create([
        'quest_name' => 'プレゼンの準備をする(サンプルクエスト)',
        'quest_overview' => 'これは概要欄です',
      ]);
    }

    /**
     * モンスターの見本を作成する
     * @return [type] [description]
     */
    public function createSampleMonsters()
    {
      $sample_monsters = [];
      $sample_monsters[] = [
        'monster_name' => '情報を収集する',
        'monster_overview' => 'これは概要欄です',
        'level' => 3,
        'order' => 1,
      ];
      $sample_monsters[] = [
        'monster_name' => '資料を作成する',
        'monster_overview' => '概要欄は空白でも大丈夫です',
        'level' => 5,
        'order' => 2,
      ];
      $sample_monsters[] = [
        'monster_name' => '発表練習をする',
        'monster_overview' => 'ドラッグ＆ドロップでモンスターの並び替えができます',
        'level' => 2,
        'order' => 3,
      ];
      foreach ($sample_monsters as $sample_monster) {
        $this->quests()->first()->monsters()->create([
          'monster_name' => $sample_monster['monster_name'],
          'monster_overview' => $sample_monster['monster_overview'],
          'level' => $sample_monster['level'],
          'order' => $sample_monster['order'],
        ]);
      }
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
