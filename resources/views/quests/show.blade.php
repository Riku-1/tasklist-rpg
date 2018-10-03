@extends('layouts.app')

@section('content')
  <h1>画像のインパクトが強すぎてタスクネームがわかりにくい。</h1>
  <h1>文字を目立たせるか画像を小さくするべき</h1>

  <!--自分以外のクエストは見えなくする-->
  <!--このページは後で全く違う形にする。ロードマップを表示する形式に-->
  {!! link_to_route('monsters.create', 'モンスターを追加', ['quest_id' => $quest->id]) !!}
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">レベル</th>
        <th scope="col">画像</th>
        <th scope="col">名前</th>
        <th scope="col">HP(進行度)</th>
        <th scope="col">報酬</th>
        <th scope="col">順番</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody id="monster_table">
      @php
        //モンスターに番号を振るための変数。
        //$monster->orderで引っ張ってくるのも可能だが、変な値が入っていた場合に矯正できるように表示順に新しく番号を振る。
        $i = 0;
      @endphp
      @foreach ($quest->monsters()->orderBy('order', 'asc')->paginate(10); as $monster)
        {{--levelには表示より1小さい値が入ってるので修正して表示--}}
        <td>{{ $monster->level + 1 }}</td>
        <td><img src="{{ secure_asset($monster->choiceImageFromLevel()) }}" alt="モンスター"></td>
        {{--自由記入欄なので文字数の処理を考える--}}
        <td>{{ $monster->monster_name }}</td>
        <td>
          <form>
            <div class="form-group">
              <label for="hp_slider">{{ $monster->hp }}/100</label>
              <input type="range" class="form-control-range" id="hp_slider" value="{{ $monster->hp }}" step="10">
            </div>
          </form>
        </td>
        <td>
          @php
            if ($monster->reward_id) {
              $reward = $quest->reward();
              echo $reward;
            }
            else {
              // null（報酬の指定なし）なら報酬はガチャ券
              echo "ガチャ券";
            }
          @endphp
        </td>
        <!--ソート機能のためのセル-->
        <td class="order" id="{{ $i }}">{{ $i }},</td>
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
                  {!! Form::open(['route' => ['monsters.destroy', $monster->id, $quest->id], 'method' => 'delete']) !!}
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
      @php
        ++$i;
      @endphp
      @endforeach
    </tbody>
  </table>
  @include('script/sortable')
  @include('script/hp_slider')
  <p id="log"></p>
@endsection
