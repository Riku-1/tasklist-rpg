@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => 'quests.store']) !!}
  <div class="form-group">
    {!! Form::label('quest_name', 'クエスト名') !!}
    {!! Form::text('quest_name', old('quest_name'), ['class' => 'form-control']) !!}

    {!! Form::label('quest_overview', 'クエストの概要（自由記入）') !!}
    {!! Form::textarea('quest_overview', old('quest_overview'), ['class' => 'form-control']) !!}

    {!! Form::submit('クエスト生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
