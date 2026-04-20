/**
 * テキスト読み上げ（text to speech）
 */
(function ($) {

//	var tts = document.querySelector('#reader');
//	var speech = document.querySelector('.block-system-main-block');

	var tts = $('#tts-reader');
	var tts_stop = $('#tts-stop')
	if(tts){ /* 読み上げボタンが存在するときに処理を行う */
		var text = $('#block-bootstrap-barrio-subtheme-custom-content--2 .node').text();
		var msg = new SpeechSynthesisUtterance();

		tts.click(function() {
			// console.log('start reading');

			msg.text = text;
			msg.lang = 'ja-JP';

			window.speechSynthesis.speak(msg);
		});
	}

	if(tts_stop){

		tts_stop.click(function(){
			window.speechSynthesis.cancel();
		});
/* 		tts.addEventListener( 'click', function() {
			msg.text = text;
			msg.lang = 'ja-JP';

			window.speechSynthesis.speak(msg);
		}, false ); */

/* 		ttsst.addEventListener( 'click', function() {
			window.speechSynthesis.cancel();
		}, false ); */
	}
})(jQuery);
