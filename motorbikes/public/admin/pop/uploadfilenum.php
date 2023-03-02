<?php


$datetime=Views::timeToStr(time(),'Y-m-d');
$direct=ROOTFILE.DS.Config::$defaultaddresslink.'includes'.DS.'uploads'.DS.$datetime;
mkdir($direct);
$direct.=DS;

$file=Models::uploadFileSystem($_FILES['file'],array('jpg','jpeg','png'),10,500000000,$direct);
echo $datetime.'/'.$file[1];

// $file=Models::uploadFileSystem($_FILES["file"]);

// $fp = fopen('data.txt', 'a');//opens file in append mode  
// $array=array('teacherID'=>$_SESSION[teacher][ID],'school'=>$_SERVER['HTTP_HOST'],'namefile'=>$file[1],'size'=>$_FILES["file"]["size"],'file'=>$_FILES["file"],'time'=>time());
// fwrite($fp, Views::jsonEncode($array));  
// fwrite($fp, "\r\n");  
// fclose($fp);  

// echo $file[1];
?>