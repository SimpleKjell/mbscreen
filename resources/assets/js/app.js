
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

jQuery(document).ready(function($) {

  $('#kampagnenSlider').on('slid.bs.carousel', function () {

    var activ = parseInt($('.mbStepSingle.active').attr('data-slide-to'));

    if(activ !== 0) {
      for (var i = 0; i < activ; i++) {
        $('[data-slide-to="' + i +'"]').addClass('progress-active');
      }
    } else {

      $('.mbStepSingle').removeClass('progress-active');
    }

    $('.mbStepSingle.activeBetween').removeClass('activeBetween');
  });

  $('#kampagnenSlider').on('slide.bs.carousel', function () {
    $('.mbStepSingle.active').addClass('activeBetween');
  })



  /*
  * Erster Versuch, zwischen den Slides zu wechseln.
  */
  $('.transition-layer').unbind().click(function () {
    console.log('wie oft');
    $('.transition-layer').addClass('active');

    setTimeout(function () {

      var curr = $('.transition-layer').attr('data-next');
      var url = '/' + curr;

      $.ajax({
      url: url,
      beforeSend: function( xhr ) {

      }}).done(function( data ) {
        $('#main').html(data).attr('data-curr', next);

        /*
        * Setze neue Navlinks
        */
        $('.nav-link').removeClass('active');
        $nav = $('[href="/'+$('.transition-layer').attr('data-next')+'"]').addClass('active');

        /*
        * Und den nächsten
        */
        $next = $nav.next();
        if($next.length > 0) {
          var next = $next.attr('href').replace('/', '');
          $('.transition-layer').attr('data-next', next);
        } else {
          var next = '';
          $('.transition-layer').attr('data-next', '');
        }


        window.scrollTo(0, 0);

        setTimeout(function () {
          $('.transition-layer').removeClass('active');

          /*
          * Überprüfe, um welchen Screen es sich handelt, und führe eventuell weitere Aktionen aus.
          */
          switch (curr) {
            case 'mediabrothers':

              $('.scroll').click();
              $('.masonry').click();

              break;
            case 'social-news':

              $('.scroll').click();

              break;
            case 'aktuell':

              setTimeout(function() {
                $('.transition-layer').click();
              }, 10000)

              break;
            case '':
              location.reload();
              break;
          }


        }, 1000);


      });

    }, 500);



  })


  $(document).on('click', '.masonry', function() {
    $('.grid').masonry({
      // options...
      itemSelector: '.grid-item',
      // columnWidth: 200,
      // gutter: 25,
      columnWidth: '.grid-sizer',
      gutter: '.gutter-sizer',
    });
  })

  $('.scroll').unbind().bind('click', function() {
    console.log('yeop');
    var stop = false;
    var ani = setInterval(function () {
      if(stop) {
        stop = false;
        $("html, body").finish()
      } else {
        aniAn(ani);
        stop = true;
      }
    }, 8000);



  })

  function aniAn(ani) {
    console.log('hoer?');

    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();
    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
        console.log('schon hier');
        $('.transition-layer').click();
        clearInterval(ani);
    }

    $("html, body").animate({ scrollTop: $(document).scrollTop() + 400 }, {duration: 4000, easing: 'linear'});
  }


  /*
  * Carousel
  */
  $('#kampagnenSlider').carousel({
    interval: 8000
  })

  $('#kampagnenSlider').on('slide.bs.carousel', function () {
    /*
    * Überprüfe, ob es der letzte ist
    */
    var anzItems = parseInt($('.mb-step-content-container').attr('data-items')) - 1;
    var currItem = parseInt($('.mbStepSingle.active').attr('data-slide-to')) + 1;

    if(anzItems === currItem) {
      $('#kampagnenSlider').carousel('pause')

      setTimeout(function() {
        $('.transition-layer').click();
      }, 8000)
    }



  })

})
