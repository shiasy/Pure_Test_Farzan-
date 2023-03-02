<?php

if (strpos($_POST[file], 'includes/uploads')) {
	unlink(Config::$defaultaddress.$_POST[file]);
}else{
	unlink(ROOTFILE.DS.Config::$defaultaddresslink.'includes/uploads/'.$_POST[file]);
}
