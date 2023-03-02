$(document).ready(function() {


    // $('.pagebody form#form2 ,.pagebody form#form').bind('keypress', function(e) {
    //     var code = e.keyCode || e.which;
    //     if (code==13) {/*Enter key disable in form by id form or form2*/
    //         return false;
    //     }
    // });
    $('.slidemenu .backbar,.slidemenu .menubar').click(function () {
        if($('.slidemenu').attr('class').indexOf('smallshow')>=0){
            $('.slidemenu').removeClass('smallshow');
            $('.slidemenu').addClass('bigshow');
            $('.bodydash').removeClass('smallshow');
            $('.bodydash').addClass('bigshow');
        }else{
            $('.slidemenu').removeClass('bigshow');
            $('.slidemenu').addClass('smallshow');
            $('.bodydash').removeClass('bigshow');
            $('.bodydash').addClass('smallshow');
        }
    });

    $('.slidemenu .changeslide #slideup').click(function () {
        scroll=$('.slidemenu .slide').scrollTop();
        scroll=scroll-56;
        if (scroll<0){
            scroll=0;
        }
        $('.slidemenu .slide').scrollTop(scroll);
    });

    $('.slidemenu .changeslide #slidedown').click(function () {
        scroll=$('.slidemenu .slide').scrollTop();
        scroll=scroll+56;
        $('.slidemenu .slide').scrollTop(scroll);
    });

    $('.slidemenu').on('wheel', function(event){


        if(event.originalEvent.deltaY < 0){
            // wheeled up
            scroll=$('.slidemenu .slide').scrollTop();
            scroll=scroll-56;
            if (scroll<0){
                scroll=0;
            }
            $('.slidemenu .slide').scrollTop(scroll);
        }
        else {
            // wheeled down
            scroll=$('.slidemenu .slide').scrollTop();
            scroll=scroll+56;
            $('.slidemenu .slide').scrollTop(scroll);
        }
    });

    $('.slidemenu .slide').scroll(function () {
        scrolltop=$(this).scrollTop();

        // for (i=0;i<$(this).find('.submenu').length;i++){
        //     $(this).find('.submenu').eq(i).css('margin-top','-'+(scrolltop-(-8))+'px');
        // }
        for (i=0;i<$(this).find('.plus').length;i++){
            if (($(window).width()+17)<992) {
                $(this).find('.plus').eq(i).css('margin-top','calc(-50% + -'+(scrolltop-(-5))+'px)');
            }else{
                $(this).find('.plus').eq(i).css('margin-top','-'+(scrolltop-(-20))+'px');
            }
            
        }

    });


/*left*/    
    $('.slidemenuleft .changeslide #slideup').click(function () {
        scroll=$('.slidemenuleft .slide').scrollTop();
        scroll=scroll-56;
        if (scroll<0){
            scroll=0;
        }
        $('.slidemenuleft .slide').scrollTop(scroll);
    });

    $('.slidemenuleft .changeslide #slidedown').click(function () {
        scroll=$('.slidemenuleft .slide').scrollTop();
        scroll=scroll+56;
        $('.slidemenuleft .slide').scrollTop(scroll);
    });

    $('.slidemenuleft').on('wheel', function(event){


        if(event.originalEvent.deltaY < 0){
            // wheeled up
            scroll=$('.slidemenuleft .slide').scrollTop();
            scroll=scroll-56;
            if (scroll<0){
                scroll=0;
            }
            $('.slidemenuleft .slide').scrollTop(scroll);
        }
        else {
            // wheeled down
            scroll=$('.slidemenuleft .slide').scrollTop();
            scroll=scroll+56;
            $('.slidemenuleft .slide').scrollTop(scroll);
        }
    });

    $('.slidemenuleft .slide').scroll(function () {
        scrolltop=$(this).scrollTop();

        // for (i=0;i<$(this).find('.submenu').length;i++){
        //     $(this).find('.submenu').eq(i).css('margin-top','-'+(scrolltop-(-8))+'px');
        // }
        for (i=0;i<$(this).find('.plus').length;i++){
            if (($(window).width()+17)<992) {
                $(this).find('.plus').eq(i).css('margin-top','calc(-50% + -'+(scrolltop-(-5))+'px)');
            }else{
                $(this).find('.plus').eq(i).css('margin-top','-'+(scrolltop-(-20))+'px');
            }
            
        }

    });
/*left*/

    $('.body .pagebody .added .card-header, .body .pagebody .listed .card-header').click(function () {
        if ($(this).next().is(':visible')){
            $(this).next().fadeOut(100);
        }else{
            $(this).next().fadeIn(100);
        }
    });



    // $('.slidemenu * .submenu>div,.slidemenuleft * .submenu>div').click(function(){
    //     $(this).parent().removeClass('showed').addClass('hiddened');
    // });

    // $('.submenu>div').click(function(){
    //     // alert('sad');
    //     alert(2);
    //     $('.submenu').css('display','none');
    // });



    $('.slidemenu * .submenu>div,.slidemenuleft * .submenu>div').click(function () {
        $('.slidemenu * .submenu>div,.slidemenuleft * .submenu>div').removeClass('active');
        $('.slidemenu .plus>div,.slidemenuleft .plus').removeClass('active');
        $('.slidemenu>div>div>div:not(.linesplite):not(.deactive),.slidemenuleft>div>div>div:not(.linesplite):not(.deactive),.slidemenu .profile>div,.slidemenuleft .profile>div').removeClass('active');
        $(this).addClass('active');
        $(this).parent().parent().addClass('active');
    });

    $('.slidemenu .plus,.slidemenuleft .plus').click(function () {
        $('.slidemenu * .submenu>div,.slidemenuleft * .submenu>div').removeClass('active');
        $('.slidemenu .plus>div,.slidemenuleft .plus').removeClass('active');
        $('.slidemenu>div>div>div:not(.linesplite):not(.deactive),.slidemenuleft>div>div>div:not(.linesplite):not(.deactive)').removeClass('active');
        $(this).addClass('active');
        $(this).parent().parent().addClass('active');
    });

    $('.slidemenu>div:not(.changeslide):not(.deactive)>div>div:not(.linesplite):not(.deactive),.slidemenuleft>div:not(.changeslide):not(.deactive)>div>div:not(.linesplite):not(.deactive),.slidemenu .profile:not(.deactive)>div,.slidemenuleft .profile:not(.deactive)>div').click(function (event) {

        $target = $(event.target);
        if(!$target.closest('.submenu').length){

            // $('.slidemenu * .submenu>div,.slidemenuleft * .submenu>div').removeClass('active');
            check=$(this).find('.submenu').attr('class');
            $('.slidemenu * .submenu,.slidemenuleft * .submenu').removeClass('showed');

            $('.slidemenu .plus>div,.slidemenuleft .plus').removeClass('active');

            //append
            if ($(this).attr('data-deactiveimg')!=undefined && $(this).attr('data-deactiveimg')!="") {
                
                if ($('.slidemenu>div>div>.active:not(.linesplite):not(.deactive) .imgmenu').html()!=undefined) {
                    $('.slidemenu>div>div>.active:not(.linesplite):not(.deactive) .imgmenu').attr('src',$('.slidemenu>div>div>.active:not(.linesplite):not(.deactive) .imgmenu').attr('src').replace($(this).attr('data-activeimg'),$(this).attr('data-deactiveimg')));
                }
            }

            $('.slidemenu>div>div>div:not(.linesplite):not(.deactive),.slidemenuleft>div>div>div:not(.linesplite):not(.deactive),.slidemenu .profile>div,.slidemenuleft .profile>div').removeClass('active');


            $(this).addClass('active');
            //append
            if ($(this).attr('data-activeimg')!=undefined && $(this).attr('data-activeimg')!="") {
                if ($(this).find('.imgmenu').html()!=undefined) {
                    $(this).find('.imgmenu').attr('src',$(this).find('.imgmenu').attr('src').replace($(this).attr('data-deactiveimg'),$(this).attr('data-activeimg')));
                }
            }

            if (check!=undefined && check.indexOf('showed')>=0) {
                $(this).find('.submenu').removeClass('showed').addClass('hiddened');
            }else{
                $(this).find('.submenu').addClass('showed').removeClass('hiddened');
            }
        }

        
        

    });


    $('.slidemenu .slide').scrollTop(0);
    $('.slidemenuleft .slide').scrollTop(0);

});