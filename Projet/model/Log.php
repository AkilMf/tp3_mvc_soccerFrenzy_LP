<?php

class Log extends CRUD {

    protected $table = 'log';
    protected $primaryKey = 'id';

    protected $fillable = ['date','ip','page', 'user'];

}

?>