<?php
class Config{

     protected static $DBNAME="motorpure";
     protected static $DBHOSTNAME="localhost";
     public static $DBUSERNAME='root';
     public static $DBPASSWORD='';
     protected static $DBTABLENAME="zm_admin";
     

     
     
     public static $BASENAME='پروژه تست'; 
	public static $BASEURL=''; 
	public static $Domains=array(''); 
	public static $defaultdomain='';


	public static $defaultaddress='';
	public static $defaultaddresslink='';
	public static $defaulturllink='';

	public static $setting=array(
		'body'=>array(
			'background'=>'',
			'tags'=>array(
				'twitter'=>'',
				'description'=>'',
				'keywords'=>'',
			),
			'logo'=>'includes/images/logo.png',
			'onedes'=>'',
		),
		'more'=>array(
			'login'=>array(
				'contactus'=>'',
				'yadanaklink'=>'',
			),
		),
		'title'=>'پروژه تست',
		'copyrighttitle'=>'',

	);

	public function changeData($user,$pass)
	{
		self::$DBUSERNAME=$user;
		self::$DBPASSWORD=$pass;
	}
}

?>