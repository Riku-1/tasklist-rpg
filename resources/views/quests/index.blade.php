@extends('layouts.app')

@section('content')
  <div>
    {!! link_to_route('quests.create', 'クエストの種類を追加') !!}
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">冒険の書</th>
        <th scope="col">概要</th>
        <th scope="col">難易度</th>
        <th scope="col">進行度</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($quests as $quest)
        <tr>
          <td>{!! link_to_route('quests.show', $quest->quest_name, ['id' => $quest->id]) !!}</td>
          <!--自由記入欄なので文字数の処理を考える-->
          <td>{{ $quest->quest_overview }}</td>
          <td>30</td>
          <td></td>
          <td>

          </td>
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
