<?php
class Joueur extends CRUD {
    protected $table = 'joueur';
    protected $primaryKey = 'id';

    
    protected $fillable = ['id', 'prenom', 'nom', 'date_naissance', 'adresse','Equipe_id','photo'];


    
}
?>