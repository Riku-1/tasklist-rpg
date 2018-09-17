@extends('layouts.app')

@section('content')

  @foreach ($rewards as $reward)
    {{ $reward->reward_name }}
  @endforeach
@endsection
