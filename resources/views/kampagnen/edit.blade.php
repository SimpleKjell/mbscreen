@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$kampagne->title}}</h1>

  {!! Form::open(['action' => ['KampagnenController@update', $kampagne->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
      <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $kampagne->title, ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
      </div>
      <div class="form-group">
        {{Form::label('desc', 'Beschreibung')}}
        {{Form::textarea('desc', $kampagne->desc, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      <div class="form-group">
        {{Form::label('video_url', 'Video URL (Youtube,Vimeo)')}}
        {{Form::text('video_url', '', ['class' => 'form-control', 'placeholder' => 'https://www.youtube.com/watch?v=ZHyopzbBuFk'])}}
      </div>
      <a href="/admin/kampagnen/{{$kampagne->id}}" class="btn btn-secondary">Zurück</a>
      {{Form::hidden('_method', 'PUT')}}
      {{Form::submit('Bearbeiten', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
