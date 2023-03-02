<?php
    

    if ($_SESSION[user][id]!=''||$_COOKIE[userID]!=''){
        SafeData::redirect('index');
    }
    

    if($_POST[code]!=''&&$_POST[code]==$_SESSION[codelogin]&&$_POST[email]!=''&&$_POST[password]!=''){

        $user=Users::get(array('email'=>$_POST[email],'password'=>jwt::encode(strval($_POST[password]))))[0];

        if ($user[id]!=''){
            
            if ($_POST[cookie]=='on') {
                setcookie('userID', $user[id], time() + (86400 * 30 * 12), "/");
            }

            $_SESSION[user]=$user;
            SafeData::redirect('index');

        }else{
            $_SESSION[message]=array(array('status'=>'danger','message'=>'اطلاعات وارد شده صحیح نمی باشد.'));
        }
    }elseif ($_POST[code]!=''&&$_POST[code]!=$_SESSION[codelogin]){
        $_SESSION[message]=array(array('status'=>'danger','message'=>'کد امنیتی وارد شده صحیح نمی باشد.'));
        
    }else{
        
    }

    Config::$setting[body][background]=DIR.'includes/images/bg/'.rand(1,3).'.jpg';

?>

<!DOCTYPE html>
<html>
<head>
    <title><?=Config::$setting[title]?></title>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">    
    <meta name="twitter:card" content="<?=Config::$setting[body][tags][twitter]?>">
    <meta name="og:title" property="og:title" content="<?=Config::$setting[title]?>">
    <meta name="description" content="<?=Config::$setting[body][tags][description]?>">
    <meta name="keywords" content="<?=Config::$setting[body][tags][keywords]?>">

    <link rel="apple-touch-startup-image" href="<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>">
    <link rel="apple-touch-icon" href="<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>">
    <link rel="icon" href="<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>" type="image/icon type">
    <meta name="apple-mobile-web-app-title" content="<?=Config::$setting[title]?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    
    
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/bootstrap.min.css?id=12319891355">
    <link href="<?=DIR?>includes/themes/tagsinput.css?id=12319891355" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?=DIR?>includes/chosens/dist/tagify.css?id=12319891355">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/style.css?id=12319891355">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/stylep.css?id=12319891355">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/themes/stylepanel.css?id=12319891355">
    <script src="<?=DIR?>includes/scripts/jquery.min.js?id=12319891355"></script>
    <script src="<?=DIR?>includes/scripts/popper.min.js?id=12319891355"></script>
    <script src="<?=DIR?>includes/scripts/bootstrap.min.js?id=12319891355"></script>
    <script src="<?=DIR?>includes/chosens/dist/tagify.js?id=12319891355"></script>


    <script type="text/javascript" src="<?=DIR?>includes/scripts/javascript.js?id=12319891355"></script>
    <script type="text/javascript" src="<?=DIR?>includes/scripts/stylepanel.js?id=12319891355"></script>


    <link rel="stylesheet" href="<?= DIR ?>includes/chosen/chosen.css?id=12319891355">

    <link href="<?=DIR?>includes/scripts/datetime/css/daterangepicker.css?id=12319891355" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=DIR?>includes/scripts/datetime/css/datepicker-theme.css?id=12319891355" rel="stylesheet" type="text/css" media="all"  />

    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/jquery-clockpicker.min.css?id=12319891355">
    <link rel="stylesheet" type="text/css" href="<?=DIR?>includes/scripts/datetime/disc/assets/css/github.min.css?id=12319891355">
<style type="text/css">
    
        body{
            padding: 0px !important;
        }
        .background{
            background-position: center center !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;

        }

        .bg-login{
            background-color: #fff;
            box-shadow: 1px 0px 5px 0px #000;
        }
        .bg-login .logo{
            width: 60px;
        }
        .bg-login .neme{
            width: calc(100% - 60px);
        }
        .bg-login .neme p:first-child{
            font-size: 20px !important;
        }
        .color-theme{
            color: #3595cb !important;
        }
        .input-group .form-control, .input-group .form-input, .chosen-container, .custom-file-label{
            border-bottom: 1px solid rgba(0, 168, 198,0.8) !important;
            border-left: 0px solid transparent !important;
            color: #000 !important;
        }
        .login input[type="submit"]{
            background: rgba(0, 168, 198,0.8) !important;
            color: white !important;
        }
    
</style>
</head>
<body class="bybgimg ">


<div class="row vh-100">
    <div class="mx-auto mx-md-0 col-lg-3 col-md-5 col-12 bg-login d-flex flex-wrap align-content-center">
        <div class="w-100 p-0 ">
            <div class="col-12">
                <div class="row">
                    <div class="align-content-center d-flex  flex-wrap">
                        <img src="<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>" class="logo">
                    </div>
                    <div class="neme align-self-center pr-2">
                        <p class="text-info mb-0"><?=Config::$setting[title]?></p>
                        <p class="text-dark small mb-0"><?=Config::$setting[body][onedes]?></p>
                    </div>
                </div>
            </div>

          
            <div class="col-12 login pb-5">
                <form action="<?=DIR?>admin/login<?=($_GET[kind]=='sub')?'?kind=sub':''?>" method="post" enctype="multipart/form-data" >

                    <div class="row">

                        <div class="col-12 px-0 mb-3 ">
                                                    </div>
                        
                        <?php
                if (sizeof($_SESSION[message])>0){
                    foreach ($_SESSION[message] as $item) {
                        if ($item[message]!=''){
                            ?>
                            <div class="col-lg-12 col-md-12 mb-2" >
                                <div class="w-100 alert alert-<?=$item[status]?>">
                                    <?=$item[message]?>
                                </div>
                            </div>
                            <?php
                            
                        }
                    }
                    unset($_SESSION[message]);
                }

                ?>
                    <div class="col-lg-12 col-md-12  mb-3">
                        <div class="input-group">
                            <input type="text" name="email" placeholder="ایمیل" class="form-control form-input" data-opcheck="" required="">



                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12  mb-3">
                        <div class="input-group">
                            <input type="password" name="password" placeholder="رمز عبور" class="form-control form-input" data-opcheck="" required="">



                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12  mb-3">
                        <div class="custom-control custom-switch w-100 text-dark">
                            <input type="checkbox" class="custom-control-input" name="cookie" id="switch1">
                            <label class="custom-control-label" for="switch1">من را بخاطر بسپار</label>
                          </div>
                    </div>



                    <div class="col-lg-12 col-md-12  mb-3">
                            <img src="<?=DIR?>createimg" class="d-flex mx-auto createimg">
                        </div>

                        <div class="col-lg-12 col-md-12  mb-3">
                            <div class="input-group">
                                <input type="number" data-checksubmit="1" name="code" placeholder="کد امنیتی" class="form-control form-input" data-opcheck="number" required="">
                            </div>
                        </div>

                    
                
                        <div class="col-lg-12 col-md-12  mb-3">
                            <div class="input-group">
                                <input type="submit" value="ورود" class="form-control form-input">
                            </div>
                        </div>
             
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-7 d-none d-md-flex background" style="background-image:url('<?=Config::$setting[body][background]?>')"></div>

</div>

</body>
</html>