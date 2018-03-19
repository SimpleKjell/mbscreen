@extends('layouts.front')

@section('content')

<div class="social-container">


  <div class="container">

    @if($posts)




      @foreach($posts as $postCont)
      <div class="row pt-md-4">
          <div class="col card-deck">

            @if($postCont)

              @foreach($postCont as $post)

                <div class="card {{$post['portal']}}">
                  <div class="card-img-top" style="background-image: url({{$post['picture']}});">
                    <img class="card-img-top" src="/storage/images/pixel.jpg" alt="">
                  </div>
                  <div class="social-icon">
                    <img src="/storage/images/insta.png" alt=""> | {{$post['portal']}}
                  </div>
                  <div class="card-body">
                    <p class="card-text">{{$post['message']}}</p>
                  </div>
                </div>

              @endforeach

            @endif

          </div>
        </div>
      @endforeach

    @endif


  </div>
</div>

@endsection
