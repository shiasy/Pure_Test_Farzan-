<?php
//header('Content-Type: application/json; charset=UTF-8');
// Ensure we have session
error_reporting(0);
if(session_id() === ""){
    session_start();
}
$path = ROOT . DS . 'config' . DS . 'Config.php';
if (!$path){
    $path = ROOT . DS . 'config' . DS . 'config.php';
}
// include the config settings

require_once ($path);

// Autoload any classes that are required
spl_autoload_register(function($className) {

    //$className = strtolower($className);
    $rootPath = ROOT . DS;
    $valid = false;

    // check root directory of library
    $valid = file_exists($classFile = $rootPath . 'library' . DS . $className . '.class.php');
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . strtolower($className) . '.class.php');
    }

    // if we cannot find any, then find library/mvc directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'mvc' . DS . $className . '.class.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'library' . DS . 'mvc' . DS . strtolower($className) . '.class.php');
        }
    }

    // if we cannot find any, then find library/jwt directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'jwt' . DS . 'jwt' . DS . $className . '.php');

        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'library' . DS . 'jwt' . DS . 'jwt' . DS . strtolower($className) . '.php');
        }
    }
    // if we cannot find any, then find library/rsacrypt directory
    if(!$valid&&strtolower($className)=='rsacrypt'){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'rsacrypt' . DS . 'vendor' . DS . 'autoload.php');

        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'library' . DS . 'rsacrypt' . DS . 'vendor' . DS . 'autoload.php');
        }
    }

    //db backup
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'db' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'db' . DS . strtolower($className) . '.php');
        }
    }
    //config
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'config' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'config' . DS . strtolower($className) . '.php');
        }
    }
    // if we cannot find any, then find application/controllers directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'class' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS . 'class'  . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'pages' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS . 'pages'  . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'class'. DS . 'portal' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS . 'class'. DS . 'portal'  . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS .  'recive' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS .'recive'  . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'send' . DS . 'sms' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS . 'send' . DS . 'sms'  . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'send' . DS . 'used' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers'. DS . 'send' . DS . 'used'  . DS . strtolower($className) . '.php');
        }
    }


    // if we cannot find any, then find application/models directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'models' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
        }
    }

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'views' . DS . $className . '.php');
        if(!$valid){
            $valid = file_exists($classFile = $rootPath . 'application' . DS . 'views' . DS . strtolower($className) . '.php');
        }
    }



    // if we have valid fild, then include it
    if($valid){
        require_once($classFile);
    }else{
        /* Error Generation Code Here */
    }
});

