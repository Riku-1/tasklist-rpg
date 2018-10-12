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
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>



  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary">Left</button>
    <button type="button" class="btn btn-secondary">Middle</button>
    <button type="button" class="btn btn-secondary">Right</button>
  </div>
@endsection
