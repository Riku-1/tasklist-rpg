@extends('layouts.app')

@section('content')
  {!! Form::model($reward, ['route' => ['rewards.update', $reward->id], 'method' => 'put']) !!}
  <div class="form-group">
    {!! Form::label('reward_name', '報酬の名前') !!}
    {!! Form::text('reward_name', old('reward_name'), ['class' => 'form-control']) !!}

    {!! Form::label('rarity', 'レアリティ') !!}
    {!! Form::select('rarity', ["C", "B", "A", "S"], $reward->rarity) !!}

    {!! Form::submit('設定更新') !!}
  {!! Form::close() !!}
  </div>
@endsection
