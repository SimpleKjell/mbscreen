
<div class="container-fluid">
  <div class="row">
    <!--  Projektinformation -->
    <div class="col-md-6 p-4">
      <div class="row bg-beige p-4">
        <!--  Projektlogo -->
        <div class="col-md-2 justify-content-center align-self-center">
          <div class="">
            <?php
            $url = '';
            $media = NULL;
            if(!is_null($kampagne->kunde->getMedia('kunden_logo')->first())) {
              $url = $kampagne->kunde->getMedia('kunden_logo')->first()->getUrl();
            }
            ?>
            <img class="rounded-circle" src="<?php echo $url;?>" alt="">
          </div>
        </div>
        <div class="col-md-8 pr-0 justify-content-center align-self-center">
          <div class="bg-white pt-2 pb-2 pl-3">
            <?php echo $kampagne->title; ?>
          </div>
          <div class="bg-white pt-2 pb-2 pl-3 mt-3">
            <?php echo $kampagne->kunde->title; ?>
          </div>
        </div>
        <div class="col-md-2 pr-0 justify-content-center align-self-center">
          <div class="bg-white p-3 h-100 text-center">
            <?php
            switch ($kampagne->category) {
              case '0':
                echo 'Kampagne';
                break;
              case '1':
                echo 'Website';
                break;
              case '2':
                echo 'Gamification';
                break;
              case '3':
                echo 'Social Media Kampagne';
                break;
            }

            $art = $kampagne->art;
            if($art) {
              $artArr = json_decode($art);
              if(!is_null($artArr->mobile))
                echo '<div>Mobile</div>';
              if(!is_null($artArr->desktop))
                echo '<div>Desktop</div>';
              if(!is_null($artArr->desktop))
                echo '<div>Social Media</div>';
            }


            ?>

          </div>
        </div>
      </div>
      <div class="row mt-3">
        <!--  Testbox -->
        @if($kampagne->web_kpi_aufrufe != '' && $kampagne->fb_kpi_likes != '' && $kampagne->insta_kpi_likes != '')

        <div class="col-md-6 pl-0">
          <div class="bg-beige p-3">
            <div class="bg-white p-3">
              <div class="desc-head">Projektleitung</div>
              {!! nl2br(e($kampagne->text_2))!!}
              <hr>
              <div class="desc-head">Beschreibung</div>
              {!! nl2br(e($kampagne->text_1))!!}
            </div>
          </div>
          <div class="bg-beige mt-3 p-3">
            <img width="30" src="/storage/images/uxpin-icon-set_world.png" alt=""> WEB-KPI
            <div class="row pl-3 pr-3 pt-3">
              <div class="col-md-6 pl-1 pr-2">
                <div class="box-blue p-2">
                  SEITENAUFRUFE
                  <hr>
                  <b><?php echo $kampagne->web_kpi_aufrufe; ?></b>
                </div>
              </div>
              <div class="col-md-6 pl-2 pr-1">
                <div class="white-box p-2">
                  NUTZER
                  <hr>
                  <b><?php echo $kampagne->web_kpi_nutzer; ?></b>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 pr-0">

          @if($kampagne->fb_kpi_likes != '' || $kampagne->fb_kpi_kommentare != '')
            <!--  Facebook API-->
            <div class="bg-beige p-3">
              <img width="30" src="/storage/images/fb_logo.png" alt=""> FACEBOOK-KPI
              <div class="row p-3">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REACTIONS
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_likes; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    Kommentare
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_kommentare; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 pb-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REICHWEITE
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_reichweite; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    IMPRESSIONEN
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_impressionen; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    SHARES
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_teilungen; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    VIDEO-VIEWS
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_vid_views; ?></b>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if($kampagne->insta_kpi_reichweite != '' || $kampagne->insta_kpi_kommentare != '')
            <!--  Facebook API-->
            <div class="{{($kampagne->insta_kpi_kommentare != '' ) ? 'mt-3' : ''}} bg-beige p-3">
              <img width="30" src="/storage/images/ig-logo-email.png" alt=""> INSTAGRAM-KPI
              <div class="row p-3">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REACTIONS
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_likes; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    Kommentare
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_kommentare; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    SHARES
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_teilungen; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    VIDEO-VIEWS
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_vid_views; ?></b>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        @else

        <div class="col-md-6 pl-0">
          <div class="bg-beige p-3 h-100">
            <div class="bg-beige h-100">
              <div class="bg-white h-100 p-3">
                <div class="desc-head">Projektleitung</div>
                {!! nl2br(e($kampagne->text_2))!!}
                <hr>
                <div class="desc-head">Beschreibung</div>
                {!! nl2br(e($kampagne->text_1))!!}
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-6 pr-0">

          @if($kampagne->web_kpi_aufrufe != '' || $kampagne->web_kpi_nutzer != '')
            <div class="bg-beige p-3">
              <img width="30" src="/storage/images/uxpin-icon-set_world.png" alt=""> WEB-KPI
              <div class="row pl-3 pr-3 pt-3">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="box-blue p-2">
                    SEITENAUFRUFE
                    <hr>
                    <b><?php echo $kampagne->web_kpi_aufrufe; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="white-box p-2">
                    NUTZER
                    <hr>
                    <b><?php echo $kampagne->web_kpi_nutzer; ?></b>
                  </div>
                </div>
              </div>
            </div>
          @endif

          @if($kampagne->fb_kpi_likes != '' || $kampagne->fb_kpi_kommentare != '')
            <!--  Facebook API-->
            <div class="{{($kampagne->web_kpi_aufrufe != '' ) ? 'mt-3' : ''}} bg-beige p-3">
              <img width="30" src="/storage/images/fb_logo.png" alt=""> FACEBOOK-KPI
              <div class="row p-3">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REACTIONS
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_likes; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    Kommentare
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_kommentare; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 pb-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REICHWEITE
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_reichweite; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    IMPRESSIONEN
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_impressionen; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    SHARES
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_teilungen; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    VIDEO-VIEWS
                    <hr>
                    <b><?php echo $kampagne->fb_kpi_vid_views; ?></b>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if($kampagne->insta_kpi_reichweite != '' || $kampagne->insta_kpi_kommentare != '')
            <!--  Facebook API-->
            <div class="{{($kampagne->insta_kpi_kommentare != '' ) ? 'mt-3' : ''}} bg-beige p-3">
              <img width="30" src="/storage/images/ig-logo-email.png" alt=""> INSTAGRAM-KPI
              <div class="row p-3">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    REACTIONS
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_likes; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    Kommentare
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_kommentare; ?></b>
                  </div>
                </div>
              </div>
              <div class="row pl-3 pr-3 mt-0">
                <div class="col-md-6 pl-1 pr-2">
                  <div class="white-box p-2">
                    SHARES
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_teilungen; ?></b>
                  </div>
                </div>
                <div class="col-md-6 pl-2 pr-1">
                  <div class="box-blue p-2">
                    VIDEO-VIEWS
                    <hr>
                    <b><?php echo $kampagne->insta_kpi_vid_views; ?></b>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        @endif

      </div>
    </div>
    <!--  Projektbilder -->
    <div class="col-md-6 p-4">
      <div class="row bg-beige p-4 h-100">
        <?php

        // Alle Bilder sammeln
        $bild_1 = $kampagne->getMedia('image_side')->first();
        $bild_2 = $kampagne->getMedia('image_side_2')->first();
        $bild_3 = $kampagne->getMedia('image_main')->first();
        $bild_4 = $kampagne->getMedia('image_square')->first();

        $slides = [];




        if(!is_null($bild_1)) {
          $slides[] = [
            'url' => $bild_1->getUrl(),
            'caption' => $kampagne->image_content_1,
            'logo' => $kampagne->image_kanal_1,
            'video' => false,
          ];
        }
        if(!is_null($bild_2)) {
          $slides[] = [
            'url' => $bild_2->getUrl(),
            'caption' => $kampagne->image_content_2,
            'logo' => $kampagne->image_kanal_2,
            'video' => false,
          ];
        }
        if(!is_null($bild_3)) {
          $slides[] = [
            'url' => $bild_3->getUrl(),
            'caption' => $kampagne->image_content_3,
            'logo' => $kampagne->image_kanal_3,
            'video' => false,
          ];
        }
        if(!is_null($bild_4)) {
          $slides[] = [
            'url' => $bild_4->getUrl(),
            'caption' => $kampagne->image_content_4,
            'logo' => $kampagne->image_kanal_4,
            'video' => false,
          ];
        }

        if($kampagne->video_url != '') {
          $slides[] = [
            'url' => $kampagne->video_url,
            'logo' => $kampagne->video_art,
            'duration' => $kampagne->video_duration,
            'video' => true,
          ];
        }


        ?>

        <div data-number="{{$key}}" class="kampagnenInsideSlide owl-carousel owl-carousel-{{$key}} owl-theme my-auto mx-auto">

            <?php
            $i = 0;
            foreach ($slides as $slide) {
              ?>

              <div class="<?php echo ($i == 0) ? '' : '';?>">
                <img class="d-block w-100" src="<?php echo $slide['url']; ?>" alt="">
                <div class="bg-white p-3">
                  <?php
                  if($slide['video']) {

                    $videoart = ($slide['logo'] == '1') ? 'youtube' : 'vimeo';
                    switch ($videoart) {
                      case 'youtube':
                        ?>
                        <div data-ele-id="<?php echo $videoCount;?>" data-duration="<?php echo $slide['duration']?>" class="videoWrapper" data-videoid="<?php echo $slide['url']; ?>" data-videoart="<?php echo $videoart; ?>">
                          <div id="player-<?php echo $videoCount;?>"></div>
                        </div>
                        <?php
                        break;

                      default:
                        ?>
                        <div data-ele-id="<?php echo $videoCount;?>" data-duration="<?php echo $slide['duration']?>" class="videoWrapper" data-videoid="<?php echo $slide['url']; ?>" data-videoart="<?php echo $videoart; ?>">
                          <div id="player-<?php echo $videoCount;?>"></div>
                        </div>
                        <?php
                        break;
                    }
                  } else {
                    ?>
                    <span class="kanal-logo mr-3 text-center">
                      <?php
                        switch ($slide['logo']) {
                          case 0:
                            echo 'Facebook';
                            break;
                          case '1':
                            echo 'Instagram';
                            break;
                          case '2':
                            echo 'Web';
                            break;
                          case '3':
                            echo 'Twitter';
                            break;
                        }
                        ?>
                    </span>
                    <?php
                    echo $slide['caption'];
                  }?>

                </div>
              </div>
              <?php
              $i++;
            }
            ?>


        </div>

      </div>
    </div>
  </div>
</div>
