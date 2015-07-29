<?php

require_once '../includes/config.php';
require_once '../includes/class.MySQL.php';

abstract class AbstractStatic 
{
    private $oMysql;
    
    public function __construct()
    {
           $this->oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);    
    }
    
    public function debug($message) 
    {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
    }
}
