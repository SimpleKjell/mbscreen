@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Socials</h1>

  @if(count($socials) > 0)

    <div class="row">

      @foreach($socials as $social)

        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><a href="/admin/socials/{{$social->id}}">{{$social->social}}</a></h5>
            </div>
          </div>
        </div>

      @endforeach

    </div>
  @else
    <p>
      Keine Social Media Verbindungen vorhanden.
    </p>
  @endif

  <a href="/admin/socials/create" class="mt-md-3 btn btn-block btn-info" >Weitere Verbindung hinzufügen</a>

@endsection
