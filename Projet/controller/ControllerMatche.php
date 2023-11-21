<?php
RequirePage::model('CRUD');
RequirePage::model('Matche');
RequirePage::model('Equipe');
RequirePage::model('Competition');
RequirePage::library('Validation');
require_once('controller/ControllerHome.php');

class ControllerMatche extends Controller{

    public function index(){
        $matche = new Matche();
        $equipe = new Equipe;
        $competition = new Competition;
        $selectMatches = $matche->select();
        $selectEquipes = $equipe->select();
        $selectCompetition = $competition->select();
        return Twig::render('matches-liste.php',['matches'=>$selectMatches, 'equipes'=>$selectEquipes, 'competitions'=>$selectCompetition]);
    }

    public function create(){

        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1){
            $equipe = new Equipe;
            $selectEquipes = $equipe->select('nom');
            $competition = new Competition;
            $selectCompetitions = $competition->select('nom');
            return Twig::render('matche-create.php', ['equipes'=>$selectEquipes,'competitions'=> $selectCompetitions]);    
        }
        RequirePage::url('matche');
    }

    public function store(){
        
        if(empty(!$_POST)){

            $validation = new Validation;
            extract($_POST);
            $validation->name('Ligue(Compétition)')->value($Competition_id)->required()->pattern('int');
            $validation->name('date du Matche')->value($match_date)->required()->pattern('date_ymd');
            $validation->name('Équipe à domicile :')->value($equipe_Domicile)->required()->pattern('int');
            $validation->name('Équipe à Exterieur :')->value($equipe_exterieur)->required()->pattern('int');
            $validation->name('Score Domicile')->value($score_domicile)->required()->pattern('int');
            $validation->name('Score Exterieur')->value($score_exterieur)->required()->pattern('int');
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
            $competition = new Competition;
            $selectCompetitions = $competition->select('nom');
            return Twig::render('matche-create.php', ['errors' =>$errors, 'matche' => $_POST,'equipes'=>$selectEquipes,'competitions'=> $selectCompetitions]);
            exit();
        }

        $matche = new Matche();
        $insert = $matche->insert($_POST);
        $this->index();

        //Done


    }
}

?>