<?php
RequirePage::model('CRUD');
RequirePage::model('Joueur');
RequirePage::model('Equipe');
RequirePage::library('Validation');

require_once('controller/ControllerHome.php');

class ControllerJoueur extends Controller {
    public function index() {
        if (CheckSession::sessionAuth()){
            $joueur = new Joueur();
            $select = $joueur->select();
            return Twig::render('joueur-index.php',['joueurs'=>$select]);   
        }
        else RequirePage::url('home');
    }

    public function create(){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1){
            $equipe = new Equipe;
            $selectEquipes = $equipe->select('nom');
            return Twig::render('joueur-create.php', ['equipes'=>$selectEquipes]);
        }
        RequirePage::url('joueur');
    }

    // lien pour la methode store n aura pas accessible directment
    public function store(){
        //$tempImage = '';
        if(empty(!$_POST)){
            $validation = new Validation;
            extract($_POST);
            $validation->name('prenom')->value($prenom)->max(45)->min(3);    
            $validation->name('nom')->value($nom)->max(45)->min(3);
            $validation->name('date de naissance')->value($date_naissance)->required()->pattern('date_ymd');
            $validation->name('adresse')->value($adresse)->max(150)->min(9)->required();
            $validation->name('equipe')->value($Equipe_id)->required()->pattern('int');
            
        }
        else{
            
            $controller = new ControllerHome;
            echo $controller->error();
            die();
        }

        if(!$validation->isSuccess()){
            $errors =  $validation->displayErrors();
            $equipe = new Equipe;
            $selectEquipes = $equipe->select('nom');
            //$tempImage = $_FILES['photo']['name'];
            return Twig::render('joueur-create.php', ['errors' =>$errors, 'joueur' => $_POST,'equipes'=>$selectEquipes /* ,'tempImage'=> $tempImage */]);
            exit();
        }

        // Ajout de la photo du joueur
        if(!empty($_FILES['photo'])){
            //print_r($_FILES['photo']);
            //die();
            $photo = Image::imgFileChamp($_FILES['photo']);

            $_POST['photo'] = $photo;
            print_r($_POST);
            $joueur = new Joueur;
        }

        $insert = $joueur->insert($_POST);
        RequirePage::url('joueur/show/'.$insert);
     }

     public function show($id=null){
        if(isset($id) && is_numeric($id)){
            $joueur = new Joueur;
            $joueurToShow = $joueur->selectId($id);

            if($joueurToShow['id'] == $id ){
                $age = $joueur->calculAge($joueurToShow['date_naissance']);
                $equipe = new Equipe;
                $selectEquipe = $equipe->selectId($joueurToShow['Equipe_id']);
                return Twig::render('joueur-show.php', ['joueur'=>$joueurToShow, 'nom'=>  $selectEquipe['nom'], 'age'=> $age]);
            }
        }else{
            $controller = new ControllerHome;
            echo $controller->error();
        }
    }

    // EDITING
    public function edit($id=null){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1){

            // si je recois un "id" : gestion d'erreur ( Uncaught ArgumentCountError )
            if(isset($id) && is_numeric($id)){
                $joueur = new Joueur;
                $selectId = $joueur->selectId($id);
                if($selectId['id'] == $id ){
                    $equipe = new Equipe;
                    $selectEquipes = $equipe->select('nom');
                    return Twig::render('joueur-edit.php', ['joueur'=>$selectId, 'equipes'=>$selectEquipes]);
                }
                else{
                    $controller = new ControllerHome;
                    echo  $controller->error();
                }
            }else{
                $controller = new ControllerHome;
                echo  $controller->error();
            }
        }
        RequirePage::url('joueur');
    }

    // DELETING
    public function destroy(){
        if(isset($_POST['id'])){
            $joueur = new Joueur;
            $joueurToDelete = $joueur->selectId($_POST['id']);
            // si le joueur existe
            if($joueurToDelete['id'] == $_POST['id'] ){
                $update = $joueur->delete($_POST['id']);

                //deleting image from folder
                unlink('photoJoueurs/'.$joueurToDelete['photo']);
                $select = $joueur->select();
                //return Twig::render('joueur-index.php',['joueurs'=>$select]);
                RequirePage::url('joueur');
            }
            // id n'existe pas dans ma table joueur
            else{ 
                $controller = new ControllerHome;
                echo  $controller->error();
            }             
        }
        else{
            
            $controller = new ControllerHome;
            echo  $controller->error();
        }
    }
    
    // Modification de joueur 
   public function update(){


        // lien pour la methode update n'aura pas accessible directment
       
            if(empty(!$_POST)){
                $validation = new Validation;
                extract($_POST);
                $validation->name('prenom')->value($prenom)->max(45)->min(3);    
                $validation->name('nom')->value($nom)->max(45)->min(3);
                $validation->name('date de naissance')->value($date_naissance)->required()->pattern('date_ymd');
                $validation->name('adresse')->value($adresse)->max(150)->min(9)->required();
                $validation->name('equipe')->value($Equipe_id)->required()->pattern('int');
            }               
            else{
                $controller = new ControllerHome;
                echo $controller->error();
                die();
            }

            if(!$validation->isSuccess()){

                $errors =  $validation->displayErrors();
                $equipe = new Equipe;
                $selectEquipes = $equipe->select('nom');
                return Twig::render('joueur-edit.php', ['errors' =>$errors, 'joueur' => $_POST,'equipes'=>$selectEquipes]);
                exit();
            }

                // Modifi photo 
                if(!empty($_FILES['photo'])){

                $photo = Image::imgFileChamp($_FILES['photo']);

                $_POST['photo'] = $photo;
                //print_r($_POST);
                $joueur = new Joueur;
            }
            $update = $joueur->update($_POST);
            $this->show($_POST['id']);
       
    }   
}
?>