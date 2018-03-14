@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Social Media</h1>

  <!--  Facebook Accs Token -->
  @if($access_token)

  {!! Form::open(['action' => 'SocialController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
      <div class="form-group">
        {{Form::label('social', 'Title')}}
        {{Form::text('social', 'Facebook', ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
      </div>

      {{Form::hidden('key', $access_token)}}


      {{Form::submit('Erstellen', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
  <!--  Facebook Accs Token -->

  @else

  <div class="">
    @if($facebook_l)
      <a href="{{$facebook_l}}" class="btn btn-outline-info btn-lg btn-block">Facebook</a>
    @endif

    <a href="" class="btn btn-outline-warning btn-lg btn-block">Twitter</a>
    <a href="" class="btn btn-outline-secondary btn-lg btn-block">Instagram</a>
  </div>

  @endif





@endsection
