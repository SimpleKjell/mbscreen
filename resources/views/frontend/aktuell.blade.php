

<div class="live-container paddingTopMedium pb-4 container">
  <div class="container">
    <div class="grid">
      <div class="gutter-sizer"></div>
      <div class="grid-sizer"></div>
      @if($posts)
      <!-- card-columns -->
        @foreach($posts as $post)


              <?php

              switch ($post['portal']) {
                case 'facebook':
                    ?>
                    <div class="grid-item">
                      <div class=" card {{$post['portal']}}">
                        @if($post['picture'])
                        <div class="card-img-top" style="background-image: url({{$post['picture']}});">
                          <!-- <img class="card-img-top" src="/storage/images/pixel.jpg" alt=""> -->
                          <img src="{{$post['picture']}}" alt="">
                        </div>
                        @endif
                        <div class="social-icon">
                          <img src="/storage/images/fb.png" alt="">
                        </div>
                        @if($post['message'])
                        <div class="card-body">
                          <p class="card-text">{{$post['message']}}</p>
                          <hr>
                          <p>
                            <small>{{$post['belongs_to']}}</small>
                            <br>
                            <span class="date">{{date('d. F Y H:i', $post['created'])}}</span>
                          </p>
                        </div>
                        @endif
                      </div>
                    </div>


                    <?php
                  break;
                case 'instagram':
                  ?>
                  <div class="grid-item">
                    <div class=" card {{$post['portal']}}">
                      <div class="card-img-top" style="background-image: url({{$post['picture']}});">
                        <img class="card-img-top" src="/storage/images/pixel.jpg" alt="">
                      </div>
                      <div class="social-icon">
                        <img src="/storage/images/insta.png" alt="">
                      </div>
                      <div class="card-body">
                        <p class="card-text">{!! html_entity_decode($post['message'], ENT_QUOTES, 'UTF-8') !!}</p>
                        <hr>
                        <p>
                          <small>{{$post['belongs_to']}}</small>
                          <br>
                          <span class="date">{{date('d. F Y H:i', $post['created'])}}</span>
                        </p>
                      </div>
                    </div>
                  </div>


                  <?php
                  break;
                case 'twitter':
                  ?>
                  <div class="grid-item">
                    <div class=" card {{$post['portal']}}">
                      @if($post['picture'])
                      <div class="card-img-top" style="background-image: url({{$post['picture']}});">
                        <img class="card-img-top" src="/storage/images/pixel.jpg" alt="">
                      </div>
                      @endif

                      <div class="social-icon">
                        <img src="/storage/images/twitter.png" alt="">
                      </div>
                      <div class="card-body">
                        <p class="card-text">{{$post['message']}}</p>
                        <hr>
                        <p>
                          <b>{{$post['belongs_to']}}</b>
                          <br>
                          <span class="date">{{date('d. F Y H:i', $post['created'])}}</span>
                        </p>
                      </div>
                    </div>
                  </div>

                  <?php
                  break;
              }

              ?>




        @endforeach

      @endif

      <div class="clear"></div>
    </div>

  </div>
</div>
