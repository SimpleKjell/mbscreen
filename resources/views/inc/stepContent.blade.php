<div class="container-fluid">
  <!-- <div class="mbStepContentBase">
    <h3>Name XY</h3>
    <p>
      <b>Unterüberschrift</b>
    </p>
    <p>
      Lorem Ipusm delor Ipsum delorem Ispum delorem Ipsum delor delor ipsium
    </p>
  </div> -->

  <?php


  ?>

  <div class="row first-row">
    <div class="col m-auto">
      <div class="text-container p-md-3">
        <?php echo $kampagne->text_1; ?>
      </div>
    </div>
    <div class="col p-md-3 m-auto h-100">
      <?php $url = 'http://via.placeholder.com/1200x623';

        $media = NULL;
        if(!is_null($kampagne->getMedia('image_side')->first())) {
          $url = $kampagne->getMedia('image_side')->first()->getUrl();
        } ?>
      <img src="<?php echo $url; ?>" alt="">
    </div>
    <div class="col p-md-3 m-auto h-100">
      <?php $url = 'http://via.placeholder.com/1200x623';

        $media = NULL;
        if(!is_null($kampagne->getMedia('image_side_2')->first())) {
          $url = $kampagne->getMedia('image_side_2')->first()->getUrl();
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
  </div>

  <div class="row second-row pb-md-3">
    <div class="col-md-6">
      <?php $url = 'http://via.placeholder.com/1200x720';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_main')->first())) {
          $url = $kampagne->getMedia('image_main')->first()->getUrl();
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
    <div class="col-md-2 hide-overflow">
      <p>
        <?php echo $kampagne->text_2; ?>
      </p>
      <p>
        <?php echo $kampagne->text_3; ?>
      </p>
    </div>
    <div class="col-md-4">
      <?php $url = 'http://via.placeholder.com/700x700';
        $media = NULL;
        if(!is_null($kampagne->getMedia('image_square')->first())) {
          $url = $kampagne->getMedia('image_square')->first()->getUrl();
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
  </div>

</div>
