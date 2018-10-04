@extends('layouts.app')

@section('content')
  @if (Auth::check())
    @if ($num_gacha_ticket == 0)
      {{ 'ガチャチケがありません' }}
    @else
      {!! link_to_route('gacha.result', 'ガチャを回す') !!}
    @endif
  @else
    <div class="center jumbotron">
      <div class="text-center">
        <h1>Tasklist RPG</h1>
        {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
      </div>
    </div>
  @endif
  <script type="text/javascript">
    $('button').click(function () {
      if (true) {

      }
    })
  </script>
@endsection
