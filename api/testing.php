<?php
include('php-riot-api.php');
include('FileSystemCache.php');

//testing classes
//using double quotes seems to make all names work (see issue: https://github.com/kevinohashi/php-riot-api/issues/33)
$summoner_name = "Banhammer Live";
$summoner_id = 25132718;

$test = new Riotapi('eune');


$testCache = new Riotapi('eune', new FileSystemCache('cache/'));
//$r = $test->getSummonerByName($summoner_name);

//$r = $test->getSummoner($summoner_id);
//$r = $test->getSummoner($summoner_id,'masteries');
//$r = $test->getSummoner($summoner_id,'runes');
//$r = $test->getSummoner($summoner_id,'name');
//$r = $test->getStats($summoner_id);
//$r = $test->getStats($summoner_id,'ranked');
//$r = $test->getTeam($summoner_id);
//$r = $test->getLeague($summoner_id);
//$r = $test->getGame($summoner_id);
//$r = $test->getChampion();
try {
    $r = $test->getSummonerByName($summoner_name);
    print_r($r);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
};
echo "<br>\r\n testing cache:";
try {
    $r = $testCache->getSummoner($summoner_id);
    print_r($r);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
};

?>