<?php
if ($_SESSION[user][id]==''&&$_COOKIE[userID]==''){
    SafeData::redirect('logout');
}    
    $data=$_POST;
    
    switch ($data[operator]) {
    
    case 'new':
		?>
		<div class="alert alert-secondary bg-alert shadow-sm rtl">
	    	<strong id="titlepage">محصولات</strong>
		</div>

        <div class="w-100 p-0" id="checked"></div>
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-info my-1" onclick='popup(`{"operator":"list","dir":"<?=$_POST[dir]?>"}`,"pop/popMotors",".body>.pagebody")'>بازگشت</button>
        </div>
		<!-- <p class="rtl">توضیحات</p> -->
		<form id="form" enctype="multipart/form-data">
		
			<div class="row w-100">
                <div class=" col-xl-6 col-12 mb-3 added p-0">
                
                <div class="card w-100">
                <div class="card-header">
                        افزودن
                    </div>
                    <div class="card-body">
                        <div class="row w-100">


                            <div class="col-12 mb-3"  data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <select name="company"  class="select2-not-tag custom-select form-input">
                                        <option value="هیوندا">هیوندا</option>
                                        <option value="کاوازاکی">کاوازاکی</option>
                                        <option value="سوزوکی">سوزوکی</option>
                                        <option value="یاما">یاما</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        کمپانی
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg">
                                        </span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="kind" placeholder="مدل" class="form-control form-input" data-opcheck="" data-type="null" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        مدل
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="color" placeholder="رنگ" class="form-control form-input" data-opcheck="" data-type="null" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        رنگ
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="weight" placeholder="وزن (کیلوگرم)" class="form-control form-input" data-opcheck="" data-type="null" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        وزن (کیلوگرم)
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="price" placeholder="مبلغ (ریال)" class="form-control form-input" data-opcheck="" data-type="null" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        مبلغ (ریال)
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                            <p class="w-100">لوگو</p>
                                            <div class="col-12 row rounded border bg-light pt-3">

                                                
                                                <div class="col row p-0 mb-3">
                                                    
                                                    <div class="custom-file">
                                                        <input type="file" name="logo" class="custom-file-input form-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">فایل</label>
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                            <div class="col-12 mb-3 rtl">
                                <button type="button" class="btn btn-light border border-secondary bg-alert px-3 bg-panel" onclick='if (confirm("آیا از ثبت محصول جدید مطمئن هستید ؟") == true) {  sendform(`{"operator":"add"}`,`pop/popMotors`,".body #checked",``,`#form`); }'>
                                ثبت محصول جدید
                                </button>
                            </div></div>
                        
                    </div>
                </div>
                
            </div>
            <div class=" col-xl-6 col-12 mb-3 listed p-0">
                <div class="card list w-100">
                    <div class="card-header">
                        راهنما
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary">
                           
                                   
    
                                   
    
                              
                        </div>
                    </div>
			</div>
	    </div>
	</div>
			
		</form>
		<?php
		break;
case 'list':
		?>
		<div class="alert alert-secondary bg-alert shadow-sm rtl">
	    	<strong id="titlepage">محصولات</strong>
		</div>

        <div class="w-100 p-0" id="checked"></div>
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-info my-1" onclick='popup(`{"operator":"new","dir":"<?=$_POST[dir]?>"}`,"pop/popMotors",".body>.pagebody")'>افزودن</button>
        </div>
		<!-- <p class="rtl">توضیحات</p> -->
		<form id="form" enctype="multipart/form-data">
		
			<div class="row w-100">
                
            <div class=" col-xl-12 col-12 mb-3 listed p-0">
                <div class="card list w-100">
                    <div class="card-header">
                        لیست
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive loadtable" data-url="load/loadtableMotors" data-operator="list"><div class="row w-100">
                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <div class="input-group">
                                                <input name="search" data-name="pagelimit" class="form-control" type="number" value="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-panel">تعداد نمایش در هر صفحه</span>
                                                </div>
                                            </div>
                                        </div>
                                    
    
                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <div class="input-group">
                                                <input name="search" class="form-control" data-name="dir" value="<?=$_POST[dir]?>" type="hidden">
                                                 
                                                    <select name="search" onchange="loadpage('load/loadtableMotors','list');" class="select2-not-tag custom-select form-input" data-name="company">
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

                                                <input type="text" name="search" data-name="kind" class="form-control form-input">

                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-panel">مدل</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <div class="input-group">

                                                <input type="text" name="search" data-name="color" class="form-control form-input">

                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-panel">رنگ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <div class="input-group">

                                                <input type="text" name="search" data-name="ofdate" value="<?=(time()-(31*3600*24))?>000" class="form-control form-input jalali-datepicker datepicker">

                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-panel">از تاریخ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <div class="input-group">

                                                <input type="text" name="search" data-name="todate" value="<?=(time())?>000" class="form-control form-input jalali-datepicker datepicker">

                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-panel">تا تاریخ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <button type="button" class="btn btn-info w-100 text-center"  onclick="loadpage('load/loadtableMotors','list');">جستجو بر اساس زمان</button>
                                        </div>


                                        <div class="col-6 col-md-6 col-lg-4 mb-3">
                                            <button type="button" class="btn btn-success w-100 text-center"  onclick='
                                            $(`#exportdata .title`).html($(`#titlepage`).html());
                                            $(`#exportdata .titlestable`).html(strip_tags($(`#form .table thead tr`).html(),`<th><td><tr>`));
                                            $(`#exportdata .titlestable .noexport`).remove();
                                            $(`#exportdata .datastable`).html(strip_tags($(`#form .table tbody`).html(),`<th><tr><td>`));
                                            $(`#exportdata .datastable .noexport`).remove();
                                            $(`#exportdata input[name="title"]`).val($(`#exportdata .title`).html());
                                            $(`#exportdata input[name="titlestable"]`).val($(`#exportdata .titlestable`).html());
                                            $(`#exportdata input[name="titlesnumbric"]`).val($(`#exportdata .titlestable th`).length);
                                            $(`#exportdata input[name="datastable"]`).val($(`#exportdata .datastable`).html());
                                            $(`#exportdata`).submit();'>خروجی excel</button>
                                        </div>
    
                                    </div>
                                    <div class="w-100 row">
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
                                                echo '<li class="page-item '.$active.'"><a class="page-link">'.$i.'</a></li>';
                                              }?>
                                              
                                            </ul>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-info bg-panel">
                                            <tr><th>
                                                    ردیف
                                                </th>
                                                <th>
                                                    مدیر
                                                </th>
                                                <th>
                                                    کمپانی
                                                </th>
                                                <th>
                                                    مدل
                                                </th>
                                                <th>
                                                    رنگ
                                                </th>
                                                <th>
                                                    وزن
                                                </th>
                                                <th>
                                                    مبلغ
                                                </th>
                                                <th>
                                                    تصویر
                                                </th>
                                                <th>
                                                    تاریخ ثبت
                                                </th>
                                                <th>
                                                    آخرین بروزرسانی
                                                </th>
                                                <th>
                                                    عملیات
                                                </th>
                                                </tr>
                                            <tr><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th><input class="form-control" name="searchtable" data-target="#tbody1" type="text" placeholder="جستجو در ستون"></th><th></th>
                                                    </tr>
                                        </thead>
                                        
                                        <tbody id="tbody1">
                                            <script type="text/javascript">
                                                loadpage('load/loadtableMotors','list');
                                            </script>
                                            
                                        </tbody>
                                    </table>
                                    
    
                                    <?php
                                    
                                    $number=1;
                                
                                    
                                    ?>
                                    <div class="col-lg-12 col-md-12	 col-sm-12 mb-3">
                                    <ul class="pagination pagination-sm">
                                      <?php
                                      for ($i=1; $i <=$number ; $i++) { 
                                        if ($i==1) {
                                            $active='active';
                                        }else{
                                            $active='';
                                        }
                                        echo '<li class="page-item '.$active.'"><a class="page-link">'.$i.'</a></li>';
                                      }?>
                                      
                                    </ul>
                                </div>
    
                                </div>
                        </div>
                    </div>
			</div>
	    </div>
	</div>
			
		</form>
        <form id="exportdata" class="d-none" target="new" method="post" action="<?=$_POST[dir]?>export">
                <div class="title d-none"></div>
                <div class="titlestable d-none"></div>
                <div class="datastable d-none"></div>
              <input type="text" value="" name="title"/>
              <input type="text" value="" name="titlesnumbric"/>
              <input type="text" value="" name="titlestable"/>
              <input type="text" value="" name="datastable"/>
            </form>
		<?php
		break;
		case 'add':
	$data[jsclasscall]=1;

			if (($data[company]==''||$data[kind]==''||$data[color]==''||$data[weight]==''||$data[price]=='')) {
				?>
				<div class="alert alert-warning alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <strong>اعلانیه ! </strong>اطلاعات را کامل پر کنید.
			    </div>
				<?php
			}else{

				if ($_FILES[logo]!='') {
                    
                        $direct=ROOT.DS.Config::$defaultaddresslink.'includes/uploads';
                        $direct.=DS;
                        $file=Models::uploadFileSystem($_FILES['logo'],array('jpg','jpeg','png'),10,500000000,$direct);
                        
                        if (sizeof($file)>0) {
                            $data[logo]='includes/uploads/'.$file[1];
                        }else{                            
                            $data[logo]='';
                        }
                    }else{
                        $data[logo]='';
                    }


				$req=Motors::add (array('id'=>$data[id],'user_id'=>$_SESSION['user']['id'],'company'=>$data[company],'kind'=>$data[kind],'color'=>$data[color],'weight'=>$data[weight],'price'=>$data[price],'image'=>$data[logo],'created_at'=>time(),'updated_at'=>time()));
				if ($req[status]==0) {
					?>
					<script type="text/javascript">
						loadpage('load/loadtableMotors','list');
					</script>

					<div class="alert alert-success alert-dismissible">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <strong>موفقیت آمیز ! </strong><?=$req[result][message]?>
				    </div>
					<?php
				}else{
					?>
					<div class="alert alert-danger alert-dismissible">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <strong>ثبت نگردید ! </strong><?=$req[result][message]?>
				    </div>
					<?php
				}
		
			}
	
		break;
		
		case 'delete':
