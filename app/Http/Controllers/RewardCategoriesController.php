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
          'rewardcategories' => $reward_categories,
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
}
