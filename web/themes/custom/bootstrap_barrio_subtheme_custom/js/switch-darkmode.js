(function ($) {
  var controller = $('#darkmode-controller');
  if(Cookies.get('darkmode') == 'true'){
    controller.prop('checked', true);
    $('html').addClass('darkmode');
  }
  controller.click(function(){
    Cookies.set('darkmode', controller.prop('checked'));
    if (Cookies.get('darkmode') == 'true') {
      $('html').addClass('darkmode');
    } else {
      $('html').removeClass('darkmode');
    }
  });
})(jQuery);