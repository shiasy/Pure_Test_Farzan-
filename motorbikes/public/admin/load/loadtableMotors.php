
		<?php
if ($_SESSION[user][id]==''&&$_COOKIE[userID]==''){
    SafeData::redirect('logout');
}
	$data=$_POST;
	

	$valPage=$data[pagelimit];
	if ($valPage=="all") {
		$valPage="";
	}else{
		$valPageNumber=(($data[pagenumber]-1)*$valPage);
	}


    if ($data[todate]==''||!isset($data[todate])) {
        $data[todate]=time()+3600;
    }elseif(is_numeric($data[todate])){
        $data[todate]=substr($data[todate], 0,-3);
    }else{
        $data[todate]=Views::strToTime($data[todate].' 23:59:59');
    }

    if ($data[ofdate]==''||!isset($data[ofdate])) {
        $data[ofdate]=time()-(3600*24*31);
    }elseif(is_numeric($data[ofdate])){
        $data[ofdate]=substr($data[ofdate], 0,-3);
    }else{
        $data[ofdate]=Views::strToTime($data[ofdate].' 00:00:00');
    }
    // ,'bettimesend1'=>$data[ofdate],'bettimesend2'=>$data[todate]


	switch ($data[operator]) {case 'list':
			$number=Motors::get(array('betcreated_at1'=>$data[ofdate],'betcreated_at2'=>$data[todate],'company'=>$data[company],'likekind'=>$data[kind],'likecolor'=>$data[color],'typeShow'=>1))[0][id];
            $numberall=$number;
			if (($number/$valPage)>floor($number/$valPage)) {
				$number=floor($number/$valPage)+1;
			}else{
				$number=($number/$valPage);
			}
			if ($number==0||$valPage=='') {
				$number=1;
			}
			if ($number<$data[pagenumber]) {
				$data[pagenumber]=1;
				$valPageNumber=0;
			}
			$req=Motors::get(array('betcreated_at1'=>$data[ofdate],'betcreated_at2'=>$data[todate],'company'=>$data[company],'likekind'=>$data[kind],'likecolor'=>$data[color],"limit"=>$valPage,"firstLimit"=>$valPageNumber));
			$num=($data[pagenumber]-1)*$valPage+1;
			
			if (sizeof($req)==0) {
					?>
					<tr>
							<td colspan="50">موردی یافت نشد.</td>
						</tr>
					<?php
				}
			foreach ($req as $key => $value) {
                $value[user_id]=Users::get(array('id'=>$value[user_id]))[0];
					?>
					<tr>
						<td><?=$num?></td>
						
						<td>
                            <button  data-toggle="modal" data-target="#editmodal" type="button" class="btn btn-info w-100 my-1" onclick='popup(`{"operator":"change","type":"show","id":"<?= Used::jwt_encode($value[user_id][id])?>","dir":"<?= $data[dir]?>"}`,"pop/popUsers","#editmodal .modal-content",``);'><?=$value[user_id][name].' '.$value[user_id][email]?></button>
                        </td>
						<td><?=$value[company]?></td>
						<td><?=$value[kind]?></td>
						<td><?=$value[color]?></td>
						<td><?=$value[weight]?></td>
						<td><?=$value[price]?></td>
						<td><img src="<?=$_POST[dir].$value[image]?>" class="img-md"></td>
						<td><?=Views::timeToStr($value[created_at])?></td>
						<td><?=Views::timeToStr($value[updated_at])?></td><td>

							<button type="button" class="btn btn-primary dropdown-toggle bg-panel" data-toggle="dropdown">
						      عملیات
						    </button>
						    <div class="dropdown-menu px-2">

						    	<h5 class="dropdown-header">ویرایش</h5>

						    	<button  data-toggle="modal" data-target="#editmodal" type="button" class="btn btn-info w-100 my-1" onclick='popup(`{"operator":"change","type":"show","id":"<?= Used::jwt_encode($value[id])?>","dir":"<?= $data[dir]?>"}`,"pop/popMotors","#editmodal .modal-content",``);'>مشاهده و ویرایش</button>
								

								<h5 class="dropdown-header">حذف</h5>
								
								<button type="button" class="btn btn-danger w-100 my-1" onclick='if (confirm("آیا از درخواست خود مطمئن هستید؟") == true) {popup(`{"operator":"delete","id":"<?= Used::jwt_encode($value[id])?>"}`,"pop/popMotors",".body #checked",``);}'>حذف</button>

							</div> 

						</td>
					</tr>
					<?php
					$num++;
				
			}

			break;default:
			# code...
			break;
	}


    $page='';
    if ($data[pagenumber]!=1) {
        $page.='<li class="page-item"><a class="page-link" href="javascript:;">قبلی</a></li>';       
    }else{
        $page.='<li class="page-item  disabled"><a class="page-link">قبلی</a></li>';
    }

    if ($data[pagenumber]>5) {
        $first=$data[pagenumber]-5;
        if ($first!=1) {
            $checkper=1;
        }
    }else{
        $first=1;
    }

    if ($number>=$data[pagenumber]+5) {
        $last=$data[pagenumber]+5;
        if ($number!=$last) {
            $checkapp=1;
        }
    }else{
        $last=$number;
    }

    if ($checkper==1) {
        $page.='<li class="page-item  disabled"><a class="page-link" >...</a></li>';
    }

    for ($i = $first; $i <= $last ; $i++) {
        $append='';
        if ($i==$data[pagenumber]) {
            $append='active';
            $page.='<li class="page-item '.$append.'"><div class="page-numbric"><input class="form-input form-control" value="'.$i.'"></div><a class="page-link" >'.$i.'</a></li>';
        }else{
            $page.='<li class="page-item '.$append.'"><a class="page-link" >'.$i.'</a></li>';
        }

        
    }
    

    if ($checkapp==1) {
        $page.='<li class="page-item  disabled"><a class="page-link" >...</a></li>';
    }

    if ($number>1 && $number!=$data[pagenumber]) {
        $page.='<li class="page-item"><a class="page-link" href="javascript:;" >بعدی</a></li>';
    }else{
        $page.='<li class="page-item  disabled"><a class="page-link">بعدی</a></li>';
    }
  
