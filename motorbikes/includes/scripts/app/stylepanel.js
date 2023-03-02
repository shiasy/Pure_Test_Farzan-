var pageslink = [];
var footer = 'img/home/';

$(document).ready(function(){

    // $('.numbric .after').click(function(){
    //   max=$(this).attr('data-max');
    //   min=$(this).attr('data-min');
    //   step=$(this).attr('data-step');

    //   val=$(this).parent().find('.number').val();
    //   if ((val-(-1*step))<=max) {
    //     $(this).parent().find('.number').val((val-(-1*step)));
    //   }
    // });
    // $('.numbric .before').click(function(){
    //   data=$(this).data()
    //   val=$(this).parent().find('.number').val();
    //   if ((val-step)>=min) {
    //     $(this).parent().find('.number').val((val-step));
    //   }
    // });
//      $('html').on('keydown' , function(event) {
//
//         if(! $(event.target).is('input')) {
//             // console.log(event.which);
//            //event.preventDefault();
//            if(event.which == 8) {
//             //  alert('backspace pressed');
//             return false;
//          }
//         }
// });

    
    

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
              // $('#loadpage').fadeIn(500);

              if (status=='') {
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
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
              // $('#loadpage').fadeOut(50);
      $('#'+idloadingpage).fadeOut(50);
      $('#'+idloadingpage).remove();
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
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
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
            $('#'+idloadingpage).remove();
          }

       });


   });
   */

});


function dragOverHandler(ev) {
    ev.preventDefault();
}


function dropHandler(ev,clsimg,cls='') {

  

  
    ev.preventDefault();

    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }



  if (clsimg!='') {
        var reader = new FileReader();
    reader.onload = function (e) {
          $(clsimg).css('background-image', 'url("'+e.target.result+'")');

      }
      reader.readAsDataURL(fileSelect.files[0]);



  }
  // console.log(fileSelect.files);

}

function dragOverHandler2(ev) {
    ev.preventDefault();
}
function dragOverHandler11(ev) {
    ev.preventDefault();
}
function dragOverHandler21(ev) {
    ev.preventDefault();
}
function dragOverHandler22(ev) {
    ev.preventDefault();
}
function dragOverHandler100(ev) {
    ev.preventDefault();
}
function dragOverHandlerfilenum(ev) {
    ev.preventDefault();
}
function dragOverHandlerchat(ev) {
    ev.preventDefault();
}
function dragOverHandler3(ev) {
    ev.preventDefault();
}

function dragOverHandler4(ev) {
    ev.preventDefault();
}

