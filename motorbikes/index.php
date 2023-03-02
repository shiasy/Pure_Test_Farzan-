<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
// define the application path
define('ROOT', dirname(__FILE__));
define('ROOTFILE', dirname(dirname(__FILE__)));

// start to dispatch
require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');


// echo var_dump($_GET);
$_GET['oldpages']=$_GET['pages'];
$urlAddress=explode("/", $_GET['pages']);

$pagesName=$urlAddress[(sizeof($urlAddress)-1)];
$page='public';
$dir='';
foreach ($urlAddress as $key => $value) {
	if ($value!='') {
		$page.='/'.$value;

	}
	if ($key!=0) {
		$dir.='../';
	}
}

define('DIR', $dir);

//	$settingdefault=Panel::getsetting()[result][0];

	if (file_exists(ROOT.'/public/'.$_GET['pages'].'.php')) {


		require_once(ROOT.'/public/'.$_GET['pages'].'.php');

	}else if (file_exists(ROOT.'/public/'.$_GET['pages'].'/index.php')) {

		require_once(ROOT.'/public/'.$_GET['pages'].'/index.php');

	}else if (file_exists(ROOT.'/public/'.$_GET['pages'].'index.php')) {

		require_once(ROOT.'/public/'.$_GET['pages'].'index.php');

	}else{

		require_once(ROOT.'/public/index.php');

	}
	

?>
