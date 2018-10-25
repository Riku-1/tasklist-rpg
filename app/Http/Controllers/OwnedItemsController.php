<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;

class OwnedItemsController extends Controller
{
  public function index()
  {
    $data = [];
    if (\Auth::check()) {
      $user = \Auth::user();
      $rewards = $user->rewards()->orderBy('created_at', 'desc')->paginate(100);

      $data = [
        'user' => $user,
        'rewards' => $rewards,
      ];
      return view('owned_items.index', $data);
    }else {
      return view('welcome');
    }
  }

  /**
   * アイテムを消費する（数を1減らす）
   * @param  Request $request   [description]
   * @param  [type]  $reward_id [description]
   */
  public function update(Request $request, $reward_id)
  {
    $reward = Reward::find($reward_id);
    $CONSUMPTION_NUM = 1;

    $reward->num_owned = $reward->increaseNumOwned(-$CONSUMPTION_NUM);
    $reward->save();

    return redirect()->route('owned_items.index');
  }

}
