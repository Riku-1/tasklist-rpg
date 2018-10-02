<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'QuestsController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => 'auth'], function ()
{
  //resourceのうちどのルートが必要か後で考えていらんやつは削る
  Route::resource('rewards', 'RewardsController');
  Route::resource('owned_items', 'OwnedItemsController');
  Route::resource('monster', 'MonstersController');

  Route::resource('quests', 'QuestsController');
  Route::post('quests/save_order', 'QuestsController@saveOrder');
  Route::post('quests/save_hp', 'QuestsController@saveHp');

  Route::group(['prefix' => 'monster'], function () {
    Route::get('{quest_id}/create', 'MonstersController@create')->name('monsters.create');
    Route::post('{quest_id}/store', 'MonstersController@store')->name('monsters.store');
    Route::delete('{quest_id}/{monster_id}', 'MonstersController@destroy')->name('monsters.destroy');
  });

  Route::group(['prefix' => 'gacha'], function () {
    Route::get('main', 'GachaController@main')->name('gacha.main');
    Route::get('result', 'GachaController@result')->name('gacha.result');
  });

});
