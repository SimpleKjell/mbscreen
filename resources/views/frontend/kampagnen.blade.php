@extends('layouts.front')

@section('content')

  <div id="kampagnenSlider" class="carousel slide pb-md-3" data-interval="10000">
    <div class="kampagnen-container ml-3 mr-3">

      @if($kampagnen)
      <div data-items="{{count($kampagnen)}}" class="carousel-inner mb-step-content-container">


          @foreach($kampagnen as $key => $kampagne)
            <div class="carousel-item {{($key == 0 ) ? 'active' : ''}}">
              @include('inc.stepContent')
            </div>

          @endforeach



      </div>
      @endif




  </div>
  @include('inc.footNav')
</div>

@endsection
