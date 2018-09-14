<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardsController extends Controller
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
        return view('rewards.index', $data);
      }else {
        return view('welcome');
      }
    }
}