function deletefile2(ev,clsappend='') {
  filename=ev.attr('data-upload');
  idfile=ev.attr('data-id');
  var formData = new FormData();

  formData.set('file', filename);

  $.ajax({
      type:"POST",
      beforeSend: function(){
            // $('#loadpage').fadeIn(500);
          },
      url:'pop/deletefile',
      dataType: 'html',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
     
      success: function(result){
        $('#'+idfile).hide(200);
        $('#'+idfile).remove();

        $(clsappend+' input[data-id="'+idfile+'"]').remove();
      },
      error: function(xhr, ajaxOptions, thrownError){
     
        
      },
      complete: function(){
     
      }

  });
}
function deletefilenum(ev,clsappend='') {
  filename=ev.attr('data-upload');
  idfile=ev.attr('data-id');
  var formData = new FormData();

  formData.set('file', filename);

  $.ajax({
      type:"POST",
      beforeSend: function(){
            // $('#loadpage').fadeIn(500);
          },
      url:'pop/deletefilenum',
      dataType: 'html',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
     
      success: function(result){
        $('#'+idfile).hide(200);
        $('#'+idfile).remove();

        $(clsappend+' input[data-id="'+idfile+'"]').remove();
      },
      error: function(xhr, ajaxOptions, thrownError){
     
        
      },
      complete: function(){
     
      }

  });
}
function dropHandler2(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

              if($(clsimg+'>div').length<5){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}
function dropHandler11(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=5000000) {
            if (error==0) {

              if($(clsimg+'>div').length<1){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}

function dropHandler21(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

              if($(clsimg+'>div').length<5){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}


function dropHandler22(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

              if($(clsimg+'>div').length<5){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}


function dropHandlerfilenum(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
    var d = new Date();
    var n = d.getTime();
    var timenow = parseInt(n/1000);
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx'||pasvand=='csv') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (alerts['allow'].indexOf(pasvand)<0 && alerts['allow']!='all') {
            img='../includes/images/defautls/'+'else.svg';
            classes='my-3 mx-auto w-50';
            error=1; 
          }

          if (fileSelect.files[0].size<=alerts['volume']) {
            if (error==0) {

              if($(clsimg+'>div:not(.thrownError)').length<alerts['numbric']){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-6 col-lg-6"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefilenum($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "load/uploadfilenum",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  if (alerts['typeshow']=='only') {
                    $(clsappend).append('<input type="hidden" name="'+alerts['namefile']+'['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  }else{
                    $(clsappend).append('<input type="hidden" name="'+alerts['namefile']+'['+idfile+'][file]" class="form-input" value="'+res+'" data-id="'+idfile+'"><input type="hidden" name="'+alerts['namefile']+'['+idfile+'][kind]" class="form-input" value="'+pasvand+'" data-id="'+idfile+'"><input type="hidden" name="'+alerts['namefile']+'['+idfile+'][timestamp]" class="form-input" value="'+timenow+'" data-id="'+idfile+'">');
                  }
                  
                  popup('{"operator":"numbriccountoffile","file":"'+res+'"}','load/smscalc','#numbriccount','');

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              alertsallow='jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx';
              if (alerts['allow']!=''&&alerts['allow']!='all') {
                  alertsallow=alerts['allow'];
              }
              
              $(clsimg).append('<div class="col-12 mb-3 thrownError d-flex col-md-6 col-lg-6"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : '+alertsallow+'</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 thrownError d-flex col-md-6 col-lg-6"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}


function dropHandler100(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
    var d = new Date();
    var n = d.getTime();
    var timenow = parseInt(n/1000);
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (alerts['allow'].indexOf(pasvand)<0 && alerts['allow']!='all') {
            img='../includes/images/defautls/'+'else.svg';
            classes='my-3 mx-auto w-50';
            error=1; 
          }

          if (fileSelect.files[0].size<=alerts['volume']) {
            if (error==0) {

              if($(clsimg+'>div:not(.thrownError)').length<alerts['numbric']){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  if (alerts['typeshow']=='only') {
                    $(clsappend).append('<input type="hidden" name="'+alerts['namefile']+'['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  }else{
                    $(clsappend).append('<input type="hidden" name="'+alerts['namefile']+'['+idfile+'][file]" class="form-input" value="'+res+'" data-id="'+idfile+'"><input type="hidden" name="'+alerts['namefile']+'['+idfile+'][kind]" class="form-input" value="'+pasvand+'" data-id="'+idfile+'"><input type="hidden" name="'+alerts['namefile']+'['+idfile+'][timestamp]" class="form-input" value="'+timenow+'" data-id="'+idfile+'">');
                  }
                  
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              alertsallow='jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx';
              if (alerts['allow']!=''&&alerts['allow']!='all') {
                  alertsallow=alerts['allow'];
              }
              
              $(clsimg).append('<div class="col-12 mb-3 thrownError d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : '+alertsallow+'</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 thrownError d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}
function downloadchat(link,pasvand) {
    fetch(link)
        .then(resp => resp.blob())
        .then(blob => {
          const url = window.URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.style.display = 'none';
          a.href = url;
          // the filename you want
          a.download = Math.floor((Math.random() * 10000000) + 1)+'.'+pasvand;
          document.body.appendChild(a);
          a.click();
          window.URL.revokeObjectURL(url);
          
        })
        .catch();

}
function dropHandlerchat(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //console.log(alerts);
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;

          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

                idfile='filechat'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12"><div class="item p-2 float-reverse rounded d-table mb-3"><img src="'+img+'" class="img-fluid '+classes+'"><div class="w-100 skill-bar bg-secondary my-2 p-0"><div class="proccess-bar float-left" style="width:0%;"></div></div></div></div>');

                $('#listbody #list2').scrollTop(($('#listbody #list2>.row').height()+500));

                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  

                  popup(`{"DIR":"`+alerts['DIR']+`","token":"` + alerts['token'] + `","file":"` + res + `","passvand":"` + pasvand + `"}`,alerts['DIR']+"pop/sendchat","","");
                  $('#'+idfile).remove();

                  // $('#'+idfile).attr("data-upload",res);
                  // $('#'+idfile+' .delete').attr("data-id",idfile);
                });

              
               
              
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}
function dropHandler4(ev,clsimg,cls='',clsappend='',alerts,codearray) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

              if($(clsimg+'>div').length<5){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+codearray+']['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}
function dropHandler3(ev,clsimg,cls='',clsappend='',alerts) {

  if (alerts!='') {

    alerts=jQuery.parseJSON(alerts);
  }
    

    //
  
    ev.preventDefault();

    
    id=$(cls).attr('id');
    fileSelect=document.getElementById(id);

    if (typeof(ev.dataTransfer) != "undefined" && ev.dataTransfer !== null) {
      fileSelect.files=ev.dataTransfer.files;     
    }else{

    }
    
    
// dropHandler2(event,'#profileview','#customFile','#customFile2');

        // console.log(ev.dataTransfer.files[0]);

  
      
        var reader = new FileReader();  
        reader.onload = function (e) {
          img='../includes/images/defautls/';
          classes='';
          pasvand=fileSelect.files[0].name.split('.');
          pasvand=pasvand[(((pasvand.length)-1))];
          pasvand=pasvand.toLowerCase();
          error=0;
          if (pasvand=='svg'||pasvand=='jpg'||pasvand=='png'||pasvand=='jpeg') {
              img=e.target.result;
          }else if (pasvand=='zip') {
            img+='zip.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='rar') {
            img+='rar.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='pdf') {
            img+='pdf.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='txt') {
            img+='txt.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='exe') {
            img+='exe.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='docx') {
            img+='docx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='xlsx') {
            img+='xlsx.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='sql') {
            img+='sql.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp3') {
            img+='mp3.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mp4') {
            img+='mp4.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='mpeg') {
            img+='mpeg.svg';
            classes='my-3 mx-auto w-50';
          }else if (pasvand=='ppt'||pasvand=='pptx') {
            img+='ppt.svg';
            classes='my-3 mx-auto w-50';
          }else{
            img+='else.svg';
            classes='my-3 mx-auto w-50';
            error=1;
          }

          if (fileSelect.files[0].size<=10000000) {
            if (error==0) {

              if($(clsimg+'>div').length<1){
                idfile='file'+Math.floor((Math.random() * 10000000) + 1);
                $(clsimg).append('<div id="'+idfile+'" class="col-12 mb-3  d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image"> <div class="w-100 skill-bar bg-secondary p-0"><div class="proccess-bar float-left" style="width:0%;"></div>                                </div>  <div class="card-body">    <h4 class="card-title"></h4>    <p class="card-text">'+fileSelect.files[0].name+'</p>    <a href="javascript:;" class="btn btn-danger delete" onclick=\'deletefile2($(this),"'+clsappend+'");\'>'+alerts['delete']+'</a>  </div></div></div>');


                var formData = new FormData();

                formData.set('file', fileSelect.files[0] , fileSelect.files[0].name);
                

                $.ajax({
                  url : "pop/uploadfile",
                  type: "POST",
                  data : formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                      xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                          percent = Math.ceil(position / total * 100);
                        }
                  
                        $('#'+idfile+' .proccess-bar').css("width",percent+"%");
                  
                      }, true);
                    }
                    return xhr;
                  },
                  mimeType:"multipart/form-data"
                }).done(function(res){ //
                  // nameappend=$(clsappend).attr('name');
                  
                  $(clsappend).append('<input type="hidden" name="files['+idfile+']" class="form-input" value="'+res+'" data-id="'+idfile+'">');
                  

                  $('#'+idfile+' .delete').attr("data-upload",res);
                  $('#'+idfile+' .delete').attr("data-id",idfile);
                });

               
                // $.ajax({
                //     type:"POST",
                //     beforeSend: function(){
                //           $('#loadpage').fadeIn(500);
                //         },
                //     url:'pop/uploadfile',
                //     dataType: 'html',
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     uploadProgress: function(event, position, total, percentComplete) {
                //       // console.log(total);
                //       // console.log(percentComplete );
                //         var percentVal = percentComplete + '%';
                //         $(idfile+' .proccess-bar').css(width,percentVal);
                //         // bar.width(percentVal);
                //         // percent.html(percentVal);
                //     },
                //     success: function(result){
                      
                //       console.log(result);
                  
                      
                //     },
                //     error: function(xhr, ajaxOptions, thrownError){
                      
                //       console.log(xhr);
                //       console.log(ajaxOptions);
                //       console.log(thrownError);
                  
                      
                //     },
                //     complete: function(){
                //       $('#loadpage').fadeOut(500);
                //     }

                // });
               
              }
            }else{
              $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['miskind']+' : jpg,jpeg,png,svg,zip,rar,pdf,docx,xlsx,sql,txt,exe,mp4,mpeg,mp3,ppt,pptx</p> </div></div></div>');  
            }
          }else{
            $(clsimg).append('<div class="col-12 mb-3 d-flex col-md-4 col-lg-3"><div class="card w-100">  <img class="card-img-top '+classes+'" src="'+img+'" alt="Card image">  <div class="card-body">    <h4 class="card-title">!!!</h4>    <p class="card-text text-danger">'+alerts['sizefile']+'</p> </div></div></div>');
          }
          
          
        }
        reader.readAsDataURL(fileSelect.files[0]);



  
  // console.log(fileSelect.files);

}

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
              // $('#loadpage').fadeIn(500);

              if (status=='') {
                $('[data-operator="'+operator+'"] tbody').html('<div id="'+idloadingpage+'" data-url="'+url+'" data-operator="'+operator+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $('[data-operator="'+operator+'"] tbody').append('<div id="'+idloadingpage+'" data-url="'+url+'" data-operator="'+operator+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $('[data-operator="'+operator+'"] tbody').prepend('<div id="'+idloadingpage+'" data-url="'+url+'" data-operator="'+operator+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
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
          // $('#loadpage').fadeOut(50);
      $('#'+idloadingpage).fadeOut(50);
      $('.loadingpage[data-url="'+url+'"][data-operator="'+operator+'"]').fadeOut(50);
           $('#'+idloadingpage).remove();
           $('.loadingpage[data-url="'+url+'"][data-operator="'+operator+'"]').remove();
        }

    });
}

function checkCodeMeli(code='')
{

   var L=code.length;

   if(L<8 || parseInt(code,10)==0) return false;
   code=('0000'+code).substr(L+4-10);
   if(parseInt(code.substr(3,6),10)==0) return false;
   var c=parseInt(code.substr(9,1),10);
   var s=0;
   for(var i=0;i<9;i++)
      s+=parseInt(code.substr(i,1),10)*(10-i);
   s=s%11;
   return (s<2 && c==s) || (s>=2 && c==(11-s));
   
}

function validateEmail(val)
{
    var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(val))
    {
        return false;
    }
    return true;
}


function valiphone(val)
{
    var filter = /09(([0-9]))/;
    if (!filter.test(val))
    {
      var filter = /989(([0-9]))/;
      if (!filter.test(val))
      {
        return false;
      }else{
        return true;
      }
      return false;
    }
    return true;
}

function valimobile(val)
{
    var filter = /09(([0-9]))/;
    if (!filter.test(val))
    {
      var filter = /989(([0-9]))/;
      if (!filter.test(val))
      {
        return false;
      }else{
        return true;
      }
      return false;
    }
    return true;
}

function validateurl(val)
{
    if (val.indexOf('http://')!=-1)
    {
      first=val.indexOf('http://');
      if (val.indexOf('.')!=-1)
      {
         last=val.indexOf('.');
         if (last>first) {
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
    }else if (val.indexOf('https://')!=-1)
    {
      first=val.indexOf('https://');
      if (val.indexOf('.')!=-1)
      {
         last=val.indexOf('.');
         if (last>first) {
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
    }
    return false;

}

function alertme(title='',valbtn='',des='',onclickfun='',classappend='body',kindappend='html',size='big'){
  if (size='small') {
    var width='';
    var classdia='modal-dialog-centered smallsize modal-sm modal-dialog-scrollable';
    var height='';
  }


  idmodal='myModal'+Math.floor((Math.random() * 10000000) + 1);

  
  if (valbtn!='') {

    var button='<button class="btn btn-self" onclick=\'$("#'+idmodal+'").modal("hide");'+onclickfun+'\' data-dismiss="modal">'+valbtn+'</button>';
  }else{
    var button='';
  }

  
  var h='<div class="modal" id="'+idmodal+'"><div class="modal-dialog '+classdia+'" '+width+'><div class="modal-content"><div class="modal-header"><h4 class="modal-title">'+title+'</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body" '+height+'><p>'+des+'</p>'+button+'</div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button></div></div></div></div>';
  if (kindappend=='append') {
    $(classappend).append(h);  
  }else if (kindappend=='prepend') {
    $(classappend).prepend(h);  
  }else{
    $(classappend).html(h);  
  }
  
  $('#'+idmodal).modal('show');
  
}

function popup(data,url,cls,status=''){

   data=jQuery.parseJSON(data);
   var formData = new FormData();
   $.each( data, function( key, value ) {
     formData.set(key, value);
   });

   // idloadingpage2='loading'+Math.floor((Math.random() * 1000000) + 1);
   
   $.ajax({
        type:"POST",
        beforeSend: function(){
          $('.apploading').css('display','flex').animate({opacity:'1'},200);

          
          // if (status=='') {
          //   $(cls).html('<div id="'+idloadingpage2+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
          // }else if (status=='append') {
          //   $(cls).append('<div id="'+idloadingpage2+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
          // }else if (status=='prepend') {
          //   $(cls).prepend('<div id="'+idloadingpage2+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
          // }

        },
        url:url,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){

          if (status=='') {
            $(cls).html(result);
          }else if (status=='append') {
            $(cls).append(result);
          }else if (status=='prepend') {
              $(cls).prepend(result);
          }else if (status=='val') {
              $(cls).val(result);
          }else if (status=='text') {
              $(cls).text(result);
          }

            $(cls).trigger('chosen:updated');
      
         
        },
        complete: function(){
           $('.apploading').css('display','none').animate({opacity:'0'},100);
           // $('#'+idloadingpage2).fadeOut(50);
           // $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').fadeOut(50);
           // $('#'+idloadingpage2).remove();
           // $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').remove();
        }

    });

}

function reloadpage(){
  pageslinkitem=pageslink[(pageslink.length-1)];
  datapageslink=jQuery.parseJSON(pageslinkitem[0]);
  popupback(pageslinkitem[0],pageslinkitem[1],pageslinkitem[2],pageslinkitem[3],0);
}

function popupback(data,url,cls,status='',setback='1'){
    if (setback==1) {
      pageslink.push([data,url,cls,status]);
      $('.modal').modal('hide');
      $('.modal-backdrop').remove();
    }

    
   

   data=jQuery.parseJSON(data);
   var formData = new FormData();
   $.each( data, function( key, value ) {
     formData.set(key, value);
   });

// idloadingpage3='loading'+Math.floor((Math.random() * 1000000) + 1);
   
   $.ajax({
        type:"POST",
        beforeSend: function(){
              $('.apploading').css('display','flex').animate({opacity:'1'},200);

              // if (status=='') {
              //   $(cls).html('<div id="'+idloadingpage3+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              // }else if (status=='append') {
              //   $(cls).append('<div id="'+idloadingpage3+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              // }else if (status=='prepend') {
              //   $(cls).prepend('<div id="'+idloadingpage3+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              // }

            },
        url:url,
        dataType: 'html',
        cache: true,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){

          if (status=='') {
            $(cls).html(result);
          }else if (status=='append') {
            $(cls).append(result);
          }else if (status=='prepend') {
              $(cls).prepend(result);
          }else if (status=='val') {
              $(cls).val(result);
          }else if (status=='text') {
              $(cls).text(result);
          }

            $(cls).trigger('chosen:updated');
      
         
        },
        complete: function(){
           $('.apploading').css('display','none').animate({opacity:'0'},100);
           // $('#'+idloadingpage3).fadeOut(50);
           // $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').fadeOut(50);
           // $('#'+idloadingpage3).remove();
           // $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').remove();
        }

    });

}


function nulltion(formID){
  number=$(formID+' .form-input').length;
  error=0;
  for (var i = 0; i < number; i++) {
    data=$(formID+' .form-input').eq(i).attr('data-type');
    type=$(formID+' .form-input').eq(i).attr('type');
   
    if (data=='null') {
      if (type=="file") {
         id=$(formID+' .form-input').eq(i).attr('id');
         fileSelect=document.getElementById(id);
         val=fileSelect.files[0].name;
         
      }else if(type=='radio'||type=='checkbox'){

        if($(formID+' .form-input').eq(i).is(':checked')) { 
          val=$(formID+' .form-input').eq(i).val();
        }

      }else{
         val=$(formID+' .form-input').eq(i).val();
      }  

      if (val=='') {
        error=1;
      }
    }
    
  }

  if (error==1) {
    alert('لطفا موارد مشخص شده را تکمیل فرمایید.');
  }else{
    $(formID+' .form-input').val('');
  }
}

function sendform(data,url,cls,status='',formID){


    number=$(formID+' .form-input').length;

    data=jQuery.parseJSON(data);
    var formData = new FormData();

    $.each( data, function( key, value ) {
        formData.set(key, value);
    });

    

    for (var i = 0; i < number; i++) {
        key=$(formID+' .form-input').eq(i).attr('name');
        type=$(formID+' .form-input').eq(i).attr('type');
        if (type=="file") {
            id=$(formID+' .form-input').eq(i).attr('id');
            fileSelect=document.getElementById(id);
            if(fileSelect.files && fileSelect.files.length == 1){
                var file = fileSelect.files[0];
                formData.set(key, file , file.name);
            }else if(fileSelect.files){
                if (key.indexOf('[]')!=-1) {
                    key=key.replace('[]','');
                }
                for (var j = 0; j <fileSelect.files.length; j++) {
                    var file = fileSelect.files[j];
                    formData.set(key+'['+j+']', file , file.name);
                }
            }

            //data[key]=val;
        }else if(type=='radio'||type=='checkbox'){

            if($(formID+' .form-input').eq(i).is(':checked')) {
                val=$(formID+' .form-input').eq(i).val();
                formData.set(key, val);
            }
            // data[key]=val;


        }else{
            val=$(formID+' .form-input').eq(i).val();
            // data[key]=val;
            formData.set(key, val);
        }

    }

    data=JSON.stringify(data);
idloadingpagesendform='loading'+Math.floor((Math.random() * 1000000) + 1);
    $.ajax({
        type:"POST",

        beforeSend: function(){
              // $('#loadpage').fadeIn(500);

              if (status=='') {
                $(cls).html('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $(cls).append('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $(cls).prepend('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }
              
            },
        url:url,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){

            if (status=='') {
                $(cls).html(result);
            }else if (status=='append') {
                $(cls).append(result);
            }else if (status=='prepend') {
                $(cls).prepend(result);
            }

            
        },
    complete: function(){

      // $('#loadpage').fadeOut(50);
      $('#'+idloadingpagesendform).fadeOut(50);
      $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').fadeOut(50);
           $('#'+idloadingpagesendform).remove();
           $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').remove();
    }

    });

}



function sendformBydataload(data,url,cls,status='',formID){


    var formData = new FormData();

    number=$(formID+' *[name="search"]').length;
    for (var i = 0; i < number; i++) {
      key=$(formID+' *[name="search"]').eq(i).attr('data-name');
      val=$(formID+' *[name="search"]').eq(i).val();
      formData.set(key, val);
    }


    number=$(formID+' .form-input').length;
    
    data=jQuery.parseJSON(data);
    $.each( data, function( key, value ) {
        formData.set(key, value);
    });





    

    

    for (var i = 0; i < number; i++) {
        key=$(formID+' .form-input').eq(i).attr('name');
        type=$(formID+' .form-input').eq(i).attr('type');
        if (type=="file") {
            id=$(formID+' .form-input').eq(i).attr('id');
            fileSelect=document.getElementById(id);
            if(fileSelect.files && fileSelect.files.length == 1){
                var file = fileSelect.files[0];
                formData.set(key, file , file.name);
            }else if(fileSelect.files){
                if (key.indexOf('[]')!=-1) {
                    key=key.replace('[]','');
                }
                for (var j = 0; j <fileSelect.files.length; j++) {
                    var file = fileSelect.files[j];
                    formData.set(key+'['+j+']', file , file.name);
                }
            }

            //data[key]=val;
        }else if(type=='radio'||type=='checkbox'){

            if($(formID+' .form-input').eq(i).is(':checked')) {
                val=$(formID+' .form-input').eq(i).val();
                formData.set(key, val);
            }
            // data[key]=val;


        }else{
            val=$(formID+' .form-input').eq(i).val();
            // data[key]=val;
            formData.set(key, val);
        }

    }

    data=JSON.stringify(data);
idloadingpagesendform='loading'+Math.floor((Math.random() * 1000000) + 1);
    $.ajax({
        type:"POST",

        beforeSend: function(){
              // $('#loadpage').fadeIn(500);

              if (status=='') {
                $(cls).html('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $(cls).append('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $(cls).prepend('<div id="'+idloadingpagesendform+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }
              
            },
        url:url,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){

            if (status=='') {
                $(cls).html(result);
            }else if (status=='append') {
                $(cls).append(result);
            }else if (status=='prepend') {
                $(cls).prepend(result);
            }

            
        },
    complete: function(){

      // $('#loadpage').fadeOut(50);
      $('#'+idloadingpagesendform).fadeOut(50);
      $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').fadeOut(50);
           $('#'+idloadingpagesendform).remove();
           $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').remove();
    }

    });

}



function sendformmanual(data,url,cls,status='',formID/*inputID*/){


    number=$(formID).length;

    data=jQuery.parseJSON(data);
    var formData = new FormData();

    $.each( data, function( key, value ) {
        formData.set(key, value);
    });
    for (var i = 0; i < number; i++) {
        key=$(formID).eq(i).attr('name');
        type=$(formID).eq(i).attr('type');
        if (type=="file") {
            id=$(formID).eq(i).attr('id');
            fileSelect=document.getElementById(id);
            if(fileSelect.files && fileSelect.files.length == 1){
                var file = fileSelect.files[0];
                formData.set(key, file , file.name);
            }else if(fileSelect.files){
                if (key.indexOf('[]')!=-1) {
                    key=key.replace('[]','');
                }
                for (var j = 0; j <fileSelect.files.length; j++) {
                    var file = fileSelect.files[j];
                    formData.set(key+'['+j+']', file , file.name);
                }
            }

            //data[key]=val;
        }else if(type=='radio'||type=='checkbox'){

            if($(formID).eq(i).is(':checked')) {
                val=$(formID).eq(i).val();
                formData.set(key, val);
            }
            // data[key]=val;


        }else{
            val=$(formID).eq(i).val();
            // data[key]=val;
            formData.set(key, val);
        }

    }

    data=JSON.stringify(data);
idloadingpage='loading'+Math.floor((Math.random() * 1000000) + 1);
    
    $.ajax({
        type:"POST",
        beforeSend: function(){
              // $('#loadpage').fadeIn(500);

              if (status=='') {
                $(cls).html('<div id="'+idloadingpage+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='append') {
                $(cls).append('<div id="'+idloadingpage+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }else if (status=='prepend') {
                $(cls).prepend('<div id="'+idloadingpage+'" data-url="'+url+'" data-cls="'+cls+'" class="loadingpage"><img src="../includes/images/app/loading/1.gif"></div>');
              }
            },
        url:url,
        dataType: 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){

            if (status=='') {
                $(cls).html(result);
            }else if (status=='append') {
                $(cls).append(result);
            }else if (status=='prepend') {
                $(cls).prepend(result);
            }

            
        },
  complete: function(){

    // $('#loadpage').fadeOut(50);
    $('#'+idloadingpage).fadeOut(50);
    $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').fadeOut(50);
     $('#'+idloadingpage).remove();
     $('.loadingpage[data-url="'+url+'"][data-cls="'+cls+'"]').remove();
  }

    });

}


/*  price amount  */
function FormatNumberBy3(num, decpoint, sep) {
    // check for missing parameters and use defaults if so
    if (arguments.length == 2) {
        sep = ",";
    }
    if (arguments.length == 1) {
        sep = ",";
        decpoint = ".";
    }
    // need a string for operations
    num = num.toString();
    // separate the whole number and the fraction if possible
    a = num.split(decpoint);
    x = a[0]; // decimal
    y = a[1]; // fraction
    z = "";


    if (typeof(x) != "undefined") {
        // reverse the digits. regexp works from left to right.
        for (i=x.length-1;i>=0;i--)
            z += x.charAt(i);
        // add seperators. but undo the trailing one, if there
        z = z.replace(/(\d{3})/g, "$1" + sep);
        if (z.slice(-sep.length) == sep)
            z = z.slice(0, -sep.length);
        x = "";
        // reverse again to get back the number
        for (i=z.length-1;i>=0;i--)
            x += z.charAt(i);
        // add the fraction back in, if it was there
        if (typeof(y) != "undefined" && y.length > 0)
            x += decpoint + y;
    }
    return x;
}


function toEnglishDigits(str) {

    // convert persian digits [۰۱۲۳۴۵۶۷۸۹]
    var e = '۰'.charCodeAt(0);
    str = str.replace(/[۰-۹]/g, function(t) {
        return t.charCodeAt(0) - e;
    });

    // convert arabic indic digits [٠١٢٣٤٥٦٧٨٩]
    e = '٠'.charCodeAt(0);
    str = str.replace(/[٠-٩]/g, function(t) {
        return t.charCodeAt(0) - e;
    });
    return str;
}

function strip_tags (input, allowed) {/*allowed="<p><th><td><tr>"*/
      allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
      var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
      var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
      input=input.replaceAll('.body>.pagebody', '');
      
      return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
      })
}

function strip_tags_main (input, allowed) {/*allowed="<p><th><td><tr>"*/
      allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
      var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
      var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
      return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
      })
}


function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}
/*  price amount  */