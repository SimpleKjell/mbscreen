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
        $media = $kampagne->getFirstMedia('side');
        if(!is_null($media)) {
          $url = $media->getUrl('side');
        } ?>
      <img src="<?php echo $url; ?>" alt="">
    </div>
    <div class="col p-md-3 m-auto h-100">
      <?php $url = 'http://via.placeholder.com/1200x623';
        $media = $kampagne->getFirstMedia('side_2');
        if(!is_null($media)) {
          $url = $media->getUrl('side');
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
  </div>

  <div class="row second-row">
    <div class="col-md-6">
      <?php $url = 'http://via.placeholder.com/1200x720';
        $media = $kampagne->getFirstMedia('main');
        if(!is_null($media)) {
          $url = $media->getUrl('main');
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
    <div class="col-md-2">
      <p>
        <?php echo $kampagne->text_2; ?>
      </p>
      <p>
        <?php echo $kampagne->text_3; ?>
      </p>
    </div>
    <div class="col-md-4">
      <?php $url = 'http://via.placeholder.com/700x700';
        $media = $kampagne->getFirstMedia('square');
        if(!is_null($media)) {
          $url = $media->getUrl('square');
        } ?>
      <img src="<?php echo $url;?>" alt="">
    </div>
  </div>

  <div class="row text-center">

    <!--  Hauptcol -->
    <div class="col">
      <div class="my-3 py-3 bg-dark">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
    </div>
    <!--  Hauptcol -->
    <div class="col">
      <div class="py-3 bg-mb-occ">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="my-3 py-3 bg-light">
        <h1>Kommentare</h1>
      </div>
    </div>
    <!--  Hauptcol -->
    <div class="col">
      <div class="py-3 bg-mb-hb">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
    </div>
  </div>

</div>
