<?php

class Competition extends CRUD {

    protected $table = 'competition';
    protected $primaryKey = 'id';

    protected $fillable = ['id','nom'];

    

}

?>