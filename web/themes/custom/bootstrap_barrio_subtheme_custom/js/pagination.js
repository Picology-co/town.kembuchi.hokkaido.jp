(function ($) {

  $(document).ready(function() {
    // 既存のコンテンツを取得
    const items = $("div#pagination-target div.item");
    const itemsPerPage = 5; // 1ページに表示するアイテム数

    // 指定したページのコンテンツを表示する関数
    function displayPage(page) {
        items.hide(); // 全アイテムを非表示
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        // 対象範囲のアイテムのみ表示
        items.slice(start, end).show();
    }

    // ページネーションの設定
    $('div#pagination-container').pagination({
        items: items.length,               // アイテムの総数
        itemsOnPage: itemsPerPage,         // 1ページに表示するアイテム数
        cssStyle: 'light-theme',           // テーマ
        onPageClick: function(pageNumber) { // ページがクリックされたときの処理
            displayPage(pageNumber);
        }
    });

    // 最初のページを表示
    displayPage(1);
  });

})(jQuery);