$data[jsclasscall]=1;
		if ($data[id]!='') {

			$req=Motors::delete (array('id'=>Used::jwt_decode($data[id])));
			if ($req[status]==0) {
				?>
				<script type="text/javascript">
					loadpage('load/loadtableMotors','list');
				</script>
				
				<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <strong>موفقیت آمیز ! </strong><?=$req[result][message]?>
			    </div>
				<?php
			}else{
				$error=1;
			}
			
		}else{
			$error=1;
		}

		if ($error==1) {
			?>
			<div class="alert alert-danger alert-dismissible">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>حذف نگردید ! </strong>درخواست حذف نگردید.
		    </div>
			<?php
		}

		
		break;
		
		
	case 'change':
        $data[jsclasscall]=1;
		switch ($data[type]) {
			

			case 'edit':
			// echo var_dump($data);

				if (($data[id]=='')) {
					?>
					<div class="alert alert-warning alert-dismissible">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <strong>اعلانیه ! </strong>اطلاعات را کامل پر کنید.
				    </div>
					<?php
				}else{
                    if ($_FILES[logo]!='') {
                    
                        $direct=ROOT.DS.Config::$defaultaddresslink.'includes/uploads';
                        $direct.=DS;

                        $file=Models::uploadFileSystem($_FILES['logo'],array('jpg','jpeg','png'),10,500000000,$direct);
                        
                        if (sizeof($file)>0) {
                            $data[logo]='includes/uploads/'.$file[1];
                        }else{                            
                            $data[logo]='';
                        }
                    }else{
                        $data[logo]='';
                    }


					$req=Motors::edit(array('fixid'=>Used::jwt_decode($data[id]),'company'=>$data[company],'kind'=>$data[kind],'color'=>$data[color],'weight'=>$data[weight],'price'=>$data[price],'image'=>$data[logo],'updated_at'=>time()));
					?>
					<script type="text/javascript">
						$('#editmodal').modal('toggle');
					</script>
					<?php
				}
				break;


			case 'show':
				$admin=Motors::get(array('id'=>Used::jwt_decode($data[id])))[0];
				?>
				<!-- Modal Header -->
	              <div class="modal-header">
	                <h4 class="modal-title">مشاهده و ویرایش محصول</h4>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	              </div>
	              
	              <!-- Modal body -->
	              <div class="modal-body">
	                
	                <form id="form2" enctype="multipart/form-data">
						<div class="card">
							<div class="card-body">
								<div class="row w-100">
								


                                <div class="col-12 mb-3"  data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <select name="company"  class="select2-not-tag custom-select form-input">
                                        <option <?=($admin[company]=='هیوندا')?'selected':''?> value="هیوندا">هیوندا</option>
                                        <option <?=($admin[company]=='کاوازاکی')?'selected':''?> value="کاوازاکی">کاوازاکی</option>
                                        <option <?=($admin[company]=='سوزوکی')?'selected':''?> value="سوزوکی">سوزوکی</option>
                                        <option <?=($admin[company]=='یاما')?'selected':''?> value="یاما">یاما</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        کمپانی
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg">
                                        </span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="kind" placeholder="مدل" class="form-control form-input" data-opcheck="" data-type="null" required="" value="<?=$admin[kind]?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        مدل
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="color" placeholder="رنگ" class="form-control form-input" data-opcheck="" data-type="null" required="" value="<?=$admin[color]?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        رنگ
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="weight" placeholder="وزن (کیلوگرم)" class="form-control form-input" data-opcheck="" data-type="null" required="" value="<?=$admin[weight]?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        وزن (کیلوگرم)
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div><div class="col-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                <div class="input-group">
                                    <input type="text" name="price" placeholder="مبلغ (ریال)" class="form-control form-input" data-opcheck="" data-type="null" required=""  value="<?=$admin[price]?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-panel">
                                        مبلغ (ریال)
                                        <img src="<?=$_POST[dir]?>img/star/red" class="xsmimg"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 mb-3" data-toggle="tooltip" data-placement="top" title="این فیلد اجباری است">
                                            <p class="w-100">تصویر</p>
                                            <div class="col-12 row rounded border bg-light pt-3">
                                                <?php 
                                                if ($admin[image]!='') {
                                                    ?>
                                                    <img class="img-lg ml-3 rounded" src="<?=$_POST[dir]?><?=$admin[image]?>">
                                                    <?php
                                                }?>
                                                
                                                
                                                <div class="col row p-0 mb-3">
                                                    
                                                    <div class="custom-file">
                                                        <input type="file" name="logo" class="custom-file-input form-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">تصویر</label>
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

									<div class="col-lg-12 col-md-12  mb-3 rtl">
										<button type="button" class="btn btn-light border border-secondary bg-alert px-3 bg-panel " onclick='if (confirm("آیا از ویرایش این مورد  مطمئن هستید ؟") == true) {  sendform(`{"operator":"change","type":"edit","id":"<?=Used::jwt_encode($admin[id])?>"}`,`pop/popMotors`,".body #checked",``,`#form2`); }'>
			    						ویرایش
			    						</button>
									</div>
									
									

								</div>
								
							</div>
						</div>
					</form>

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