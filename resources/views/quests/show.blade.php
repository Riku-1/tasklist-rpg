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
        <td><img src="{{ secure_asset($monster->choiceImageFromLevel()) }}" alt="Boss"></td>
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
  <script>
    {{--ここから並び替え処理--}}
    $('#monster_table').sortable({
      //ドラッグ＆ドロップのときにhelperの高さが変わらないようにする
      placeholder: '#monster_table > tr',
      forcePlaceholderSize: true,
      tolerance: 'pointer',
      update: function () {
        //並び替えられた順にorderを引っ張ってきて配列を作る
        var orders = $(this).find('[class="order"]').text();
        var separator = ',';
        var array_orders = orders.split(separator);
        array_orders.pop()

        $.post('save_order', {
          'array_orders[]': array_orders,
          'quest_id': {{ $quest->id }},
          //CSRF対策
          '_token': '{{ csrf_token() }}',
        })

        //データベース保存が終わってからorderセルの番号を書き直す。これをやっておかないと再度並べ替えたとき順番がめちゃくちゃになる
        .always(function () {
          $('#monster_table').find('[class="order"]').each(function (i) {
            //区切り文字,が必要
            $(this).text(i + ",");
          })
        })
      }
    })

    $('#monster_table').disableSelection();
    {{--ここまで並び替え処理--}}

    {{--ここからHPのスライダー処理--}}
      $('[id=hp_slider]').change(function () {
        {{--labelの書き換え--}}
        var hp = $(this).val();
        $(this).prev().text(hp + "/100")

        {{--AjaxでデータをDBに保存--}}
        $.post('save_hp', {
          'quest_id': {{ $quest->id }},
          'hp' : hp,
          'monster_num':  $('[id=hp_slider]').index(this),
          //CSRF対策
          '_token': '{{ csrf_token() }}',
        })

      })
    {{--ここまでHPのスライダー処理--}}
  </script>
  <p id="log"></p>
@endsection
