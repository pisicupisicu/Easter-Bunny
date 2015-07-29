<?php

require_once '../includes/config.php';
require_once '../includes/class.MySQL.php';
require_once 'Riotapi.php';

class WrapperRiot 
{
   private $region = 'eune';
   private $platform_id;
   private $oMysql;
   private $riot;
    
    public function __construct($region = 'eune')
    {
        $this->region = $region;   
        $this->oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->riot = new Riotapi($this->region);
        $this->platform_id = strtoupper(substr($this->region, 0, -1)) . '1';
    }        
    
    public function getLeague($summoner_id)
    {
        try {
            $request = $this->riot->getLeague($summoner_id);
            $this->debug($request);            
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
    
    public function getCurrentGame($summoner_id)
    {
        try {
            $request = $this->riot->getCurrentGame($summoner_id, $this->platform_id);
            
            $structure = array();
            
            foreach ($request['participants'] as $key => $participant) {
                if ($key < 5) {
                    $structure['home']['users'][] = array(
                        'summonerName' => $participant['summonerName'],
                        'championId'   => $participant['championId'],
                        'spell1Id'     => $participant['spell1Id'],
                        'spell2Id'     => $participant['spell2Id']
                    );
                } else {
                    $structure['away']['users'][] = array(
                        'summonerName' => $participant['summonerName'],
                        'championId'   => $participant['championId'],
                        'spell1Id'     => $participant['spell1Id'],
                        'spell2Id'     => $participant['spell2Id']
                    );
                }
                
            }
            
            foreach ($request['bannedChampions'] as $key => $bannedChampion) {
                if ($bannedChampion['teamId'] == 100) {
                    $structure['home']['bannedChampions'][] = array(
                        'championId' => $bannedChampion['championId'],
                        'pickTurn' => $bannedChampion['pickTurn']
                    );
                } else {
                    $structure['away']['bannedChampions'][] = array(
                        'championId' => $bannedChampion['championId'],
                        'pickTurn' => $bannedChampion['pickTurn']
                    );
                }
                
            }
            
            //$this->debug($request);
            //$this->debug($structure);
            return $structure;
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
    
    private function debug($message) 
    {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
    }
}
