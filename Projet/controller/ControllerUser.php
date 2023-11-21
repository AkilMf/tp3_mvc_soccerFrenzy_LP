<?php
RequirePage::model('CRUD');
RequirePage::model('User');
RequirePage::model('Privilege');
RequirePage::library('Validation');

class ControllerUser extends controller {

    // only admin can use the USER's Methods , 
/*     public function __construct(){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] != 1 || $_SESSION['privilege'] != 2) {
            RequirePage::url('home');
            exit();
        }
    } */
    
    public function index(){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1){
            $user = new user;
            $select = $user->select('username');
            
            $privilege = new Privilege;
            $i=0;
            foreach($select as $user){
                $selectId = $privilege->selectId($user['privilege_id']);
                $select[$i]['privilege']= $selectId['privilege'];
                $i++;
            }
            return Twig::render('user/index.php', ['users'=>$select]);
        }
        else RequirePage::url('home');
    }

    public function create(){
        if (((CheckSession::sessionAuth()) && $_SESSION['privilege'] == 1 ) || empty($_SESSION) ){
            $privilege = new Privilege;
            $select = $privilege->select('privilege');
            return Twig::render('user/create.php', ['privileges' => $select]);
        }
        else RequirePage::url('home');

    }

    public function store(){
        if(empty(!$_POST)){

            $validation = new Validation;
            extract($_POST);
            $validation->name('prenom')->value($prenom)->max(45)->min(3);    
            $validation->name('nom')->value($nom)->max(45)->min(3);
            $validation->name('utilisateur')->value($username)->max(50)->required()->pattern('email');
            $validation->name('mot de passe')->value($passwordd)->max(20)->min(6);
            
            if (CheckSession::sessionAuth()){
                if($_SESSION['privilege'] == 1){
                    $validation->name('privilege')->value($privilege_id)->required();
                }
            }
            // privilege est utilisateur par default si la session ouverte n'est pas Admin
            else $_POST['privilege_id'] = 2;

            if(!$validation->isSuccess()){
                
                $errors =  $validation->displayErrors();
                //echo $errors;
                $privilege = new Privilege;
                $select = $privilege->select('privilege');
            return Twig::render('user/create.php', ['errors' =>$errors, 'privileges' => $select, 'user' => $_POST]);
            exit();
            }

            $user = new user;

            $options = [
                'cost' => 10
            ];
            $salt = "Me??!%@@?";
            $passwordSalt = $_POST['passwordd'].$salt;
            $_POST['passwordd'] =  password_hash($passwordSalt, PASSWORD_BCRYPT, $options);
            
            

            $insert = $user->insert($_POST);
            RequirePage::url('user');
        }else{
            $controller = new ControllerHome;
            echo $controller->error();
            die();
        }
    }


}


?>