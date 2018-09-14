@extends('layouts.app')

@section('content')
  {{-- ユーザーが設定している報酬を表示する --}}
  <div>
    {!! link_to_route('reward_categories.create', '報酬の種類を追加') !!}
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
      <tr>
        <td>ゲーム１時間</td>
        <td>C</td>
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
          aaa
        </td>
        <td> <button type="button" name="button">－</button> </td>
      </tr>
    </tbody>
  </table>

  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary">Left</button>
    <button type="button" class="btn btn-secondary">Middle</button>
    <button type="button" class="btn btn-secondary">Right</button>
  </div>
@endsection
