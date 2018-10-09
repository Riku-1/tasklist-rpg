<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Quest;


class MonstersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quest_id)
    {
      $monster = new Monster;

      return view('monsters.create', ['monster' => $monster, 'quest_id' => $quest_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $quest_id)
    {
      $quest = Quest::find($quest_id);
      $last_order = $quest->getLastOrder();
      //新しいモンスターは最後尾に追加する
      $order = ++$last_order;

      $quest->monsters()->create([
        'monster_name' => $request->monster_name,
        'monster_overview' => $request->monster_overview,
        'level' => $request->level,
        'order' => $order,
      ]);

      return redirect()->route('quests.show', ['quest_id' => $quest_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $quest_id  最終的にクエストページにリダイレクトするのでそのためだけに使用
     * @param  int  $monster_id
     * @return \Illuminate\Http\Response
     */
    public function edit($quest_id, $monster_id)
    {
      $monster = Monster::find($monster_id);

      return view('monsters.edit', ['quest_id' => $quest_id, 'monster' => $monster]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quest_id  最終的にクエストページにリダイレクトするのでそのためだけに使用
     * @param  int  $monster_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quest_id, $monster_id)
    {
      $monster = Monster::find($monster_id);
      $monster->update([
        'monster_name' => $request->monster_name,
        'monster_overview' => $request->monster_overview,
        'level' => $request->level,
      ]);
      return redirect()->route('quests.show', ['quest_id' => $quest_id]);
    }

    /**
     * 指定されたモンスターを削除し、その後削除した分ずれたorderを再設定する
     * @param  [type] int $quest_id [description] モンスターが所属するクエストのid
     * @param  [type] int $order    [description] そのクエスト内でのモンスターの順番
     * @return [type] void [description] Ajax処理でDB保存を行うため値を返さない
     */
    public function destroy($quest_id, $order)
    {
      $quest = Quest::find($quest_id);
      $monsters = $quest->monsters()->paginate(100);
      $monster_num_in_quest = $monsters->count();
      $monster = $monsters->where('order', $order)->first();
      $monster->delete();

      //消去した分orderに抜けが出るので修正する
      for ($i=$order+1; $i <= $monster_num_in_quest ; $i++) {
        $monster = $monsters->where('order', $i)->first();
        $monster->order = $i - 1;
        $monster->save();
      }

    }
}
