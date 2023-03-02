<?php
session_start();
class Models extends Config {
  public static $con=null;
    public function connectDB($dbName=null,$dbHostName=null,$dbUserName=null,$dbPassWord=null)
    {
      // $dbUserName=UserAccess::deToken()[0];
      // $dbPassWord=UserAccess::deToken()[1];
      // Config::changeData($dbUserName,$dbPassWord);
      if($dbHostName==''||!isset($dbHostName))
      {
        $dbHostName=self::$DBHOSTNAME;
      }
      if($dbUserName==''||!isset($dbUserName))
      {
        $dbUserName=self::$DBUSERNAME;
      }
      if($dbPassWord==''||!isset($dbPassWord))
      {
        $dbPassWord=self::$DBPASSWORD;
      }
      if($dbName==''||!isset($dbName))
      {
        $dbName=self::$DBNAME;
      }
      //echo $dbHostName.' '.$dbUserName.' '.$dbPassWord.' '.$dbName;
          $conn=mysqli_connect($dbHostName,$dbUserName,$dbPassWord,$dbName) or die(mysqli_error($conn));
          if(!mysqli_select_db($conn,$dbName))
            mysqli_select_db($conn,$dbName) or die(mysqli_error($conn));
          //mysqli_query($conn,"SET CHARACTER SET utf8");
          mysqli_set_charset($conn,"utf8mb4");
          self::$con=$conn;
      
    }

    public function disConnectDB(){
      mysqli_close(self::$con);
    }

    public function insertData($array/*$anArrayOfNameColAndValueCol,$tableName=null*/){
      if($array['tableName']==''||$array['tableName']==null||!isset($array['tableName']))
      {
        $array['tableName']=self::$DBTABLENAME;
      }
      $number=1;
      $code="INSERT INTO ".$array['tableName']."(";
          foreach ($array['values'] as $name => $value) {
            if ($number==1){
              $code=$code.$name;
              $number++;
            }
            else{
              $code=$code.",".$name;
            }
          }
          $number=1;
          $code=$code.")VALUES (";
          foreach ($array['values'] as $name => $value) {
            if ($number==1) {
              $code=$code."'".$value."'";
              $number++;
            }
            else
              $code=$code.",'".$value."'";
          }
          $code=$code.")";

// echo  var_dump($code);
          //echo var_dump(self::$con);
          mysqli_query(self::$con,$code);
    }


    public function fun($sql){
      if (!$dbResult=mysqli_query(self::$con,$sql)) {
        $dbResult=mysqli_error(self::$con);
      }
        
        return $dbResult;
    }

    public function multifun($sql){
      if (!$dbResult=mysqli_multi_query(self::$con,$sql)) {
        $dbResult=mysqli_error(self::$con);
      }
        
        return $dbResult;
    }

    public function query($sql){
        $dbResult=mysqli_query(self::$con,$sql);
        return $dbResult;
    }
    public function query2($sql){
          Models::connectDB();
        $dbResult=mysqli_query(self::$con,$sql);
        Models::disConnectDB();
        return $dbResult;
    }

    public function queryarray($sql){
      Models::connectDB();
        $dbResult=mysqli_query(self::$con,$sql);
        $dbResult=mysqli_fetch_all($dbResult, MYSQLI_ASSOC);
        Models::disConnectDB();
        return $dbResult;
    }

    public function queryarraybank($sql){
      Models::connectDB(Config::$DBBANKNAME);
        $dbResult=mysqli_query(self::$con,$sql);
        $dbResult=mysqli_fetch_all($dbResult, MYSQLI_ASSOC);
        Models::disConnectDB();
        return $dbResult;
    }

    public function deleteData($array/*$anArrayOfNameColAndValueCol,$tableName=null*/){
      if($array['tableName']==''||$array['tableName']==null||!isset($array['tableName']))
      {
        $array['tableName']=self::$DBTABLENAME;
      }
      $number=1;
      $code="DELETE FROM `".$array['tableName']."` ";
          foreach ($array['values'] as $name => $value) {
            if ($value!=''&&$value!=null) {
              if ($number==1){
                $code=$code." WHERE `".$name."` = '".$value."'";
                $number++;
              }
              else{
                $code=$code." AND `".$name."` = '".$value."'";
              }
            }
            
          }
          
          mysqli_query(self::$con,$code)or die(mysqli_error(self::$con));
      }

