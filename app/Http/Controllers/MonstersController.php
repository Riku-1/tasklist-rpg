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
      $quest->monsters()->create([
        'monster_name' => $request->monster_name,
        'monster_overview' => $request->monster_overview,
        'level' => $request->level,
        'order' => $request->order,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($monster_id, $quest_id)
    {
      $monster = Monster::find($monster_id);
      $monster->delete();

      return redirect()->route('quests.show', ['quest_id' => $quest_id]);
    }
}