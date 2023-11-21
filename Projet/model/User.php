<?php

class User extends CRUD {

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['prenom','nom','username', 'passwordd', 'privilege_id'];

    public function checkUser($username, $password) {
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));

        $count = $stmt->rowCount();
        //echo $count;
        if($count == 1){
            //crypt password
            $salt = "Me??!%@@?";
            $saltedPassword = $password.$salt;
            $user_infos = $stmt->fetch();
            //print_r($user_infos);
        
            if(password_verify($saltedPassword, $user_infos['passwordd'])){
                $id = session_regenerate_id();
                $_SESSION['user_id'] = $user_infos['id'];
                $_SESSION['username'] = $user_infos['username'];
                $_SESSION['nom'] = $user_infos['nom'];
                $_SESSION['prenom'] = $user_infos['prenom'];
                $_SESSION['privilege'] = $user_infos['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);

                RequirePage::url('joueur');
                exit();
            }else{
                $errors = "<ul><li>Veuillez Verifier votre mot de passe !</li></ul>";
                return $errors;
            }
        }else{
            $errors = "<ul><li>Veuillez Verifier votre nom d'utilisateur !</li></ul>";
            return $errors;
        }
    }
}
?>