<?php    

require_once 'AbstractStatic.php';

class Masteries extends AbstractStatic
{
    public function __construct($oMysql)
    {
        parent::__construct($oMysql);
    }
    
    public function getMasteriesById($masteryId)
    {
        $masteries = $this->oMySQL->select('rt_masteries');
        
        if (!$masteryId) {
            return $masteries;
        }
        
        foreach ($masteries as $mastery) {
            if ($mastery['mastery_id'] == $masteryId) {
                //$this->debug($mastery);
                return $mastery;
            }
        }
    }
    
    public function computeMasteries($masteries)
    {
        $result = array('Offense' => 0, 'Defense' => 0, 'Utility' => 0);
        
        foreach ($masteries as $mastery) {
            $dbMastery = $this->getMasteriesById($mastery['masteryId']);
            //echo $mastery['masteryId'] . '=>' . $dbMastery['masteryTree'] . ' => ' . $dbMastery['ranks'] . PHP_EOL;
            
            $result[$dbMastery['masteryTree']] += $dbMastery['ranks'];
        }
        
        //$this->debug($result);die;
        return $result;
    }        
}

