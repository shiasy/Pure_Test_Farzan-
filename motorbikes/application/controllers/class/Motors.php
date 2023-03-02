<?php
class Motors extends Controller{
	public function add($array=array()){
		Models::connectDB();
		
		// $check=self::get(array("ID"=>$array["IDssssssssss"]));

		// if (sizeof($check)==0) {
			
			$dbResult=Models::insertData( array(
			"tableName"=>"msh_motors"
			,"values"=>array("id"=>$array["id"],"user_id"=>$array["user_id"],"company"=>$array["company"],"kind"=>$array["kind"],"color"=>$array["color"],"weight"=>$array["weight"],"price"=>$array["price"],"image"=>$array["image"],"created_at"=>$array["created_at"],"updated_at"=>$array["updated_at"])
			));
			
			
			return array(
				"status"=>0
				,"result"=>array("message"=>"درخواست با موفقیت ثبت گردید.")
			);

		// }else{
		// 	return array(
		// 		"status"=>1
		// 		,"result"=>array("message"=>"مشکل در ثبت درخواست وجود دارد.")
		// 	);
		// }
		


		Models::disConnectDB();
		return $result;
	}public function edit($array=array()){

		Models::connectDB();


		Models::changeData(array("forChange"=>array("id"=>array($array["id"]),"user_id"=>array($array["user_id"]),"company"=>array($array["company"]),"kind"=>array($array["kind"]),"color"=>array($array["color"]),"weight"=>array($array["weight"]),"price"=>array($array["price"]),"image"=>array($array["image"]),"created_at"=>array($array["created_at"]),"updated_at"=>array($array["updated_at"])),"fixed"=>array("id"=>array($array["fixid"]),"user_id"=>array($array["fixuser_id"]),"company"=>array($array["fixcompany"]),"kind"=>array($array["fixkind"]),"color"=>array($array["fixcolor"]),"weight"=>array($array["fixweight"]),"price"=>array($array["fixprice"]),"image"=>array($array["fiximage"]),"created_at"=>array($array["fixcreated_at"]),"updated_at"=>array($array["fixupdated_at"])),"tableName"=>"msh_motors"));
		

		return array(
				"status"=>0
				,"result"=>array("message"=>"درخواست مورد نظر ویرایش گردید.")
			);
	
		Models::disConnectDB();
	}public function delete($array=array()){
		Models::connectDB();

		Models::deleteData(array("values"=>array("id"=>$array["id"],"user_id"=>$array["user_id"],"company"=>$array["company"],"kind"=>$array["kind"],"color"=>$array["color"],"weight"=>$array["weight"],"price"=>$array["price"],"image"=>$array["image"],"created_at"=>$array["created_at"],"updated_at"=>$array["updated_at"]),"tableName"=>"msh_motors"));

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

		$ifs=array(array("id","=",$array["id"]),array("user_id","=",$array["user_id"]),array("company","=",$array["company"]),array("kind","=",$array["kind"]),array("color","=",$array["color"]),array("weight","=",$array["weight"]),array("price","=",$array["price"]),array("image","=",$array["image"]),array("created_at","=",$array["created_at"]),array("updated_at","=",$array["updated_at"]),array("id","IN",$array["INid"]),array("user_id","IN",$array["INuser_id"]),array("company","IN",$array["INcompany"]),array("kind","IN",$array["INkind"]),array("color","IN",$array["INcolor"]),array("weight","IN",$array["INweight"]),array("price","IN",$array["INprice"]),array("image","IN",$array["INimage"]),array("created_at","IN",$array["INcreated_at"]),array("updated_at","IN",$array["INupdated_at"]),array("id","!=",$array["notid"]),array("user_id","!=",$array["notuser_id"]),array("company","!=",$array["notcompany"]),array("kind","!=",$array["notkind"]),array("color","!=",$array["notcolor"]),array("weight","!=",$array["notweight"]),array("price","!=",$array["notprice"]),array("image","!=",$array["notimage"]),array("created_at","!=",$array["notcreated_at"]),array("updated_at","!=",$array["notupdated_at"]),array("id",">=",$array["bigid"]),array("user_id",">=",$array["biguser_id"]),array("company",">=",$array["bigcompany"]),array("kind",">=",$array["bigkind"]),array("color",">=",$array["bigcolor"]),array("weight",">=",$array["bigweight"]),array("price",">=",$array["bigprice"]),array("image",">=",$array["bigimage"]),array("created_at",">=",$array["bigcreated_at"]),array("updated_at",">=",$array["bigupdated_at"]),array("id","<=",$array["smallid"]),array("user_id","<=",$array["smalluser_id"]),array("company","<=",$array["smallcompany"]),array("kind","<=",$array["smallkind"]),array("color","<=",$array["smallcolor"]),array("weight","<=",$array["smallweight"]),array("price","<=",$array["smallprice"]),array("image","<=",$array["smallimage"]),array("created_at","<=",$array["smallcreated_at"]),array("updated_at","<=",$array["smallupdated_at"]),array("id","REGEXP",$array["REGEXPid"]),array("user_id","REGEXP",$array["REGEXPuser_id"]),array("company","REGEXP",$array["REGEXPcompany"]),array("kind","REGEXP",$array["REGEXPkind"]),array("color","REGEXP",$array["REGEXPcolor"]),array("weight","REGEXP",$array["REGEXPweight"]),array("price","REGEXP",$array["REGEXPprice"]),array("image","REGEXP",$array["REGEXPimage"]),array("created_at","REGEXP",$array["REGEXPcreated_at"]),array("updated_at","REGEXP",$array["REGEXPupdated_at"]),array("id","NOT REGEXP",$array["NOTREGEXPid"]),array("user_id","NOT REGEXP",$array["NOTREGEXPuser_id"]),array("company","NOT REGEXP",$array["NOTREGEXPcompany"]),array("kind","NOT REGEXP",$array["NOTREGEXPkind"]),array("color","NOT REGEXP",$array["NOTREGEXPcolor"]),array("weight","NOT REGEXP",$array["NOTREGEXPweight"]),array("price","NOT REGEXP",$array["NOTREGEXPprice"]),array("image","NOT REGEXP",$array["NOTREGEXPimage"]),array("created_at","NOT REGEXP",$array["NOTREGEXPcreated_at"]),array("updated_at","NOT REGEXP",$array["NOTREGEXPupdated_at"]),array("id","LIKE",$array["likeid"]),array("id","LIKE",$array["like"],"",1),array("user_id","LIKE",$array["likeuser_id"]),array("user_id","LIKE",$array["like"],"",1),array("company","LIKE",$array["likecompany"]),array("company","LIKE",$array["like"],"",1),array("kind","LIKE",$array["likekind"]),array("kind","LIKE",$array["like"],"",1),array("color","LIKE",$array["likecolor"]),array("color","LIKE",$array["like"],"",1),array("weight","LIKE",$array["likeweight"]),array("weight","LIKE",$array["like"],"",1),array("price","LIKE",$array["likeprice"]),array("price","LIKE",$array["like"],"",1),array("image","LIKE",$array["likeimage"]),array("image","LIKE",$array["like"],"",1),array("created_at","LIKE",$array["likecreated_at"]),array("created_at","LIKE",$array["like"],"",1),array("updated_at","LIKE",$array["likeupdated_at"]),array("updated_at","LIKE",$array["like"],"",1));

		$between=array(array("id",$array["betid1"],$array["betid2"]),array("user_id",$array["betuser_id1"],$array["betuser_id2"]),array("company",$array["betcompany1"],$array["betcompany2"]),array("kind",$array["betkind1"],$array["betkind2"]),array("color",$array["betcolor1"],$array["betcolor2"]),array("weight",$array["betweight1"],$array["betweight2"]),array("price",$array["betprice1"],$array["betprice2"]),array("image",$array["betimage1"],$array["betimage2"]),array("created_at",$array["betcreated_at1"],$array["betcreated_at2"]),array("updated_at",$array["betupdated_at1"],$array["betupdated_at2"]));
		
		switch ($array["sort"]) {case "descid":
				$sort=array(array("DESC","id"));
				break;
				case "ascid":
				$sort=array(array("ASC","id"));
				break;
				case "descuser_id":
				$sort=array(array("DESC","user_id"));
				break;
				case "ascuser_id":
				$sort=array(array("ASC","user_id"));
				break;
				case "desccompany":
				$sort=array(array("DESC","company"));
				break;
				case "asccompany":
				$sort=array(array("ASC","company"));
				break;
				case "desckind":
				$sort=array(array("DESC","kind"));
				break;
				case "asckind":
				$sort=array(array("ASC","kind"));
				break;
				case "desccolor":
				$sort=array(array("DESC","color"));
				break;
				case "asccolor":
				$sort=array(array("ASC","color"));
				break;
				case "descweight":
				$sort=array(array("DESC","weight"));
				break;
				case "ascweight":
				$sort=array(array("ASC","weight"));
				break;
				case "descprice":
				$sort=array(array("DESC","price"));
				break;
				case "ascprice":
				$sort=array(array("ASC","price"));
				break;
				case "descimage":
				$sort=array(array("DESC","image"));
				break;
				case "ascimage":
				$sort=array(array("ASC","image"));
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
			"tbl"=>array(array("msh_motors","")) 
			, "sort"=>$sort
			,"cols"=>array(1=>array(array("id","id")))
			,"numberShow"=>array($firstLim,$array["limit"])
			,"between"=>$between
			,"group"=>array($array["group"])
			, "ifs"=>$ifs
			));
		}else{

			$dbResult=Views::showData( array(
			"tbl"=>array(array("msh_motors","")) 
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

	