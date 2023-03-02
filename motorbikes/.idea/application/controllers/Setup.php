<?php
class Setup extends Models{
	public function createTableDB($array/*$anArrayOfNameCOlAndTypeColAndValueCol=array(""=>array("","","","")),$tableName=null*/){
		if (!isset($array['cols'])) {
			$array['cols']=array(""=>array("","","",""));
		}
		if($array['tableName']==''||$array['tableName']==null||!isset($array['tableName']))
		{
			$array['tableName']=self::$DBTABLENAME;
		}
		$code='CREATE TABLE '.$array['tableName'].'(ID BIGINT(25) NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(ID)';
		foreach ($array['cols'] as $name => $array) {
			if ($array[0]!='') {
				if ($array[1]!='') {
					if ($array[2]!='') {
						$code=$code.','.$name.' '.$array[0]."(".$array[1].") CHARACTER SET ".$array[2]." COLLATE ".$array[3];
					}else{
						$code=$code.','.$name.' '.$array[0]."(".$array[1].")";
					}
					
				}else{
					if ($array[2]!='') {
						$code=$code.','.$name.' '.$array[0]." CHARACTER SET ".$array[2]." COLLATE ".$array[3];
					}else{
						$code=$code.','.$name.' '.$array[0];
					}
				}
			}
		}
		$code=$code.") ENGINE=MyISAM ";
		mysqli_query(self::$con,$code)or die(mysqli_error(self::$con));
		mysqli_query(self::$con,"ALTER TABLE $array['tableName']
		DEFAULT CHARACTER SET UTF8
		COLLATE utf8_persian_ci;");
	}

	public function fun($sql){
          $dbResult=mysqli_query($sql);
          return $dbResult;
    }
}
?>