@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Kampagnen</h1>

  @if(count($kampagnes) > 0)

    <div class="row">

      @foreach($kampagnes as $kampagne)

        <div class="col">
          <div class="card">
            <img class="card-img-top" src="/storage/cover_images/{{$kampagne->cover_image}}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><a href="/admin/kampagnen/{{$kampagne->id}}">{{ $kampagne->title }}</a></h5>
              <p class="card-text">{!! $kampagne->desc !!}</p>
            </div>
          </div>
        </div>

      @endforeach

    </div>
  @else
    <p>
      Keine Kampagnen vorhanden.
    </p>
  @endif

  <a href="/admin/kampagnen/create" class="mt-md-3 btn btn-block btn-info" >Weitere Kampagne hinzufügen</a>

@endsection
