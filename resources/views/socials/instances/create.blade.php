@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Füge weitere {{$social->social}} Page hinzu.</h1>


  <!--  Pages gibt es nur für Facebook-->
  @if($pages)

    {!! Form::open(['action' => ['SocialInstancesController@store', $social->id], 'method' => 'POST'] ) !!}


      <div class="form-group">
        {{Form::label('page_id', 'Pages')}}
        {{Form::select('page_id', $pages, NULL, ['class' => 'form-control'])}}
      </div>



      {{Form::hidden('social_id', $social->id)}}
      {{Form::hidden('anz_posts', '10')}}


      {{Form::submit('Hinzufügen', ['class' => 'btn btn-info btn-block'])}}

    {!! Form::close() !!}


  @elseif($social->social == 'Twitter')

  {!! Form::open(['action' => ['SocialInstancesController@store', $social->id], 'method' => 'POST'] ) !!}


    <div class="form-group">
      {{Form::label('title', 'Accountname')}}
      {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Name des Accounts, z.B. MediaBrothers'])}}
    </div>



    {{Form::hidden('social_id', $social->id)}}
    {{Form::hidden('anz_posts', '10')}}


    {{Form::submit('Hinzufügen', ['class' => 'btn btn-info btn-block'])}}

  {!! Form::close() !!}

  @elseif($social->social == 'Instagram')

  Derzeit wird automatisiert https://www.instagram.com/mediabrothers/ ausgelesen.

  @endif













@endsection
