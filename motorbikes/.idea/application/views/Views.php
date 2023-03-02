<?php
error_reporting(0);
class Views extends Models{
	public function baseHtml($titleWeb=' ',$rss='',$anArrayOfStylesAndScripts=array("style"=>array(),"script"=>array(''))){
		echo '<title>'.$titleWeb.'</title>';
		if(isset($rss)&&$rss!='')
			echo '<link rel="alternate" type="application/rss+xml" title="'.$titleWeb.'" href="'.$rss.'">';
		echo '<script type="text/javascript" src="'.ROOT.DS.'public'.DS.'scripts'.DS.'jquery-1.10.2.js"></script>';
		echo '<script type="text/javascript" src="'.ROOT.DS.'public'.DS.'scripts'.DS.'jquery-1.10.2.min.js"></script>';
		echo '<script type="text/javascript" src="'.ROOT.DS.'public'.DS.'scripts'.DS.'javaScript.js"></script>';
		echo '<link rel="stylesheet" type="text/css" href="'.ROOT.DS.'public'.DS.'themes'.DS.'styleSheet.css">';
		foreach ($anArrayOfStylesAndScripts as $key => $value) {
			if(isset($value)&&$value!=''){
				if($key=='style'){
					$i=0;
					while (isset($value[$i])&&$value[$i]!='') {
						$ok=file_exists(ROOT.DS.'public'.DS.'themes'.DS.$value[$i].'.css');
						if($ok){
							echo '<link rel="stylesheet" type="text/css" href="'.ROOT.DS.'public'.DS.'themes'.DS.$value[$i].'.css">';
						}
						$i++;
					}
				}
				else if($key=='script'){
					$i=0;
					while (isset($value[$i])&&$value[$i]!='') {
						$ok=file_exists(ROOT.DS.'public'.DS.'scripts'.DS.$value[$i].'.js');
						if($ok){
							echo '<link rel="stylesheet" type="text/css" href="'.ROOT.DS.'public'.DS.'scripts'.DS.$value[$i].'.js"></script>';
						}
						$i++;
					}
				}
			}
		}
	} 

	public function times($format="H:i:s",$time_zone=12600){
		$time=date($format,time()+$time_zone);
		return $time;
	}

	public function persianTime($format="H:i:s",$timezone=0){
	    $now = date("Y-m-d", time()+$timezone);
	    $time = date("H:i:s", time()+$timezone);
	    list($year, $month, $day) = explode('-', $now);
	    list($hour, $minute, $second) = explode(':', $time);
	    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	    $timestamp = mktime($month, $day, $year);
	    require_once ('jdf.php');
	    $Date = jdate($format,$timestamp);
	    return $Date;
	}

	public function timeToStr($timestamp,$format="Y/m/d H:i:s"){

	    require_once ('jdf.php');
	    $Date = jdate($format,$timestamp);
	    return $Date;
	}
	

	public function strToTime($time){

	    require_once ('jdf.php');
	    $date=explode(' ', $time);
	    if (strpos($time,'-')==null) {
	    	$time=explode('/', $date[0]);
	    }else{
	    	$time=explode('-', $date[0]);
	    }
	    // echo var_dump($time);
	    // echo strtotime('2019/03/30 00:00:00');

	    $time=jalali_to_gregorian($time[0] , $time[1] ,$time[2] ,'/').' '.$date[1];
	    $time=strtotime($time.' '.'Asia/Tehran');

	    // echo time().' '.$time;
	    // $time=date("Y-m-d", $time);
	    // $saat=explode(':', $date[1]);
	    // if ($saat[0]>2) {
	    // 	$saat[0]=$saat[0]-3;
	    // }else{
	    // 	$saat[0]=23-2+$saat[0];
	    // }

	    // if ($saat[1]>30) {
	    // 	$saat[1]=$saat[1]-30;
	    // 	$saat[0]++;
	    // }else{
	    // 	$saat[1]=60-30+$saat[1];
	    // }
	    // if ($saat[0]>23) {
	    // 	$saat[0]=1;
	    // }
	    // $date[1]=$saat[0].':'.$saat[1].':'.$saat[2];
	    // $time=$time.' '.$date[1];
// echo var_dump($time);

	    // $time=strtotime($time);
	    // $time=$time-(3600*8.5);
	    return $time;
	}

