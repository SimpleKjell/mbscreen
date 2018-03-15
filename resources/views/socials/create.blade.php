@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Social Media</h1>

  <!--  Facebook Accs Token -->
  @if($access_token)

  {!! Form::open(['action' => 'SocialController@store', 'method' => 'POST'] ) !!}
      <div class="form-group">
        <h3>Erstelle Facebook Verbindung</h3>
        {{Form::hidden('social', 'Facebook')}}
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

    @if(!$twitter)
      {!! Form::open(['action' => 'SocialController@store', 'method' => 'POST'] ) !!}


          {{Form::hidden('social', 'Twitter')}}

          {{Form::submit('Twitter', ['class' => 'btn btn-outline-warning btn-lg btn-block'])}}
      {!! Form::close() !!}
    @endif

    @if(!$instagram)
      {!! Form::open(['action' => 'SocialController@store', 'method' => 'POST'] ) !!}


          {{Form::hidden('social', 'Instagram')}}

          {{Form::submit('Instagram', ['class' => 'btn btn-outline-secondary btn-lg btn-block'])}}
      {!! Form::close() !!}
    @endif

  </div>

  @endif





@endsection
