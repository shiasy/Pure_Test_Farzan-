<?php
class Users extends Controller{
	public function add($array=array()){
		Models::connectDB();
		
		$check=self::get(array("email"=>$array["email"]));

		if (sizeof($check)==0) {
			
			$dbResult=Models::insertData( array(
			"tableName"=>"msh_users"
			,"values"=>array("id"=>$array["id"],"name"=>$array["name"],"email"=>$array["email"],"password"=>$array["password"],"created_at"=>$array["created_at"],"updated_at"=>$array["updated_at"])
			));
			
			
			return array(
				"status"=>0
				,"result"=>array("message"=>"این ایمیل از قبل موجود است.")
			);

		}else{
			return array(
				"status"=>1
				,"result"=>array("message"=>"مشکل در ثبت درخواست وجود دارد.")
			);
		}
		


		Models::disConnectDB();
		return $result;
	}public function edit($array=array()){

		Models::connectDB();


		Models::changeData(array("forChange"=>array("id"=>array($array["id"]),"name"=>array($array["name"]),"email"=>array($array["email"]),"password"=>array($array["password"]),"created_at"=>array($array["created_at"]),"updated_at"=>array($array["updated_at"])),"fixed"=>array("id"=>array($array["fixid"]),"name"=>array($array["fixname"]),"email"=>array($array["fixemail"]),"password"=>array($array["fixpassword"]),"created_at"=>array($array["fixcreated_at"]),"updated_at"=>array($array["fixupdated_at"])),"tableName"=>"msh_users"));
		

		return array(
				"status"=>0
				,"result"=>array("message"=>"درخواست مورد نظر ویرایش گردید.")
			);
	
		Models::disConnectDB();
	}public function delete($array=array()){
		Models::connectDB();

		Models::deleteData(array("values"=>array("id"=>$array["id"],"name"=>$array["name"],"email"=>$array["email"],"password"=>$array["password"],"created_at"=>$array["created_at"],"updated_at"=>$array["updated_at"]),"tableName"=>"msh_users"));

		return array(
				"status"=>0
				,"result"=>array("message"=>"درخواست مورد نظر حذف گردید.")
			);
		Models::disConnectDB();
	}public function get($array=array()){
		Models::connectDB();


		if ($array["firstLimit"]==""||!isset($array["firstLimit"])) {
			$firstLim=0;
		}else{
			$firstLim=$array["firstLimit"];
		}

		$ifs=array(array("id","=",$array["id"]),array("name","=",$array["name"]),array("email","=",$array["email"]),array("password","=",$array["password"]),array("created_at","=",$array["created_at"]),array("updated_at","=",$array["updated_at"]),array("id","IN",$array["INid"]),array("name","IN",$array["INname"]),array("email","IN",$array["INemail"]),array("password","IN",$array["INpassword"]),array("created_at","IN",$array["INcreated_at"]),array("updated_at","IN",$array["INupdated_at"]),array("id","!=",$array["notid"]),array("name","!=",$array["notname"]),array("email","!=",$array["notemail"]),array("password","!=",$array["notpassword"]),array("created_at","!=",$array["notcreated_at"]),array("updated_at","!=",$array["notupdated_at"]),array("id",">=",$array["bigid"]),array("name",">=",$array["bigname"]),array("email",">=",$array["bigemail"]),array("password",">=",$array["bigpassword"]),array("created_at",">=",$array["bigcreated_at"]),array("updated_at",">=",$array["bigupdated_at"]),array("id","<=",$array["smallid"]),array("name","<=",$array["smallname"]),array("email","<=",$array["smallemail"]),array("password","<=",$array["smallpassword"]),array("created_at","<=",$array["smallcreated_at"]),array("updated_at","<=",$array["smallupdated_at"]),array("id","REGEXP",$array["REGEXPid"]),array("name","REGEXP",$array["REGEXPname"]),array("email","REGEXP",$array["REGEXPemail"]),array("password","REGEXP",$array["REGEXPpassword"]),array("created_at","REGEXP",$array["REGEXPcreated_at"]),array("updated_at","REGEXP",$array["REGEXPupdated_at"]),array("id","NOT REGEXP",$array["NOTREGEXPid"]),array("name","NOT REGEXP",$array["NOTREGEXPname"]),array("email","NOT REGEXP",$array["NOTREGEXPemail"]),array("password","NOT REGEXP",$array["NOTREGEXPpassword"]),array("created_at","NOT REGEXP",$array["NOTREGEXPcreated_at"]),array("updated_at","NOT REGEXP",$array["NOTREGEXPupdated_at"]),array("id","LIKE",$array["likeid"]),array("id","LIKE",$array["like"],"",1),array("name","LIKE",$array["likename"]),array("name","LIKE",$array["like"],"",1),array("email","LIKE",$array["likeemail"]),array("email","LIKE",$array["like"],"",1),array("password","LIKE",$array["likepassword"]),array("password","LIKE",$array["like"],"",1),array("created_at","LIKE",$array["likecreated_at"]),array("created_at","LIKE",$array["like"],"",1),array("updated_at","LIKE",$array["likeupdated_at"]),array("updated_at","LIKE",$array["like"],"",1));

		$between=array(array("id",$array["betid1"],$array["betid2"]),array("name",$array["betname1"],$array["betname2"]),array("email",$array["betemail1"],$array["betemail2"]),array("password",$array["betpassword1"],$array["betpassword2"]),array("created_at",$array["betcreated_at1"],$array["betcreated_at2"]),array("updated_at",$array["betupdated_at1"],$array["betupdated_at2"]));
		
		switch ($array["sort"]) {case "descid":
				$sort=array(array("DESC","id"));
				break;
				case "ascid":
				$sort=array(array("ASC","id"));
				break;
				case "descname":
				$sort=array(array("DESC","name"));
				break;
				case "ascname":
				$sort=array(array("ASC","name"));
				break;
				case "descemail":
				$sort=array(array("DESC","email"));
				break;
				case "ascemail":
				$sort=array(array("ASC","email"));
				break;
				case "descpassword":
				$sort=array(array("DESC","password"));
				break;
				case "ascpassword":
				$sort=array(array("ASC","password"));
				break;
				case "desccreated_at":
				$sort=array(array("DESC","created_at"));
				break;
				case "asccreated_at":
				$sort=array(array("ASC","created_at"));
				break;
				case "descupdated_at":
				$sort=array(array("DESC","updated_at"));
				break;
				case "ascupdated_at":
				$sort=array(array("ASC","updated_at"));
				break;
				
			default:
				$sort=array(array("DESC","id"));
				break;
		}

		if ($array["typeShow"]==1) {

			$dbResult=Views::showData( array(
			"tbl"=>array(array("msh_users","")) 
			, "sort"=>$sort
			,"cols"=>array(1=>array(array("id","id")))
			,"numberShow"=>array($firstLim,$array["limit"])
			,"between"=>$between
			,"group"=>array($array["group"])
			, "ifs"=>$ifs
			));
		}else{

			$dbResult=Views::showData( array(
			"tbl"=>array(array("msh_users","")) 
			, "sort"=>$sort
			,"numberShow"=>array($firstLim,$array["limit"])
			,"between"=>$between
			,"group"=>array($array["group"])
			, "ifs"=>$ifs
			));

		}
		
		$result=array();
		while($record=mysqli_fetch_assoc($dbResult)){
			if (isset($record["id"])&&$record["id"]!="") {
			
				$record["timestamp3"]=$record["timestamp2"];
				$record["timestamp2"]=$record["timestamp"];
				$time=Views::strToTime(Views::timeToStr(time(),"Y/m/d")." 00:00:00");
				if ($record["timestamp"]>=$time) {
					$record["timestamp"]=Views::timeToStr($record["timestamp"],"H:i:s");
				}elseif ($record["timestamp"]>=($time-(3600*24*7))) {
					$record["timestamp"]=Views::timeToStr($record["timestamp"],"l H:i:s");
				}else{
					$record["timestamp"]=Views::timeToStr($record["timestamp"],"H:i:s Y/m/d");
				}
				
				if($array["web"]==""||$array["web"]==0){

				}

				array_push($result,$record);

				
			}
		}
		return $result;		
		/*if (sizeof($result)>0) {
			return array(
				"status"=>0
				,"result"=>$result
			);
		}else{
			return array(
				"status"=>1
				,"result"=>array(array("message"=>"موردی یافت نشد"))
			);
		}*/
	}
}

	