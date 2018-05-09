
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('owl.carousel');

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
timeout = '';

jQuery(document).ready(function($) {

  var autoplayTimeout = 6000;
  $('.owl-carousel').each(function (index) {
    $('.owl-carousel-'+index).owlCarousel({
      items: 1,
      autoplay: false,
      autoplayTimeout: autoplayTimeout,
      dots: false,
      autoHeight:true,
    });
  })

  var isFirst = $('#kampagnenSlider').find('.carousel-item.active .owl-carousel-0 .owl-item.active .videoWrapper').length;
  if(isFirst > 0) {
    var duration = parseInt($('#kampagnenSlider .owl-carousel-0').find('.owl-item .videoWrapper').attr('data-duration'));
    var autoplayTimeout = (duration + 5) * 1000;
  }
  // $('.owl-carousel-0').owlCarousel({autoplayTimeout: autoplayTimeout});
  // $('.owl-carousel-0').trigger('play.owl.autoplay');

  // if(first) {
    // var duration = parseInt($('#kampagnenSlider .owl-carousel-0 .').find('.owl-item .videoWrapper').attr('data-duration'));
  //   var autoplayTimeout = duration * 1000;
  //   console.log(duration);
  // } else {
  //   var autoplayTimeout = 4000;
  // }

  $('.owl-carousel').on('changed.owl.carousel', function () {

    $(this).trigger('stop.owl.autoplay');
    var them = this;


    setTimeout(function () {
      var current = $(them).find('.owl-item.active')
      // console.log(current.find('.videoWrapper').length);
      if(current.find('.videoWrapper').length > 0) {


        $(".owl-item.active iframe")[0].src += "&autoplay=1";


        var duration = parseInt(current.find('.videoWrapper').attr('data-duration'));
        var autoplayTimeout = (duration + 5) * 1000;
        $(them).trigger('play.owl.autoplay', [autoplayTimeout]);

      } else {
        var autoplayTimeout = 6000;
        $(them).trigger('play.owl.autoplay', [autoplayTimeout]);
      }
      console.log(autoplayTimeout);
    }, 10);

  })

  $('.owl-carousel').on('change.owl.carousel', function(e) {




  if (e.namespace && e.property.name === 'position' && e.relatedTarget.relative(e.property.value) === e.relatedTarget.items().length - 1) {
    // put your stuff here ...
    var them = $(this);



    setTimeout(function () {
      var last = them.find('.owl-item.active');
      console.log(last);
      if(last.find('.videoWrapper').length > 0) {

        var duration = parseInt(last.find('.videoWrapper').attr('data-duration'));
        var autoplayTimeout = (duration + 7) * 1000;
        // Slide eine Kampagne weiter
        clearTimeout(timeout);
        timeout = setTimeout(function () {

          them.trigger('to.owl.carousel', [0, 1]);

          var anzItems = parseInt($('.mb-step-content-container').attr('data-items'));
          var currItem = parseInt($('.mbStepSingle.active').attr('data-slide-to')) + 1;

          if(anzItems === currItem) {
            $('#kampagnenSlider').carousel('pause')
            $('.transition-layer').click();
          } else {
            $("#kampagnenSlider").carousel("next");
          }


        }, autoplayTimeout);

      } else {
        // Slide eine Kampagne weiter
        clearTimeout(timeout);
        timeout = setTimeout(function () {

          them.trigger('to.owl.carousel', [0, 1]);

          var anzItems = parseInt($('.mb-step-content-container').attr('data-items'));
          var currItem = parseInt($('.mbStepSingle.active').attr('data-slide-to')) + 1;

          if(anzItems === currItem) {
            $('#kampagnenSlider').carousel('pause')
            console.log('nächjster');
            $('.transition-layer').click();
          } else {
            $("#kampagnenSlider").carousel("next");
          }


        }, 6000);

      }
    }, 500);

  }
  });

  // Starte das erste OwlCarousel
  $('.owl-carousel-0').trigger('play.owl.autoplay', [autoplayTimeout]);

  // Suche aktuelles Carousel heraus, wieviele Slides drin sind
  var numOfOwls = $('#kampagnenSlider .carousel-item.active').find('.owl-item').length;
  var interval = numOfOwls * 6000


  if($('#kampagnenSlider .carousel-item.active').find('.owl-item .videoWrapper').length > 0) {
    var duration = parseInt($('#kampagnenSlider .carousel-item.active').find('.owl-item .videoWrapper').attr('data-duration'));
    interval = interval + duration * 1000
  }




  setTimeout(function() {

    $('.lade-balken').remove();
    $('.mbStepSingle.active').append('<div class="lade-balken"></div>')
    $('.mbSteps .mbStepSingle .lade-balken').animate({
      width: "100%"
    }, interval, "linear")
    // console.log('los gehtssa');
  }, 10)

  // $('#kampagnenSlider').carousel({
  //   interval: interval
  // })

})





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

  $('#kampagnenSlider').on('slid.bs.carousel', function () {

    var them = this;
    setTimeout(function() {

      var numOfOwls = $('#kampagnenSlider .carousel-item.active').find('.owl-item').length;
      var interval = numOfOwls * 6000

      var last = $(them).find('.carousel-item.active').is(':last-child');

      if($('#kampagnenSlider .carousel-item.active').find('.owl-item .videoWrapper').length > 0) {
        var duration = parseInt($('#kampagnenSlider .carousel-item.active').find('.owl-item .videoWrapper').attr('data-duration'));
        interval = interval + duration * 1000
      }

      if(last)
        interval = interval * 2

      $('.lade-balken').remove();
      $('.mbStepSingle.active').append('<div class="lade-balken"></div>')
      $('.mbSteps .mbStepSingle .lade-balken').animate({
        width: "100%"
      }, interval, "linear")


      // Setze alle anderen Owl Carousels auf 0
      console.log($(them));
      var number = $(them).find('.carousel-item.active .kampagnenInsideSlide').attr('data-number')
      $('.owl-carousel-'+number).trigger('to.owl.carousel', [0, 1]);
      $('.owl-carousel').not('.owl-carousel-'+number).trigger('stop.owl.autoplay')
      // console.log(number);

      // $('.owl-carousel').not('.owl-carousel-'+number).trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
      // $('.owl-carousel').not('.owl-carousel-'+number).find('.owl-stage-outer').children().unwrap();

      // console.log($('.owl-carousel-'+number));
      // $('.owl-carousel-'+number).trigger('refresh.owl.carousel');
      // $('.owl-carousel-'+number).owlCarousel({
      //   items: 1,
      //   autoplay: false,
      //   autoplayTimeout: 4000,
      //   dots: false,
      //   autoHeight:true,
      // });

      // console.log($('.owl-carousel').not('.owl-carousel-'+number));
      // $('.owl-carousel').not('.owl-carousel-'+number).trigger('to.owl.carousel', [0, 1]).trigger('refresh.owl.carousel').trigger('to.owl.carousel', [0, 1]);
      // $('.owl-carousel').trigger('refresh.owl.carousel');
      // $('.owl-carousel').not('.owl-carousel-'+number).trigger('to.owl.carousel', [0, 1]).trigger('stop.owl.autoplay');
      // $('.owl-carousel-'+number).trigger('play.owl.autoplay');

    }, 10)

  })



  /*
  * Erster Versuch, zwischen den Slides zu wechseln.
  */
  $('.transition-layer').unbind().click(function () {

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
              $('.masonry').click();
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


  /*
  * Zum Testen hier - muss wieder gelöscht werden
  */
  // $('.grid').masonry({
  //   // options...
  //   itemSelector: '.grid-item',
  //   // columnWidth: 200,
  //   // gutter: 25,
  //   columnWidth: '.grid-sizer',
  //   gutter: '.gutter-sizer',
  // });
  /*
  * Zum Testen hier - muss wieder gelöscht werden
  */

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


    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();
    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {

        $('.transition-layer').click();
        clearInterval(ani);
    }

    $("html, body").animate({ scrollTop: $(document).scrollTop() + 400 }, {duration: 4000, easing: 'linear'});
  }


  /*
  * Carousel
  */
  // $('#carouselInner').carousel({
  //   interval: 4000
  // })




  // $('#kampagnenSlider').carousel('pause')

  $(document).on('slide.bs.carousel', '#kampagnenSlider', function () {

    /*
    * Überprüfe, ob es der letzte ist
    */
    // var anzItems = parseInt($('.mb-step-content-container').attr('data-items')) - 1;
    // var currItem = parseInt($('.mbStepSingle.active').attr('data-slide-to')) + 1;
    //
    // if(anzItems === currItem) {
    //   $('#kampagnenSlider').carousel('pause')
    //
    //   setTimeout(function() {
    //     $('.transition-layer').click();
    //   }, 8000)
    // }



  })

})
