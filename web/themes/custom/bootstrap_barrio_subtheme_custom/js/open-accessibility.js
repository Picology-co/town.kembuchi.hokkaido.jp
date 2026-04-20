// スマホで表示するときのアクセシビリティメニューの開閉処理
(function ($) {

  $(window).scroll(function() {
    // ページのトップからのスクロール位置を取得
    var pos = $(window).scrollTop();

    // スクロール位置の研さ
    if (pos > 50) {
      // クラスを付与することでCSSで動作を制御する。
      $('body').attr('open-accessibility', true);
    }
    else {
      // クラスを付与することでCSSで動作を制御する。
      $('body').removeAttr('open-accessibility');
    }
  });

})(jQuery);