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
        <th scope="col">所持数</th>
        <th scope="col">レアリティ</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($rewards as $reward)
        <tr>
          <td>{{ $reward->reward_name }}</td>
          <!--あとでセレクトボックスつけて好きな数減らせるようにする-->
          <td>{{ $reward->num_owned }}</td>
          <td>{{ $reward->convertRarityValueIntoChar() }}</td>
          <td>
            {!! link_to_route('rewards.edit', '編集', ['id' => $reward->id]) !!}
          </td>
          <td>
            <!--ここから削除ボタン-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
              消費する
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
                    消費しますか？
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['route' => ['owned_items.update', $reward->id], 'method' => 'put']) !!}
                      {!! Form::submit('増やす', ['class' => 'btn btn-primary']) !!}
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



  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary">Left</button>
    <button type="button" class="btn btn-secondary">Middle</button>
    <button type="button" class="btn btn-secondary">Right</button>
  </div>
@endsection
