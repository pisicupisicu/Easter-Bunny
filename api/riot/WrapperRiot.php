<?php

require_once 'Riotapi.php';

class WrapperRiot 
{
   private $region = 'eune';
   private $platform_id;
   private $oMysql;
   private $riot;
    
    public function __construct($region = 'eune', $oMySQL)
    {
        $this->region = $region;
        $this->oMySQL = $oMySQL;
        $this->riot = new Riotapi($this->region);
        $this->platform_id = strtoupper(substr($this->region, 0, -1)) . '1';
    }
    
    public function getSummonerId($name)
    {
        return $this->riot->getSummonerId($name);
    }
    
    /**
    *  [36826926] => Array
        (
            [0] => Array
                (
                    [name] => Soraka's Dervish
                    [tier] => PLATINUM
                    [queue] => RANKED_SOLO_5x5
                    [entries] => Array
                        (
                            [0] => Array
                            (    
                                [playerOrTeamId] => 48630926
                                [playerOrTeamName] => Hroula
                                [division] => V
                                [leaguePoints] => 55
                                [wins] => 41
                                [losses] => 49
                                [isHotStreak] => 
                                [isVeteran] => 
                                [isFreshBlood] => 
                                [isInactive] =>         
    * 
    */
    public function getUserLeagueInfo($summoner_id)
    {        
        try {
            $request = $this->riot->getLeague($summoner_id);
            //$this->debug($request);
            foreach ($request as $req) {
                foreach ($req[0]['entries'] as $user) {
                        if ($user['playerOrTeamId'] == $summoner_id) {
                            $user['tier'] = $req[0]['tier'];
                            //$this->debug($user);
                            return $user;
                    }
                }
                
            }
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
        
        return array();                
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
                        'spell2Id'     => $participant['spell2Id'],
                        'masteries'    => $participant['masteries']
                    );
                } else {
                    $structure['away']['users'][] = array(
                        'summonerName' => $participant['summonerName'],
                        'championId'   => $participant['championId'],
                        'spell1Id'     => $participant['spell1Id'],
                        'spell2Id'     => $participant['spell2Id'],
                        'masteries'    => $participant['masteries']
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
    
    public function debug($message) 
    {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
    }
}
