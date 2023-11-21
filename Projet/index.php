<?php
session_start();



require_once('controller/Controller.php');
require_once('library/View.php');
require_once('library/RequirePage.php');
require_once('library/CheckSession.php');
require_once('controller/ControllerHome.php');
require_once('library/Image.php');

// init path
define('PATH_DIR', 'http://localhost/MyPHP/WEB_AVANCEE/TP3_Footy\TP_3_Ligue_project/');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Twig.php');



$url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

//print_r($url);

if($url == '/'){
    
    //require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    echo  $controller->index();
}
else{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    //
    
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath)){
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;

        $page = $requestURL;
        $controller = new $controllerName;
        // je verifie aussi si la methode existe dans la classe
        if(isset($url[1]) && method_exists($controllerName, $url[1])){
            $method = $url[1];
            if(isset($url[2])){
                echo $controller->$method($url[2]);
            }else{
                echo $controller->$method();
            }
        }else{
            echo $controller->index();
        }
        
    }else{
        //require_once('controller/ControllerHome.php');
        $controller = new ControllerHome;
        echo $controller->error(); 
    }
}



?>