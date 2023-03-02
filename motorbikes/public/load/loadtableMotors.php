
		<?php

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
			$number=Motors::get(array('betcreated_at1'=>$data[ofdate],'betcreated_at2'=>$data[todate],'company'=>$data[company],'likekind'=>$data[kind],'likecolor'=>$data[color],'typeShow'=>1,'sort'=>$data[sort]))[0][id];
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
			$req=Motors::get(array('betcreated_at1'=>$data[ofdate],'betcreated_at2'=>$data[todate],'company'=>$data[company],'likekind'=>$data[kind],'likecolor'=>$data[color],'sort'=>$data[sort],"limit"=>$valPage,"firstLimit"=>$valPageNumber));
			$num=($data[pagenumber]-1)*$valPage+1;
			
			if (sizeof($req)==0) {
					?>
					<div class="col-12  ">
                        <div class="card w-100 h-100">
                          
                          
                            <h4 class="card-title mb-0 p-3 text-center">موردی یافت نشد.</h4>
                          
                          </div>
                        </div>
                    </div>
                    
					<?php
				}
			foreach ($req as $key => $value) {
                $value[user_id]=Users::get(array('id'=>$value[user_id]))[0];
					?>

                    <div class="col-12 col-md-4 col-xl-3">
                        <div class="card w-100 h-100" data-toggle="modal" data-target="#editmodal" type="button" class="btn btn-info w-100 my-1" onclick='popup(`{"operator":"change","type":"show","id":"<?= Used::jwt_encode($value[id])?>","dir":"<?= $_POST[dir]?>"}`,"pop/popMotors","#editmodal .modal-content",``);' >

                          <img class="card-img-top" src="<?=$_POST[dir].$value[image]?>" alt="<?=$value[company].'-'.$value[kind]?>">
                          <div class="card-body">
                            <h4 class="card-title "><?=$value[company].' - '.$value[kind]?><span class="float-right"><?=$value[color]?></span></h4>
                            
                            <p class="card-text text-info"><?=number_format($value[weight])?> کیلوگرم</p>
                            <p class="card-text text-success"><?=number_format($value[price])?> ریال</p>
                            
                          </div>
                        </div>
                    </div>
					
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

          
            $(`.pagination`).html('<?=$page?>');

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
                    $('.ware_search *[name="pagenumber"]').val($(this).find('a').html());
                    sendform(`{"operator":"list","dir":"<?=$_POST['dir']?>"}`,"load/loadtableMotors",".ware_list","",".ware_search");
                }
            });

    
$('.pagination .page-item.active .page-numbric input').change(function(){
                
                $('.ware_search *[name="pagenumber"]').val($(this).val());
                sendform(`{"operator":"list","dir":"<?=$_POST['dir']?>"}`,"load/loadtableMotors",".ware_list","",".ware_search");


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