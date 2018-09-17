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
}
