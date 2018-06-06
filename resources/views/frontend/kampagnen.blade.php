@extends('layouts.front')

@section('content')

  <div id="kampagnenSlider" class="carousel slide pb-md-3" >
    <div class="kampagnen-container pl-3 pr-3">
      @if($kampagnen)

      <div data-items="{{count($kampagnen)}}" class="carousel-inner mb-step-content-container">
        <?php
        $videoCount = 0;
        ?>
          @foreach($kampagnen as $key => $kampagne)
            <div class="carousel-item {{($key == 0 ) ? 'active' : ''}}">
              @include('inc.stepContent')
            </div>
            <?php
            $videoCount++;
            ?>
          @endforeach

      </div>

      @endif
    </div>
    @include('inc.footNav')
  </div>
@endsection
