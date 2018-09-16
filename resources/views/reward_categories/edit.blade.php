@extends('layouts.app')

@section('content')
  {!! Form::model($reward_category, ['route' => ['reward_categories.update', $reward_category->id], 'method' => 'put']) !!}
  <div class="form-group">
    {!! Form::label('reward_name', '報酬の名前') !!}
    {!! Form::text('reward_name', old('reward_name'), ['class' => 'form-control']) !!}

    {!! Form::label('rarity', 'レアリティ') !!}
    {!! Form::select('rarity', ["C", "B", "A", "S"], $reward_category->rarity) !!}

    {!! Form::submit('設定更新') !!}
  {!! Form::close() !!}
  </div>
@endsection
