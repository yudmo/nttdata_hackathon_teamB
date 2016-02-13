/*-------------------------------------------------
 
  common.js
 
 --------------------------------------------------*/
 
$(function(){
	// リンク付き画像ホバー時、の透明度を徐々に変化させる
	$('a > img, #viewlist a > i').hover(
		function(){
			$(this).stop().animate({'opacity': '0.5'}, 400);
		},
		function(){
			$(this).stop().animate({'opacity': '1'}, 400);
		}
	);
	
	// グローバルメニューホバー時、背景色を徐々に変化させる
	$('#gNav li a').hover(
		function(){
			$(this).stop().animate({backgroundColor: '#d35400'}, 300);
		},
		function(){
			$(this).stop().animate({backgroundColor: '#e67e22'}, 300);
		}
	);
});

// グローバルメニューを使用不可能にする処理
function disabledGNav(){
	$('#dashboard #gNav').addClass('disabled');
	$('#dashboard #gNav li').each(function(index, element) {
		$(this).children('a').attr('href', 'javascript:void(0)');
	});
}