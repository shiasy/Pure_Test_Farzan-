

$(document).ready(function(){


    
    

    iNum=$('price').length;

    for (var i = 0; i < iNum; i++) {
        if ($('price').eq(i).html().indexOf(",") < 0) {
            $('price').eq(i).html(FormatNumberBy3($('price').eq(i).html()));
        }
    }
   $('form .form-input[type="file"]').change(function(){
      id=$(this).attr('id');

      fileSelect=document.getElementById(id);
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0];
      }
      // alert(file.type);

      if ($(this).val()==''||(file.type!='text/plain'&&file.type!='video/x-matroska'&&file.type!='application/vnd.ms-excel'&&file.type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'&&file.type!='video/mp4'&&file.type!='audio/mpeg'&&file.type!='image/jpeg'&&file.type!='image/jpeg'&&file.type!='image/png'&&file.type!='application/zip'&&file.type!='application/pdf'&&file.type!='application/octet-stream'&&file.type!='application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
         $(this).val('');
         $('label[for="'+id+'"]').html('انتخاب فایل');
         alert('فایل انتخاب شده در لیست فایل های مجاز نمی باشد.');
      }else{
         $('label[for="'+id+'"]').html(file.name);
      }
   });


    

      $( "input" ).on( "keyup", function( event ) {
        $(this).val(toEnglishDigits($(this).val()));
     });

     $( "input" ).on( "keypress", function( event ) {

      // alert($(this).val());
      var x = event.which || event.keyCode;
      y=$(this).attr('data-type');
      operatorName=$(this).attr('data-opcheck');
      vals=$(this).val();
      if ($(this).attr('data-checksubmit')==1 && x==13) {
        return true;
      }

      if (y=='nationalcode') {
          if(vals.length==10) {
            return false;
          }
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }   
      }else if (y=='mail') {
        // alert(vals.length);
        // alert(x);
        if (vals.length==0) {
      // alert(x);
          /*not int*/
          if ((x<123&&x>96)||(x<91&&x>64)||x==8/*<--*/||x==9/*tab*/||x==97/*ctrl+A*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }
        }else{
          if (x<1500) {
              return true;
          }else{
              return false;
          }
        }
      }


      if (operatorName=='nationalcode') {
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }  
      }else if (operatorName=='number') {
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }   
      }else if (operatorName=='phone') {
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }   
      }else if (operatorName=='mobile') {
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }   
      }else if(operatorName=='persian') {
          if ((x>1500&&x<1800)||x==8/*<--*/||x==9/*tab*/||x==32/*space*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              alert('لطفا فقط از حروف فارسی استفاده نمایید.');
              // $(this).trigger( "focusout" );
              return false;
          } 
      }else if(operatorName=='english') {
          if ((x<123&&x>96)||(x<91&&x>64)||x==8/*<--*/||x==9/*tab*/||x==32/*space*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              alert('لطفا فقط از حروف انگلیسی استفاده نمایید.');
              // $(this).trigger( "focusout" );
              return false;
          } 
      }else if(operatorName=='mail') {

        if (vals.length==0) {
          /*not int*/
          if ((x<123&&x>96)||(x<91&&x>64)||x==8/*<--*/||x==9/*tab*/||x==97/*ctrl+A*/||x==32/*space*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }
        }else{
          if (x<1500) {
              return true;
          }else{
              return false;
          }
        }
           
      }else if(operatorName=='shaba') {
         if (vals.length==1||vals.length==2) {
          /*not int*/
          if ((x>47&&x<58)||x==9/*tab*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }
        }else{
          if ((x>47&&x<58)||x==8/*<--*/||x==9/*tab*/||x==32/*space*/||(x>34&&x<41)/*home,end,dir*/) {
              return true;
          }else{
              return false;
          }
        }
      }
    });


  $('input[data-opcheck="phone"]').keyup(function(){
      if (valiphone($(this).val())==false) {
         $(this).addClass('border');
         $(this).addClass('border-danger');
         // $(this).addClass('text-danger');
      }else{
         $(this).addClass('border');
         $(this).removeClass('border-danger');
         $(this).removeClass('text-danger');
         // $(this).addClass('text-success');
         $(this).addClass('border-success');
      }
   });
  $('input[data-opcheck="phone"]').blur(function(){
      if (valiphone($(this).val())==false) {
         
         $(this).val('');
          $(this).attr('placeholder','شماره وارد شده معتبر نمی باشد.');
         $(this).addClass('border-danger');
         $(this).addClass('text-danger');
      }
   });

  $('input[data-opcheck="mobile"]').keyup(function(){
    if (valimobile($(this).val())==false) {
       $(this).addClass('border');
       $(this).addClass('border-danger');
       // $(this).addClass('text-danger');
    }else{
       $(this).addClass('border');
       $(this).removeClass('border-danger');
       $(this).removeClass('text-danger');
       // $(this).addClass('text-success');
       $(this).addClass('border-success');
    }
 });
  $('input[data-opcheck="mobile"]').blur(function(){
    if (valimobile($(this).val())==false||$(this).val().length<11) {
      $(this).val('');
       $(this).attr('placeholder',"شماره وارد شده معتبر نمی باشد.");
       $(this).addClass('border-danger');
       $(this).addClass('text-danger');
    }
 });

   $('input[data-type="nationalcode"]').keyup(function(){
      if (checkCodeMeli($(this).val())==false) {
         $(this).addClass('border');
         $(this).addClass('border-danger');
         // $(this).addClass('text-danger');
      }else{
         $(this).addClass('border');
         $(this).removeClass('border-danger');
         $(this).removeClass('text-danger');
         // $(this).addClass('text-success');
         $(this).addClass('border-success');
      }
   });

   $('input[data-type="nationalcode"]').blur(function(){
      if (checkCodeMeli($(this).val())==false) {
         $(this).val('');
         $(this).addClass('border-danger');
         $(this).addClass('text-danger');
      }
   });

   $('input[data-type="mail"]').keyup(function(){
      if (validateEmail($(this).val())==false) {
         $(this).addClass('border');
         $(this).addClass('border-danger');
      }else{
         $(this).addClass('border');
         $(this).removeClass('border-danger');
         $(this).removeClass('text-danger');
         $(this).addClass('border-success');
      }
   });

   $('input[data-type="mail"]').blur(function(){
      if (validateEmail($(this).val())==false) {
         
         $(this).val('');
          $(this).attr('placeholder','ایمیل وارد شده صحیح نمی باشد.');
         $(this).addClass('border-danger');
         $(this).addClass('text-danger');
      }
   });



   $('input[data-type="url"]').keyup(function(){
      if (validateurl($(this).val())==false) {
         $(this).addClass('border');
         $(this).addClass('border-danger');
      }else{
         $(this).addClass('border');
         $(this).removeClass('border-danger');
         $(this).removeClass('text-danger');
         $(this).addClass('border-success');
      }
   });

   $('input[data-type="url"]').blur(function(){
      if (validateurl($(this).val())==false) {

        $(this).val('');
          $(this).attr('placeholder','آدرس سایت وارد شده صحیح نمی باشد.');
        
        $(this).addClass('border-danger');
        $(this).addClass('text-danger');
      }
   });

   $('input[data-type="null"]').keyup(function(){
      if ($(this).val()=='') {
         $(this).addClass('border');
         $(this).addClass('border-danger');
      }else{
         $(this).addClass('border');
         $(this).removeClass('border-danger');
         $(this).removeClass('text-danger');
         $(this).addClass('border-success');
      }
   });

   $('input[data-type="null"]').blur(function(){
      if ($(this).val()=='') {

        $(this).val('');
        $(this).attr('placeholder','این فیلد نباید خالی باشد.');
        
        $(this).addClass('border-danger');
        $(this).addClass('text-danger');
      }
   });

   $('.pagination .page-item:not(.disabled):not(.active)').click(function(){
      $('.pagination .page-item').removeClass('active');
      $(this).addClass('active');
   });

   $('.loadtable *[name="search"]:not(.datepicker):not(.jalali-datepicker)').blur(function(){
      check=0;
      $(this).parents().map(function() {
         if (this.className.indexOf('loadtable')!='-1'&&check==0) {
            check=1;
            operator=this.getAttribute('data-operator');
             url=this.getAttribute('data-url');
         }
      });
      

      var formData = new FormData();

      number=$('[data-operator="'+operator+'"] *[name="search"]').length;
      for (var i = 0; i < number; i++) {
         key=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).attr('data-name');
         val=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).val();
         formData.set(key, val);
      }
      
      formData.set("pagenumber", $('[data-operator="'+operator+'"] .pagination .active .page-link').html());

      formData.set("operator", operator);

      if (url==''||url==undefined){
          url='loadtable';
      }
idloadingpage='loading'+Math.floor((Math.random() * 1000000) + 1);
      
      $.ajax({
           type:"POST",
           beforeSend: function(){
              $('#loadpage').fadeIn(500);

              if (status=='') {
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }
            },
           url:url,
           dataType: 'html',
           cache: false,
           contentType: false,
           processData: false,
           data: formData,
           success: function(result){
             
             $('[data-operator="'+operator+'"] tbody').html(result);
         
             
           },
            complete: function(){
              $('#loadpage').fadeOut(50);
      $('#'+idloadingpage).fadeOut(50);
            }

       });


   });

