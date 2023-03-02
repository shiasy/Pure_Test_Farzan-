<?php

    $data=$_POST;
    
    switch ($data[operator]) {
    
    	
		
	case 'change':
        $data[jsclasscall]=1;
		switch ($data[type]) {
			

			
			case 'show':
				$admin=Motors::get(array('id'=>Used::jwt_decode($data[id])))[0];
				?>

                  <div class="card-body row">
                    <div class="col-12 col-md-6">
                        <img src="<?=$_POST[dir].$admin[image]?>" class="rounded img-fluid">
                    </div>
                    <div class="col-12 col-md-6">
			
                        <h4 class="card-title "><?=$admin[company].' - '.$admin[kind]?><span class="float-right"><?=$admin[color]?></span></h4>
                        
                        <p class="card-text text-info"><?=number_format($admin[weight])?> کیلوگرم</p>
                        <p class="card-text text-success"><?=number_format($admin[price])?> ریال</p>
                        <p class="card-text text-primary">ایمیل پشتیبانی : <?=Users::get(array('id'=>$admin[user_id]))[0][email]?></p>
                        <p class="card-text text-secondary"><?=Views::timeToStr($admin[created_at])?></p>
                    </div>
                    
                    
                  </div>
	              
	              
	              <!-- Modal footer -->
	              <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
	              </div>
				<?php
				break;
			}

			if (isset($req)&&$req[status]==0) {
				?>
				<script type="text/javascript">
					loadpage('load/loadtableMotors','list');
				</script>
				
				<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <strong>موفقیت آمیز ! </strong><?=$req[result][message]?>
			    </div>
				<?php
			}elseif(isset($req)){
				?>
				<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <strong>حذف نگردید ! </strong>در ویرایش مشکلی رخ داده است.
			    </div>
				<?php
			}
		break;
		
	default:
		# code...
		break;
}

?>


<script type="text/javascript">
    $(".select2-not-tag").select2({
      tags: false
    });

    $(".select2-by-tag").select2({
      tags: false
    });
    </script>
<script type="text/javascript" src="<?=$_POST[dir]?>includes/scripts/datetime/disc/jquery-clockpicker.min.js"></script>
<script type="text/javascript" src="<?=$_POST[dir]?>includes/scripts/datetime/disc/assets/js/highlight.min.js"></script>
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
<script type="text/javascript" src="<?=$_POST[dir]?>includes/scripts/datetime/disc/assets/js/highlight.min.js"></script>
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


<script type="text/javascript" src="<?=$_POST[dir]?>includes/scripts/javascript.js"></script>

<script type="text/javascript" src="<?=$_POST[dir]?>includes/scripts/table.js?id=12319891250"></script>



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