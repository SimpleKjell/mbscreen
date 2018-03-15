@extends('layouts.front')

@section('content')



  <div id="carouselExampleIndicators" class="carousel slide my-md-3 p-md-3" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner mbStepContentContainer">
      <div class="carousel-item active">
        @include('inc.stepContent')
      </div>
      <div class="carousel-item">
        @include('inc.stepContent')
      </div>
      <div class="carousel-item">
        @include('inc.stepContent')
      </div>
    </div>

    @include('inc.footNav')
  </div>

@endsection
