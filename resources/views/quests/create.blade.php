@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => 'quests.store']) !!}
  <div class="form-group">
    {!! Form::label('quest_name', 'クエストの名前') !!}
    {!! Form::text('quest_name', old('quest_name'), ['class' => 'form-control']) !!}

    {!! Form::label('quest_overview', 'クエストの概要（自由記入）') !!}
    {!! Form::textarea('quest_overview', old('quest_overview'), ['class' => 'form-control']) !!}

    {!! Form::submit('報酬生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
