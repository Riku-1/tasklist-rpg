@extends('layouts.app')

@section('content')
  {!! Form::model($monster, ['route' => ['monsters.update', $quest_id, $monster->id], 'method' => 'put']) !!}
  <div class="form-group">
    {!! Form::label('monster_name', '名前') !!}
    {!! Form::text('monster_name', old('monster_name'), ['class' => 'form-control']) !!}

    {!! Form::label('monster_overview', '概要（自由記入）') !!}
    {!! Form::textarea('monster_overview', old('monster_overview'), ['class' => 'form-control']) !!}

    {{--ここで入力したレベルは内部的には-1された数字になるので気をつけるように--}}
    {!! Form::label('level', 'レベル') !!}
    {!! Form::select('level', [1, 2, 3, 4, 5], old('rarity')) !!}

    {!! Form::submit('編集完了') !!}
  {!! Form::close() !!}
  </div>
@endsection
