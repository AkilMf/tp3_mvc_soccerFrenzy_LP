<?php

class CheckSession{

    static public function sessionAuth(){
        //echo 'ddd';
        if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            return true;
        }else{
            return false;
        }
    }
}


?>