	public function ip(){
		return $_SERVER['REMOTE_ADDR'];
	}

	public function agentBrowser(){
			if(isset($_SERVER['HTTP_USER_AGENT']))
				return $_SERVER['HTTP_USER_AGENT'];
			else
				return "UNKNOWN";
	}
	public function showData($array/*$tbl=array(array('','')),$anArrayOfNameCol=array(0=>array(array('*',''))),$anArrayOfDESCorASCAndNameCol=array(array('DESC','ID')),$numberShowData='',$anArrayOfNameColAndFirstValueAndLastValue='',$anArrayIFOfNameColAndOrderAndValue='',$anArrayOfJoin=array(""=>array("",'','','')),$anArrayOfGroup=array(''),$anArrayOfHaving=array(array("",'',''))*/){
		if (!isset($array['tbl'])) {
			$array['tbl']=array(array('',''));
		}
		if (!isset($array['cols'])) {
			$array['cols']=array(0=>array(array('*','')));
		}
		if (!isset($array['sort'])) {
			$array['sort']=array(array('DESC','ID'));
		}
		if (!isset($array['numberShow'])) {
			$array['numberShow']='';
		}
		if (!isset($array['between'])) {
			$array['between']='';
		}
		if (!isset($array['ifs'])) {
			$array['ifs']='';
		}
		if (!isset($array['join'])) {
			$array['join']=array(""=>array("",'','',''));
		}
		if (!isset($array['group'])) {
			$array['group']=array('');
		}
		if (!isset($array['having'])) {
			$array['having']=array(array("",'',''));
		}
		if ($array['cols']=='') {
			$array['cols']=array(0=>array(array('*','')));
		}
		$tableName='';

		foreach ($array['tbl'] as $key => $value) {
			if ($value[0]!='') {
				if ($key==0) {
					if ($value[1]!=''&&$value[1]!=null) {
						$tableName=$tableName."".$value[0]." AS ".$value[1]."";
					}else{
						$tableName=$tableName."".$value[0]."";
					}
				}else{
					if ($value[1]!=''&&$value[1]!=null) {
						$tableName=$tableName.",".$value[0]." AS ".$value[1]."";
					}else{
						$tableName=$tableName.",".$value[0]."";
					}
				}
			}else{
				$tableName=self::$DBTABLENAME;
			}
		}
		$col='';
		$CheckCol=0;
		foreach ($array['cols'] as $key => $value) {
		
			// echo var_dump($key);
			if ($key=='0'||$key=='') {
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.''.$val[0].' AS '.$val[1];
						}else{
							$col=$col.''.$val[0].'';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.','.$val[0].' AS '.$val[1];
						}else{
							$col=$col.','.$val[0].'';
						}
					}
				}
			}elseif($key==1){
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.' Count('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.' Count('.$val[0].')';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.', Count('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.', Count('.$val[0].')';
						}
					}
				}
			}else{
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.' '.$key.'('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.' '.$key.'('.$val[0].')';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.', '.$key.'('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.', '.$key.'('.$val[0].')';
						}
					}
				}
			}
		}
		
		
		$if='';
		$checkIf=0;

		if(is_array($array['between'])){
		
			foreach ($array['between'] as $key => $anArrayOfNameColAndFirstValueAndLastValue2) {

				if ($anArrayOfNameColAndFirstValueAndLastValue2[1]!=''&&$anArrayOfNameColAndFirstValueAndLastValue2[2]!='') {
					
					if ($checkIf==0) {
						$if=$if.' WHERE '.$anArrayOfNameColAndFirstValueAndLastValue2[0].' between "'.$anArrayOfNameColAndFirstValueAndLastValue2[1].'" and "'.$anArrayOfNameColAndFirstValueAndLastValue2[2].'" ';
							$checkIf=1;
					}else{
						$if=$if.' AND '.$anArrayOfNameColAndFirstValueAndLastValue2[0].' between "'.$anArrayOfNameColAndFirstValueAndLastValue2[1].'" and "'.$anArrayOfNameColAndFirstValueAndLastValue2[2].'" ';
					}
				}
				
			}
			
		}

		
		foreach ($array['ifs'] as $number => $value) {
			if($value!==''&&$checkIf==1){

				if ((!is_array($value[2])&&$value[2]!==''&&$value[2]!==null)||(is_array($value[2])&&$value[2][1]!='')) {

					if(is_array($value[2])&&$value[2][1]!=''){
						$value[2]=$value[2][0];
					}
					if ($value[1]=='IN'||$value[1]=='in') {
						if($value[4]==''){
							$value[4]=4;
						}
					}
					if ($value[1]=='REGEXP'||$value[1]=='regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}

					if ($value[1]=='NOT REGEXP'||$value[1]=='not regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}
					if($value[4]==''){
						$value[4]=2;
					}
					if($value[1]=='LIKE'||$value[1]=='like'){
						if($value[3]==''){
							$value[3]=2;
						}
						if($value[4]==''){
							$value[4]=2;
						}
						switch ($value[3]) {
							case '0':
								$value[2]='%'.$value[2];
								break;
							case '1':
								$value[2]=$value[2].'%';
								break;
							case '2':
								$value[2]='%'.$value[2].'%';
								break;
							
							default:
								$value[2]='%'.$value[2].'%';
								break;
						}
					}

					if ($value[4]==1) {
						$if=$if.' OR '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}elseif($value[4]==6){
						$if=$if.' OR '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==7){
						$if=$if.' AND '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==4){
						$if=$if.' AND '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}elseif($value[4]==5){
						$if=$if.' OR '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}else{
						$if=$if.' AND '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}
					
				}
			}
			elseif($value!==''){

				if (($value[2]!==''&&$value[2]!==null&&!is_array($value[2]))||(is_array($value[2])&&$value[2][1]!='')) {

					if(is_array($value[2])&&$value[2][1]!=''){
						$value[2]=$value[2][0];
					}

					if ($value[1]=='IN'||$value[1]=='in') {
						if($value[4]==''){
							$value[4]=4;
						}
					}

					if ($value[1]=='REGEXP'||$value[1]=='regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}

					if ($value[1]=='NOT REGEXP'||$value[1]=='not regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}
					if($value[4]==''){
						$value[4]=2;
					}
					if($value[1]=='LIKE'||$value[1]=='like'){
						if($value[3]==''){
							$value[3]=2;
						}

						if($value[4]==''){
							$value[4]=2;
						}
						switch ($value[3]) {
							case '0':
								$value[2]='%'.$value[2];
								break;
							case '1':
								$value[2]=$value[2].'%';
								break;
							case '2':
								$value[2]='%'.$value[2].'%';
								break;
							
							default:
								$value[2]='%'.$value[2].'%';
								break;
						}
					}

					if ($value[4]==1) {
						$if=$if.' WHERE '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}elseif($value[4]==6||$value[4]==7){
						$if=$if.' WHERE '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==4){
						$if=$if.' WHERE '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}elseif($value[4]==5){
						$if=$if.' WHERE '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}else{
						$if=$if.' WHERE '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}
					$checkIf=1;
				}
			}
		
		}

		if (isset($array['appendifs'])&&$array['appendifs']!='') {
			if ($checkIf==1) {

				if ((strpos($array['appendifs'], 'AND')===false&&strpos($array['appendifs'], 'OR')===false&&strpos($array['appendifs'], 'and')===false&&strpos($array['appendifs'], 'or')===false)) {
					
					$array['appendifs']=' AND '.$array['appendifs'];
				}else{
					
				}

				$if=$if.' '.$array['appendifs'];
			}else{
				if (strpos(ltrim($array['appendifs'],' '), 'AND')===0||strpos(ltrim($array['appendifs'],' '), 'OR')===0||strpos(ltrim($array['appendifs'],' '), 'and')===0||strpos(ltrim($array['appendifs'],' '), 'or')===0) {
					$array['appendifs']=explode(' ', ltrim($array['appendifs'],' '));
					unset($array['appendifs'][0]);
					$array['appendifs']=implode(' ',$array['appendifs']);
				}
				

				$if=$if.' WHERE '.$array['appendifs'];
			}
		}

		if(is_array($array['addedquerywhere'])&&$array['addedquerywhere']['query']!=''&&$checkIf==0){
			$if.=' WHERE '.$array['addedquerywhere']['query'];
			$checkIf=1;
		}elseif (is_array($array['addedquerywhere'])&&$array['addedquerywhere']['query']!=''){
			$if.=' '.$array['addedquerywhere']['andor'].' '.$array['addedquerywhere']['query'];
		}

		$order='';
		foreach ($array['sort'] as $key => $value) {
			if ($key==0) {
				if ($value[1]!=''&&$value[1]!=null) {
					$order='ORDER by '.$value[1].' '.$value[0];
				}
			}else{
				if ($value[1]!=''&&$value[1]!=null) {
					$order=$order.', '.$value[1].' '.$value[0];
				}
			}
		}
		if (is_array($array['numberShow'])) {
			
			if ($array['numberShow'][0]==0&&($array['numberShow'][1]!==null&&$array['numberShow'][1]!=''))
				$order=$order.' LIMIT 0,'.$array['numberShow'][1];
			elseif($array['numberShow'][0]!==''&&($array['numberShow'][1]!==null&&$array['numberShow'][1]!=''))
				$order=$order.' LIMIT '.$array['numberShow'][0].','.$array['numberShow'][1];
		}
		

		$join='';
		$numberJoin=0;
		foreach ($array['join'] as $key => $value) {
			if ($key!='') {
				if ($value[0]!=''&&$value[0]!=null&&$numberJoin==0) {
					if ($value[1]!=''&&$value[1]!=null) {
						$join.=' '.$key.' JOIN '.$value[0].' ON '.$value[1].' '.$value[2].' '.$value[3].'';
						$numberJoin++;
					}else{
						$join.=' '.$key.' JOIN '.$value[0].'';
						$numberJoin++;
					}
				}elseif($value[0]!=''&&$value[0]!=null){
					if ($value[1]!=''&&$value[1]!=null) {
						$join.=', '.$key.' JOIN '.$value[0].' ON '.$value[1].' '.$value[2].' '.$value[3].'';
					}else{
						$join.=', '.$key.' JOIN '.$value[0].'';
					}
				}
			}
		}
		$group='';
		foreach ($array['group'] as $key => $value) {
			if ($key==0) {
				if ($value!=''&&$value!=null) {
					$group=$group." GROUP BY ".$value;
				}
			}else{
				if ($value!=''&&$value!=null) {
					$group=$group." , ".$value;
				}
			}
		}
		$having='';
		foreach ($array['having'] as $key => $value) {
			if ($key==0) {
				if ($value[0]!=''&&$value[0]!=null) {
					$having=$having."HAVING ".$value[0]." ".$value[1]." ".$value[2]."";
				}
			}else{
				if ($value[0]!=''&&$value[0]!=null) {
					$having=$having." AND ".$value[0]." ".$value[1]." ".$value[2]."";
				}
			}
		}
		
// echo "SELECT ".$col." FROM ".$tableName." ".$join." ".$if." ".$group." ".$having." ".$order."<br><br>";
		$dbResult=mysqli_query(self::$con,"SELECT ".$col." FROM ".$tableName." ".$join." ".$if." ".$group." ".$having." ".$order);
		return $dbResult;
	}

public function showDataFake($array/*$tbl=array(array('','')),$anArrayOfNameCol=array(0=>array(array('*',''))),$anArrayOfDESCorASCAndNameCol=array(array('DESC','ID')),$numberShowData='',$anArrayOfNameColAndFirstValueAndLastValue='',$anArrayIFOfNameColAndOrderAndValue='',$anArrayOfJoin=array(""=>array("",'','','')),$anArrayOfGroup=array(''),$anArrayOfHaving=array(array("",'',''))*/){
		if (!isset($array['tbl'])) {
			$array['tbl']=array(array('',''));
		}
		if (!isset($array['cols'])) {
			$array['cols']=array(0=>array(array('*','')));
		}
		if (!isset($array['sort'])) {
			$array['sort']=array(array('DESC','ID'));
		}
		if (!isset($array['numberShow'])) {
			$array['numberShow']='';
		}
		if (!isset($array['between'])) {
			$array['between']='';
		}
		if (!isset($array['ifs'])) {
			$array['ifs']='';
		}
		if (!isset($array['join'])) {
			$array['join']=array(""=>array("",'','',''));
		}
		if (!isset($array['group'])) {
			$array['group']=array('');
		}
		if (!isset($array['having'])) {
			$array['having']=array(array("",'',''));
		}
		if ($array['cols']=='') {
			$array['cols']=array(0=>array(array('*','')));
		}
		$tableName='';

		foreach ($array['tbl'] as $key => $value) {
			if ($value[0]!='') {
				if ($key==0) {
					if ($value[1]!=''&&$value[1]!=null) {
						$tableName=$tableName."".$value[0]." AS ".$value[1]."";
					}else{
						$tableName=$tableName."".$value[0]."";
					}
				}else{
					if ($value[1]!=''&&$value[1]!=null) {
						$tableName=$tableName.",".$value[0]." AS ".$value[1]."";
					}else{
						$tableName=$tableName.",".$value[0]."";
					}
				}
			}else{
				$tableName=self::$DBTABLENAME;
			}
		}
		$col='';
		$CheckCol=0;
		foreach ($array['cols'] as $key => $value) {
		
			// echo var_dump($key);
			if ($key=='0'||$key=='') {
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.''.$val[0].' AS '.$val[1];
						}else{
							$col=$col.''.$val[0].'';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.','.$val[0].' AS '.$val[1];
						}else{
							$col=$col.','.$val[0].'';
						}
					}
				}
			}elseif($key==1){
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.' Count('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.' Count('.$val[0].')';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.', Count('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.', Count('.$val[0].')';
						}
					}
				}
			}else{
				foreach ($value as $number => $val) {
					if ($number==0&&$CheckCol==0){
						$CheckCol=1;
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.' '.$key.'('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.' '.$key.'('.$val[0].')';
						}
					}
					else{
						if ($val[1]!=''&&$val[1]!=null) {
							$col=$col.', '.$key.'('.$val[0].') AS '.$val[1];
						}else{
							$col=$col.', '.$key.'('.$val[0].')';
						}
					}
				}
			}
		}
		
		
		$if='';
		$checkIf=0;

		if(is_array($array['between'])){
		
			foreach ($array['between'] as $key => $anArrayOfNameColAndFirstValueAndLastValue2) {

				if ($anArrayOfNameColAndFirstValueAndLastValue2[1]!=''&&$anArrayOfNameColAndFirstValueAndLastValue2[2]!='') {
					
					if ($checkIf==0) {
						$if=$if.' WHERE '.$anArrayOfNameColAndFirstValueAndLastValue2[0].' between "'.$anArrayOfNameColAndFirstValueAndLastValue2[1].'" and "'.$anArrayOfNameColAndFirstValueAndLastValue2[2].'" ';
							$checkIf=1;
					}else{
						$if=$if.' AND '.$anArrayOfNameColAndFirstValueAndLastValue2[0].' between "'.$anArrayOfNameColAndFirstValueAndLastValue2[1].'" and "'.$anArrayOfNameColAndFirstValueAndLastValue2[2].'" ';
					}
				}
				
			}
			
		}

		
		foreach ($array['ifs'] as $number => $value) {
			if($value!==''&&$checkIf==1){

				if ((!is_array($value[2])&&$value[2]!==''&&$value[2]!==null)||(is_array($value[2])&&$value[2][1]!='')) {

					if(is_array($value[2])&&$value[2][1]!=''){
						$value[2]=$value[2][0];
					}
					if ($value[1]=='IN'||$value[1]=='in') {
						if($value[4]==''){
							$value[4]=4;
						}
					}
					if ($value[1]=='REGEXP'||$value[1]=='regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}

					if ($value[1]=='NOT REGEXP'||$value[1]=='not regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}
					if($value[4]==''){
						$value[4]=2;
					}
					if($value[1]=='LIKE'||$value[1]=='like'){
						if($value[3]==''){
							$value[3]=2;
						}
						if($value[4]==''){
							$value[4]=2;
						}
						switch ($value[3]) {
							case '0':
								$value[2]='%'.$value[2];
								break;
							case '1':
								$value[2]=$value[2].'%';
								break;
							case '2':
								$value[2]='%'.$value[2].'%';
								break;
							
							default:
								$value[2]='%'.$value[2].'%';
								break;
						}
					}

					if ($value[4]==1) {
						$if=$if.' OR '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}elseif($value[4]==6){
						$if=$if.' OR '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==7){
						$if=$if.' AND '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==4){
						$if=$if.' AND '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}elseif($value[4]==5){
						$if=$if.' OR '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}else{
						$if=$if.' AND '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}
					
				}
			}
			elseif($value!==''){

				if (($value[2]!==''&&$value[2]!==null&&!is_array($value[2]))||(is_array($value[2])&&$value[2][1]!='')) {

					if(is_array($value[2])&&$value[2][1]!=''){
						$value[2]=$value[2][0];
					}

					if ($value[1]=='IN'||$value[1]=='in') {
						if($value[4]==''){
							$value[4]=4;
						}
					}

					if ($value[1]=='REGEXP'||$value[1]=='regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}

					if ($value[1]=='NOT REGEXP'||$value[1]=='not regexp') {
						if($value[4]==''){
							$value[4]=7;
						}
					}
					if($value[4]==''){
						$value[4]=2;
					}
					if($value[1]=='LIKE'||$value[1]=='like'){
						if($value[3]==''){
							$value[3]=2;
						}

						if($value[4]==''){
							$value[4]=2;
						}
						switch ($value[3]) {
							case '0':
								$value[2]='%'.$value[2];
								break;
							case '1':
								$value[2]=$value[2].'%';
								break;
							case '2':
								$value[2]='%'.$value[2].'%';
								break;
							
							default:
								$value[2]='%'.$value[2].'%';
								break;
						}
					}

					if ($value[4]==1) {
						$if=$if.' WHERE '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}elseif($value[4]==6||$value[4]==7){
						$if=$if.' WHERE '.$value[0].' '.$value[1]."'".$value[2]."'";
					}elseif($value[4]==4){
						$if=$if.' WHERE '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}elseif($value[4]==5){
						$if=$if.' WHERE '.$value[0].' '.$value[1].' ('.$value[2].') ';
					}else{
						$if=$if.' WHERE '.$value[0].' '.$value[1].' "'.$value[2].'" ';
					}
					$checkIf=1;
				}
			}
		
		}

		if (isset($array['appendifs'])&&$array['appendifs']!='') {
			if ($checkIf==1) {

				if ((strpos($array['appendifs'], 'AND')===false&&strpos($array['appendifs'], 'OR')===false&&strpos($array['appendifs'], 'and')===false&&strpos($array['appendifs'], 'or')===false)) {
					
					$array['appendifs']=' AND '.$array['appendifs'];
				}else{
					
				}

				$if=$if.' '.$array['appendifs'];
			}else{
				if (strpos(ltrim($array['appendifs'],' '), 'AND')===0||strpos(ltrim($array['appendifs'],' '), 'OR')===0||strpos(ltrim($array['appendifs'],' '), 'and')===0||strpos(ltrim($array['appendifs'],' '), 'or')===0) {
					$array['appendifs']=explode(' ', ltrim($array['appendifs'],' '));
					unset($array['appendifs'][0]);
					$array['appendifs']=implode(' ',$array['appendifs']);
				}
				

				$if=$if.' WHERE '.$array['appendifs'];
			}
		}

		if(is_array($array['addedquerywhere'])&&$array['addedquerywhere']['query']!=''&&$checkIf==0){
			$if.=' WHERE '.$array['addedquerywhere']['query'];
			$checkIf=1;
		}elseif (is_array($array['addedquerywhere'])&&$array['addedquerywhere']['query']!=''){
			$if.=' '.$array['addedquerywhere']['andor'].' '.$array['addedquerywhere']['query'];
		}

		$order='';
		foreach ($array['sort'] as $key => $value) {
			if ($key==0) {
				if ($value[1]!=''&&$value[1]!=null) {
					$order='ORDER by '.$value[1].' '.$value[0];
				}
			}else{
				if ($value[1]!=''&&$value[1]!=null) {
					$order=$order.', '.$value[1].' '.$value[0];
				}
			}
		}
		if (is_array($array['numberShow'])) {
			
			if ($array['numberShow'][0]==0&&($array['numberShow'][1]!==null&&$array['numberShow'][1]!=''))
				$order=$order.' LIMIT 0,'.$array['numberShow'][1];
			elseif($array['numberShow'][0]!==''&&($array['numberShow'][1]!==null&&$array['numberShow'][1]!=''))
				$order=$order.' LIMIT '.$array['numberShow'][0].','.$array['numberShow'][1];
		}
		

		$join='';
		$numberJoin=0;
		foreach ($array['join'] as $key => $value) {
			if ($key!='') {
				if ($value[0]!=''&&$value[0]!=null&&$numberJoin==0) {
					if ($value[1]!=''&&$value[1]!=null) {
						$join.=' '.$key.' JOIN '.$value[0].' ON '.$value[1].' '.$value[2].' '.$value[3].'';
						$numberJoin++;
					}else{
						$join.=' '.$key.' JOIN '.$value[0].'';
						$numberJoin++;
					}
				}elseif($value[0]!=''&&$value[0]!=null){
					if ($value[1]!=''&&$value[1]!=null) {
						$join.=', '.$key.' JOIN '.$value[0].' ON '.$value[1].' '.$value[2].' '.$value[3].'';
					}else{
						$join.=', '.$key.' JOIN '.$value[0].'';
					}
				}
			}
		}
		$group='';
		foreach ($array['group'] as $key => $value) {
			if ($key==0) {
				if ($value!=''&&$value!=null) {
					$group=$group." GROUP BY ".$value;
				}
			}else{
				if ($value!=''&&$value!=null) {
					$group=$group." , ".$value;
				}
			}
		}
		$having='';
		foreach ($array['having'] as $key => $value) {
			if ($key==0) {
				if ($value[0]!=''&&$value[0]!=null) {
					$having=$having."HAVING ".$value[0]." ".$value[1]." ".$value[2]."";
				}
			}else{
				if ($value[0]!=''&&$value[0]!=null) {
					$having=$having." AND ".$value[0]." ".$value[1]." ".$value[2]."";
				}
			}
		}
		
echo "SELECT ".$col." FROM ".$tableName." ".$join." ".$if." ".$group." ".$having." ".$order."<br><br>";
		// $dbResult=mysqli_query(self::$con,"SELECT ".$col." FROM ".$tableName." ".$join." ".$if." ".$group." ".$having." ".$order);
		// return $dbResult;
	}

	public function cutText($text,$numberOfFirst='',$numberOfLast='',$anArrayOfFirstNumberAndLastNumber='')
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

	public function findWordInText($text,$Word)
	{
		return strpos($text,$Word);
	}
	
	public function jsonFormater($jsonResponse){
		
		//header('Content-Type: application/json;charset=utf8');

        
		return json_encode($jsonResponse,JSON_UNESCAPED_UNICODE);
	}

	public function jsonEncode($jsonResponse){
		
		//header('Content-Type: application/json;charset=utf8');

        
		return json_encode($jsonResponse,JSON_UNESCAPED_UNICODE);
		// return json_encode($jsonResponse, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_TAG);
	}

	public function jsonEncodeApi($jsonResponse){
		
		header('Content-Type: application/json;charset=utf8');

        
		return json_encode($jsonResponse,JSON_UNESCAPED_UNICODE);
	}

	public function jwtPassCode($jwt='',$pass='',$passRight='iRBsZumo37QldxkMIjqADAttA6Q=',$col='Jwt',$colCheckExpiryTime='DateAndTime',$tableName='tbl_jwt',$jwtPass='JKbE&*&*REFEH&*VHSUIH(*FIO#@%'){
		if (isset($jwt)&&$jwt!='') {
		    
			$dbResult=self::showData(array(array($tableName,'')));
			$checkJwt=0;
			while($record=mysqli_fetch_assoc($dbResult)){
				if (isset($record[$col])&&$record[$col]!='') {
					if ($jwt==$record[$col]) {
						
						$timeNow=self::persianTime('Y-m-d').' '.self::times('H:i:s',0);

						if($timeNow<=$record[$colCheckExpiryTime]){
							return jwt::decode($record[$col]);
						}else{
							//return 'Error has occurred is wrong JWT';
							return 'false';
						}
					}else{
						//return 'Error has occurred is wrong JWT';
						return 'false';
					}
					$checkJwt=1;
				}
			}
			if ($checkJwt==0) {
				//return 'Error has occurred is wrong JWT';
				return 'false';
			}
		}elseif (isset($pass)&&$pass!='') {
			if ($pass==$passRight) {

				$dbResult=self::showData(array(array($tableName,'')));
				$checkJwt=0;
				while($record=mysqli_fetch_assoc($dbResult)){
					if (isset($record[$col])&&$record[$col]!='') {
						$timeNow=self::persianTime('Y-m-d').' '.self::times('H:i:s',0);
						
						if($timeNow<=$record[$colCheckExpiryTime]){
							return $record[$col];
						}else{
							$codeTrans=rand(10000,9999999).'SearchJob'.rand(10000,9999999);
							$newJwtCode=jwt::encode($codeTrans,$jwtPass);
							if (Views::times('H:i:s',14400)>='00:00:00'&&Views::times('H:i:s',14400)<='04:00:00') {
								$da=Views::persianTime('Y');
								$da1=Views::persianTime('m');
								$da2=Views::persianTime('d');
								if ($da2>=29) {
									$da2=1;
									$da1++;
								}else{
									$da2++;
								}	
								$expiryTime=$da."-".$da1."-".$da2." ".Views::times('H:i:s',14400);
							}else{
								$da=Views::persianTime('Y');
								$da1=Views::persianTime('m');
								$da2=Views::persianTime('d');
								if ($da2>29) {
									$da2=1;
									$da1++;
								}
								$expiryTime=$da.'-'.$da1.'-'.$da2.' '.Views::times('H:i:s',14400);						
							}
							Models::changeData(array($col=>array($newJwtCode),$colCheckExpiryTime=>array($expiryTime)),array("ID"=>array($record['ID'])),$tableName);
							return $newJwtCode;
						}
						$checkJwt=1;
					}
				}
				if ($checkJwt==0) {
					$codeTrans=rand(10000,9999999).'SearchJob'.rand(10000,9999999);
					$newJwtCode=jwt::encode($codeTrans,$jwtPass);
					if (Views::times('H:i:s',14400)>='00:00:00'&&Views::times('H:i:s',14400)<='04:00:00') {
						$da=Views::persianTime('Y');
						$da1=Views::persianTime('m');
						$da2=Views::persianTime('d');
						if ($da2>=29) {
							$da2=1;
							$da1++;
						}else{
							$da2++;
						}	
						$expiryTime=$da."-".$da1."-".$da2." ".Views::times('H:i:s',14400);
					}else{
						$da=Views::persianTime('Y');
						$da1=Views::persianTime('m');
						$da2=Views::persianTime('d');
						if ($da2>29) {
							$da2=1;
							$da1++;
						}
						$expiryTime=$da.'-'.$da1.'-'.$da2.' '.Views::times('H:i:s',14400);						
					}
					Models::insertData(array($col=>$newJwtCode,$colCheckExpiryTime=>$expiryTime),$tableName);
					return $newJwtCode;
				}
			}else{
				//return 'Error has occurred is wrong password';
				return 'false';
			}
		}
		
	}

	public function checkJwtPassCode($quantitySent,$col='Jwt',$tableName='tbl_jwt'){
		$dbResult=self::showData(array(array($tableName,'')));
		$checkJwt=0;
		while($record=mysqli_fetch_assoc($dbResult)){
			if (isset($record[$col])&&$record[$col]!='') {
				if ($quantitySent==jwt::decode($record[$col])) {
					return 'ok';
				}else{
					return $quantitySent;
				}
			}
		}
	}
		
}
?>
