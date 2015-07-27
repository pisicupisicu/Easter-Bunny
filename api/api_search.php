<?php

    require_once 'includes/config.php';
    require_once 'includes/class.MySQL.php';
    include('php-riot-api.php');
    
    $oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    //$summoner_name = "Banhammer Live";
    //$summoner_id = 25132718;
    //$summoner_name = "Snowflakeyuki";
    //$summoner_id = 36826926;
    $sumonner_name = "Vivà";
    $summoner_id = 48179352;
    
    
    $region = 'eune';
    $platform_id = strtoupper(substr($region, 0, -1)) . '1';

    $test = new Riotapi($region);
    // getLeague($test, $oMySQL, $summoner_id);
    getCurrentGame($test, $oMySQL, $summoner_id, $platform_id);
    
    function getLeague($test, $oMySQL, $summoner_id)
    {
        try {
            $request = $test->getLeague($summoner_id);
            $test->debug($request);            
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
    
    function getCurrentGame($test, $oMySQL, $summoner_id, $platform_id)
    {
        try {
            $request = $test->getCurrentGame($summoner_id, $platform_id);
            $test->debug($request);            
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }

