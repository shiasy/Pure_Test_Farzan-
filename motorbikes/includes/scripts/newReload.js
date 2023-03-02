

$(window).on('load', function() {

    $(document).on('click','a', function(e){
       
       var pageURL=$(this).attr('href');
       var target=$(this).attr('target')
       if (pageURL.indexOf('#')<0 && pageURL.indexOf('mailto:')<0 && pageURL.indexOf('tel:')<0 && pageURL!='javascript:;' && (target=='undefined' || target=='' || target==undefined)) {
            e.preventDefault();
            popup('{}',pageURL,'body','append','1','1');
            // console.log('3');
       }else{
            // console.log('4');
       }
    });
})

$(window).on('load', function() {
    $(document).keydown(function(event){

        if(event.keyCode == 116) {

          event.preventDefault();

          reloadpagenew('1');

          return false;

        }
        if(event.keyCode==82 && event.ctrlKey){

            event.preventDefault();

            reloadpagenew('1');

            return false;

        }

    });

});


$(window).on('load', function() {


  window.onpopstate = function() {

      
        // $('.modal').modal('hide');
        // $('.modal-backdrop').remove();
        reloadpagenew('1');
      

  };

});