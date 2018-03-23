<div class="container-fluid mbSteps text-center pt-md-3 ">

    <ul class="row carousel-indicators">


      @if($kampagnen)

        @foreach($kampagnen as $key => $kampagne)

          <li class="col mbStepSingle {{($key == 0 ) ? 'active' : ''}}" data-target="#kampagnenSlider" data-slide-to="{{$key}}">
            <div class="text-circle"></div>
            <br>
            <a href="#">{{$kampagne->title}}</a>
          </li>

        @endforeach

      @endif
    </ul>


</div>
