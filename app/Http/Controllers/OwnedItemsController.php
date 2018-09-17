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
      $rewards = $user->rewards()->orderBy('created_at', 'desc')->paginate(10);

      $data = [
        'user' => $user,
        'rewards' => $rewards,
      ];
      return view('owned_items.index', $data);
    }else {
      return view('welcome');
    }
  }

  public function update(Request $request, $reward_id)
  {
    //今は1増やすだけ。後々変数分増減できるようにする。0以下にならないようにvalidationする。
    $reward = Reward::find($reward_id);
    $num_consumption =  1;

    $num_owned_consumed = $reward->num_owned + $num_consumption;

    $reward->num_owned = $num_owned_consumed;
    $reward->save();

    return redirect()->route('owned_items.index');
  }

}
