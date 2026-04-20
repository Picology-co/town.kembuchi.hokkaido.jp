/*
 * altの無いimgに強制的にalt=""を付ける
 */

const imgs = document.getElementsByTagName('img');

Array.from(imgs).forEach(function(img){

    if(!img.hasAttribute('alt')){
        //空のalt属性を追加
        img.setAttribute('alt', '');
    }

});