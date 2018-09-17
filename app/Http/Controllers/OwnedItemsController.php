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
    //今は1増やすだけ。0以下にならないようにvalidationする。
    $reward = Reward::find($reward_id);
    $num_consumption =  -1;

    $reward->increaseNumOwned(-$num_consumption);

    return redirect()->route('owned_items.index');
  }

}
