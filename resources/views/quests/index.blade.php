@extends('layouts.app')

@section('content')
  <div>
    {!! link_to_route('quests.create', 'クエストを追加') !!}
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">冒険の書</th>
        <th scope="col">概要</th>
        <th scope="col">進行度</th>
        <th scope="col">編集</th>
        <th scope="col">削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($quests as $quest)
        <tr>
          <td>{!! link_to_route('quests.show', $quest->quest_name, ['id' => $quest->id]) !!}</td>
          <!--自由記入欄なので文字数の処理を考える-->
          <td>{{ $quest->quest_overview }}</td>
          <td>{{ $quest->calcQuestProgress() }}</td>
          <td>{!! link_to_route('quests.edit', '編集', ['id' => $quest->id]) !!}</td>
          <td>
            <!--ここから削除ボタン-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">
              -
            </button>

            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    このクエストを削除しますか？
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['route' => ['quests.destroy', $quest->id], 'method' => 'delete']) !!}
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
    </tbody>
  </table>
@endsection
