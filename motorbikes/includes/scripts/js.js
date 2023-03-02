$(document).ready(function(){
	// alert('sad');
	$(window).scroll(function(){

		if($(window).scrollTop() <= 500)
        {
        	a=$(window).scrollTop()/500;
            $('.fixheader').css('background','rgba(131, 76, 235,'+a+')');
        }else{
        	a=1;
        	$('.fixheader').css('background','rgba(131, 76, 235,1)');
        }
	});


	

	
});
