<?php
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    error_reporting(E_ALL & ~E_NOTICE);
    error_reporting(E_ALL);
    session_start();
    date_default_timezone_set('Asia/Yerevan');
    function __autoload($className)
    {
        $className = ltrim($className, '\\');

        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            
            $className = substr($className, $lastNsPos + 1);
            
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            
        }
         
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        require $fileName;
    }
    
        /**
     * Handling fatal error
     *
     * @return void
     */
    function fatalErrorHandler()
    {
        $error = error_get_last();
        if(($error['type'] === E_ERROR) || ($error['type'] === E_USER_ERROR))
        {
            $oError = new Model\Errors\CatchErrors();
            $aError = array();
            if(isset($_COOKIE['upet'])){
                $aError['type'] = 'user';
                $aError['user'] = $_COOKIE['upet'];
            }
            if(isset($_COOKIE['pets'])){
                $aError['type'] = 'businnes';
                $aError['user'] = $_COOKIE['pets'];
            }
            if(isset($error['message'])){
                $aError['text'] = $error['message'];
            }else{
                $aError['text'] = serialize($error);
            }
            $oError->_post = $aError;
            $oError->insert();
            header("LOCATION:https://petlox.ec/");
        }
    }
    register_shutdown_function('fatalErrorHandler');

?>