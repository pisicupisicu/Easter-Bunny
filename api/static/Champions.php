<?php    

require_once 'AbstractStatic.php';

class Champions extends AbstractStatic
{   
    public function __construct($oMysql)
    {
        parent::__construct($oMysql);
    }
    
    public function getChampionsById($championId)
    {
        $champions = $this->oMySQL->select('rt_champions');
        
        if (!$championId) {
            return $champions;
        }
        
        foreach ($champions as $champion) {
            if ($champion['api_id'] == $championId) {
                //$this->debug($champion);
                return $champion;
            }
        }
    }
}
