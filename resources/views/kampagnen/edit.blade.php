@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$kampagne->title}}</h1>

  {!! Form::open(['action' => ['KampagnenController@update', $kampagne->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
  <hr>
  <h3 class="marginTopMedium">Bezeichnung</h3>


  @if($kunden)
  <div class="form-group marginTopMedium">
    {{Form::label('kunden_id', 'Kunde')}}
    {{Form::select('kunden_id', $kunden, $kampagne->kunden_id, ['class' =>  'form-control'])}}
  </div>
  @endif

  <div class="form-group marginTopMedium">
    {{Form::label('title', 'Title')}}
    {{Form::text('title', $kampagne->title, ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
  </div>

  <div class="form-group marginTopMedium">
    {{Form::label('category', 'Kategorie')}}
    {{Form::select('category', ['Kampagne', 'Website', 'Gamification', 'Social Media Kampagne'], $kampagne->category, ['class' =>  'form-control'])}}
  </div>

  <div class="form-group marginTopMedium">
    {{Form::label('art', 'Art / Geräte')}}
    {{Form::select('art', ['Mobil', 'Desktop', 'Mobil & Desktop', 'Social Media'], $kampagne->art, ['class' =>  'form-control'])}}
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
        <?php $url = ''; $media = $kampagne->getFirstMedia('side');
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
        <?php $url = ''; $media = $kampagne->getFirstMedia('side_2');
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
        <?php $url = ''; $media = $kampagne->getFirstMedia('square');
        if(!is_null($media)) {
          $url = $media->getUrl();
        } ?>
        {{Form::label('image_square', 'Bild Quadrat (700x700)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        {{Form::file('image_square')}}
      </div>
    </div>
  </div>


  <hr>

  <!-- Web KPI -->
  <h3 class="marginTopMedium">Web-KPI</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('web_kpi_nutzer', 'Nutzer')}}
        {{Form::text('web_kpi_nutzer', $kampagne->web_kpi_nutzer, ['class' => 'form-control', 'placeholder' => 'Nutzer'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('web_kpi_aufrufe', 'Seitenaufrufe')}}
        {{Form::text('web_kpi_aufrufe', $kampagne->web_kpi_aufrufe, ['class' => 'form-control', 'placeholder' => 'Seitenaufrufe'])}}
      </div>
    </div>
  </div><!-- Web KPI -->

  <hr>

  <!--  Facbook KPI-->
  <h3 class="marginTopMedium">Facebook-KPI</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_reichweite', 'Reichweite')}}
        {{Form::text('fb_kpi_reichweite', $kampagne->fb_kpi_reichweite, ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_impressionen', 'Impressionen')}}
        {{Form::text('fb_kpi_impressionen', $kampagne->fb_kpi_impressionen, ['class' => 'form-control', 'placeholder' => 'Impressionen'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_likes', 'Likes')}}
        {{Form::text('fb_kpi_likes', $kampagne->fb_kpi_likes, ['class' => 'form-control', 'placeholder' => 'Likes'])}}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_kommentare', 'Kommentare')}}
        {{Form::text('fb_kpi_kommentare', $kampagne->fb_kpi_kommentare, ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_teilungen', 'Teilungen')}}
        {{Form::text('fb_kpi_teilungen', $kampagne->fb_kpi_teilungen, ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('fb_kpi_vid_views', 'Video Views')}}
        {{Form::text('fb_kpi_vid_views', $kampagne->fb_kpi_vid_views, ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
      </div>
    </div>
  </div><!--  Facbook KPI-->

  <hr>

  <!--  Instagram KPI-->
  <h3 class="marginTopMedium">Instagram-KPI</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('insta_kpi_reichweite', 'Reichweite')}}
        {{Form::text('insta_kpi_reichweite', $kampagne->insta_kpi_reichweite, ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('insta_kpi_likes', 'Likes')}}
        {{Form::text('insta_kpi_likes', $kampagne->insta_kpi_likes, ['class' => 'form-control', 'placeholder' => 'Likes'])}}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('insta_kpi_kommentare', 'Kommentare')}}
        {{Form::text('insta_kpi_kommentare', $kampagne->insta_kpi_kommentare, ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('insta_kpi_teilungen', 'Teilungen')}}
        {{Form::text('insta_kpi_teilungen', $kampagne->insta_kpi_teilungen, ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        {{Form::label('insta_kpi_vid_views', 'Video Views')}}
        {{Form::text('insta_kpi_vid_views', $kampagne->insta_kpi_vid_views, ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
      </div>
    </div>
  </div><!--  Instagram KPI-->

  {{Form::hidden('_method', 'PUT')}}
  {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
  {!! Form::close() !!}

@endsection
