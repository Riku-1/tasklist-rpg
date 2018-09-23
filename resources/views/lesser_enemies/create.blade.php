@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => ['lesser_enemies.store', $quest_id]]) !!}
  <div class="form-group">
    {!! Form::label('enemy_name', '名前') !!}
    {!! Form::text('enemy_name', old('enemy_name'), ['class' => 'form-control']) !!}

    {!! Form::label('enemy_overview', '概要（自由記入）') !!}
    {!! Form::textarea('enemy_overview', old('enemy_overview'), ['class' => 'form-control']) !!}

    {!! Form::label('level', 'レベル') !!}
    {!! Form::select('level', [1, 2, 3, 4, 5], old('rarity')) !!}

    <!--orderは後々ドラッグ＆ドロップとセレクト選択で入れ替えの二種類で-->
    {!! Form::label('order', '順番') !!}
    {!! Form::select('order', [1, 2, 3, 4, 5], old('order')) !!}

    {!! Form::submit('モンスター生成') !!}
  {!! Form::close() !!}
  </div>
@endsection
