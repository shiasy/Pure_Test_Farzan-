

function headerbackbtn(imp=0) {
	// console.log(pageslink);
	$('.modal').modal('hide');
	$('.modal-backdrop').remove();

	if (pageslink[(pageslink.length-2)]==undefined) {
	// /**/
	// /**/
	// pageslink.splice((pageslink.length-1),1);
	window.history.pushState(null, "", window.location.href);
	pageslink = [[`{"dir":"<?= DIR ?>"}`,"pages/home",".body .pagebody"]];

	}else{
		
	pageslinkitem=pageslink[(pageslink.length-1)];
		
	if(pageslinkitem[1].indexOf('pages/smartphone')<0||imp==1){		

		window.history.pushState(null, "", window.location.href);

		pageslinkitem=pageslink[(pageslink.length-2)];

		datapageslink=jQuery.parseJSON(pageslinkitem[0]);
		popupback(pageslinkitem[0],pageslinkitem[1],pageslinkitem[2],pageslinkitem[3],0);
		pageslink.splice((pageslink.length-1),1);

		if(pageslinkitem[1].indexOf('pages/credit')>=0){

		    changemenuselect('#credit');

		}else if(pageslinkitem[1].indexOf('pages/home')>=0){

		    changemenuselect('#home');

		}else if(pageslinkitem[1].indexOf('pages/setting')>=0){

		    changemenuselect('#setting');

		}


		// $(".index").attr("id",datapageslink['operator']);
		// if(jQuery.inArray(datapageslink['operator'], ["login","news","games","searchteam","searchgame","dashboard","bet","index"])){
		//     pageslink = [pageslink[(pageslink.length-2)]];
		// }else{
		//     pageslink.splice((pageslink.length-2),1);
		// }
	}


	}
}

function deactivemenuselect() {
	if ($('.body .footer-menu .item.active').length>=1) {
		$('.body .footer-menu .item.active .logo').attr('src',$('.body .footer-menu .item.active .logo').attr('src').replace('/rgb(0,159,180)',''));
		$('.body .footer-menu .item.active').removeClass('active');
	}
}
function changemenuselect(ID) {
	deactivemenuselect();

	$('.body .footer-menu .item'+ID).addClass('active');
	$('.body .footer-menu .item'+ID+' .logo').attr('src',$('.body .footer-menu .item'+ID+' .logo').attr('src')+'/rgb(0,159,180)');
}