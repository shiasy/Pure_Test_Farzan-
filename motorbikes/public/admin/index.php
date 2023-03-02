
<?php

if ($_SESSION[user][id]==''&&$_COOKIE[userID]==''){
    SafeData::redirect('logout');
}

if ($_SESSION[user][id]!='') {
    $user=Users::get(array('id'=>$_SESSION[user][id]))[0];
}elseif ($_COOKIE[userID]!='') {
    $user=Users::get(array('id'=>$_COOKIE[userID]))[0];
}
$_SESSION[user]=$user;

?>

<!DOCTYPE html>
<html>
<head>
    <title><?=Config::$setting[title]?></title>
    <meta charset="utf-8">
    <link rel="icon" href="<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>" type="image/icon type">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta name="robots" content="noindex, nofollow">

    <meta name="twitter:card" content="<?=Config::$setting[body][tags][twitter]?>">
    <meta name="og:title" property="og:title" content="<?=Config::$setting[title]?>">
    <meta name="description" content="<?=Config::$setting[body][tags][description]?>">
    <meta name="keywords" content="<?=Config::$setting[body][tags][keywords]?>">



    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/bootstrap.min.css?id=12319891358">
    <link href="<?=DIR?>includes/themes/tagsinput.css?id=12319891358" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?=DIR?>includes/chosens/dist/tagify.css?id=12319891358">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/select2.org/css/select2.css?id=12319891358">

    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/style.css?id=12319891358">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/stylep.css?id=12319891358">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/stylepanel.css?id=12319891358">
    <script src="<?=DIR?>includes/scripts/jquery.min.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/scripts/popper.min.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/scripts/bootstrap.min.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/chosens/dist/tagify.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/select2.org/js/select2.full.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/datepicker/persian-date.js?id=12319891358"></script>
    <script src="<?=DIR?>includes/datepicker/persian-datepicker.js?id=12319891358"></script>

    <script type="text/javascript" src="<?=DIR?>includes/ck/ckeditor/ckeditor.js?id=12319891358"></script>
    <script type="text/javascript" src="<?=DIR?>includes/ck/ckfinder/ckfinder.js?id=12319891358"></script>
    <script type="text/javascript" src="<?=DIR?>includes/chart/apexcharts.js?id=12319891358"></script>

    <script type="text/javascript" src="<?=DIR?>includes/scripts/scroll.js?id=12319891358"></script>
    <script type="text/javascript" src="<?=DIR?>includes/scripts/javascript.js?id=12319891358"></script>
    <script type="text/javascript" src="<?=DIR?>includes/scripts/stylepanel.js?id=12319891358"></script>

    

    <link rel="stylesheet" href="<?= DIR ?>includes/chosen/chosen.css?id=12319891358">

    <link href="<?=DIR?>includes/datepicker/persian-datepicker.css?id=12319891358" rel="stylesheet" type="text/css" media="all" />
    <!-- <link href="<?=DIR?>includes/scripts/datetime/css/datepicker-theme.css?id=12319891358" rel="stylesheet" type="text/css" media="all"  /> -->

    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/jquery-clockpicker.min.css?id=12319891358">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/assets/css/github.min.css?id=12319891358">

    
</head>
<body>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
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

          // console.log(pageslink);
          $('.modal').modal('hide');
          $('.modal-backdrop').remove();
          if (pageslink[(pageslink.length-2)]==undefined) {
            /**/
            window.history.pushState(null, "", window.location.href);
            /**/
            pageslink.splice((pageslink.length-1),1);
          }else{
            
            window.history.pushState(null, "", window.location.href);

            pageslinkitem=pageslink[(pageslink.length-2)];
            datapageslink=jQuery.parseJSON(pageslinkitem[0]);
            popupback(pageslinkitem[0],pageslinkitem[1],pageslinkitem[2],pageslinkitem[3],0);
            pageslink.splice((pageslink.length-1),1);

            
            // $(".index").attr("id",datapageslink['operator']);
            // if(jQuery.inArray(datapageslink['operator'], ["login","news","games","searchteam","searchgame","dashboard","bet","index"])){
            //     pageslink = [pageslink[(pageslink.length-2)]];
            // }else{
            //     pageslink.splice((pageslink.length-2),1);
            // }
            
            
          }

      };

  });


</script>    

<?php

require_once('slidemenu.php');
?>


<div class="mx-2 my-2 body">
    <div class="pagebody">
        <div class="col-12">
            

        </div>
    </div>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
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

<!-- <div id="loadpage"><div class="lds-hourglass"></div></div> -->

<script type="text/javascript">
    popupback(`{"dir":"<?= DIR ?>","operator":"list"}`,"pop/popMotors",".body>.pagebody");
    0
</script>


</body>
</html>