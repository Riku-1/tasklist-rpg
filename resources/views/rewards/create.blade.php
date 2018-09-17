@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => 'rewards.store']) !!}
  <div class="form-group">
    {!! Form::label('reward_name', '報酬の名前') !!}
    {!! Form::text('reward_name', old('reward_name'), ['class' => 'form-control']) !!}

    {!! Form::label('rarity', 'レアリティ') !!}
    {!! Form::select('rarity', ["C", "B", "A", "S"], old('rarity')) !!}

    {!! Form::submit('報酬生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
