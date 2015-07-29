<?php    

require_once 'AbstractStatic.php';

class Champions extends AbstractStatic
{   
    public function __construct()
    {
        parent::__construct();
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
