@extends('layouts.app')

@section('content')
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">名前</th>
        <th scope="col">画像</th>
        <th scope="col">レベル</th>
        <th scope="col">残り体力</th>
        <th scope="col">報酬</th>
        <th scope="col">順番</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!--ここからtrが終わるまでボス情報-->
        <td>{{ $quest->enemy_name }}</td>
        <!--自由記入欄なので文字数の処理を考える-->
        <td><img src="{{ secure_asset("image/boss1.png") }}" alt="Boss"></td>
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
      </tr>
    </tbody>
  </table>

@endsection
