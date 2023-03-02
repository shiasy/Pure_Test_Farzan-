<?php
class Cut{
	function cutText($text,$numberOfFirst='',$numberOfLast='',$anArrayOfFirstNumberAndLastNumber='')
    {
      $result='';
      $len=strlen($text);
      if(isset($numberOfFirst)&&$numberOfFirst!=''){
        for ($i=0; $i <$numberOfFirst ; $i++) { 
          $result.=$text[$i];
        }
      }
      if(isset($numberOfLast)&&$numberOfLast!=''){
        $numberOfLast=$len-$numberOfLast;
        for ($i=$numberOfLast; $i <= $len ; $i++) { 
          $result.=$text[$i];
        }
      }
      if(isset($anArrayOfFirstNumberAndLastNumber)&&$anArrayOfFirstNumberAndLastNumber!=''){
        for ($i=$anArrayOfFirstNumberAndLastNumber[0]; $i < $anArrayOfFirstNumberAndLastNumber[1] ; $i++) { 
          $result.=$text[$i];
        }
      }
      return $result;
    }
}