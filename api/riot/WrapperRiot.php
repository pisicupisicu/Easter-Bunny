<?php

require_once 'Riotapi.php';

class WrapperRiot 
{
   private $region = 'eune';
   private $platform_id;
   private $oMysql;
   private $riot;
   
   const NR_MATCHES = 15;
    
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
    
    public function getMatchList($summoner_id, $championId)
    {
        $i = 0;
        $result = array();
        try {
            $request = $this->riot->getMatchList($summoner_id, $championId, 2015);
            if (isset($request['matches'])) {
                foreach ($request['matches'] as $match) {
                    $i++;                
                    if (($match['queue'] == 'RANKED_SOLO_5x5') && $i < self::NR_MATCHES) {
                        $result['matches'][] = $match['matchId'];                    
                    }
                    $result['total'] = $i;
                }
            } else {
                $result['matches'] = array();
                $result['total'] = 0;
            }
            
            //$this->debug($result);die;
            return $result;
            
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
    
    public function getMatch($matchId)
    {
        $result = array();
        
        try {
            $request = $this->riot->getMatch($matchId);
            
            $result['kills'] = $request['participants'][0]['stats']['kills'];
            $result['deaths'] = $request['participants'][0]['stats']['deaths'];
            $result['assists'] = $request['participants'][0]['stats']['assists'];
            
            //$this->debug($request);
            return $result;            
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
        
    public function getMatchStats($summoner_id, $championId)
    {
        //echo "summoner_id = $summoner_id championId = $championId" . PHP_EOL;
        $matches  = $this->getMatchList($summoner_id, $championId);
        
        $result = array(
          'total' => $matches['total'],
          'matches'   => count($matches['matches']),
          'kills'  => 0,
          'deaths' => 0,
          'assists' => 0,
          'avg_kills' => 0,
          'avg_deaths' => 0,
          'avg_assists' => 0,
        );
        
        
        if (empty($matches['matches'])) {
            return $result;
        }
        
        foreach ($matches['matches'] as $currentMatch) {
            $match = $this->getMatch($currentMatch);
            $result['kills'] += (int) $match['kills'];
            $result['deaths'] += (int) $match['deaths'];
            $result['assists'] += (int) $match['assists'];
        }
        
        if ($result['matches']) {
            $result['avg_kills'] = round($result['kills'] / $result['matches'], 1);
            $result['avg_deaths'] = round($result['deaths'] / $result['matches'], 1);
            $result['avg_assists'] = round($result['assists'] / $result['matches'], 1);
        }
                
       //$this->debug($result);die;
       return $result;
    }
    
    public function getStats($summoner_id)
    {
        $result = array('ranked_wins' => 0, 'ranked_losses' => 0);
        
        try {
            $request = $this->riot->getStats($summoner_id);
            foreach ($request['playerStatSummaries'] as $stat) {
                if ($stat['playerStatSummaryType'] == 'Unranked') {
                    $result['unranked_wins'] = $stat['wins'];
                } elseif (strstr($stat['playerStatSummaryType'], 'Ranked')) {
                    $result['ranked_wins'] += $stat['wins'];
                    $result['ranked_losses'] += $stat['losses'];
                }
            }
            //$this->debug($result);
            return $result;
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
