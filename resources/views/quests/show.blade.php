@extends('layouts.app')

@section('content')

  <h2>クエスト：{{ $quest->quest_name }}</h2>
  <h3>概要：{{ $quest->quest_overview }}</h3>
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
        <th scope="col" style="display:none">順番</th>
        <th scope="col" style="display:none">is_alive</th>
        <th scope="col">削除</th>
        <th scope="col">編集</th>
      </tr>
    </thead>
    <tbody id="sortable_table">
      @php
        //モンスターに番号を振るための変数。
        //$monster->orderで引っ張ってくるのも可能だが、変な値が入っていた場合に矯正できるように表示順に新しく番号を振る。
        $i = 0;
      @endphp
      @foreach ($quest->monsters()->orderBy('order', 'asc')->paginate(100); as $monster)
        <tr>
          {{--levelには表示より1小さい値が入ってるので修正して表示--}}
          <td>{{ $monster->level + 1 }}</td>
          <td><img src="{{ secure_asset($monster->choiceImageFromLevel()) }}" alt="モンスター" id="monster_img"></td>
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
          <!--ソート機能のためのセル-->
          <td class="order" id="{{ $i }}" style="display:none">{{ $i }},</td>
          <td class="is_alive" style="display:none">1</td>
          <td>
            <button type="button" class="btn btn-danger" id="deleteButton">
              -
            </button>
          </td>
          <td>{!! link_to_route('monsters.edit', '編集', ['quest_id' => $quest->id,'monster_id' => $monster->id]) !!}
        </tr>
      @php
        ++$i;
      @endphp
      @endforeach
    </tbody>
  </table>
  {{--modalは一つだけ作り押されたbuttonによってjQueryで書き換える--}}
  <!-- Modal -->
  <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <button type="button" class="btn btn-danger" id="finalConfirmDelete">削除する</button>
        </div>
      </div>
    </div>
  </div>
  @include('script/sortable')
  @include('script/hp_slider')
  @include('script/delete')
@endsection
