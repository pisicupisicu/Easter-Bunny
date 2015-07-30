<?php

abstract class AbstractStatic 
{
    private $oMysql;
    
    public function __construct($oMysql)
    {
           $this->oMySQL = $oMysql;
    }
    
    public function debug($message) 
    {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
    }
}
