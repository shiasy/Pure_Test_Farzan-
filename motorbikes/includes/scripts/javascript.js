$(document).ready(function() {



});

$(document).on('show.bs.modal', '.modal', function () {
    if ($(".modal-backdrop").length > 1) {
        $(".modal-backdrop").not(':first').remove();
    }
});

function changeSscrollLeft(thissel,step=-1) {	
	var stepper=thissel.attr('data-step');
	stepperfix=(thissel.parent().find('.list').width())
	if (stepper=='undefined'||stepper==''||stepper==undefined) {
		// stepper=10*16*2
		stepper=stepperfix;
	}else if(stepper.indexOf('all')>=0){
		
		screen=''
		if (window.matchMedia('screen and (min-width: 1200px)').matches) {/*xl*/
			screen='xl'
			stepper=thissel.attr('data-step-'+screen);
		}else if (window.matchMedia('screen and (min-width: 992px)').matches) {/*lg*/
			screen='lg'
			stepper=thissel.attr('data-step-'+screen);
		}else if (window.matchMedia('screen and (min-width: 768px)').matches) {/*md*/
			screen='md'
			stepper=thissel.attr('data-step-'+screen);
		}else if (window.matchMedia('screen and (min-width: 576px)').matches) {/*sm*/
			screen='sm'
			stepper=thissel.attr('data-step-'+screen);
		}else if (window.matchMedia('screen and (min-width: 0px)').matches){/*xsm*/
			screen=''
			stepper=thissel.attr('data-step');
		}

		response=["xl","lg","md","sm",""]
		while(((stepper=='undefined'||stepper==''||stepper==undefined) && screen!='')){
			screen=response[response.indexOf(screen)+1]
			if (screen!='') {
				stepper=thissel.attr('data-step-'+screen);
			}else{
				stepper=thissel.attr('data-step');
			}
		}


		
		stepper=eval(stepper.replace('all',stepperfix));
	}

	newpos=thissel.parent().find('.list').scrollLeft()+(step*stepper);
	thissel.parent().find('.list').animate({scrollLeft: newpos}, 500);
}
