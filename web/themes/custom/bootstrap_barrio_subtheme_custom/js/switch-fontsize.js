(function ($) {
  var controller = $('#fontsize-controller');
  if(Cookies.get('largesize') == 'true'){
    controller.prop('checked', true);
    $('html').addClass('largesize');
  }
  controller.click(function(){
    Cookies.set('largesize', controller.prop('checked'));
    if (Cookies.get('largesize') == 'true') {
      $('html').addClass('largesize');
    } else {
      $('html').removeClass('largesize');
    }
  });
})(jQuery);