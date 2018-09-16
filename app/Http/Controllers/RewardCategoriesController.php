<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RewardCategory;

class RewardCategoriesController extends Controller
{
    public function index()
    {
      $data = [];
      if (\Auth::check()) {
        $user = \Auth::user();
        $reward_categories = $user->rewardCategories()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
          'user' => $user,
          'reward_categories' => $reward_categories,
        ];
        return view('reward_categories.index', $data);
      }else {
        return view('welcome');
      }
    }

    public function create()
    {
      $reward_category = new RewardCategory;

      return view('reward_categories.create', ['reward_category' => $reward_category]);
    }

    public function store(Request $request)
    {
    //  validation($request);

      $request->user()->rewardCategories()->create([
        'reward_name' => $request->reward_name,
        'rarity' => $request->rarity,
      ]);

      return redirect()->route('reward_categories.index');
    }

    public function edit($reward_id)
    {
      $reward_category = RewardCategory::find($reward_id);

      return view('reward_categories.edit', ['reward_category' => $reward_category]);
    }

    public function update(Request $request, $reward_id)
    {
      $reward_category = RewardCategory::find($reward_id);

      //validation();

      RewardCategory::find($reward_id)->update([
        'reward_name' => $request->reward_name,
        'rarity' => $request->rarity,
      ]);

      return redirect()->route('reward_categories.index');
    }

    public function destroy($reward_id)
    {
      $reward_category = RewardCategory::find($reward_id);
      $reward_category->delete();

      return redirect()->route('reward_categories.index');
    }
/*バリデーションが難しいので後まわしにする
    private function validation($reward_category)
    {
      $this->validate($reward_category, [
        'reward_name' => 'required|string|max:50',

        // レアリティは0~3の整数（S,A,B,Cの4種類）
        'rarity' => 'integer|integer|gte:0|lte:3',
      ]);
    }
*/
}
