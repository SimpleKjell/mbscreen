@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Kampagne</h1>

  {!! Form::open(['action' => 'KampagnenController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
      <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
      </div>
      <div class="form-group">
        {{Form::label('desc', 'Beschreibung')}}
        {{Form::textarea('desc', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      <div class="form-group">
        {{Form::label('video_url', 'Video URL (Youtube,Vimeo)')}}
        {{Form::text('video_url', '', ['class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}
      </div>
      <a href="/admin/kampagnen" class="btn btn-secondary">Zurück zu allen Kampagnen</a>
      {{Form::submit('Absenden', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
