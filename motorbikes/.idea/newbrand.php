<?php
$data=$_POST;
$getdata=$_GET;
	
if ($data[name]!=''&&$data[catID]!=''&&$data[status]!='') {

	if ($_FILES[img][name]!='') {
		$img=Models::uploadFileSystem($_FILES[img]);
		if ($img[1]=='') {
			$img='';
		}else{
			$img=$img[1];
		}
	}else{
		$img='';
	}

	if ($data[ID]=='') {
		$user=Cats::add(array('name'=>$data[name],"catID"=>Used::jwt_decode($data[catID]),'kind'=>'برند','status'=>$data[status],'img'=>$img,'timestamp'=>time()));
	}else{
		$error=0;
		if ($data[name]!='') {
			$cat=Cats::get(array('name'=>$data[name],'kind'=>'برند'))[0];
			if ($cat[ID]!=''&&$cat[ID]!=Used::jwt_decode($data[ID])) {
				$error=1;
			}
		}
		if ($error==0) {
			$user=Cats::edit(array('fixID'=>Used::jwt_decode($data[ID]),"catID"=>Used::jwt_decode($data[catID]),'name'=>$data[name],'status'=>$data[status],'img'=>$img));
		}else{
			$user=array('status'=>1);
		}
	}
	
	if ($user[status]==0) {
		?>
		<div class="w-100 d-flex">
			<div class="alert alert-success alert-dismissible w-100">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				اطلاعات ثبت گردید.
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function(){
					popup(`{"dir":"<?=$data['dir']?>","catID":"<?=$data[catID]?>"}`,`<?=$data['dir']?>pages/brands`,`.pagebody .body`,``);
				},500);
		    });
		</script>

		<?php
	}else{
		?>
		<div class="w-100 d-flex">
			<div class="alert alert-danger alert-dismissible w-100">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				نام برند تکراری می باشد.
			</div>
		</div>
		<?php	
	}
}else{
	?>
	<div class="w-100 d-flex">
		<div class="alert alert-warning alert-dismissible w-100">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			وارد کردن موارد زیر اجباری می باشد.<br>
			نام ، وضعیت ، دسته
		</div>
	</div>
	<?php
}
?>
