@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$kunde->title}}</h1>



    {!! Form::open(['action' => ['KundenController@update', $kunde->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
        <hr>
        <h3 class="marginTopMedium">Bezeichnung</h3>
        <div class="form-group marginTopMedium">
          {{Form::label('title', 'Name')}}
          {{Form::text('title', $kunde->title, ['class' => 'form-control', 'placeholder' => 'Name des Kundens'])}}
        </div>
        <div class="form-group marginTopMedium">
          <?php
          $url = '';
          $media = NULL;
          if(!is_null($kunde->getMedia('kunden_logo')->first())) {
            $url = $kunde->getMedia('kunden_logo')->first()->getUrl();
          }
          ?>
          {{Form::label('kunden_logo', 'Logo')}}<br>
          <img src="<?php echo $url;?>" alt="">
          {{Form::file('kunden_logo')}}
        </div>


        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
    {!! Form::close() !!}




@endsection
