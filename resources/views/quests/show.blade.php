@extends('layouts.app')

@section('content')
  <!--自分以外のクエストは見えなくする-->
  <!--このページは後で全く違う形にする。ロードマップを表示する形式に-->
  {!! link_to_route('lesser_enemies.create', 'モンスターを追加', ['quest_id' => $quest->id]) !!}
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">名前</th>
        <th scope="col">画像</th>
        <th scope="col">レベル</th>
        <th scope="col">残り体力</th>
        <th scope="col">報酬</th>
        <th scope="col">順番</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody id="monster_table">
      @foreach ($quest->lesser_enemies as $lesser_enemy)
        <td>{{ $lesser_enemy->enemy_name }}</td>
        <!--自由記入欄なので文字数の処理を考える-->
        <td><img src="{{ secure_asset("image/boss.png") }}" alt="Boss"></td>
        <td>{{ $lesser_enemy->level }}</td>
        <td>{{ $lesser_enemy->hp }}</td>
        <td>
          @php
            if ($lesser_enemy->reward_id) {
              $reward = $quest->reward();
              echo $reward;
            }
            else {
              // null（報酬の指定なし）なら報酬はガチャ券
              echo "ガチャ券";
            }
          @endphp
        </td>
        <td>0</td>
        <td>
          <!--ここから削除ボタン-->
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            -
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  このモンスターを削除しますか？
                </div>
                <div class="modal-footer">
                  {!! Form::open(['route' => ['lesser_enemies.destroy', $lesser_enemy->id, $quest->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          <!--ここまで削除ボタン-->
        </td>
      </tr>
      @endforeach
      <tr id="boss_tr">
        {{--ここからtrが終わるまでボス情報。
        !!! ボスは$questから、ザコ敵は$lesser_enemyから引っ張ってきており、エラーの原因になりやすいので気をつけること
        --}}
        <td>{{ $quest->enemy_name }}</td>
        <!--自由記入欄なので文字数の処理を考える-->
        <td><img src="{{ secure_asset("image/boss.png") }}" alt="Boss"></td>
        <td>{{ $quest->level }}</td>
        <td>{{ $quest->hp }}</td>
        <td>
          @php
            if ($quest->reward_id) {
              $reward = $quest->reward();
              echo $reward;
            }
            else {
              // null（報酬の指定なし）なら報酬はガチャ券
              echo "ガチャ券";
            }
          @endphp
        </td>
        <td>0</td>
        {{--ボスは削除不可--}}
        <td></td>
      </tr>
    </tbody>
  </table>
  <script>
    $('#monster_table').sortable({
      //bossは並び替えできない
      items: '> tr:not(#boss_tr)',
      //ドラッグ＆ドロップのときにhelperの高さが変わらないようにする
      placeholder: '#monster_table > tr',
      forcePlaceholderSize: true,
      tolerance: 'pointer',
      });
    $('#monster_table').disableSelection();

    $('#monster_table').bind('sortstop', function (e, ui) {
    // ソートが完了したら実行される。
    })

  </script>
@endsection
