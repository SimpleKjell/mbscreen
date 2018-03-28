@extends('layouts.admin')

@section('content')

  <h1>{{$socialInstance->title}}</h1>

  {!! Form::open(['action' => ['SocialInstancesController@update', $sId, $socialInstance->id], 'method' => 'POST'] ) !!}
      <div class="form-group">
        {{Form::label('anz_posts', 'Anzahl Posts')}}
        {{Form::number('anz_posts', $socialInstance->anz_posts, ['class' => 'form-control', 'max' => 10, 'placeholder' => '10'])}}
      </div>

      <!-- <div class="form-group">
        {{Form::checkbox('use_wall', 'val', NULL, ['class' => '', ($socialInstance->use_wall == "val") ? 'checked' : '', 'id' => 'use_wall'])}}
        {{Form::label('use_wall', 'Für die Social Wall benutzen')}}
      </div> -->

      {{Form::hidden('_method', 'PUT')}}
      {{Form::submit('Bearbeiten', ['class' => 'btn btn-info btn-block'])}}
      <a href="{{ url()->previous() }}" class="btn btn-secondary marginTopMedium">Zurück</a>
  {!! Form::close() !!}

@endsection
