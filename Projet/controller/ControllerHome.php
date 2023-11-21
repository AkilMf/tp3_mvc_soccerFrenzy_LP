<?php
class ControllerHome extends Controller {

    public function index(){
        return Twig::render('home.php');
    }

    public function error($e = null){
        return Twig::render('404.php');
        //return 'Erreur '.$e;
    }

}

?>