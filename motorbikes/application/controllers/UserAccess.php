<?php
session_start();
class UserAccess extends Panel{

	public function token($username='',$pass=''){
		$codeTrans=rand(10000,9999999).';'.$username.';'.$pass.';'.rand(10000,9999999);
		$_SESSION['token']=jwt::encode(json_encode(jwt::encode($codeTrans,"JKbE&*&*REFEH&*VHSUIH(*FIO#@%")),"JKbE&*&*REFEH&*VHSUIH(*FIO#@%");
		return 1;
	}

	public function deToken(){
		$ToKeN=$_SESSION['token'];
		$ToKeN=jwt::decode($ToKeN);
		$ToKeN=json_decode($ToKeN);
		$ToKeN=jwt::decode($ToKeN);
		$num=strpos($ToKeN, ";");
		$num++;
		$len=strlen($ToKeN);
		$ToKeN=Cut::cutText($ToKeN,'','',array($num,$len));
		$num=strpos($ToKeN, ";");
		$len=strlen($ToKeN);
		$PaSs=Cut::cutText($ToKeN,'','',array(($num+1),$len));
		$ToKeN=Cut::cutText($ToKeN,'','',array(0,$num));
		$num=strpos($PaSs, ";");
		$PaSs=Cut::cutText($PaSs,'','',array(0,$num));
		return array($ToKeN,$PaSs);
	}

}
?>