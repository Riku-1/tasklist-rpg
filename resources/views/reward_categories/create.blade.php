@extends('layouts.app')

@section('content')
  {!! Form::open(['route' => 'reward_categories.store']) !!}
  <div class="form-group">
    {!! Form::label('reward_name', '報酬の名前') !!}
    {!! Form::text('reward_name', old('reward_name'), ['class' => 'form-control']) !!}

    <div class="form-row align-items-center">
      <div class="col-auto my-1">
        <label class="my-1 mr-2" for="rarity_select">レアリティ</label>
        <select class="custom-select my-1 mr-sm-2" id="rarity_select" name="rarity">
          <option value="0" selected>C</option>
          <option value="1">B</option>
          <option value="2">A</option>
          <option value="3">S</option>
        </select>
      </div>
    </div>

    {!! Form::submit('報酬生成') !!}
    {!! Form::close() !!}
  </div>
@endsection
