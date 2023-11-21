<?php

class Equipe extends CRUD {

    protected $table = 'equipe';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','categorie','Etablissement_id'];
}

?>