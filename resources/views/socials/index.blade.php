@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Socials</h1>

  @if(count($socials) > 0)

    <div class="row">

      @foreach($socials as $social)

        <div class="col">
          <div class="card">
            <img class="card-img-top" src="/storage/cover_images/bilsd" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><a href="/admin/kampagnen/test">Titel</a></h5>
              <p class="card-text">Beschreibung</p>
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
