@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Kampagne</h1>



    {!! Form::open(['action' => 'KampagnenController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
        <hr>
        <h3 class="marginTopMedium">Bezeichnung</h3>


        @if($kunden)
        <div class="form-group marginTopMedium">
          {{Form::label('kunden_id', 'Kunde')}}
          {{Form::select('kunden_id', $kunden, Null, ['class' =>  'form-control'])}}
        </div>
        @endif

        <div class="form-group marginTopMedium">
          {{Form::label('title', 'Title')}}
          {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title der Kampagne'])}}
        </div>

        <div class="form-group marginTopMedium">
          {{Form::label('category', 'Kategorie')}}
          {{Form::select('category', ['Kampagne', 'Website', 'Gamification', 'Social Media Kampagne'], Null, ['class' =>  'form-control'])}}
        </div>

        <div class="form-group marginTopMedium">
          {{Form::label('art', 'Art / Geräte')}}
          <br>
          {{Form::checkbox('is_mobile', 'is_mobile', '', ['id' => 'is_mobile'])}} {{Form::label('is_mobile', 'Mobil')}}
          <br>
          {{Form::checkbox('is_desktop', 'is_desktop', '', ['id' => 'is_desktop'])}} {{Form::label('is_desktop', 'Desktop')}}
          <br>
          {{Form::checkbox('is_social', 'is_social', '', ['id' => 'is_social'])}} {{Form::label('is_social', 'Social Media')}}
          <br>
        </div>

        <div class="form-group marginTopMedium">
          {{Form::label('text_2', 'Projektleitung')}}
          {{Form::text('text_2', '', ['class' => 'form-control', 'placeholder' => 'Projektleitung'])}}
        </div>


        <hr>
        <h3 class="marginTopMedium">Textcontent</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">

              {{Form::label('text_1', 'Haupttext (Max. 600 Zeichen)')}}
              {{Form::textarea('text_1', '', ['id' => 'article-ckeditor-x', 'class' => 'form-control', 'placeholder' => 'Beschreibungstext'])}}

            </div>
          </div>
        </div>
        <hr>
        <h3 class="marginTopMedium">Bildcontent</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('cover_image', 'Bild 1 (1200x720)')}}<br>
              {{Form::file('image_main')}}
            </div>
            <hr>
            <div class="form-group marginTopMedium">
              {{Form::label('image_content_1', 'Bildunterschrift')}}
              {{Form::text('image_content_1', '', ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
            </div>
            <div class="form-group marginTopMedium">
              {{Form::label('image_kanal_1', 'Kanal')}}
              {{Form::select('image_kanal_1', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], Null, ['class' =>  'form-control'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('cover_image', 'Bild 1 (1200x623)')}}<br>
              {{Form::file('image_side')}}
            </div>
            <hr>
            <div class="form-group marginTopMedium">
              {{Form::label('image_content_2', 'Bildunterschrift')}}
              {{Form::text('image_content_2', '', ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
            </div>
            <div class="form-group marginTopMedium">
              {{Form::label('image_kanal_2', 'Kanal')}}
              {{Form::select('image_kanal_2', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], Null, ['class' =>  'form-control'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('cover_image', 'Bild 1 (1200x623)')}}<br>
              {{Form::file('image_side_2')}}
            </div>
            <hr>
            <div class="form-group marginTopMedium">
              {{Form::label('image_content_3', 'Bildunterschrift')}}
              {{Form::text('image_content_3', '', ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
            </div>
            <div class="form-group marginTopMedium">
              {{Form::label('image_kanal_3', 'Kanal')}}
              {{Form::select('image_kanal_3', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], Null, ['class' =>  'form-control'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('image_square', 'Bild Quadrat (700x700)')}}<br>
              {{Form::file('image_square')}}
            </div>
            <hr>
            <div class="form-group marginTopMedium">
              {{Form::label('image_content_4', 'Bildunterschrift')}}
              {{Form::text('image_content_4', '', ['class' => 'form-control', 'placeholder' => 'Bildunterschrift'])}}
            </div>
            <div class="form-group marginTopMedium">
              {{Form::label('image_kanal_4', 'Kanal')}}
              {{Form::select('image_kanal_4', ['Facebook', 'Instagram', 'Web', 'Twitter', 'Other'], Null, ['class' =>  'form-control'])}}
            </div>
          </div>
        </div>
        <hr>
        <h3 class="marginTopMedium">Videocontent</h3>
        <div class="row">
          <div class="col-md-2">
            {{Form::label('text_3', 'Videoart')}}
            {{Form::select('video_art', ['Vimeo', 'YouTube'], '' , ['class' =>  'form-control'])}}
          </div>
          <div class="col-md-8">
            {{Form::label('video_url', 'Videourl')}}
            {{Form::text('video_url', '', ['class' => 'form-control', 'placeholder' => 'Videourl'])}}
          </div>
          <div class="col-md-2">
            {{Form::label('video_duration', 'Videolänge')}}
            {{Form::text('video_duration', '', ['class' => 'form-control', 'placeholder' => 'Videourl'])}}
          </div>
        </div>

        <!--  Web KPI -->
        <hr>
        <h3 class="marginTopMedium">Web-KPI</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('web_kpi_nutzer', 'Nutzer')}}
              {{Form::text('web_kpi_nutzer', '', ['class' => 'form-control', 'placeholder' => 'Nutzer'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('web_kpi_aufrufe', 'Seitenaufrufe')}}
              {{Form::text('web_kpi_aufrufe', '', ['class' => 'form-control', 'placeholder' => 'Seitenaufrufe'])}}
            </div>
          </div>
        </div><!--  Web KPI -->

        <hr>

        <!--  Facbook KPI-->
        <h3 class="marginTopMedium">Facebook-KPI</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_reichweite', 'Reichweite')}}
              {{Form::text('fb_kpi_reichweite', '', ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_impressionen', 'Impressionen')}}
              {{Form::text('fb_kpi_impressionen', '', ['class' => 'form-control', 'placeholder' => 'Impressionen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_likes', 'Likes')}}
              {{Form::text('fb_kpi_likes', '', ['class' => 'form-control', 'placeholder' => 'Likes'])}}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_kommentare', 'Kommentare')}}
              {{Form::text('fb_kpi_kommentare', '', ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_teilungen', 'Teilungen')}}
              {{Form::text('fb_kpi_teilungen', '', ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_vid_views', 'Video Views')}}
              {{Form::text('fb_kpi_vid_views', '', ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
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
              {{Form::text('insta_kpi_reichweite', '', ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_likes', 'Likes')}}
              {{Form::text('insta_kpi_likes', '', ['class' => 'form-control', 'placeholder' => 'Likes'])}}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_kommentare', 'Kommentare')}}
              {{Form::text('insta_kpi_kommentare', '', ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_teilungen', 'Teilungen')}}
              {{Form::text('insta_kpi_teilungen', '', ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_vid_views', 'Video Views')}}
              {{Form::text('insta_kpi_vid_views', '', ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
            </div>
          </div>
        </div><!--  Instagram KPI-->

        {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
    {!! Form::close() !!}




@endsection
