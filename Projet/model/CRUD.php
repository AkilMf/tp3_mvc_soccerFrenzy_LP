<?php
class CRUD extends PDO{
    public function __construct(){
        parent::__construct('mysql:host=localhost;dbname=soocer;port=3306;charset=utf8','root', '');
    }

    public function select($field='id', $order ='ASC'){
        $sql = "SELECT * from $this->table ORDER by $field $order";
        $stmt = $this->query($sql);

        return $stmt->fetchAll();
    }

    public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = '$value'";
        $stmt = $this->query($sql);
        $count = $stmt->rowCount();

        if($count == 1){
            return $stmt->fetch();
        }else{
          RequirePage::url('home/error/404');
        }  
    }

    public function insert($data){
        //print_r($_FILES['photo']);
        //die();
        //vide it
       /*  if($_FILES['photo']['error'] === 4){
            // image not exist */

        $data_keys = array_fill_keys($this->fillable, ''); // :Array ( [id] => [prenom] => [nom] => [date_naissance] => [adresse] => [Equipe_id] => [photo] => )
        
        $data = array_intersect_key($data, $data_keys); //Array ( [prenom] => dsds [nom] => dsdsds [date_naissance] => 2023-11-11 [adresse] => fsdfsdsdfdfsdfdfd [Equipe_id] => 3 )

        $nomChamp = implode(", ",array_keys($data)); // prenom, nom, date_naissance, adresse, Equipe_id
        
        $valeurChamp = ":".implode(", :", array_keys($data)); // :prenom, :nom, :date_naissance, :adresse, :Equipe_id

        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";
        $stmt = $this->prepare($sql); //:INSERT INTO joueur (prenom, nom, date_naissance, adresse, Equipe_id) VALUES (:prenom, :nom, :date_naissance, :adresse, :Equipe_id) )

        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value); // aman jun 2023-11-11 78street 2  
        }            
        $stmt->execute();
        return $this->lastInsertId();   


    }

    public function calculAge($birthDayDate){
        $birthDayDate = new DateTime($birthDayDate);
        $dateJour = new DateTime();
        return $dateJour->diff($birthDayDate)->y;
    }

    public function update($data){

        $queryField = null;
        foreach($data as $key => $value){
            $queryField .="$key =:$key, ";
        }
        $queryField = rtrim($queryField, ", ");
        $sql = "UPDATE $this->table SET $queryField WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        };
    }

    public function delete($value){
        $sql = "DELETE FROM $this->table where $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        }

    }
}
?>