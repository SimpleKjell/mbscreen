<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <script src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflnjBBxk/www-widgetapi.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>

    <script src="https://player.vimeo.com/api/player.js"></script>
  </head>
  <body class="home">
    @include('inc.navbar')

    <div data-next="mediabrothers" class="transition-layer">
      <div class="logo">
        <img src="http://www.mediabrothers.at/wp-content/themes/mediabrothers/assets/images/logo.png" alt="">
      </div>
    </div> -->
    <div class="scroll"></div>
    <div class="masonry"></div>

    <div id="main" class="main">
      @yield('content')
    </div>
  </body>
  <script src="/js/app.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.1/masonry.pkgd.min.js"></script>

</html>
