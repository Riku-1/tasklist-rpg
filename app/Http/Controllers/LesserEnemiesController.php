<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LesserEnemy;
use App\Quest;


class LesserEnemiesController extends Controller
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
      $lesser_enemy = new LesserEnemy;

      return view('lesser_enemies.create', ['lesser_enemy' => $lesser_enemy, 'quest_id' => $quest_id]);
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
      $quest->lesser_enemies()->create([
        'enemy_name' => $request->enemy_name,
        'enemy_overview' => $request->enemy_overview,
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
    public function destroy($id)
    {
        //
    }
}
