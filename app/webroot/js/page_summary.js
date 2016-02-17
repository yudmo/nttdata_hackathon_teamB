/*-------------------------------------------------

  Summary javascript

 --------------------------------------------------*/

$(function(){
	if(action == 'view'){
		$('#dashboard #gNav #gNavLast').addClass('current');
	}else if(action == 'index'){
		$('#dashboard #gNav #gNavMy').addClass('current');
	}
});