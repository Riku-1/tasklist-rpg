<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;

class GachaController extends Controller
{
    public function main()
    {
      //後々所持チケット枚数を引っ張ってきて表示する。今はページ表示するだけ
      $num_gacha_ticket = \Auth::user()->gacha_ticket;
      return view('gacha.main', ['num_gacha_ticket' => $num_gacha_ticket ]);
    }

    public function result()
    {
      //現在はすべての報酬が同じ確率で出現する仕様。後々レアリティで出現率変更
      //後でガチャを回してランダムに報酬を取得する部分だけ関数に切り出す
      $rewards = [];
      $gacha_times = 1;
      $user = \Auth::user();
      if (\Auth::check()) {
        for ($i=0; $i < $gacha_times; $i++) {
          //設定された報酬の中からランダムに抜き出す
          $reward = $user->rewards()->inRandomOrder()->first();
          $reward->num_owned = $reward->increaseNumOwned(1);
          $reward->save();
          $rewards[] = $reward;
        };

        $user->gacha_ticket += -1;
        $user->save();
        return view('gacha.result', ['rewards' => $rewards]);
      }
    }
}
