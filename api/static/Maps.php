<?php    

require_once 'AbstractStatic.php';

class Maps extends AbstractStatic
{
    public function __construct($oMysql)
    {
        parent::__construct($oMysql);
    }
    
    public function getMapsById($mapId)
    {
        $maps = $this->oMySQL->select('rt_maps');
        
        if (!$mapId) {
            return $maps;
        }
        
        foreach ($maps as $map) {
            if ($map['map_id'] == $mapId) {
                //$this->debug($map);
                return $map;
            }
        }
    }
}
