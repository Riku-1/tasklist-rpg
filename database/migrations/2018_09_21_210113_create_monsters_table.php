<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('quest_id')->unsigned()->index;
            $table->string('monster_name', 100);
            $table->string('monster_overview')->nullable();
            //敵のレベル（タスクの難易度）を表す。難易度を可視化してあまり難しいタスクはさらに分割させることが狙い
            //レベルによって敵画像を変更する
            $table->integer('level')->unsigned()->default(1);
            //敵のHP（タスクの進行度）を表す。0以下なら撃破済み
            $table->integer('hp')->default(100);
            //敵の並びを管理
            $table->integer('order')->unsigned();

            $table->foreign('quest_id')->references('id')->on('quests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