/*
   $('.loadtable .pagination .page-item').click(function(){
      check=0;
      $(this).parents().map(function() {
         if (this.className.indexOf('loadtable')!='-1'&&check==0) {
            check=1;
             operator=this.getAttribute('data-operator');
             url=this.getAttribute('data-url');
         }
      });
      

      var formData = new FormData();

      number=$('[data-operator="'+operator+'"] *[name="search"]').length;
      for (var i = 0; i < number; i++) {
         key=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).attr('data-name');
         val=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).val();
         formData.set(key, val);
      }
      
      formData.set("pagenumber", $('[data-operator="'+operator+'"] .pagination .active .page-link').html());

      formData.set("operator", operator);
       if (url==''||url==undefined){
           url='loadtable';
       }
      
      idloadingpage='loading'+Math.floor((Math.random() * 1000000) + 1);

      $.ajax({
           type:"POST",
           beforeSend: function(){
              $('#loadpage').fadeIn(500);

              if (status=='') {
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }
            },
           url:url,
           dataType: 'html',
           cache: false,
           contentType: false,
           processData: false,
           data: formData,
           success: function(result){
             
             $('[data-operator="'+operator+'"] tbody').html(result);
         
             
           },
          complete: function(){
            $('#loadpage').fadeOut(50);
            $('#'+idloadingpage).fadeOut(50);
          }

       });


   });
*/
});


function loadpage(url='',operator){
   var formData = new FormData();

   number=$('[data-operator="'+operator+'"] *[name="search"]').length;
   for (var i = 0; i < number; i++) {
      key=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).attr('data-name');
      val=$('[data-operator="'+operator+'"] *[name="search"]').eq(i).val();
      formData.set(key, val);
   }
   
   formData.set("pagenumber", $('[data-operator="'+operator+'"] .pagination .active .page-link').html());

   formData.set("operator", operator);
    if (url==''||url==undefined){
        url='loadtable';
    }
   idloadingpage='loading'+Math.floor((Math.random() * 1000000) + 1);
   $.ajax({
        type:"POST",
        beforeSend: function(){
              $('#loadpage').fadeIn(500);

              if (status=='') {
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" class="loadingpage"><img src="./includes/images/loading/1.gif"></div>');
              }
            },
        url:url,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){
          
          $('[data-operator="'+operator+'"] tbody').html(result);
      
          
        },
        complete: function(){
          $('#loadpage').fadeOut(50);
      $('#'+idloadingpage).fadeOut(50);
        }

    });
}
