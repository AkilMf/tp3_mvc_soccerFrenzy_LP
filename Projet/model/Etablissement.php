<?php

class Etablissement extends CRUD {

    protected $table = 'etablissement';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nom_etablissement'];
    
}

?>