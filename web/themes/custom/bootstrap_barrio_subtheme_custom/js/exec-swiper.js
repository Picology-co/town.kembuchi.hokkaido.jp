(function($) {
  var swiper = new Swiper('div.swiper-container', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    loop: true,
    loopAdditionalSlides: 1,
    speed: 2000,
    autoHeight: false,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    autoplay: {
      delay: 7000,
      stopOnLastSlide: false,
      disableOnInteraction: false,
      reverseDirection: false,
      waitForTransition: false,
    },
  });
})(jQuery);

$(document).ready(function() {
  var swiper = new Swiper('div.swiper-container', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    loop: true,
    loopAdditionalSlides: 1,
    speed: 2000,
    autoHeight: false,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    autoplay: {
      delay: 7000,
      stopOnLastSlide: false,
      disableOnInteraction: false,
      reverseDirection: false,
      waitForTransition: false,
    },
  });
});