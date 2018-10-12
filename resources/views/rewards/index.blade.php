@extends('layouts.app')

@section('content')
  {{-- ユーザーが設定している報酬を表示する --}}
  <div>
    {!! link_to_route('rewards.create', '報酬の種類を追加') !!}
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">報酬</th>
        <th scope="col">レアリティ</th>
        <th scope="col">有効無効切り替え</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($rewards as $reward)
        <tr>
          <td>{{ $reward->reward_name }}</td>
          <td>{{ $reward->convertRarityValueIntoChar() }}</td>
          <td>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-dark active">
                <input type="radio" name="options" id="enabled" autocomplete="off" checked>有効
              </label>
              <label class="btn btn-dark">
                <input type="radio" name="options" id="disabled" autocomplete="off">無効
              </label>
            </div>
          </td>
          <td>
            {!! link_to_route('rewards.edit', '編集', ['id' => $reward->id]) !!}
          </td>
          <td>
            <!--ここから削除ボタン-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete{{ $reward->id }}">
              -
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteTitle{{ $reward->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    この報酬を削除しますか？
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['route' => ['rewards.destroy', $reward->id], 'method' => 'delete']) !!}
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
