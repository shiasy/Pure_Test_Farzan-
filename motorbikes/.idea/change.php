<?php
$data=$_POST;
$getdata=$_GET;

switch ($data[kind]) {
	case 'viewstory':
		$story=Story::get(array('ID'=>$data[ID]))[0];
		
		$story[views]=json_decode($story[views],true);
		
		array_push($story[views], strval($_SESSION['user']['ID']));
		
		Story::edit(array('fixID'=>$story[ID],'views'=>Views::jsonEncode($story[views])))[0];
		
		break;
	case 'wareimg':
		
		
		$ware=Ware::get(array('ID'=>Used::jwt_decode($data[ID])))[0];
		
		if ($ware[imgs]!='') {
			$ware[imgs]=json_decode($ware[imgs],true);
		}
		?>

		<!-- Modal Header -->
			        <div class="modal-header">
			          <h4 class="modal-title"> </h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        
			        <!-- Modal body -->
			        <div class="modal-body">

		<div id="demo12312312" class="carousel slide" data-ride="carousel">

		  <!-- Indicators -->
		  <ul class="carousel-indicators">
		  	<?php
		  	$n=0;
		  	foreach ($ware[imgs] as $key => $value) {
		  		$append='';
		  		if ($n==0) {
		  			$append='class="active"';
		  		}
		  		?>
		  		<li data-target="#demo12312312" data-slide-to="<?=$n?>" <?=$append?>></li>
		  		<?php
		  		$n++;
		  	}
		  	?>
		    
		  </ul>

		  <!-- The slideshow -->
		  <div class="carousel-inner">

		  	<?php
		  	$n=0;
		  	foreach ($ware[imgs] as $key => $value) {
		  		$append='';
		  		if ($n==0) {
		  			$append='active';
		  		}
		  		?>
		  		<div class="carousel-item <?=$append?>">
			      <img src="<?=$data['dir']?>includes/uploads/<?=$value?>" alt="Los Angeles" class="w-100 mx-auto">
			    </div>
		  		<?php
		  		$n++;
		  	}
		  	?>

		   
		  </div>

		  <!-- Left and right controls -->
		  <a class="carousel-control-prev" href="#demo12312312" data-slide="prev">
		    <span class="carousel-control-prev-icon"></span>
		  </a>
		  <a class="carousel-control-next" href="#demo12312312" data-slide="next">
		    <span class="carousel-control-next-icon"></span>
		  </a>

		</div>

	</div>
	<div class="modal-footer">
			          <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
			        </div>
		<?php
		break;
	case 'listbrand':
		echo "<option value=''>برند را انتخاب نمایید.</option>";
		
		$cats=Cats::get(array('kind'=>'برند',"status"=>"فعال",'catID'=>Used::jwt_decode($data[catID])));
		if ($data[active]!='') {
			$data[active]=Used::jwt_decode($data[active]);
		}
		foreach ($cats as $key => $value) {
			if ($value[ID]!='') {
				$append='';
				if ($data[active]==$value[ID]) {
					$append='selected';
				}
				echo "<option $append value='".Used::jwt_encode($value[ID])."'>".$value[name]."</option>";
			}
		}
		break;
	case 'returned':
		
			
		switch ($data[status]) {
			case 'add':
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID])))[0];
				if ($basket[ID]!='') {
					$basket[wareIDs]=json_decode($basket[wareIDs],true);
					$basket[logs]=json_decode($basket[logs],true);
					$returnedlist=array();
					foreach ($basket[wareIDs] as $key => $value) {
						if($data[number][jwt::encode($value[wareID])]>0&&$value[numbric]>=$data[number][jwt::encode($value[wareID])]) {

							$value[numbric]=$data[number][jwt::encode($value[wareID])];


							array_push($returnedlist, $value);
						}else{

						}
					}

					if (sizeof($returnedlist)>0) {
						Returned::add(array('basketID'=>$basket[ID],'userID'=>$_SESSION[user][ID],'timestamp'=>time(),'wares'=>Views::jsonEncode($returnedlist),'status'=>'ثبت شده','kind'=>'مرجوعی'));
						?>
						<script type="text/javascript">
							<?=urldecode($data[updatelist])?>
							alertme('ثبت عودت','ملاحظه گردید','درخواست عودت کالا با موفقیت ثبت گردید.','','#appendreq','');
						</script>
						<?php
					}else{
						?>
						<script type="text/javascript">
							<?=urldecode($data[updatelist])?>
							alertme('عدم عودت','ملاحظه گردید','تعداد محصول انتخابی اشتباه می باشد.','','#appendreq','');
						</script>
						<?php
					}
				}
			
				break;
			case 'new':
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID])))[0];
				if ($basket[ID]!='') {
					$basket[wareIDs]=json_decode($basket[wareIDs],true);
					$basket[logs]=json_decode($basket[logs],true);
					?>

					<!-- Modal Header -->
			        <div class="modal-header">
			          <h4 class="modal-title">عودت \ مرجوعی</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        
			        <!-- Modal body -->
			        <div class="modal-body">
			          <div class="w-100 row" id="returnedlist">
			          	
			          	
			          	<?php
						foreach ($basket[wareIDs] as $key3 => $value3) {
							$value3[ware]=Ware::get(array('ID'=>$value3[wareID]))[0];
							$code3='ware'.time().rand(1,1000000);
							?>

							<div class=" w-100">
								
								<div class="w-100 pt-2" >
									<?=$value3[ware][name]?>
									<span class="float-left card-text small"><?=number_format($value3[numbric])?>عدد</span>
								</div>

								<div class="w-50 mx-auto my-3 numbriclist">
									<div class="input-group mb-3">
									    <div class="input-group-prepend" onclick="decreasenew($(this))" data-min="0"  data-max="<?=$value3[numbric]?>" data-step="<?=$value3[ware][step]?>">
									    	<span class="input-group-text noselect px-3 text-danger font">-</span>
									    </div>
									    <input type="number" name="number[<?=jwt::encode($value3[wareID])?>]" readonly=""   data-min="0"  data-max="<?=$value3[numbric]?>" data-step="<?=$value3[ware][step]?>" class="form-control form-input text-center" placeholder="تعداد" value="0">
								    	<div class="input-group-append" onclick="increasenew($(this))"   data-min="0"  data-max="<?=$value3[numbric]?>" data-step="<?=$value3[ware][step]?>">
									    	<span class="input-group-text noselect px-3 text-success">+</span>
									    </div>
									</div>
								</div>
								<div class="w-100 border-bottom py-2">
									 کد : <?=number_format($value3[ware][code])?>
									<span class="float-left card-text small">قیمت : <?=($value[kind]=='نقدی')?number_format($value3[alloffprice]):number_format($value3[allprice])?> تومان </span>
								</div>
								
								
							</div>
							
							<?php
						}
						?>

						<div class="col-12 mt-3">
							<button class="btn btn-success text-center px-4 mb-3"  data-dismiss="modal" onclick='sendform(`{"kind":"returned","status":"add","updatelist":"<?=urlencode('$(\'#firstlimit\').val(0);sendform(`{"DIR":"'.$data['dir'].'","firstlimit":"` + $(\'#firstlimit\').val() + `"}`,"'.$data['dir'].'pop/baskets","#lists","","#search");')?>","ID":"<?=$data[ID]?>","dir":"<?=$data['dir']?>"}`,`<?=$data['dir']?>pop/change`,`#appendreq`,``,`#returnedlist`)'>ثبت درخواست</button>
						</div>

			          </div>
			        </div>

			        <script type="text/javascript">

					function increasenew(ids){
						val=$(ids).parent().find('.form-input').val();
						min=$(ids).attr('data-min');
						max=$(ids).attr('data-max');
						step=$(ids).attr('data-step');
						if ((val-((-1)*(step)))<=max) {
							$(ids).parent().find('.form-input').val((val-((-1)*(step))));
						}
					}
					function decreasenew(ids){
						val=$(ids).parent().find('.form-input').val();
						min=$(ids).attr('data-min');
						max=$(ids).attr('data-max');
						step=$(ids).attr('data-step');
						if ((val-step)>=min) {
							$(ids).parent().find('.form-input').val((val-step));
						}
					}
					</script>
					
			        
			        <!-- Modal footer -->
			        <div class="modal-footer">
			          <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
			        </div>
					<?php
				}
				break;
		}

	break;

	case 'basket':
		
			
		switch ($data[status]) {
			case 'تایید':
			
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID]),'userID'=>$_SESSION[user][ID],'status'=>'تایید شده'))[0];
				if ($basket[ID]!='') {
					$basket[wareIDs]=json_decode($basket[wareIDs],true);
					$basket[logs]=json_decode($basket[logs],true);
					$basket[logs]['confirmreqtime']=$basket[chtimestamp];
					$basket[logs]['createtime']=$basket[timestamp2];
					$priceall=0;
					foreach ($basket[wareIDs] as $key => $value) {
						
						if ($basket[kind]=='نقدی') {
							$priceall+=$value[alloffprice];
						}else{
							$priceall+=$value[allprice];
						}
					}

					$basket=Basket::edit(array('fixID'=>Used::jwt_decode($data[ID]),'logs'=>Views::jsonEncode($basket[logs]),'timestamp'=>time(),'priceall'=>$priceall,'status'=>'ثبت شده'));
					
					?>
					<script type="text/javascript">
						<?=urldecode($data[updatelist])?>
						alertme('تاییدسفارش','ملاحظه گردید','سفارش با موفقیت تایید گردید.','','#appendreq','');
					</script>
					<?php
				}
				
				break;
			case 'ثبت شده':
			
					
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID]),'userID'=>$_SESSION[user][ID],'status'=>'ثبت نشده'))[0];
				if ($basket[ID]!='') {
					$basket[wareIDs]=json_decode($basket[wareIDs],true);
					$basket[logs]=json_decode($basket[logs],true);
					$basket[logs]['confirmreqtime']=$basket[chtimestamp];
					$basket[logs]['createtime']=$basket[timestamp2];
					$priceall=0;
					foreach ($basket[wareIDs] as $key => $value) {
						if ($data[wares][jwt::encode(strval($value[wareID]))]=='on') {
							if ($data[kindprice]=='نقدی') {
								$priceall+=$value[alloffprice];
							}else{
								if ($value[allprice]==0) {
									Ware::edit(array('fixID'=>$value[wareID],'capacity'=>array('`capacity`+'.$value[numbric].'','element')));
									unset($basket[wareIDs][$key]);
								}else{									
									$priceall+=$value[allprice];
								}
							}
						}else{
							unset($basket[wareIDs][$key]);
						}
					}

					if (sizeof($basket[wareIDs])>0) {
						$basket=Basket::edit(array('fixID'=>Used::jwt_decode($data[ID]),'address'=>$data[address],'kind'=>$data[kindprice],'wareIDs'=>Views::jsonEncode($basket[wareIDs]),'timestamp'=>time(),'priceall'=>$priceall,'status'=>'ثبت شده'));

						?>
						<script type="text/javascript">
							<?=urldecode($data[updatelist])?>
							alertme('ثبت سفارش','ملاحظه گردید','سفارش با موفقیت ثبت گردید.','','#appendreq','');
						</script>
						<?php

					}else{
						$basket=Basket::edit(array('fixID'=>Used::jwt_decode($data[ID]),'address'=>$data[address],'kind'=>$data[kindprice],'wareIDs'=>Views::jsonEncode($basket[wareIDs]),'timestamp'=>time(),'priceall'=>$priceall,'status'=>'ارسال نشده','response'=>'درخواست سفارش محصول فقط نقدی و پرداخت به صورت چکی'));

						?>
						<script type="text/javascript">
							<?=urldecode($data[updatelist])?>
							alertme('ثبت سفارش','ملاحظه گردید','سفارش به دلیل : درخواست سفارش محصول فقط نقدی و پرداخت به صورت چکی    ثبت نگردید.','','#appendreq','');
						</script>
						<?php
					}

					
					
					
				}
				
				break;
			case 'لغو':
			
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID]),'userID'=>$_SESSION[user][ID],'status'=>'تایید شده'))[0];
				if ($basket[ID]!='') {

					
					$basket=Basket::edit(array('fixID'=>$basket[ID],'chtimestamp'=>time(),'status'=>'ارسال نشده','response'=>'لغو ارسال درخواست کالا توسط کاربر'));
					
					?>
					<script type="text/javascript">
						<?=urldecode($data[updatelist])?>
						alertme('لغو سفارش','ملاحظه گردید','سفارش با موفقیت لغو گردید.','','#appendreq','');
					</script>
					<?php
				}
				
				break;
			case 'حذف':
				$basket=Basket::get(array('ID'=>Used::jwt_decode($data[ID]),'userID'=>$_SESSION[user][ID],'status'=>'ثبت نشده'))[0];
			
				if ($basket[ID]!='') {

					$basket[wareIDs]=json_decode($basket[wareIDs],true);
					foreach ($basket[wareIDs] as $key => $value) {
						Ware::edit(array('fixID'=>$value[wareID],'capacity'=>array('`capacity`+'.$value[numbric].'','element')));
					}
					
					$basket=Basket::edit(array('fixID'=>$basket[ID],'chtimestamp'=>time(),'status'=>'ارسال نشده','response'=>'لغو سفارش پیش از ثبت نهایی'));
					
					?>
					<script type="text/javascript">
						<?=urldecode($data[updatelist])?>
						alertme('حذف سفارش','ملاحظه گردید','سفارش با موفقیت حذف گردید.','','#appendreq','');
					</script>
					<?php
				}
				
				break;
			
			default:
				# code...
				break;
		}

		break;
	
	default:
		# code...
		break;
}