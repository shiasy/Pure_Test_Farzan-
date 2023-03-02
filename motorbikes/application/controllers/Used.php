<?php


class Used
{
    public function permshowmenu($permID,$kindsystem='panel',$userID='')
    {   
        if ($kindsystem=='panel') {
            if ($userID=='') {
                $userID=$_SESSION['user']['ID'];
            }
        }elseif ($kindsystem=='app') {
            if ($userID=='') {
                $userID=$_SESSION['appuser']['ID'];
            }
        }
        if ($userID!=''&&$permID!='') {

            $usersel=User::get(array('ID'=>$userID))[0];
            if($usersel[mainkind]=='admin'){
                return true;
            }

            $perm=Perm::get(array('ID'=>$permID))[0];
            if ($perm[ID]!='') {
                $perm2=$perm;
                while ($perm2[permID]!=0) {
                    $perm2=Perm::get(array('ID'=>$perm2[permID]))[0];
                    $userperm2=Userperm::get(array('userID'=>$userID,'permID'=>$perm2[ID]))[0];
                    if ($userperm2[ID]!='') {
                        if($userperm2[kind]=='قابل نمایش'){
                            
                        }else{
                            return false;
                        }
                    }else{
                        if ($perm2[kind]=='قابل خرید'&&$perm2[price]==0) {
                                
                            Userperm::add(array('userID'=>$userID,'permID'=>$perm2[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                        }
                    }
                    
                }

                $userperm=Userperm::get(array('userID'=>$userID,'permID'=>$permID))[0];
                if ($userperm[ID]!='') {

                    if($userperm[kind]=='قابل نمایش'){
                        return true;    
                    }else{
                        return false;
                    }
                

                }else{
                    if ($perm[kind]=='قابل خرید'&&$perm[price]==0) {
                                
                        Userperm::add(array('userID'=>$userID,'permID'=>$perm[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                    }
                    return true;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }        
    }


    public function permshowpage($permID,$dir='',$userID='')
    {   

        if ($userID=='') {
            $userID=$_SESSION['user']['ID'];
        }

        if ($userID==''||$permID=='') {
            die();
        }

        $usersel=User::get(array('ID'=>$userID))[0];
        if ($usersel[mainkind]!='admin') {
        // if (true) {
            
            

            if(Used::permshowmenu($permID,'panel',$userID)){
                $perm=Perm::get(array('ID'=>$permID))[0];
                if ($perm[ID]!='') {

                    $perm2=$perm;

                    while ($perm2[permID]!=0) {
                        $perm2=Perm::get(array('ID'=>$perm2[permID]))[0];
                        $userperm2=Userperm::get(array('userID'=>$userID,'permID'=>$perm2[ID]))[0];
                        if ($userperm2[ID]!='') {
                            

                            if ($userperm2[expiretime]<time()) {
                                if ($perm2[kind]=='قابل خرید'&&$perm2[price]==0) {
                                    
                                    Userperm::edit(array('fixuserID'=>$userID,'fixpermID'=>$perm2[ID],'prices'=>array(0,1),'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم'));

                                }elseif ($perm2[kind]=='قابل خرید'&&$perm2[price]!=0) {
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($perm2[ID])?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pop/popShowPage",".body>.pagebody",``);
                                        })
                                    </script>
                                    <?php
                                    die();
                                }else{
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pop/popShowPage",".body>.pagebody",``);
                                        })
                                    </script>
                                    <?php
                                    die();
                                }
                            }

                        }else{
                            if ($perm2[kind]=='قابل خرید'&&$perm2[price]==0) {
                                    
                                Userperm::add(array('userID'=>$userID,'permID'=>$perm2[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                            }elseif ($perm2[kind]=='قابل خرید'&&$perm2[price]!=0) {
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($perm2[ID])?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pop/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }else{
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pop/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }
                        }
                        
                    }


                    $userperm=Userperm::get(array('userID'=>$userID,'permID'=>$permID))[0];
                    if ($userperm[ID]!='') {
                        if ($userperm[expiretime]<time()) {
                            if ($perm[kind]=='قابل خرید'&&$perm[price]==0) {
                                
                                Userperm::edit(array('fixuserID'=>$userID,'fixpermID'=>$permID,'prices'=>array(0,1),'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم'));

                            }elseif ($perm[kind]=='قابل خرید'&&$perm[price]!=0) {
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($permID)?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pop/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }else{
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pop/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }
                        }
                    }else{
                        if ($perm[kind]=='قابل خرید'&&$perm[price]==0) {
                                    
                            Userperm::add(array('userID'=>$userID,'permID'=>$perm[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                        }elseif ($perm[kind]=='قابل خرید'&&$perm[price]!=0) {
                            ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($permID)?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pop/popShowPage",".body>.pagebody",``);
                                })
                            </script>
                            <?php
                            die();
                        }else{
                            ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pop/popShowPage",".body>.pagebody",``);
                                })
                            </script>
                            <?php
                            die();
                        }
                    }
                }
            }else{
                ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pop/popShowPage",".body>.pagebody",``);
                    })
                </script>
                <?php
                die();
            }
        }
    }

    public function permshowpageapp($permID,$dir='',$userID='')
    {   

        if ($userID=='') {
            $userID=$_SESSION['appuser']['ID'];
        }

        if ($userID==''||$permID=='') {
            die();
        }

        $usersel=User::get(array('ID'=>$userID))[0];
        if ($usersel[mainkind]!='admin') {
        // if (true) {
            
            

            if(Used::permshowmenu($permID,'app',$userID)){
                $perm=Perm::get(array('ID'=>$permID))[0];
                if ($perm[ID]!='') {

                    $perm2=$perm;
                    while ($perm2[permID]!=0) {
                        $perm2=Perm::get(array('ID'=>$perm2[permID]))[0];
                        $userperm2=Userperm::get(array('userID'=>$userID,'permID'=>$perm2[ID]))[0];
                        if ($userperm2[ID]!='') {
                            

                            if ($userperm2[expiretime]<time()) {
                                if ($perm2[kind]=='قابل خرید'&&$perm2[price]==0) {
                                    
                                    Userperm::edit(array('fixuserID'=>$userID,'fixpermID'=>$perm2[ID],'prices'=>array(0,1),'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم'));

                                }elseif ($perm2[kind]=='قابل خرید'&&$perm2[price]!=0) {
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($perm2[ID])?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pages/popShowPage",".body>.pagebody",``);
                                        })
                                    </script>
                                    <?php
                                    die();
                                }else{
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pages/popShowPage",".body>.pagebody",``);
                                        })
                                    </script>
                                    <?php
                                    die();
                                }
                            }

                        }else{
                            if ($perm2[kind]=='قابل خرید'&&$perm2[price]==0) {
                                    
                                Userperm::add(array('userID'=>$userID,'permID'=>$perm2[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                            }elseif ($perm2[kind]=='قابل خرید'&&$perm2[price]!=0) {
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($perm2[ID])?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pages/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }else{
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pages/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }
                        }
                        
                    }


                    $userperm=Userperm::get(array('userID'=>$userID,'permID'=>$permID))[0];
                    if ($userperm[ID]!='') {
                        if ($userperm[expiretime]<time()) {
                            if ($perm[kind]=='قابل خرید'&&$perm[price]==0) {
                                
                                Userperm::edit(array('fixuserID'=>$userID,'fixpermID'=>$permID,'prices'=>array(0,1),'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم'));

                            }elseif ($perm[kind]=='قابل خرید'&&$perm[price]!=0) {
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($permID)?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pages/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }else{
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pages/popShowPage",".body>.pagebody",``);
                                    })
                                </script>
                                <?php
                                die();
                            }
                        }
                    }else{
                        if ($perm[kind]=='قابل خرید'&&$perm[price]==0) {
                                    
                            Userperm::add(array('userID'=>$userID,'permID'=>$perm[ID],'prices'=>0,'expiretime'=>(time()+(3600*24*365)),'more'=>'سیستم','kind'=>'قابل نمایش'));

                        }elseif ($perm[kind]=='قابل خرید'&&$perm[price]!=0) {
                            ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    popupback(`{"dir":"<?= $dir?>","operator":"permpage","permID":"<?=Used::jwt_encode($permID)?>","userID":"<?=Used::jwt_encode($userID)?>"}`,"pages/popShowPage",".body>.pagebody",``);
                                })
                            </script>
                            <?php
                            die();
                        }else{
                            ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pages/popShowPage",".body>.pagebody",``);
                                })
                            </script>
                            <?php
                            die();
                        }
                    }
                }
            }else{
                ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        popupback(`{"dir":"<?= $dir?>","operator":"showpage"}`,"pages/popShowPage",".body>.pagebody",``);
                    })
                </script>
                <?php
                die();
            }
        }
    }

    public function sendpushnotif($array)
    {
        $end_point = 'https://api.webpushr.com/v1/notification/send/all';

        $http_header = array(
            "Content-Type: Application/Json",
            "webpushrKey: bf8cc5cf5e0581677bd147451b05f841",
            "webpushrAuthToken: 49505"
        );

        if ($array[title]=='') {
            $array[title]=Config::$BASENAME;
        }
        if ($array[msg]=='') {
            $array[msg]="یک مورد جهت تایید وجود دارد.";
        }
        if ($array[url]=='') {
            $array[url]=Config::$BASEURL;
        }
        $req_data = array(
            'title'         => $array[title], //required
            'message'       => $array[msg], //required
            'target_url'    => $array[url], //required

            //following parameters are optional
            //'name'        => 'Test campaign',
            //'icon'        => 'https://cdn.webpushr.com/siteassets/wSxoND3TTb.png',
            //'image'       => 'https://cdn.webpushr.com/siteassets/aRB18p3VAZ.jpeg',
            //'auto_hide'   => 1,
            //'expire_push' => '5m',
            //'send_at'     => '2021-01-10 13:54 +5:30',
            //'action_buttons'=> array(
                //array('title'=> 'Demo', 'url' => 'https://www.webpushr.com/demo'),
                //array('title'=> 'Rates', 'url' => 'https://www.webpushr.com/pricing')
            //)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        curl_setopt($ch, CURLOPT_URL, $end_point );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req_data) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
    }
    public function textformatsimilarity($array)
    {
        if (preg_match(str_replace(array("\r\n","\r","\n"), "\n", $array[0]),str_replace(array("\r\n","\r","\n"), "\n", $array[1]), $match)) {
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
        try {
            if($val=='')
                return false;
            else
                return jwt::decode($val)[1];
        } catch (Exception $e) {
            return false;
        }
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
        // $array=str_replace("'", "\'", $array);
        return $array;
    }

    public function json_encode_sub_manual($array)
    {   
        $array=Used::recursive_array_replace(array("\r\n","\n"), '\r\n', $array);
        $array=Views::jsonEncode($array);
        $array=str_replace('\"', '\\\"', $array);
        // $array=str_replace('"', '\"', $array);
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
            case '17':
                $result='ارسال شده در گزارش '.$step;
                break;
            case '8':
            case '18':
                $result='نرسیده به گوشی در گزارش '.$step;
                break;
            case '9':
            case '19':
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
            case '17':
                $result='ارسال شده در گزارش '.$step;
                break;
            case '8':
            case '18':
                $result='نرسیده به گوشی در گزارش '.$step;
                break;
            case '9':
            case '19':
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

    public function hidenumber($str) {
        return substr($str,0,7).str_pad(substr($str, -2), 5, '*', STR_PAD_LEFT);
    }
    public function url_encode($str) {
        return preg_replace("/ /i", "-",preg_replace("/[^الف-یa-zA-Z0-9-_\x20]/i", "", mb_strtolower($str)));
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

    public function base64_to_file($base64_string, $output_file_name) {
        // open the output file for writing
        $ifp = fopen( $output_file_name, 'wb' ); 

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp ); 

        return $output_file_name; 
    }

    public function is_ip_in_range( $ip, $range ){

        if(!is_array($range)) return false;

        // Let's search first single one
        ksort($range);
        
        // We need numerical representation of the IP
        $ip2long = ip2long($ip);
        
        // Non IP values needs to be removed
        if($ip2long !== false)
        {
            // Let's loop
            foreach($range as $start => $end)
            {
                // Convert to numerical representations as well
                $end = ip2long($end);
                $start = ip2long($start);
                $is_key = ($start === false);
                
                // Remove bad one
                if($end === false) continue;
                
                // Here we looking for single IP does match
                if(is_numeric($start) && $is_key && $end === $ip2long)
                {
                    return $ip;
                }
                else
                {
                    // And here we have check is in the range
                    if(!$is_key && $ip2long >= $start && $ip2long <= $end)
                    {
                        return $ip;
                    }
                }
            }
        }
        
        // Ok, it's not finded
        return false;
    }

    public function ip_in_range( $ip, $range ) {
        if (!is_array($range)) {
            
            if ( strpos( $range, '/' ) === false ) {
                $range .= '/32';
            }
            // $range is in IP/CIDR format eg 127.0.0.1/24
            list( $range, $netmask ) = explode( '/', $range, 2 );
            $range_decimal = ip2long( $range );
            $ip_decimal = ip2long( $ip );
            $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
            $netmask_decimal = ~ $wildcard_decimal;
            return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
        }else{
            foreach ($range as $key => $valrange) {
                if ( strpos( $valrange, '/' ) === false ) {
                    $valrange .= '/32';
                }
                // $range is in IP/CIDR format eg 127.0.0.1/24
                list( $valrange, $netmask ) = explode( '/', $valrange, 2 );
                $range_decimal = ip2long( $valrange );
                $ip_decimal = ip2long( $ip );
                $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
                $netmask_decimal = ~ $wildcard_decimal;
                if (( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) )) {
                    return true;
                }
            }
            return false;
        }

        
    }
    // echo var_dump(self::ip_in_range('127.0.0.1','127.0.0.0/24')); is true
    // echo var_dump(self::ip_in_range('127.0.0.1','127.0.0.0/32')); is false

    public function ip_in_operator($ip){
        // if (self::is_ip_in_range($ip,array('192.168.43.1'=>'192.168.43.153','127.0.0.1'=>'127.0.0.5'))) {
        // if (self::ip_in_range($ip,array("185.4.1.20/32","185.4.1.21/32","185.4.1.32/32","185.4.1.35/32","185.4.1.38/32","185.4.2.12/32","185.4.2.15/32","185.4.2.18/32","185.4.2.21/32","185.4.2.24/32","185.4.2.27/32","185.4.2.30/32","185.4.2.33/32","185.4.3.15/32","185.4.3.19/32","185.4.3.23/32","185.4.3.27/32","185.4.3.31/32","185.4.3.35/32","185.4.3.39/32","185.4.3.43/32"))) {
        if (self::ip_in_range($ip,array("109.108.160.0/19","109.203.128.0/19","109.225.128.0/18","113.203.0.0/17","130.255.192.0/18","158.58.0.0/17","164.138.128.0/18","172.80.128.0/17","176.65.192.0/19","178.131.0.0/16","185.22.28.0/23","185.5.156.0/22","188.122.96.0/19","188.209.192.0/20","188.210.192.0/20","188.210.64.0/20","188.211.0.0/20","188.212.240.0/21","188.212.48.0/20","188.213.192.0/21","188.229.0.0/17","192.15.0.0/16","204.18.0.0/16","31.2.128.0/17","37.129.0.0/16","37.63.128.0/17","37.98.0.0/17","46.164.64.0/18","46.51.0.0/17","5.106.0.0/16","5.201.192.0/18","5.22.0.0/17","5.250.0.0/17","5.52.0.0/16","62.102.128.0/20","69.194.64.0/18","80.242.0.0/20","82.180.192.0/18","83.120.0.0/14","85.239.192.0/19","86.107.0.0/20","86.107.208.0/20","86.55.0.0/16","89.196.0.0/16","89.198.0.0/15","89.45.48.0/20","91.133.128.0/17","91.251.0.0/16","93.110.0.0/16","93.117.176.0/20","93.119.208.0/20","94.101.240.0/20","95.64.0.0/17")) || ($ip>='5.208.0.0'&&$ip<='5.218.255.255')) {
            return 'mci';
        }elseif (self::ip_in_range($ip,array())) {
            return 'irancell';
        }elseif (self::ip_in_range($ip,array())) {
            return 'rightel';
        }else{
            return 'other';
        }
    }


    public function checkperm($page,$dir,$redirect=true){

        $_SESSION[usoperator]=self::ip_in_operator($_SERVER['REMOTE_ADDR']);

        $userpack=array();
        if ($_SESSION[user]!='') {
            $userpack=Userpack::get(array('userID'=>Used::jwt_decode($_SESSION[user]),'status'=>'موفق','bigexptime'=>time()))[0];
        }

        if ($userpack[ID]=='' && !in_array($_SESSION[usoperator],Config::$FREEOP)) {
            $_SESSION[permshow]=0;
        }else{
            $_SESSION[permshow]=1;
        }
        

        if(strpos($page, 'play')===false && strpos($page, 'buypackage')===false && strpos($page, 'pop/packagestatus')===false && strpos($page, 'pop/videos')===false && strpos($page, 'pop/profile')===false || (in_array($_SESSION[usoperator],Config::$FREEOP && strpos($page, 'play')!==false))){
            
            if ($_SESSION[user]==''&&$_COOKIE[userID]==''){
                ?>
                
                <?php
            }else{
                if ($_SESSION[user]!='') {
                    $user=Users::get(array('ID'=>Used::jwt_decode($_SESSION[user])))[0];
                }elseif ($_COOKIE[userID]!='') {
                    $user=Users::get(array('ID'=>Used::jwt_decode($_COOKIE[userID])))[0];
                }
                $_SESSION[user]=Used::jwt_encode($user['ID']);

                if ($redirect) {
                    if ($_SESSION[user]!='') {
                        // SafeData::newredirect($dir.'index');
                    }else{
                        SafeData::newredirect($dir.'logout');
                    }
                }else{
                    die();
                }
            }
        }else{

            if (strpos($page,'play')!==false) {
                    
                if ($_COOKIE[userID]!='') {
                    $user=Users::get(array('ID'=>Used::jwt_decode($_COOKIE[userID])))[0];
                    $_SESSION[user]=Used::jwt_encode($user['ID']);
                }

                $userpack=array();
                if ($_SESSION[user]!='') {
                    $userpack=Userpack::get(array('userID'=>Used::jwt_decode($_SESSION[user]),'status'=>'موفق','bigexptime'=>time()))[0];
                }

                if ($userpack[ID]=='' && !in_array($_SESSION[usoperator],Config::$FREEOP)) {
                    SafeData::newredirect($dir.'buypackage');
                }

            }else{

                if ($_SESSION[user]==''&&$_COOKIE[userID]==''){
                    if ($redirect) {
                        SafeData::newredirect($dir.'login');
                    }else{
                        die();
                    }
                }

                if ($_SESSION[user]!='') {
                    $user=Users::get(array('ID'=>Used::jwt_decode($_SESSION[user])))[0];
                }elseif ($_COOKIE[userID]!='') {
                    $user=Users::get(array('ID'=>Used::jwt_decode($_COOKIE[userID])))[0];
                }
                $_SESSION[user]=Used::jwt_encode($user['ID']);
            }
        }
    }
}