

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
<body class="p-0">
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





<div class="mx-2 my-2 body">
    <div class="pagebody">
        <div class="col-12">
            

            <div class="card list w-100">
                <div class="card-header">
                    محصولات
                </div>
                <div class="card-body">
                    <div>
                        <div class="ware_search px-3">
                            <div class="row w-100 bg-light border rounded shadow p-3 pt-4 pb-0 mb-4">
                                <p class="w-100">جستجو</p>


                            <div class="col-12 mb-3">
                                <div class="input-group">

                                    <div class="col row">
                                        <div class="custom-control custom-radio col mt-1">
                                            <input type="radio" class="custom-control-input form-input" id="customRadio" name="sort" value="desccreated_at" checked>
                                            <label class="custom-control-label" for="customRadio">زمان ثبت</label>
                                        </div>
                                        <div class="custom-control custom-radio col mt-1">
                                            <input type="radio" class="custom-control-input form-input" id="customRadio2" name="sort" value="descprice">
                                            <label class="custom-control-label" for="customRadio2">مبلغ</label>
                                        </div>
                                    </div>

                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">مرتب سازی بر اساس</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">
                                    <input name="pagenumber" class="form-control form-input" type="hidden" value="1">
                                    <input name="pagelimit" class="form-control form-input" type="number" value="5">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">تعداد نمایش در هر صفحه</span>
                                    </div>
                                </div>
                            </div>
                        

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">
                                    
                                     
                                        <select onchange="loadpage('load/loadtableMotors','list');" class="select2-not-tag custom-select form-input" name="company">
                                            <option value="">همه</option>
                                            <option value="هیوندا">هیوندا</option>
                                            <option value="کاوازاکی">کاوازاکی</option>
                                            <option value="سوزوکی">سوزوکی</option>
                                            <option value="یاما">یاما</option>
                                        </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">کمپانی</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">

                                    <input type="text" name="kind" class="form-control form-input">

                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">مدل</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">

                                    <input type="text" name="color" class="form-control form-input">

                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">رنگ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">

                                    <input type="text" name="ofdate" value="<?=(time()-(31*3600*24))?>000" class="form-control form-input jalali-datepicker datepicker">

                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">از تاریخ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="input-group">

                                    <input type="text" name="todate" value="<?=(time())?>000" class="form-control form-input jalali-datepicker datepicker">

                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">تا تاریخ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <button type="button" class="btn btn-info w-100 text-center" onclick='sendform(`{"operator":"list","dir":"<?=DIR?>"}`,"load/loadtableMotors",".ware_list","",".ware_search")'>جستجو</button>
                            </div>


                        <div class="col-12 col-md-12 col-lg-12 row">
                            <div class="col-12 col-md mb-3  px-0">
                                        تعداد کل رکورد در این جستجو : <span class="text-info" id="usersnumber"></span>
                                    </div>
                            <div class="col-12 col-md  mb-3">
                                    
                                <ul class="pagination pagination-sm mb-0 px-0">
                                  <?php
                                  for ($i=1; $i <=$number ; $i++) { 
                                    if ($i==1) {
                                        $active='active';
                                    }else{
                                        $active='';
                                    }
                                    echo '<li class="page-item-li '.$active.'"><a class="page-link-a">'.$i.'</a></li>';
                                  }?>
                                  
                                </ul>
                            </div>
                        </div>
                        </div>

                        
                            
                        </div>

                        <div class="w-100 mb-1">
            

                            <div class="ware_list w-100 row">
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        sendform(`{"operator":"list","dir":"<?=DIR?>"}`,"load/loadtableMotors",".ware_list","",".ware_search");
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
    $(".select2-not-tag").select2({
      tags: false
    });

    $(".select2-by-tag").select2({
      tags: false
    });
    </script>
<script type="text/javascript" src="<?=DIR?>includes/scripts/datetime/disc/jquery-clockpicker.min.js"></script>
<script type="text/javascript" src="<?=DIR?>includes/scripts/datetime/disc/assets/js/highlight.min.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker().find('input').change(function () {
        console.log(this.value);
    });
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'bottom',
        autoclose: true,
        'default': '00:00'
    });
    $('.clockpicker-with-callbacks').clockpicker({
        donetext: 'Done',
        init: function () {
            console.log("colorpicker initiated");
        },
        beforeShow: function () {
            console.log("before show");
        },
        afterShow: function () {
            console.log("after show");
        },
        beforeHide: function () {
            console.log("before hide");
        },
        afterHide: function () {
            console.log("after hide");
        },
        beforeHourSelect: function () {
            console.log("before hour selected");
        },
        afterHourSelect: function () {
            console.log("after hour selected");
        },
        beforeDone: function () {
            console.log("before done");
        },
        afterDone: function () {
            console.log("after done");
        }
    })
        .find('input').change(function () {
        console.log(this.value);
    });
    if (/Mobile/.test(navigator.userAgent)) {
        $('input').prop('dalse', true);
    }
</script>
<script type="text/javascript" src="<?=DIR?>includes/scripts/datetime/disc/assets/js/highlight.min.js"></script>
<script type="text/javascript">
    hljs.configure({tabReplace: '    '});
    hljs.initHighlightingOnLoad();
</script>

<script>
    $(document).ready(function () {
       $('.jalali-datepicker').persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            position: 'auto',
            position: [0,0],
            initialValueType: 'unix',
            viewMode: 'year'
        });

    });
</script>


<script type="text/javascript" src="<?=DIR?>includes/scripts/javascript.js"></script>

<script type="text/javascript" src="<?=DIR?>includes/scripts/table.js?id=12319891250"></script>



<script>
    $(document).ready(function(){
      $('[name="searchtable"]').on("keyup", function() {
        var target = $(this).attr('data-target');
        var index=$( '[name="searchtable"][data-target="'+target+'"]' ).index( this );
        // index++;
        var value = $(this).val().toLowerCase();
        $(""+target+" tr").filter(function() {
          $(this).toggle($(this).find('td').eq(index).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>  


</body>
</html>