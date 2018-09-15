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
      // レアリティは0~3の整数（S,A,B,Cの4種類）
      $this->validate($request, [
        'reward_name' => 'required|string|max:50',
        'rarity' => 'integer|integer|gte:0|lte:3',
      ]);


      $request->user()->rewardCategories()->create([
        'reward_name' => $request->reward_name,
        'rarity' => $request->rarity,
      ]);

      return redirect()->route('reward_categories.index');
    }
}
