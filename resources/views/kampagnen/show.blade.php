@extends('layouts.admin')

@section('content')

  <a class="btn btn-primary" href="/admin/kampagnen">Zurück zu allen Kampagnen </a><br>
  <h1 class="mb-md-3">{{ $kampagne->title }}</h1>
  <img src="/storage/cover_images/{{$kampagne->cover_image}}">
  <br>
  <p>{!! $kampagne->desc !!}</p>
  <hr>
  <a href="/admin/kampagnen/{{$kampagne->id}}/edit" class="btn btn-info">Bearbeiten</a>

  {!! Form::open(['action' => ['KampagnenController@destroy', $kampagne->id], 'method' => 'POST', 'class' => 'float-right']) !!}

    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Löschen', ['class' => 'btn btn-danger'])}}

  {!! Form::close() !!}

@endsection
