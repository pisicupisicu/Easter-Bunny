<?php    

require_once 'AbstractStatic.php';

class Runes extends AbstractStatic
{
    public function __construct($oMysql)
    {
        parent::__construct($oMysql);
    }
    
    public function getRunesById($runeId)
    {
        $runes = $this->oMySQL->select('rt_runes');
        
        if (!$runeId) {
            return $runes;
        }
        
        foreach ($runes as $rune) {
            if ($rune['rune_id'] == $runeId) {
                //$this->debug($rune);
                return $rune;
            }
        }
    }
}
