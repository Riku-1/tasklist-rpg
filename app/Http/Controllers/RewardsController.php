<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;

class RewardsController extends Controller
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
        return view('rewards.index', $data);
      }else {
        return view('welcome');
      }
    }

    public function create()
    {
      $reward = new Reward;

      return view('rewards.create', ['reward' => $reward]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'reward_name' => 'required',
        'rarity' =>'required',
      ]);
      $request->user()->rewards()->create([
        'reward_name' => $request->reward_name,
        'rarity' => $request->rarity,
      ]);

      return redirect()->route('rewards.index');
    }

    public function edit($reward_id)
    {
      $reward = Reward::find($reward_id);

      return view('rewards.edit', ['reward' => $reward]);
    }

    public function update(Request $request, $reward_id)
    {
      $this->validate($request, [
        'reward_name' => 'required',
        'rarity' =>'required',
      ]);
      $reward = Reward::find($reward_id);

      Reward::find($reward_id)->update([
        'reward_name' => $request->reward_name,
        'rarity' => $request->rarity,
      ]);

      return redirect()->route('rewards.index');
    }

    public function destroy($reward_id)
    {
      $reward = Reward::find($reward_id);
      $reward->delete();

      return redirect()->route('rewards.index');
    }
/*バリデーションが難しいので後まわしにする
    private function validation($reward)
    {
      $this->validate($reward, [
        'reward_name' => 'required|string|max:50',

        // レアリティは0~3の整数（S,A,B,Cの4種類）
        'rarity' => 'integer|integer|gte:0|lte:3',
      ]);
    }
*/
}