      public function changeData($array/*$anArrayOfNameColAndValueColChange,$anArrayOfNameColAndValueColLike,$tableName=null*/){
      if($array['tableName']==''||$array['tableName']==null||!isset($array['tableName']))
      {
        $array['tableName']=self::$DBTABLENAME;
      }
      $code="UPDATE `".$array['tableName']."` set ";
      $number=1;
      foreach ($array['forChange'] as $name => $value) {

        if(($value[1]==''||$value[1]==0)&&!is_array($value[0])){

          if ($value[0]!=''||($value[0]==0&&is_double($value[0]))) {
            if ($number==1) {
              $code.="".$name."='".$value[0]."' ";
              $number++;
            }
            else
              $code.=", ".$name."='".$value[0]."' ";
          }

        }elseif(($value[1]!=0&&$value[1]!='')||(is_array($value[0])&&$value[0][1]=='element')){

            if ($value[0]!=''||($value[0]==0&&is_double($value[0]))) {
                if ($number==1) {
                    $code.="".$name."=".$value[0][0]." ";
                    $number++;
                }
                else
                    $code.=", ".$name."=".$value[0][0]." ";
            }

        }elseif(($value[1]!=0&&$value[1]!='')||(is_array($value[0])&&$value[0][1]!='')){
            if ((is_array($value[0])&&$value[0][1]!='')){
                $value[0]=$value[0][0];
            }
            if ($number==1) {
                $code.="".$name."='".$value[0]."'";
                $number++;
            }
            else
                $code.=", ".$name."='".$value[0]."'";

        }
      }
      $code.=" WHERE ";
      $number=1;
      foreach ($array['fixed'] as $name => $value) {
        if (!is_array($value[0])||(is_array($value[0])&&$value[0][1]=='')) {
            if(($value[1]==''||$value[1]==0)&&$value[0]!=''){


              if ($number==1&&$name==1) {
                $code.="1";
                $number++;
              }elseif ($number==1) {
                $code.="".$name."='".$value[0]."' ";
                $number++;
              }
              else
                $code.="AND ".$name."='".$value[0]."' ";

            }elseif($value[0]!=''){

              if ($number==1&&$name==1) {
                $code.="1";
                $number++;
              }elseif ($number==1) {
                $code.="`".$name."`=".$value[0]." ";
                $number++;
              }
              else
                $code.="AND `".$name."`=".$value[0]." ";
            }
        }elseif(is_array($value[0])&&$value[0][1]==1){

          if(($value[1]==''||$value[1]==0)){


              if ($number==1&&$name==1) {
                $code.="1";
                $number++;
              }elseif ($number==1) {
                $code.="".$name."='".$value[0][0]."' ";
                $number++;
              }
              else
                $code.="AND ".$name."='".$value[0][0]."' ";

            }else{

              if ($number==1&&$name==1) {
                $code.="1";
                $number++;
              }elseif ($number==1) {
                $code.="`".$name."`=".$value[0][0]." ";
                $number++;
              }
              else
                $code.="AND `".$name."`=".$value[0][0]." ";
            }

        }
        
      }

      if ($array['limit']!=''){
          $code.=' LIMIT '.$array['limit'];
      }

     // echo $code;
      //echo var_dump(self::$con);
      mysqli_query(self::$con,$code)or die(mysqli_error(self::$con));
    }

    public function deleteTableDB($tableName=null){
      if($tableName==''||$tableName==null||!isset($tableName))
      {
        $tableName=self::$DBTABLENAME;
      }
        $code="DROP TABLE ".$tableName;
        mysqli_query(self::$con,$code);
      }

      public function deleteDataBase($dbName=null){
      if($dbName==''||$dbName==null||!isset($dbName))
      {
        $dbName=self::$DBNAME;
      }
        $code="DROP DATABASE ".$dbName;
        mysqli_query(self::$con,$code);
    }

