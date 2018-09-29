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

  public function show($id)
  {
    $quest = Quest::find($id);

    return view('quests.show', ['quest' => $quest]);
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

  /**
   * [sort description] sortableで並び替えたモンスターの並び順をDBに保存する
   * @param  Request $request {'quest_id', 'array_orders'}
   *  [description] arrya_ordersには旧orderの番号が新しい並び順で入っている
   *  ex)[4,1,2,3]
   *  この場合だと元々4番目だったモンスターを1番に持ってきたことになる
   * @return [type] void [description] ajax処理でDB保存を行うため値を返さない
   */
  public function saveOrder(Request $request)
  {
    $quest = Quest::find($request->quest_id);
    $monsters = $quest->monsters()->orderBy('order', 'asc')->paginate(10);

    for ($i=0; $i < count($monsters); $i++) {
      //旧orderからMonsterインスタンスを引っ張ってきて新orderを代入する
      $monster = $monsters[$request->array_orders[$i]];
      //+1はなくても動くが、SQLのindexが1からなので一応それに合わせる
      $monster->order = $i + 1;
      $monster->save();
    }
  }
}
