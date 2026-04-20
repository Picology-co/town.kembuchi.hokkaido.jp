// スマホで表示するときのサイドメニューの開閉処理
(function ($) {

  $('div.mobile-open-button__box').click(function(){
    if ($('body').is('[open-menu]')) {
      $('body').removeAttr('open-menu');
    } else {
      $('body').attr('open-menu', true);
    }
  });

  // 右スワイプでも表示できるようにする
  if ($(window).width() <= 796 && !$('body').hasClass('path-imce')) {// スマホサイズのときのみ(横幅796px以下で、imceウィンドウではない場合）
    $('body').swipe({
      swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
        if (direction === 'left') {
          $('body').removeAttr('open-menu');
        } else if (direction === 'right') {
          if ($('body').hasClass('open-menu')) return;
          $('body').attr('open-menu', true);
        }
      },
      threshold: 200
    });
  }

})(jQuery);
