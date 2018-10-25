@extends('layouts.app')

@section('content')

  @foreach ($rewards as $reward)
    {{ $reward->reward_name . "を手に入れました" }}
    <br><br>
    <div>
      手に入れた報酬は所持アイテム欄に追加されます。
    </div>
  @endforeach
@endsection
