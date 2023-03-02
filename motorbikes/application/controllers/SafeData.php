<?php
class SafeData extends Models{

    public function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if(file_exists($filePath)){
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }

    public function clean($str){
        Models::connectDB();
        $str=trim($str);
        if(get_magic_quotes_gpc()){
            $str=stripcslashes($str);
        }
        $str=htmlspecialchars($str);
        return mysqli_real_escape_string(self::$con,$str);
    }
    public function redirect($url){
         if (!headers_sent()){
             header('Location: '.$url); exit;
         }else{
             echo '<script type="text/javascript">';
             echo 'window.location.href="'.$url.'";';
             echo '</script>';
             echo '<noscript>';
             echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
             echo '</noscript>'; exit;
         }
    }

    public function newredirect($url){
         
         echo '<script type="text/javascript">
                try {
                    $(document).ready(function() {
                        popup("{}","'.$url.'","body","append","1","1");
                    });
                }
                catch(err) {
                                    
                    function loadScript( url, callback ) {
                      var script = document.createElement( "script" )
                      script.type = "text/javascript";
                      if(script.readyState) {  // only required for IE <9
                        script.onreadystatechange = function() {
                          if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                            script.onreadystatechange = null;
                            callback();
                          }
                        };
                      } else {  //Others
                        script.onload = function() {
                          callback();
                        };
                      }

                      script.src = url;
                      document.getElementsByTagName( "head" )[0].appendChild( script );
                    }


                    // call the function...
                    loadScript("includes/scripts/jquery.min.js", function() {
                        loadScript("includes/scripts/stylepanel.js", function() {
                            $(document).ready(function() {
                                popup("{}","'.$url.'","body","append","1","1");
                            });
                        });
                    });

                    

                    
                }
                
