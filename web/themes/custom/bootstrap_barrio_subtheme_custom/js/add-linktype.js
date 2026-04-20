/*
 * リンクの種別をつける
 */

  // ファイルへのリンク
  jQuery('a[href$=pdf]:not(:has(img))').attr({'data-fileext': 'pdf', 'target': '_blank'}); // pdf
  jQuery('a[href$=xls]:not(:has(img))').attr({'data-fileext': 'excel', 'target': '_blank'}); // xls
  jQuery('a[href$=xlsx]:not(:has(img))').attr({'data-fileext': 'excel', 'target': '_blank'}); // xlsx
  jQuery('a[href$=xlsm]:not(:has(img))').attr({'data-fileext': 'excel', 'target': '_blank'}); // xlsm
  jQuery('a[href$=doc]:not(:has(img))').attr({'data-fileext': 'word', 'target': '_blank'}); // doc
  jQuery('a[href$=docx]:not(:has(img))').attr({'data-fileext': 'word', 'target': '_blank'}); // docx
  jQuery('a[href$=ppt]:not(:has(img))').attr({'data-fileext': 'powerpoint', 'target': '_blank'}); // pptx
  jQuery('a[href$=pptx]:not(:has(img))').attr({'data-fileext': 'powerpoint', 'target': '_blank'}); // ppt
  jQuery('a[href$=zip]:not(:has(img))').attr({'data-fileext': 'zip', 'target': '_blank'}); // zip
  jQuery('a[href$=tar]:not(:has(img))').attr({'data-fileext': 'tar', 'target': '_blank'}); // tar
  jQuery('a[href$=gz]:not(:has(img))').attr({'data-fileext': 'gz', 'target': '_blank'}); // gzip
  jQuery('a[href$=gzip]:not(:has(img))').attr({'data-fileext': 'gz', 'target': '_blank'}); // gzip
  jQuery('a[href$=rar]:not(:has(img))').attr({'data-fileext': 'rar', 'target': '_blank'}); // rar
  jQuery('a[href$=7z]:not(:has(img))').attr({'data-fileext': '7z', 'target': '_blank'}); // 7z
  jQuery('a[href$=bz]:not(:has(img))').attr({'data-fileext': 'bz', 'target': '_blank'}); // bzip
  jQuery('a[href$=bz2]:not(:has(img))').attr({'data-fileext': 'bz2', 'target': '_blank'}); // bzip2

  // コンテンツへのリンク
(function ($) {
  var href=$('a:not(:has(img)):not([data-fileext="7z"]):not([data-fileext="bz"]):not([data-fileext="bz2"]):not([data-fileext="excel"]):not([data-fileext="gz"]):not([data-fileext="pdf"]):not([data-fileext="powerpoint"]):not([data-fileext="rar"]):not([data-fileext="tar"]):not([data-fileext="word"]):not([data-fileext="zip"])');
  var regex1 = new RegExp("^(https|http):\/\/");
  var regex2 = new RegExp(".*" + location.hostname + ".*");
  href.each(function(index){
    if ($(this).attr('href').match(regex1)) {
      if ($(this).attr('href').match(regex2)) {
        $(this).attr('data-linktype','inner');
      } else{
        $(this).attr({'data-linktype': 'outer','target': '_blank','rel':'nofollow'});
      }
    }
    else {
      $(this).attr('data-linktype','inner');
    }
  });
})(jQuery);