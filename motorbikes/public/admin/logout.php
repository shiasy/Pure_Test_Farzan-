<?php

if ($_SESSION[user][id]!=''||$_COOKIE[userID]!=''){
    
    
    unset($_SESSION[user]);
    
    unset($_COOKIE[userID]); 

    setcookie('userID', null, -1, '/'); 

    $_SESSION[message]=array(array('status'=>'success','message'=>'از انتخاب شما متشکریم'));

    
}


SafeData::redirect('login');