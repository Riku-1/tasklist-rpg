@extends('layouts.app')

@section('content')
  {!! Form::model($quest, ['route' => ['quests.update', $quest->id], 'method' => 'put']) !!}
  <div class="form-group">
    {!! Form::label('quest_name', '名前') !!}
    {!! Form::text('quest_name', old('quest_name'), ['class' => 'form-control']) !!}

    {!! Form::label('quest_overview', '概要（自由記入）') !!}
    {!! Form::textarea('quest_overview', old('quest_overview'), ['class' => 'form-control']) !!}

    {!! Form::submit('編集完了') !!}
  {!! Form::close() !!}
  </div>
@endsection