            </script>';
          exit;
     
    }

    public function newback(){
         
         echo '<script type="text/javascript">
                try {
                    history.back();
                }
                catch(err) {
                }
                
            </script>';
          exit;
     
    }

    public function shorter($text, $chars_limit) {
        if (strlen($text) > $chars_limit) 
        return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")).'...';
        else return $text;
    }

    public function perToEng($string='',$checkcron=''){
        $seachstrings = array("١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩", "٠");
        $persian = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹','۰'];
        $replacestrings= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        if (is_array($string)){
            $result=array();
            foreach ($string as $key => $number){
                if ($checkcron==1) {
                    $str=str_replace($seachstrings , $replacestrings, $number);
                    $result[$key]=str_replace($persian , $replacestrings, $str);
                }else{
                    $str=str_replace($seachstrings , $replacestrings, $number);
                    $str=str_replace($persian , $replacestrings, $str);
                    array_push($result,$str);
                }
            }
            return $result;
        }else{
            $result= str_replace($seachstrings , $replacestrings, $string);
            $result= str_replace($persian , $replacestrings, $result);
            return $result;
        }

    }

    public function periodPackToLang($val,$datas=array("hour"=>array("ir"=>"ساعتی","en"=>"hour"),"day"=>array("ir"=>"روزانه","en"=>"day"),"week"=>array("ir"=>"هفتگی","en"=>"week"),"month"=>array("ir"=>"ماهانه","en"=>"month"),"longtime"=>array("ir"=>"بلند مدت","en"=>"longtime"),"mixed"=>array("ir"=>"ترکیبی","en"=>"mixed"),"other"=>array("ir"=>"سایر","en"=>"other"))){
        return $datas[$val];
    }
    public function simKindToLang($val,$datas=array("temp"=>array("ir"=>"اعتباری","en"=>"temp"),"fix"=>array("ir"=>"دائمی","en"=>"fix"),"tdltemp"=>array("ir"=>"اعتباری - ثابت(خانگی)","en"=>"tdltemp"),"tdlfix"=>array("ir"=>"دائمی - ثابت(خانگی)","en"=>"tdlfix"))){
        return $datas[$val];
    }
    public function kindPhoneToLang($val,$datas=array("mci"=>array("ir"=>"همراه اول","en"=>"mci"),"mtn"=>array("ir"=>"ایرانسل","en"=>"mtn"),"rightel"=>array("ir"=>"رایتل","en"=>"rightel"),"other"=>array("ir"=>"سایر","en"=>"other"))){
        return $datas[$val];
    }
    public function kindPhone($number,$datas=array("mci"=>"mci","mtn"=>"mtn","rightel"=>"rightel","other"=>"other")){

        if (substr($number,0,5)=='98991'||substr($number,0,5)=='98990'||substr($number,0,4)=='9891'){
            return $datas['mci'];
        }elseif((substr($number,0,4)=='9893'&&substr($number,0,5)!='98931'/*is apadana operator*/)||substr($number,0,5)=='98904'||substr($number,0,5)=='98941'||substr($number,0,5)=='98905'||substr($number,0,5)=='98903'||substr($number,0,5)=='98902'||substr($number,0,5)=='98901'){
            return $datas['irancell'];
        }elseif(substr($number,0,5)=='98922'||substr($number,0,5)=='98921'||substr($number,0,5)=='98920'){
            return $datas['rightel'];
        }else{
            return $datas['other'];
        }
    }
    public function isPersian($string){
        // $string  = preg_replace("/[^ الف-ی]/i", "", $string);
        $string  = preg_replace("/[^الف-ی]/i", "", $string);
        if (strlen($string)>0){
            return 'persian';
        }else{
            return 'english';
        }
    }

    public function convertFatoEn($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public function numbricPages($array){
        $result=array();
        $check=1;
        foreach ($array as $key => $value){
            if (is_array($value)){

                $portal=Portal::get(array(
                    'ID'=>$value[portalID]
                ))[0];

                $portal[pages]=json_decode($portal[pages],true);
                $typemessage=self::isPersian($value[message]);

                $value[message]=str_replace(array("\r\n","\t"),' ',$value[message]);
                $len=mb_strlen($value[message], 'UTF-8');

                $pages=array();
                /*for ($i=1;$i<=10;$i++){
                    $pages[$i]=$portal[pages][$typemessage][$i]*$i;
                    //one page strlen
                }*/


                foreach ($portal[pages][$typemessage] as $key2 => $item) {
                    if ($key2>1) {
                        $pages[$key2] = $item + $pages[($key2-1)];
                    }else{
                        $pages[$key2] = $item;
                    }
                }
            

                foreach ($pages as $key2 => $value2){
                    if ($len<=$value2){
                        array_push($result,$key2);
                        break;
                    }
                }


            }else{
                $check=0;
                break;
            }
        }

        if ($check==0){


            $portal=Portal::get(array(
                'ID'=>$array[portalID]
            ))[0];


            $portal[pages]=json_decode($portal[pages],true);
            $typemessage=self::isPersian($array[message]);

            $array[message]=str_replace(array("\r\n","\t"),' ',$array[message]);
            $len=mb_strlen($array[message]);

            $pages=array();
            /*for ($i=1;$i<=10;$i++){
                $pages[$i]=$portal[pages][$typemessage][$i]*$i;
            }*/
            foreach ($portal[pages][$typemessage] as $key2 => $item) {
                if ($key2>1) {
                    $pages[$key2] = $item + $pages[($key2-1)];
                }else{
                    $pages[$key2] = $item;
                }
            }

            foreach ($pages as $key2 => $value2){
                if ($len<=$value2){
                    $result=$key2;
                    break;
                }
            }


        }
        return $result;

    }

    public function numberToPhone($string='',$checkcron=''){
        $string=self::perToEng($string,$checkcron);
        if (is_array($string)){
            $result=array();
            foreach ($string as $key =>$number){
                $number=doubleval(str_replace('+','',$number));
                

                if (strlen($number)==10/*&&strpos($number,'9')===0*/){


                    $number='98'.$number;

                    if ($checkcron==1) {
                        $result[$key]=$number;
                    }else{
                        array_push($result,$number);
                    }


                }elseif (strlen($number)==11){
                    $number=substr($number, 1);

                    $number='98'.$number;

                    if ($checkcron==1) {
                        $result[$key]=$number;
                    }else{
                        array_push($result,$number);
                    }


                }elseif(strlen($number)==12) {
                    if ($checkcron==1) {
                        $result[$key]=$number;
                    }else{
                        array_push($result,$number);
                    }
                }else{
                    if ($checkcron==1) {
                        
                    }else{
                        array_push($result,'');
                    }
                }
            

            }
            return $result;
        }else{

            $result=doubleval(str_replace('+','',$string));
            
            if (strlen($result)==10/*&&strpos($result,'9')===0*/){

                $result='98'.$result;
                return $result;
            }elseif (strlen($result)==11){
                $result=substr($result, 1);
                $result='98'.$result;
                return $result;
            }elseif(strlen($result)==12) {
                return $result;
            }else{
                return '';
            }
        


        }

    }


    public function randchar($number=5){

        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789!@#$%^&*()');

        shuffle($seed);

        $rand = '';
        foreach (array_rand($seed,$number) as $k) $rand .= $seed[$k];
        return $rand;
    }
    public function randcharnum($number=5){

        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789');

        shuffle($seed);

        $rand = '';
        foreach (array_rand($seed,$number) as $k) $rand .= $seed[$k];
        return $rand;
    }
    public function randcharnum2($number=5){

        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789');

        shuffle($seed);

        $rand = '';
        foreach (array_rand($seed,$number) as $k) $rand .= $seed[$k];
        return $rand;
    }

    public function randcharacter($number=5){

        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            );

        shuffle($seed);

        $rand = '';
        foreach (array_rand($seed,$number) as $k) $rand .= $seed[$k];
        return $rand;
    }

    public function array_random($arr, $num = 1) {
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $r;
    }

    public function array_random_phonebook_smart($arr, $num = 1,$message,$elements=array())
    {
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            if (sizeof($elements[2])>0) {
                $arr[$i][more]=json_decode($arr[$i][more],true);
                $arr[$i][message]=$message;
                $arr[$i][moresmartuser]=array();
                    
                foreach ($elements[2] as $key => $value) {
                    if ($value=='cols') {
                        $arr[$i][moresmartuser][$elements[1][$key]]=$arr[$i][more][$elements[1][$key]];
                        $arr[$i][message]=str_replace($elements[0][$key], $arr[$i][more][$elements[1][$key]], $arr[$i][message]);
                    }else{
                        $arr[$i][moresmartuser][$elements[1][$key]]=$arr[$i][$elements[1][$key]];
                        $arr[$i][message]=str_replace($elements[0][$key], $arr[$i][$elements[1][$key]], $arr[$i][message]);
                    }
                    
                }
            }
            array_push($r, array('phone'=>$arr[$i][phone],'moresmartuser'=>$arr[$i][moresmartuser],'message'=>$arr[$i][message]));
            
        }
        return $r;
    }

    public function changeDayToNumber($arr){
        if (is_array($arr)){
            $result=array();
            foreach ($arr as $ar){
                if ($ar!=''){
                    $ar=str_replace(' ','',$ar);
                    switch ($ar){
                        case 'شنبه':
                            array_push($result,0);
                            break;
                        case 'یکشنبه':
                            array_push($result,1);
                            break;
                        case 'دوشنبه':
                            array_push($result,2);
                            break;
                        case 'سهشنبه':
                            array_push($result,3);
                            break;
                        case 'چهارشنبه':
                            array_push($result,4);
                            break;
                        case 'پنجشنبه':
                            array_push($result,5);
                            break;
                        case 'جمعه':
                            array_push($result,6);
                            break;
                    }
                }
            }
            return $result;
        }else{
            $arr=str_replace(' ','',$arr);
            switch ($arr){
                case 'شنبه':
                    return 0;
                    break;
                case 'یکشنبه':
                    return 1;
                    break;
                case 'دوشنبه':
                    return 2;
                    break;
                case 'سهشنبه':
                    return 3;
                    break;
                case 'چهارشنبه':
                    return 4;
                    break;
                case 'پنجشنبه':
                    return 5;
                    break;
                case 'جمعه':
                    return 6;
                    break;
            }
        }
    }


    public function changeNumberToDay($arr){
        if (is_array($arr)){
            $result=array();

            foreach ($arr as $ar){

                if ($ar!==''){
//                    $ar=str_replace(' ','',$ar);
                    switch ($ar){
                        case '0':
                            array_push($result,'شنبه');
                            break;
                        case '1':
                            array_push($result,'یک شنبه');
                            break;
                        case '2':
                            array_push($result,'دوشنبه');
                            break;
                        case '3':
                            array_push($result,'سه شنبه');
                            break;
                        case '4':
                            array_push($result,'چهار شنبه');
                            break;
                        case '5':
                            array_push($result,'پنج شنبه');
                            break;
                        case '6':
                            array_push($result,'جمعه');
                            break;
                    }
                }

            }
            return $result;
        }else{
//            $arr=str_replace(' ','',$arr);
            switch ($arr){
                case '0':
                    return 'شنبه';
                    break;
                case '1':
                    return 'یک شنبه';
                    break;
                case '2':
                    return 'دوشنبه';
                    break;
                case '3':
                    return 'سه شنبه';
                    break;
                case '4':
                    return 'چهار شنبه';
                    break;
                case '5':
                    return 'پنج شنبه';
                    break;
                case '6':
                    return 'جمعه';
                    break;
            }
        }
    }


}
?>