@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Feed</h1>

  {!! Form::open(['action' => 'FeedsController@store', 'method' => 'POST'] ) !!}
      <div class="form-group">
        {{Form::label('feed_url', 'Feed URL')}}
        {{Form::text('feed_url', '', ['class' => 'form-control', 'placeholder' => 'http://www.mediabrothers.at/feed/'])}}
      </div>
      <div class="form-group">
        {{Form::label('anz_posts', 'Anzahl auszulesender Posts')}}
        {{Form::number('anz_posts', '', ['class' => 'form-control', 'placeholder' => '10', 'max' => '10'])}}
      </div>
      <a href="/admin/feeds" class="btn btn-secondary">Zurück zu allen Feeds</a>
      {{Form::submit('Absenden', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection
