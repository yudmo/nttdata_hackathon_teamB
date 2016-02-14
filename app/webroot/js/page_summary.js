/*-------------------------------------------------

  Summary javascript

 --------------------------------------------------*/

$(function(){
	if(!action=='index'){
		$('#dashboard #gNav #gNavLast').addClass('current');
	}else{
		$('#dashboard #gNav #gNavMy').addClass('current');
	}
});