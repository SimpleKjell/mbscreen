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
    <?php
    $art = $kampagne->art;
    $artArr = json_decode($art);


    ?>
    {{Form::label('art', 'Art / Geräte')}}
    <br>
    {{Form::checkbox('is_mobile', 'is_mobile', ($artArr) ? $artArr->mobile : '', ['id' => 'is_mobile'])}} {{Form::label('is_mobile', 'Mobil')}}
    <br>
    {{Form::checkbox('is_desktop', 'is_desktop', ($artArr) ? $artArr->desktop : '', ['id' => 'is_desktop'])}} {{Form::label('is_desktop', 'Desktop')}}
    <br>
    {{Form::checkbox('is_social', 'is_social', ($artArr) ? $artArr->social : '', ['id' => 'is_social'])}} {{Form::label('is_social', 'Social Media')}}
    <br>
  </div>

  <div class="form-group marginTopMedium">
    {{Form::label('text_2', 'Projektleitung')}}
    {{Form::text('text_2', $kampagne->text_2, ['class' => 'form-control', 'placeholder' => 'Projektleitung'])}}
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
  </div>
  <hr>
  <h3 class="marginTopMedium">Bildcontent</h3>
  <div class="row">
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php
        $url = '';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_main')->first())) {
          $url = $kampagne->getMedia('image_main')->first()->getUrl();
        }
        ?>
        {{Form::label('cover_image', 'Bild 1 (1200x720)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        <div class="text-center mt-3">
          {{Form::file('image_main')}}
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php
        $url = '';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_side')->first())) {
          $url = $kampagne->getMedia('image_side')->first()->getUrl();
        }
        ?>
        {{Form::label('image_side', 'Bild 2 (1200x623)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        <div class="text-center mt-3">
          {{Form::file('image_side')}}
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php
        $url = '';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_side_2')->first())) {
          $url = $kampagne->getMedia('image_side_2')->first()->getUrl();
        }
        ?>
        {{Form::label('cover_image', 'Bild 3 (1200x623)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        <div class="text-center mt-3">
          {{Form::file('image_side_2')}}
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group marginTopMedium">
        <?php
        $url = '';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_square')->first())) {
          $url = $kampagne->getMedia('image_square')->first()->getUrl();
        }
        ?>
        {{Form::label('image_square', 'Bild Quadrat (700x700)')}}<br>
        <img src="<?php echo $url;?>" alt="">
        <div class="text-center mt-3">
          {{Form::file('image_square')}}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <hr>
      <div class="form-group marginTopMedium">
        {{Form::label('image_content_1', 'Bildunterschrift')}}
        {{Form::text('image_content_1', $kampagne->image_content_1, ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
      </div>
      <div class="form-group marginTopMedium">
        {{Form::label('image_kanal_1', 'Kanal')}}
        {{Form::select('image_kanal_1', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], $kampagne->image_kanal_1 , ['class' =>  'form-control'])}}
      </div>
    </div>
    <div class="col">
      <hr>
      <div class="form-group marginTopMedium">
        {{Form::label('image_content_2', 'Bildunterschrift')}}
        {{Form::text('image_content_2', $kampagne->image_content_2, ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
      </div>
      <div class="form-group marginTopMedium">
        {{Form::label('image_kanal_2', 'Kanal')}}
        {{Form::select('image_kanal_2', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], $kampagne->image_kanal_2 , ['class' =>  'form-control'])}}
      </div>
    </div>
    <div class="col">
      <hr>
      <div class="form-group marginTopMedium">
        {{Form::label('image_content_3', 'Bildunterschrift')}}
        {{Form::text('image_content_3', $kampagne->image_content_3, ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
      </div>
      <div class="form-group marginTopMedium">
        {{Form::label('image_kanal_3', 'Kanal')}}
        {{Form::select('image_kanal_3', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], $kampagne->image_kanal_3 , ['class' =>  'form-control'])}}
      </div>
    </div>
    <div class="col">
      <hr>
      <div class="form-group marginTopMedium">
        {{Form::label('image_content_4', 'Bildunterschrift')}}
        {{Form::text('image_content_4', $kampagne->image_content_4, ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
      </div>
      <div class="form-group marginTopMedium">
        {{Form::label('image_kanal_4', 'Kanal')}}
        {{Form::select('image_kanal_4', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], $kampagne->image_kanal_4 , ['class' =>  'form-control'])}}
      </div>
    </div>
  </div>
  <hr>
  <h3 class="marginTopMedium">Videocontent</h3>
  <div class="row">
    <div class="col-md-2">
      {{Form::label('video_art', 'Videoart')}}
      {{Form::select('video_art', ['Vimeo', 'YouTube'], $kampagne->video_art , ['class' =>  'form-control'])}}
    </div>
    <div class="col-md-8">
      {{Form::label('video_url', 'Video ID')}}
      {{Form::text('video_url', $kampagne->video_url, ['class' => 'form-control', 'placeholder' => 'Video ID'])}}
    </div>
    <div class="col-md-2">
      {{Form::label('video_duration', 'Videolänge')}}
      {{Form::text('video_duration', $kampagne->video_duration, ['class' => 'form-control', 'placeholder' => 'in Sekunden, z.B. 120'])}}
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