?>

        <script type="text/javascript">
  $(document).ready(function(){
    $('#usersnumber').html('<?=number_format($numberall)?>');
  });

          
            $(`[data-operator="<?= $data[operator];?>"] .pagination`).html('<?=$page?>');

            $('.pagination .page-item:not(.disabled):not(.active)').click(function(){
                checkpage=$(this).find('.page-link').html();
                if (checkpage=='بعدی') {
                    nactive=$('.pagination .page-item.active').index();
                    if ((nactive+1)<$('.pagination .page-item').length) {
                        $('.pagination .page-item').removeClass('active');
                        $('.pagination .page-item').eq(nactive+1).addClass('active');
                    }
                }

                if (checkpage=='قبلی') {
                    nactive=$('.pagination .page-item.active').index();
                    if ((nactive-1)>=1) {
                        $('.pagination .page-item').removeClass('active');
                        $('.pagination .page-item').eq(nactive-1).addClass('active');
                    }
                }

                if (checkpage!='...'&&checkpage!='بعدی'&&checkpage!='قبلی') {
                    $('.pagination .page-item').removeClass('active');
                    $(this).addClass('active');
                }
            });

    $('.loadtable .pagination .page-item:not(.disabled):not(.active)').click(function(){
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
      
      $('#loadpage').fadeIn(500);
      if(url==""){
            url='loadtable';
        }
      $.ajax({
           type:"POST",
           url:url,
           dataType: 'script',
           cache: false,
           contentType: false,
           processData: false,
           data: formData,
           success: function(result){
             
             $('[data-operator="'+operator+'"] tbody').html(result);
         
             $('#loadpage').fadeOut(500);
           }

       });


   });
$('.loadtable .pagination .page-item.active .page-numbric input').change(function(){
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

                formData.set("pagenumber", $(this).val());

                formData.set("operator", operator);

                $('#loadpage').fadeIn(500);
                if(url==""){
                    url='loadtable';
                }
                $.ajax({
                    type:"POST",
                    url:url,
                    dataType: 'html',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(result){

                        $('[data-operator="'+operator+'"] tbody').html(result);

                        $('#loadpage').fadeOut(500);
                    }

                });


            });



    $(document).ready(function(){
        iNum=$('price').length;

        for (var i = 0; i < iNum; i++) {
            if ($('price').eq(i).html().indexOf(",") < 0) {
                $('price').eq(i).html(FormatNumberBy3($('price').eq(i).html()));
            }
        }
    });




</script>