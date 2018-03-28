@extends('layouts.admin')

@section('content')

  <h1>{{$socialInstance->title}}</h1>

  {!! Form::open(['action' => ['SocialInstancesController@update', $sId, $socialInstance->id], 'method' => 'POST'] ) !!}


    <div class="form-group">
      {{Form::label('title', 'Accountname')}}
      {{Form::text('title', $socialInstance->title, ['class' => 'form-control', 'placeholder' => 'Name des Accounts, z.B. mediabrothers'])}}
    </div>

    @if($kunden)
      <div class="form-group marginTopMedium">
        {{Form::label('kunden_id', 'Kunde')}}
        {{Form::select('kunden_id', $kunden, $socialInstance->kunden_id, ['class' =>  'form-control'])}}
      </div>
    @endif

    <div class="form-group">
      {{Form::label('page_id', 'Page ID')}}
      {{Form::text('page_id', $socialInstance->page_id, ['class' => 'form-control', 'placeholder' => 'Name des Accounts, z.B. 1771883507 (mb)'])}}
    </div>

    <div class="form-group">
      {{Form::label('anz_posts', 'Anzahl Posts')}}
      {{Form::number('anz_posts', $socialInstance->anz_posts, ['class' => 'form-control', 'max' => 10, 'placeholder' => '10'])}}
    </div>

    <div class="form-group">
      {{Form::checkbox('use_wall', 'val', NULL, ['class' => '', ($socialInstance->use_wall == "val") ? 'checked' : '', 'id' => 'use_wall'])}}
      {{Form::label('use_wall', 'Für die eigene Social Wall benutzen')}}
      <p>
        Wenn diese Option gewählt ist, erscheinen die Posts nur auf der eigenen Social Wall, unter <b>Mediabrothers Feed</b>.
      </p>
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Bearbeiten', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
    <a href="{{ url()->previous() }}" class="btn btn-secondary marginTopMedium">Zurück</a>
  {!! Form::close() !!}

@endsection
