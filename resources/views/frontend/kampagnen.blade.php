@extends('layouts.front')

@section('content')

  <div id="kampagnenSlider" class="carousel slide pb-md-3" data-ride="carousel" data-interval="10000">
    <div class="kampagnen-container ml-3 mr-3">

      <div class="carousel-inner mb-step-content-container">
        @if($kampagnen)

          @foreach($kampagnen as $key => $kampagne)
            <div class="carousel-item {{($key == 0 ) ? 'active' : ''}}">
              @include('inc.stepContent')
            </div>

          @endforeach

        @endif

      </div>




  </div>
  @include('inc.footNav')
</div>

  <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="..." alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->


@endsection
