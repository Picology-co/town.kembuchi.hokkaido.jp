// サイトツリーフィルタービューの表示制御
(function ($) {
  var tree_list  = $('#edit-field-sitetree label:has(span[data-reg="0"])');

  tree_list.each(function (index) {
    $(this).siblings().prop({'disabled': 'true'});
  });

  // サイトツリーがクリックされたとき、フロントページに表示をONにする対象の場合、
  // 連動してフロントページに表示するをONにする。
  $('input[id^="edit-field-sitetree-"]').on('click', function(){
    if ($(this).siblings('label:has(span[data-show-frontpage="1"])').length > 0) {
      console.log('2');
      $('#edit-field-show-news-wrapper').find('input').prop('checked', true);
    } else {
      console.log('3');
      $('#edit-field-show-news-wrapper').find('input').prop('checked', false);
    }
  });

})(jQuery);
