@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$kampagne->title}}</h1>

  {!! Form::open(['action' => ['KampagnenController@update', $kampagne->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
  <hr>
  <h3 class="marginTopMedium">Bezeichnung</h3>
  <div class="form-group marginTopMedium">
    {{Form::label('title', 'Title')}}
    {{Form::text('title', $kampagne->title, ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
  </div>
  <hr>
  <h3 class="marginTopMedium">Textcontent</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">

        {{Form::label('text_1', 'Haupttext (Max. 600 Zeichen)')}}
        {{Form::textarea('text_1', $kampagne->text_1, ['id' => 'article-ckeditor-x', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}

      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">

        {{Form::label('text_2', 'Textfield 2 (Max. 300)')}}
        {{Form::textarea('text_2', $kampagne->text_2, ['id' => 'article-ckeditor-x', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}

      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">

        {{Form::label('text_3', 'Textfield 3 (Max. 300)')}}
        {{Form::textarea('text_3', $kampagne->text_3, ['id' => 'article-ckeditor-x', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}

      </div>
    </div>
  </div>
  <hr>
  <h3 class="marginTopMedium">Bildcontent</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php
        $url = '';
        $media = $kampagne->getFirstMedia('main');
        if(!is_null($media)) {
          $url = $media->getUrl();
        }
        ?>
        {{Form::label('cover_image', 'Bild 1 (1200x720)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        {{Form::file('image_main')}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php $media = $kampagne->getFirstMedia('side');
        if(!is_null($media)) {
          $url = $media->getUrl();
        } ?>
        {{Form::label('image_side', 'Bild 2 (1200x623)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        {{Form::file('image_side')}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php $media = $kampagne->getFirstMedia('side_2');
        if(!is_null($media)) {
          $url = $media->getUrl();

        } ?>
        {{Form::label('cover_image', 'Bild 3 (1200x623)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        {{Form::file('image_side_2')}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php $media = $kampagne->getFirstMedia('square');
        if(!is_null($media)) {
          $url = $media->getUrl();
        } ?>
        {{Form::label('image_square', 'Bild Quadrat (700x700)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        {{Form::file('image_square')}}
      </div>
    </div>
  </div>
  {{Form::hidden('_method', 'PUT')}}
  {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
  {!! Form::close() !!}

@endsection
