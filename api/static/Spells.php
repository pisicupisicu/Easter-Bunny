<?php    

require_once 'AbstractStatic.php';

class Spells extends AbstractStatic
{
    public function __construct($oMysql)
    {
        parent::__construct($oMysql);
    }
    
    public function getSpellsById($spellId)
    {
        $spells = $this->oMySQL->select('rt_spells');
        
        if (!$spellId) {
            return $spells;
        }
        
        foreach ($spells as $spell) {
            if ($spell['spell_id'] == $spellId) {
                //$this->debug($spell);
                return $spell;
            }
        }
    }
}
