@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Füge weitere {{$social->social}} Page hinzu.</h1>


  <!--  Pages gibt es nur für Facebook-->
  @if($social->social == 'Facebook')

    @if($pages)

      {!! Form::open(['action' => ['SocialInstancesController@store', $social->id], 'method' => 'POST'] ) !!}


        @if($kunden)
          <div class="form-group marginTopMedium">
            {{Form::label('kunden_id', 'Kunde')}}
            {{Form::select('kunden_id', $kunden, Null, ['class' =>  'form-control'])}}
          </div>
        @endif

        <div class="form-group">
          {{Form::label('page_id', 'Pages')}}
          {{Form::select('page_id', $pages, NULL, ['class' => 'form-control'])}}
        </div>

        {{Form::hidden('social_id', $social->id)}}
        {{Form::hidden('anz_posts', '10')}}


        {{Form::submit('Hinzufügen', ['class' => 'btn btn-info btn-block'])}}

      {!! Form::close() !!}


    @else

      @if($facebook_l)
        <p>
          Es wird eine App-Authorisierung benötigt, um die Pages auslesen zu können.
          <br>          
          Sollte ein weiterer Administrator hinzugefügt werden ( bisher: Kevin Mayr ), muss dieser ebenfalls in der FB- App hinterlegt werden.
        </p>
        <br><br>
        <a href="{{$facebook_l}}" class="btn btn-outline-info btn-lg btn-block">Facebook</a>


      @endif

    @endif


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

    {!! Form::open(['action' => ['SocialInstancesController@store', $social->id], 'method' => 'POST'] ) !!}


      <div class="form-group">
        {{Form::label('title', 'Accountname')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Name des Accounts, z.B. mediabrothers'])}}
      </div>
      <div class="form-group">
        {{Form::label('page_id', 'Page ID')}}
        {{Form::text('page_id', '', ['class' => 'form-control', 'placeholder' => 'Name des Accounts, z.B. 1771883507 (mb)'])}}
      </div>


      {{Form::hidden('social_id', $social->id)}}
      {{Form::hidden('anz_posts', '10')}}


      {{Form::submit('Hinzufügen', ['class' => 'btn btn-info btn-block'])}}

    {!! Form::close() !!}

  @endif













@endsection
