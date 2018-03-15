@extends('layouts.admin')

@section('content')

  <h1>{{$socialInstance->title}}</h1>

  {!! Form::open(['action' => ['SocialInstancesController@update', $sId, $socialInstance->id], 'method' => 'POST'] ) !!}
      <div class="form-group">
        {{Form::label('anz_posts', 'Anzahl Posts')}}
        {{Form::number('anz_posts', $socialInstance->anz_posts, ['class' => 'form-control', 'max' => 10, 'placeholder' => '10'])}}
      </div>

      <a href="{{ url()->previous() }}" class="btn btn-secondary">Zurück</a>
      {{Form::hidden('_method', 'PUT')}}
      {{Form::submit('Bearbeiten', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
