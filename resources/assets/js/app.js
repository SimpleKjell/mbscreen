
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

  $('#carouselExampleIndicators').on('slid.bs.carousel', function () {

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

  $('#carouselExampleIndicators').on('slide.bs.carousel', function () {
    $('.mbStepSingle.active').addClass('activeBetween');
  })
})
