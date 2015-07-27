<?php
    require_once 'includes/config.php';
    require_once 'includes/class.MySQL.php';
    include('php-riot-api.php');
    
    $oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    $summoner_name = "Banhammer Live";
    $summoner_id = 25132718;

    $test = new Riotapi('eune');
        
    // addChampions($test, $oMySQL);
    // displayChampions($test, $oMySQL);
    // getChampionsImages($test, $oMySQL);
    // addChampionsTags($test, $oMySQL);
    // addMaps($test, $oMySQL);
     addSpells($test, $oMySQL);
    
    
    function addChampions($test, $oMySQL)
    {
            $request = $test->getAllChampions();
            //$test->debug($request);

            foreach ($request['data'] as $champion) {
                $toInsert = array(
                  'api_id' => $champion['id'],
                  'title' => $champion['title'],
                  'name' => $champion['name'],
                  'image_full' => $champion['image']['full'],
                  'image_sprite' => $champion['image']['sprite']
                );

                @$oMySQL->insert('rt_champions', $toInsert);
            }

    }
    
    function addMaps($test, $oMySQL)
    {
            $request = $test->getAllMaps();
            //$test->debug($request);

            foreach ($request['data'] as $maps) {
                $toInsert = array(
                  'map_id' => $maps['mapId'],
                  'map_name' => $maps['mapName'],
                  'image_full' => $maps['image']['full'],
                  'image_sprite' => $maps['image']['sprite']
                );

                @$oMySQL->insert('rt_maps', $toInsert);
            }

    }
    
    function addSpells($test, $oMySQL)
    {
            $request = $test->getAllSpells();
            $test->debug($request);

            foreach ($request['data'] as $spells) {
                $toInsert = array(
                  'spell_id' => $spells['id'],
                  'description' => $spells['description'],
                  'spell_name' => $spells['name'],
                  'key' => $spells['key'],
                  'summonerLevel' => $spells['summonerLevel'],
                  'image_full' => $spells['image']['full'],
                  'image_sprite' => $spells['image']['sprite']
                );

                @$oMySQL->insert('rt_spells', $toInsert);
            }

    }
    
    function addChampionsTags($test, $oMySQL)
    {
        try {
            $request = $test->getAllChampionsTags();
            //$test->debug($request);

            foreach ($request['data'] as $champion) {
                $champion_tag = '';
                $i=0;
                foreach ($champion['tags'] as $tag) {
                    if($i==0){$champion_tag .= $tag;}else{$champion_tag .= ','.$tag;}
                    $i ++;
                }
                $toUpdate = array(
                  'tags' => $champion_tag
                );
                $where = array (
                  'api_id' => $champion['id']
                );

                @$oMySQL->update('rt_champions', $toUpdate, $where);
            }

        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        };
    }
    
    
    function displayChampions($test, $oMySQL)
    {
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/champion/';
        $champions = $oMySQL->select('rt_champions');
        //$test->debug($champions);
        echo '<table><th>Champion</th><th>Image</th>';
        foreach ($champions as $champion) {
            $img = $image_prefix . $champion['image_full'];
            echo '<tr><td>' . $champion['name'] .'<td><td><img src="' . $img . '"/></td></tr>';
        }
        echo '</table>';
    }
    
    function getChampionsImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/champions';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/champion/';
        $champions = $oMySQL->select('rt_champions');
        foreach ($champions as $champion) {
            $img = $image_prefix . $champion['image_full'];
            echo $img . '<br/>';
            //echo $dir . '/' .$champion['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $champion['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }    
    
    
    
    
    
    

