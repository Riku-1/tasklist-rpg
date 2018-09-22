@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => 'quests.store']) !!}
  <div class="form-group">
    {!! Form::label('quest_name', 'クエスト名') !!}
    {!! Form::text('quest_name', old('quest_name'), ['class' => 'form-control']) !!}

    {!! Form::label('quest_overview', 'クエストの概要（自由記入）') !!}
    {!! Form::textarea('quest_overview', old('quest_overview'), ['class' => 'form-control']) !!}

    {{--後々ボスの名前は別ページで入力することにする。あとボスの名前はクエスト名から自動入力--}}
    {!! Form::label('enemy_name', 'ボスの名前') !!}
    {!! Form::text('enemy_name', old('enemy_name'), ['class' => 'form-control']) !!}

    {!! Form::label('enemy_overview', 'クエストの概要（自由記入）') !!}
    {!! Form::textarea('enemy_overview', old('enemy_overview'), ['class' => 'form-control']) !!}

    {!! Form::label('level', 'レベル') !!}
    {!! Form::select('level', [1, 2, 3, 4, 5], old('rarity')) !!}

    {!! Form::submit('報酬生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
