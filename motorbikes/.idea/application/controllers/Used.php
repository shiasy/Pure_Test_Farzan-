<?php


class Used
{


    public function textformatsimilarity($array)
    {
        if (preg_match($array[0],$array[1], $match)) {
            
            return true;
        } else {
            return false;
        }

        // if (preg_match("/(?P<foo1>hello)(.*)(?P<foo2>world)(.*)(?P<foo3>goodby)/", "hello mohammad shiasy world asus x550cc goodby", $match)) {
        //     echo var_dump($match);
        //     echo "A match was found.";
        // } else {
        //     echo "A match was not found.";
        // }
    }
    public function exportexcel($array)
    {

        if ($array[filename]=='') {
            $array[filename]=SafeData::randcharnum(50);
        }
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="'.$array[filename].'.xls"');

        ob_flush();
        flush();
        $i = sizeOf($data);
        //$fp = fopen('php://stdout', 'a');

        //fwrite($fp, chr(255).chr(254));

        $cols_line = '<tr>';

        foreach($array[titles] as $key2 => $col)
        {
            $cols_line .= '<th style="color: #fff;vertical-align: middle;background-color: #343a40;border-color: #454d55;">'.$col.'</th>';
        }
        if($array[titlestable]!='') {
            $cols_line = str_replace('style=', 'style2=', $array[titlestable]);

            $cols_line = str_replace('<th', '<th  style="color: #fff;vertical-align: middle;background-color: #343a40;border-color: #454d55;"', $cols_line);
        }


        $cols_line .= '</tr>';
        //fwrite($fp, '<table border="1" cellpadding="5">'.$cols_line);

        echo('<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
                </head>
            <body>
            <table border="1" cellpadding="5">');
        echo $array[body];
        ?>
       
        <tr>
            <td colspan="<?=($array[titlesnumbric]!='')?$array[titlesnumbric]:sizeof($array[titles])?>">
                <div style="font-size: 10px; color: #888888;text-align:center;margin-top: 20px;">
                    <?=$array[title]?>
                </div>
            </td>
        </tr>

        <?php
        echo ($cols_line);

        if ($array[datastable]!='') {
            $line=str_replace('style=', 'style2=', $array[datastable]);
            $line=str_replace(array('<tr','<td'), array('<tr style="background-color:rgba(0, 0, 0, 0.05);"','<td  style="color:#343a40 !important;vertical-align: middle;background-color: rgba(0, 0, 0, 0.05);border-color:rgb(222, 226, 230);"'), $line);
            echo ($line);
        }else{

            foreach ($array[datas] as $key => $value) {
                
                $line = '<tr style="background-color:rgba(0, 0, 0, 0.05);">';
                foreach ($array[titles] as $key2 => $value2) {
                    $line .= '<td  style="color:#343a40 !important;vertical-align: middle;background-color: rgba(0, 0, 0, 0.05);border-color:rgb(222, 226, 230);">'.$value[$key2].'</td>';
                }
                $line .= '</tr>';

                //$line = mb_convert_encoding($line, "UTF-16");

                //fwrite($fp, $line);
                echo($line);
            }
        }

        echo('</table>
            </body>
            </html>');

        /* example is */
        // Used::exportexcel(array(
        //     'filename'=>'',
        //     'title'=>'گزارش حضور و غیاب',
        //     'titles'=>array(
        //         'ID'=>'ردیف',
        //         'name'=>'نام',
        //         'family'=>'نام خانوادگی',
        //         'nationalcode'=>'کد ملی',
        //     ),
        //     'datas'=>array(
        //         array(
        //             'ID'=>'1',
        //             'name'=>'محمد',
        //             'family'=>'شیاسی',
        //             'nationalcode'=>'0311578330',
        //         ),
        //         array(
        //             'ID'=>'2',
        //             'name'=>'مهدی',
        //             'family'=>'شیاسی',
        //             'nationalcode'=>'486',
        //         ),
        //     ),
        //     'body'=>'<tr>
        //         <td colspan="3">
        //         تعداد کاربران : 50
        //         </td>
        //     </tr><tr>
        //         <td colspan="3">
        //         تعداد انجام شده : 20
        //         </td>
        //     </tr><tr>
        //         <td colspan="4" style="color:red">
        //         تعداد مانده: 30
        //         </td>
        //     </tr>'

        // ));
    }


    public function recursive_array_replace($find, $replace, $array) {

        if (!is_array($array)) {
            return str_replace($find, $replace, $array);
        }

        $newArray = array();

        foreach ($array as $key => $value) {
            if ($key!=''&&!is_int($key)) {
                $newArray[$key] = Used::recursive_array_replace($find, $replace, $value);
            }else{
                array_push($newArray, Used::recursive_array_replace($find, $replace, $value));
            }
        }

        return $newArray;
    }

    
    public function jwt_encode($val)
    {
        return jwt::encode(array(time(),$val,rand(1,9999)));
    }
    public function jwt_decode($val)
    {
        return jwt::decode($val)[1];
    }
    public function strdb_encode($val)
    {
        return str_replace("'", "\'", $val);
    }
    public function strdb_decode($val)
    {
        return str_replace("\'","'", $val);
    }
    public function strdb_encode_manual($val)
    {
        return str_replace('"', '\"', $val);
    }
    public function strdb_decode_manual($val)
    {
        return str_replace('\"','"', $val);
    }
    public function strinp_encode($val)
    {
        return str_replace('"','\"', $val);
    }
    public function strinp_decode($val)
    {
        return str_replace('\"','"', $val);
    }

    public function colarray_encode($val)
    {
        return str_replace(array("\r\n","\n"), '\r\n', $val);
    }
    public function colarray_decode($val)
    {
        return str_replace('\r\n',"\r\n", $val);
    }
    public function colarrayafter_encode($val)
    {
        return str_replace('\"', '\\\"', $val);
    }
    public function colarrayafter_encode_all($val)
    {
        return Used::recursive_array_replace('\"', '\\\"', $val);
    }
    public function colarrayafter_decode($val)
    {
        return str_replace('\"','"', $val);
    }
    public function strarraydb_encode($val)
    {
        return str_replace(array("\r\n","\n","'"), array('\r\n','\r\n',"\'"), $val);
    }
    public function strarraydb_encode_all($val)
    {
        return Used::recursive_array_replace(array("\r\n","\n","'"), array('\r\n','\r\n',"\'"), $val);
    }
    public function strarraydb_decode($val)
    {
        return str_replace(array('\r\n','\r\n',"\'"),array("\r\n","\r\n","'"), $val);
    }
    public function strarraydb2_encode($val)
    {
        return urlencode($val);
    }
    public function strarraydb2_decode($val)
    {
        return urldecode($val);
    }


    public function json_encode_sub($array)
    {   
        $array=Used::recursive_array_replace(array("\r\n","\n"), '\r\n', $array);
        $array=Views::jsonEncode($array);
        $array=str_replace('\"', '\\\"', $array);
        $array=str_replace("'", "\'", $array);
        return $array;
    }

    public function json_encode_sub_manual($array)
    {   
        $array=Used::recursive_array_replace(array("\r\n","\n"), '\r\n', $array);
        $array=Views::jsonEncode($array);
        $array=str_replace('\"', '\\\"', $array);
        $array=str_replace('"', '\"', $array);
        return $array;
    }

    function statussuboutbox($statusID,$step=''){
        if ($step==3){
            $step='آخر';
        }
        switch ($statusID){
            case '1':
                $result='در انتظار تایید';
                break;
            case '2':
                $result='در صف ارسال';
                break;
            case '3':
                $result='در حال ارسال';
                break;
            case '5':
                $result='پایان ارسال';
                break;
            case '6':
                $result='در حال گزارشگیری';
                break;
            case '7':
                $result='ارسال شده در گزارش '.$step;
                break;
            case '8':
                $result='نرسیده به گوشی در گزارش '.$step;
                break;
            case '9':
                $result='رسیده به گوشی در گزارش '.$step;
                break;
            case '10':
                $result='برگشتی';
                break;
            case '11':
                $result='ارسال نشده';
                break;
            case '12':
                $result='رد شده';
                break;
            case '13':
                $result='متوقف شده';
                break;
            case '14':
                $result='اختلال مخابراتی';
                break;
            case '15':
                $result='بازگشتی اپراتور';
                break;
            default:
                $result='تعریف نشده';
                break;
        }
        echo $result;
    }
    function statusoutbox($statusID,$result=''){
        switch ($statusID){
            case '1':
                $result='در انتظار تایید';
                break;
            case '2':
                $result='تایید شده';
                break;
            case '3':
                $result='رد شده ('.$result.')';
                break;
            case '4':
                $result='در حال ارسال';
                break;
            case '5':
                $result='گزارش گیری';
                break;
            case '6':
                $result='تایید - پایان یافته';
                break;
            case '7':
                $result='';
                break;
            case '8':
                $result='در صف ارسال';
                break;
            case '9':
                $result='اختلالات مخابراتی';
                break;
            case '10':
                $result='موجودی کم است';
                break;
            case '11':
                $result='متوقف شده';
                break;
            case '12':
                $result='متوقف شده - گزارش گیری';
                break;
            case '13':
                $result='متوقف شده - پایان یافته';
                break;
            case '14':
                $result='گزارش گیری آخر';
                break;
            default:
                $result='تعریف نشده';
                break;
        }
        echo $result;
    }



    function statussuboutboxreturn($statusID,$step=''){
        if ($step==3){
            $step='آخر';
        }
        switch ($statusID){
            case '1':
                $result='در انتظار تایید';
                break;
            case '2':
                $result='در صف ارسال';
                break;
            case '3':
                $result='در حال ارسال';
                break;
            case '5':
                $result='پایان ارسال';
                break;
            case '6':
                $result='در حال گزارشگیری';
                break;
            case '7':
                $result='ارسال شده در گزارش '.$step;
                break;
            case '8':
                $result='نرسیده به گوشی در گزارش '.$step;
                break;
            case '9':
                $result='رسیده به گوشی در گزارش '.$step;
                break;
            case '10':
                $result='برگشتی';
                break;
            case '11':
                $result='ارسال نشده';
                break;
            case '12':
                $result='رد شده';
                break;
            case '13':
                $result='متوقف شده';
                break;
            case '14':
                $result='اختلال مخابراتی';
                break;
            case '15':
                $result='بازگشتی اپراتور';
                break;
            default:
                $result='تعریف نشده';
                break;
        }
        return $result;
    }
    function statusoutboxreturn($statusID,$result=''){
        switch ($statusID){
            case '1':
                $result='در انتظار تایید';
                break;
            case '2':
                $result='تایید شده';
                break;
            case '3':
                $result='رد شده ('.$result.')';
                break;
            case '4':
                $result='در حال ارسال';
                break;
            case '5':
                $result='گزارش گیری';
                break;
            case '6':
                $result='تایید - پایان یافته';
                break;
            case '7':
                $result='';
                break;
            case '8':
                $result='در صف ارسال';
                break;
            case '9':
                $result='اختلالات مخابراتی';
                break;
            case '10':
                $result='موجودی کم است';
                break;
            case '11':
                $result='متوقف شده';
                break;
            case '12':
                $result='متوقف شده - گزارش گیری';
                break;
            case '13':
                $result='متوقف شده - پایان یافته';
                break;
            case '14':
                $result='گزارش گیری آخر';
                break;
            default:
                $result='تعریف نشده';
                break;
        }
        return $result;
    }


    function kindToStrWalletLog($kind){
        switch ($kind){
            case '0':
                return 'کاهش هزینه';
                break;
            case '1':
                return 'افزایش هزینه';
                break;
            case '2':
                return 'بازگشت هزینه';
                break;
            default:
                return 'تعریف نشده';
                break;
        }
    }

    public function replace_first($find, $replace, $subject) {
        foreach ($find as $item) {
            if (strpos($subject,$item)!==false){
                return implode($replace, explode($item, $subject, 2));
            }
        }

        return $subject;
    }


    public function sendsystem($array){
        if ($array[userID]==''){
            $array[userID]=Config::$defaultadmin;
        }
        if($array[sendby]==''){
            $array[sendby]='systemlogin';
        }


        if($array[from]==''){
            $array[from]=Config::$FROM;
        }

        $check=Fastsend::send(array(
            'from'=>$array[from],
            'numbers'=>$array[mobile],
            'message'=>$array[message],
            'timestamp'=>'',
            'timestampend'=>'',
            'wait'=>'',
            'persend'=>'',
            'kindsend'=>0,
            'timesend'=>0,
            'description'=>'ارسال سریع',
            'persendperiod'=>0,
            'user'=>array('ID'=>$array[userID]),
            'sendby'=>$array[sendby]
        ));
        
        return $check;
    }
}