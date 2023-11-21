<?php
RequirePage::model('CRUD');
RequirePage::model('Matche');
RequirePage::model('Equipe');
RequirePage::model('Log');
RequirePage::model('Competition');
RequirePage::library('Validation');
require_once('controller/ControllerHome.php');

class ControllerLog extends Controller{

    public function index(){
        if (CheckSession::sessionAuth() && $_SESSION['privilege'] == 1){
            $log = new Log();
            $selectLogs = $log->select();
            return Twig::render('log-index.php',['logs'=>$selectLogs]);
        }else RequirePage::url('home');

    }

    public function store(){
        $logActivity = array();
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d H:i:s',time());

        if(CheckSession::sessionAuth()){
            
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $logActivity = [$date, $_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'], $username];
            }
        } else {
            // Si l'utilisateur n'est pas connecté, enregistrez le journal en tant que visiteur
            $logActivity = [$date, $_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'],  'guest'];
        }


        /* print_r($logActivity);
        die(); */

        $log = new Log();
        $insert = $log->insert($logActivity);
        
        
    }
}

?>