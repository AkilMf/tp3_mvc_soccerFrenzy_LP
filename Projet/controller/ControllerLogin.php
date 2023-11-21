<?php
RequirePage::model('CRUD');
RequirePage::model('User');
RequirePage::library('Validation');

class ControllerLogin extends Controller {

    // le login est accessible seulement si aucune session n'est ouverte
    public function index(){
        if (!CheckSession::sessionAuth()){
            Twig::render('auth/index.php');
        }
        else{
            Twig::render('home.php');
        }
    }

    public function auth() {
        if(!empty($_POST)) {
            $validation = new Validation;
            extract($_POST);
    
            $validation->name('utilisateur')->value($username)->max(50)->required()->pattern('email');
            $validation->name('mot de passe')->value($passwordd)->max(20)->min(6);
    
            if(!$validation->isSuccess()){
                $errors =  $validation->displayErrors();
             return Twig::render('auth/index.php', ['errors' =>$errors,  'user' => $_POST]);
             exit();
            }
    
            $user= new User;
            $checkUser = $user->checkUser($_POST['username'], $_POST['passwordd']);
    
            Twig::render('auth/index.php', ['errors'=> $checkUser, 'user' => $_POST]);
        }
        else{
            $controller = new ControllerHome;
            echo $controller->error();
            die();
        }


    }

    public function logout(){
        $_SESSION = array();
        
        /* Source : PHP Documentation */
        // If it's desired to kill the session, also delete the session cookie.
        // This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // 
        session_destroy();

        RequirePage::url('login');
    }
}
?>