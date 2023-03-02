<?php
if($_GET['version']!=''){
    $_SESSION['devicekind']='app';
}else{
    $_SESSION['devicekind']='web';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=Language::text('title')?></title>
    <meta charset="utf-8">

<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    

    <?php
    if ($_GET[nosplash]!=1&&false) {
        ?>
    
    <link rel="prefetch prerender" href="<?=DIR?>includes/images/app/splash/1.mp4" />
    <?php
    }
    ?>




    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/bootstrap.min.css?id=12319891454">
    <link href="<?=DIR?>includes/themes/tagsinput.css?id=12319891454" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?=DIR?>includes/chosens/dist/tagify.css?id=12319891454">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/select2.org/css/select2.css?id=12319891454">

    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/app/style.css?id=12319891454">
    <?=($_SESSION['language']=='fa')?'<link rel="stylesheet" type="text/css" href="'.DIR.'includes/themes/app/style-fa.css?id=12319891454">':''?>
    <!-- <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/app/stylep.css?id=12319891454"> -->
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/app/stylepanel.css?id=12319891454">
    <?=($_SESSION['language']=='fa')?'<link rel="stylesheet" type="text/css" href="'.DIR.'includes/themes/app/stylepanel-fa.css?id=12319891454">':''?>
    <script src="<?=DIR?>includes/scripts/jquery.min.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/scripts/popper.min.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/scripts/bootstrap.min.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/chosens/dist/tagify.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/select2.org/js/select2.full.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/datepicker/persian-date.js?id=12319891454"></script>
    <script src="<?=DIR?>includes/datepicker/persian-datepicker.js?id=12319891454"></script>

    <script type="text/javascript" src="<?=DIR?>includes/ck/ckeditor/ckeditor.js?id=12319891454"></script>
    <script type="text/javascript" src="<?=DIR?>includes/ck/ckfinder/ckfinder.js?id=12319891454"></script>
    <script type="text/javascript" src="<?=DIR?>includes/chart/chartjsdeliver.js?id=12319891454"></script>

    <!-- <script type="text/javascript" src="<?=DIR?>includes/scripts/app/scroll.js?id=12319891454"></script> -->
    <script type="text/javascript" src="<?=DIR?>includes/scripts/jquery.inview.js"></script>
    


    <link rel="stylesheet" href="<?= DIR ?>includes/chosen/chosen.css?id=12319891454">

    <link href="<?=DIR?>includes/datepicker/persian-datepicker.css?id=12319891454" rel="stylesheet" type="text/css" media="all" />
    <!-- <link href="<?=DIR?>includes/scripts/datetime/css/datepicker-theme.css?id=12319891454" rel="stylesheet" type="text/css" media="all"  /> -->

    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/jquery-clockpicker.min.css?id=12319891454">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/assets/css/github.min.css?id=12319891454">

    
</head>
<body>

    <script type="text/javascript">

        $(document).ready(function() {
            $(document).keydown(function(event){

                if(event.keyCode == 116) {

                  event.preventDefault();

                  reloadpage();

                  return false;

                }
                if(event.keyCode==82 && event.ctrlKey){

                    event.preventDefault();

                    reloadpage();

                    return false;

                }

            });
            
        });

      
      $(document).ready(function() {

        

          window.history.pushState(null, "", window.location.href);        

          window.onpopstate = function() {

              headerbackbtn();

          };

      });


    </script>  
    <?php

    if ($_GET[nosplash]!=1&&false) {
        ?>
        <div class="splash d-flex">
             <video class="mx-auto my-auto" id="vidsplash">
              <source src="<?=DIR?>includes/images/app/splash/1.mp4" type="video/mp4">
            
            </video> 
        </div>
        <?php    
    }
    ?>

    <div class="w-100 row apploading fixed-top align-items-center justify-content-center">
        <p class="text-center m-0 main-title font-xl color-panel"><?=Language::text('appname')?></p>
        <img src="<?=DIR?>includes/images/app/loading/1.gif" class="img-fluid">
    </div>
    <div class="body row">
        <script type="text/javascript">
            $(document).ready(function() {
                
                
                <?php
                if ($_GET[nosplash]!=1&&false) {
                    ?>
                    $('#vidsplash')[0].play();
                    setTimeout(function() {
                        $('.splash').removeClass('d-flex').addClass('d-none');
                    },7000);
                    <?php    
                }

                ?>

                <?php
                if ($_SESSION[whatbulkuser][ID]!=''||$_COOKIE[whatuserID]!=''){
                    ?>
                    
                    popupback(`{"dir":"<?= DIR ?>"}`,"pages/dashboard",".body");
                        
                    <?php
                }else{
                    ?>
                    popupback(`{"dir":"<?=DIR?>"}`,"pages/login",".body","",0); 
                    <?php
                }
                ?>
             
                
                
            });
        </script>
        
    </div>

<div class="modal fade mw-100" id="editmodalbig" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">



        </div>
    </div>
</div>

<div class="modal fade" id="editmodal" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog ">
        <div class="modal-content">



        </div>
    </div>
</div>

<div class="modal fade mw-100" id="editmodalbig2" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">کاربر</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body"></div>
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=Language::btns('close')?></button>
                  </div>


        </div>
    </div>
</div>

<div class="modal fade" id="editmodal2" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">



        </div>
    </div>
</div>

<div class="modal fade mw-100" id="editmodalbig3" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">



        </div>
    </div>
</div>

<div class="modal fade" id="editmodal3" role="dialog" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">



        </div>
    </div>
</div>


<script type="text/javascript" src="<?=DIR?>includes/scripts/app/javascript.js?id=12319891454"></script>
<script type="text/javascript" src="<?=DIR?>includes/scripts/app/stylepanel.js?id=12319891454"></script>

</body>
</html>