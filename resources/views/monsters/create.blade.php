@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => ['monsters.store', $quest_id]]) !!}
  <div class="form-group">
    {!! Form::label('monster_name', '名前') !!}
    {!! Form::text('monster_name', old('monster_name'), ['class' => 'form-control']) !!}

    {!! Form::label('monster_overview', '概要（自由記入）') !!}
    {!! Form::textarea('monster_overview', old('monster_overview'), ['class' => 'form-control']) !!}

    {!! Form::label('level', 'レベル') !!}
    {!! Form::select('level', [1, 2, 3, 4, 5], old('rarity')) !!}

    {!! Form::submit('モンスター生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
