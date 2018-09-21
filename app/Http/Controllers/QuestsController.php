<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quest;

class QuestsController extends Controller
{
  public function index()
  {
    $data = [];
    if (\Auth::check()) {
      $user = \Auth::user();
      $quests = $user->quests()->orderBy('updated_at', 'desc')->paginate(10);
      $data = [
        'user' => $user,
        'quests' => $quests,
      ];
      return view('quests.index', $data);
    }else {
      return view('welcome');
    }
  }

  public function create()
  {
    $quest = new Quest;

    return view('quests.create', ['quest' => $quest]);
  }

  public function store(Request $request)
  {
    $request->user()->quests()->create([
      'quest_name' => $request->quest_name,
      'quest_overview' => $request->quest_overview,
    ]);

    return redirect()->route('quests.index');
  }
}
