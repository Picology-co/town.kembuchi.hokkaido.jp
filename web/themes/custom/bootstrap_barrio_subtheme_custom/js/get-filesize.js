/*
 * 自分のサーバーのファイルを取得して、ファイルサイズをリンクの横に出力する
 */
(function ($) {

	//画像リンクの場合は除外する
	$("a[href]").not(":has('img')").each(function() {

		var obj = $(this);
		var href = obj.attr('href');
		//if (href.match(/\.(TXT|CSV|PDF|MP3|ISO|ZIP|7Z|LZH|RAR|EXE|DMG|SIT|TAR|GZ|DOC|DOCX|XLS|XLSX|PPT|PPTX|MOV|AVI|MP4|WMV|MSI|MSP|SWF)$/i)) {
		if (href.match(/\.(PDF|DOC|DOCX|XLS|XLSX|XLSM|PPT|PPTX|ZIP|TAR|GZ|RAR|7Z|BZ|BZ2)$/i)) {
			var ext = RegExp.$1;
			var req = $.ajax({
				type: 'HEAD',
				url: href,
				success: function () {
					var size = req.getResponseHeader('Content-Length');
					if (size) {
						var showsize = conv_unit(size);

						var iHrefLength = href.length;
						var iDot = href.lastIndexOf(".");
						var sExtension = href.substring(iDot+1,iHrefLength);
						sExtension = sExtension.toUpperCase();

						var regExp = /PDF([?#&][\w]+[=]\d)+$/;

						if(regExp.test(sExtension)) {
							sExtension = '';
						}

						obj.after('<span class="fileInfo">['+ conv_unit(size)+']</span>');
					}
				}
			});
		}
	});
})(jQuery);


//関数
var number_format = function(val) {
	var s = '' + val;
	if (s.length > 3) {
		var r = ((r = s.length % 3) == 0 ? 3 : r);
		var d = s.substring(r);
		s = s.substr(0, r) + d.replace(/(\d{3})/g, ",$1");
	}
	return s;
};

var conv_unit = function(size) {
	var unit = ['KB','MB','GB','TB','PB','EB','ZB','YB'];
	if (size < 1024) return size + 'B';
	for (var i = 0; i < unit.length; i++) {
		size /= 1024;
		if (size < 1024) {
			if (size >= 100)
				return number_format(Math.round(size)) + unit[i];
			else
				return Math.round(size*10)/10 + unit[i];
		}
	}
	return number_format(Math.round(size)) + 'YB';
};
