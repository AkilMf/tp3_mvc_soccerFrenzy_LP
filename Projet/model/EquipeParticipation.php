<?php

class EquipeParticipation extends CRUD {

    protected $table = 'equipe_participation';
    protected $primaryKey = 'id';
    
    protected $fillable = ['Equipe_id','competition_id'];

}

?>