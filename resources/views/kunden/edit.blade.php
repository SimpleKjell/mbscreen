@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$kunde->title}}</h1>



    {!! Form::open(['action' => ['KundenController@update', $kunde->id], 'method' => 'POST'] ) !!}
        <hr>
        <h3 class="marginTopMedium">Bezeichnung</h3>
        <div class="form-group marginTopMedium">
          {{Form::label('title', 'Name')}}
          {{Form::text('title', $kunde->title, ['class' => 'form-control', 'placeholder' => 'Name des Kundens'])}}
        </div>
        <hr>
        <h3 class="marginTopMedium">Web-KPI</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('web_kpi_nutzer', 'Nutzer')}}
              {{Form::text('web_kpi_nutzer', $kunde->web_kpi_nutzer, ['class' => 'form-control', 'placeholder' => 'Nutzer'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('web_kpi_aufrufe', 'Seitenaufrufe')}}
              {{Form::text('web_kpi_aufrufe', $kunde->web_kpi_aufrufe, ['class' => 'form-control', 'placeholder' => 'Seitenaufrufe'])}}
            </div>
          </div>
        </div>

        <hr>

        <!--  Facbook KPI-->
        <h3 class="marginTopMedium">Facebook-KPI</h3>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_reichweite', 'Reichweite')}}
              {{Form::text('fb_kpi_reichweite', $kunde->fb_kpi_reichweite, ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_impressionen', 'Impressionen')}}
              {{Form::text('fb_kpi_impressionen', $kunde->fb_kpi_impressionen, ['class' => 'form-control', 'placeholder' => 'Impressionen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_likes', 'Likes')}}
              {{Form::text('fb_kpi_likes', $kunde->fb_kpi_likes, ['class' => 'form-control', 'placeholder' => 'Likes'])}}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_kommentare', 'Kommentare')}}
              {{Form::text('fb_kpi_kommentare', $kunde->fb_kpi_kommentare, ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_teilungen', 'Teilungen')}}
              {{Form::text('fb_kpi_teilungen', $kunde->fb_kpi_teilungen, ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('fb_kpi_vid_views', 'Video Views')}}
              {{Form::text('fb_kpi_vid_views', $kunde->fb_kpi_vid_views, ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
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
              {{Form::text('insta_kpi_reichweite', $kunde->insta_kpi_reichweite, ['class' => 'form-control', 'placeholder' => 'Reichweite'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_likes', 'Likes')}}
              {{Form::text('insta_kpi_likes', $kunde->insta_kpi_likes, ['class' => 'form-control', 'placeholder' => 'Likes'])}}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_kommentare', 'Kommentare')}}
              {{Form::text('insta_kpi_kommentare', $kunde->insta_kpi_kommentare, ['class' => 'form-control', 'placeholder' => 'Kommentare'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_teilungen', 'Teilungen')}}
              {{Form::text('insta_kpi_teilungen', $kunde->insta_kpi_teilungen, ['class' => 'form-control', 'placeholder' => 'Teilungen'])}}
            </div>
          </div>
          <div class="col">
            <div class="form-group marginTopMedium">
              {{Form::label('insta_kpi_vid_views', 'Video Views')}}
              {{Form::text('insta_kpi_vid_views', $kunde->insta_kpi_vid_views, ['class' => 'form-control', 'placeholder' => 'Video Views'])}}
            </div>
          </div>
        </div><!--  Instagram KPI-->


        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
    {!! Form::close() !!}




@endsection
