<?php

class Matche extends CRUD {

    protected $table = 'matche';
    protected $primaryKey = 'id';

    protected $fillable = ['id','match_date','equipe_exterieur', 'equipe_Domicile','score_domicile','score_exterieur','Competition_id','commentaire'];
}

?>