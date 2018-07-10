<?php

class Table{
    protected $db;
    
    public function __construct($db){
        $this->db = $db;
    }    
}