    public function deleteColDB($array/*$anArrayOfNameColForDelete,$tableName=null*/){
      if($array['tableName']==''||$array['tableName']==null||!isset($array['tableName']))
      {
        $array['tableName']=self::$DBTABLENAME;
      }
      foreach ($array['cols'] as $name) {
        if ($name!=''||isset($name)) {
          $code="ALTER TABLE `".$array['tableName']."` DROP COLUMN `".$name."`";
          mysqli_query(self::$con,$code);
        }
      }
    } 

    public function sendMail($to,$submit,$body,$fromOrHeader='',$tableName=null){
      $head = 'MIME-Version: 1.0' . "\r\n";
      $head .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      if($fromOrHeader==''||$fromOrHeader==null||!isset($fromOrHeader))
        $head .= 'From: **@******.*** '. "\r\n";
      else
        $head .= 'From: '.$fromOrHeader. "\r\n";
      if(mail($to,$submit,$body,$head))
        return 1;
      else
        return 0;
    } 

   public function uploadFile($uploadFile,$anArrayOfTypeFile,$minSize,$maxSize,$addressFileUpload=ROOT.DS.'public'.DS.'panel'.DS.'uploads'.DS,$anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload=array("typeFileUpload","nameFileUpload","linkFileUpload"),$tableName='tbl_upload'){
      if($tableName==''||$tableName==null||!isset($tableName))
      {
        $tableName=self::$DBTABLENAME;
      }
      $addressFileUpload2='http://'.$_SERVER["SERVER_NAME"]."/public/panel/uploads"."/";
      $check_result=0;

       $pasvand=strtolower(end(explode('.',$uploadFile['name'])));

      $checkType=0;
      if (in_array(strtolower($pasvand), $anArrayOfTypeFile)) {
        $checkType=1;
      }
      
      if ($checkType==1&&$uploadFile["size"]>=$minSize&&$uploadFile["size"]<=$maxSize&&$uploadFile["error"]==0) {
        if (file_exists($addressFileUpload . $uploadFile["name"])){
          $checkName=0;
          while ($checkName==0) {
            $randName = time().rand(1000000000,9999999999);
            if (file_exists($addressFileUpload.$randName.".".$pasvand))
              $checkName=0;
            else
              $checkName=1;
          }
          if ($checkName==1) {
            move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$randName.".".$pasvand);
            Models::insertData(array($anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[0]=>$pasvand,$anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[1]=>$randName.".".$pasvand,$anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[2]=>$addressFileUpload2.$randName.".".$pasvand),$tableName);
            $check_result = $randName.".".$pasvand;   
          }else
            $check_result = 0;
                    
        }else{
          move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$uploadFile["name"]);
          Models::insertData(array($anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[0]=>$pasvand,$anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[1]=>$uploadFile["name"],$anArrayOfNameColForTypeFileUploadAndNameFileUploadAndLinkFileUpload[2]=>$addressFileUpload2.$uploadFile["name"]),$tableName);
          $check_result = $uploadFile["name"];       
        }
      }
      return $check_result;
    }  

    public function uploadFileSystem($uploadFile,$anArrayOfTypeFile=array('pdf','PDF','jpg','gif','JPG','png','PNG','mp3','MP3','mp4','MP4','zip','ZIP'),$minSize=10,$maxSize=10000000,$addressFileUpload=ROOT.DS.'includes'.DS.'uploads'.DS.'files'.DS){

      $addressFileUpload2='http://'.$_SERVER["SERVER_NAME"]."/includes/uploads"."/";
      $check_result=array();
        $pasvand=strtolower(end(explode('.',$uploadFile['name'])));

      $checkType=0;
      if(in_array(strtolower($pasvand),$anArrayOfTypeFile)){
          $checkType=1;
      }
      // $checkType=0;
      // foreach ($anArrayOfTypeFile as $type) {
      //   if ($type!=''||isset($type)) {
      //     if ($pasvand==$type) {
      //       $checkType=1;
      //     }
      //   }
      // }
      if ($checkType==1&&$uploadFile["size"]>=$minSize&&$uploadFile["size"]<=$maxSize&&$uploadFile["error"]==0) {
        if (/*file_exists($addressFileUpload . $uploadFile["name"])*/true){
          $checkName=0;
          while ($checkName==0) {
            $randName = time().rand(1000000000,9999999999);
            if (file_exists($addressFileUpload.$randName.".".$pasvand))
              $checkName=0;
            else
              $checkName=1;
          }
          if ($checkName==1) {
            move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$randName.".".$pasvand);
            
            $check_result = array($pasvand,$randName.".".$pasvand);
          }else
            $check_result = array();
                    
        }else{
          move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$uploadFile["name"]);
          
          $check_result =array($pasvand,$uploadFile["name"]);       
        }
      }
      return $check_result;
    } 

    public function uploadFiles($uploadFile,$anArrayOfTypeFile=array('pdf','PDF','jpg','gif','JPG','png','PNG','mp4','MP4'),$minSize=10,$maxSize=10000000,$addressFileUpload=ROOT.DS.'includes'.DS.'uploads'.DS){

      $addressFileUpload2='http://'.$_SERVER["SERVER_NAME"]."/includes/uploads"."/";
      $check_result=0;

      $pasvand=strtolower(end(explode('.',$uploadFile['name'])));

      $checkType=1;
      $checkType=0;
      foreach ($anArrayOfTypeFile as $type) {
        if ($type!=''||isset($type)) {
          if ($pasvand==$type) {
            $checkType=1;
          }
        }
      }
      if ($checkType==1&&$uploadFile["size"]>=$minSize&&$uploadFile["size"]<=$maxSize&&$uploadFile["error"]==0) {
        if (file_exists($addressFileUpload . $uploadFile["name"])){
          $checkName=0;
          while ($checkName==0) {
            $randName = time().rand(1,1000);
            if (file_exists($addressFileUpload.$randName.".".$pasvand))
              $checkName=0;
            else
              $checkName=1;
          }
          if ($checkName==1) {
            move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$randName.".".$pasvand);
            
            $check_result = $randName.".".$pasvand;
          }else
            $check_result = '';
                    
        }else{
          move_uploaded_file($uploadFile["tmp_name"],$addressFileUpload.$uploadFile["name"]);
          
          $check_result =$uploadFile["name"];       
        }
      }
      return $check_result;
    }    
    
    public function uploadMultiFile($uploadFile,$anArrayOfTypeFile=array('pdf','PDF','jpg','JPG','png','PNG','mp4','MP4'),$minSize=0,$maxSize=10000000,$addressFileUpload=ROOT.DS.'includes'.DS.'uploads'.DS){

      
      $addressFileUpload2='http://'.$_SERVER["SERVER_NAME"]."/includes/uploads"."/";
      $result=array();
      for($i=0;$i<count($uploadFile['name']);$i++){

          $pasvand=end(explode('.',$uploadFile['name'][$i]));

          $checkType=1;
//          foreach ($anArrayOfTypeFile as $type) {
//            if ($type!=''||isset($type)) {
//              if ($pasvand==$type) {
//                $checkType=1;
//              }
//            }
//          }

          if ($checkType==1&&$uploadFile["size"][$i]>=$minSize&&$uploadFile["size"][$i]<=$maxSize&&$uploadFile["error"][$i]==0) {
            if (file_exists($addressFileUpload . $uploadFile["name"][$i])){
              $checkName=0;
              while ($checkName==0) {
                $randName = rand(1,1000000000);
                if (file_exists($addressFileUpload.$randName.".".$pasvand))
                  $checkName=0;
                else
                  $checkName=1;
              }
              if ($checkName==1) {
                move_uploaded_file($uploadFile["tmp_name"][$i],$addressFileUpload.$randName.".".$pasvand);
                
                $check_result = $randName.".".$pasvand;   

              }else
                $check_result = '';
                        
            }else{
              move_uploaded_file($uploadFile["tmp_name"][$i],$addressFileUpload.$uploadFile["name"][$i]);
              
              $check_result = $uploadFile["name"][$i];
            }
          }
            array_push($result, $check_result);
          }
        return $result;
      }
}
?>