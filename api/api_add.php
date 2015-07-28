<?php
    require_once 'includes/config.php';
    require_once 'includes/class.MySQL.php';
    include('php-riot-api.php');
    
    $oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    $summoner_name = "Banhammer Live";
    $summoner_id = 25132718;

    $test = new Riotapi('eune');
        
    // addChampions($test, $oMySQL);
    // addChampionsTags($test, $oMySQL);
    // addMaps($test, $oMySQL);
    // addSpells($test, $oMySQL);
    // addItems($test, $oMySQL);
    // addMasteries($test, $oMySQL);
    // addRunes($test, $oMySQL);
    
    // displayChampions($test, $oMySQL);
    
    // getChampionsImages($test, $oMySQL);
    // getItemsImages($test, $oMySQL);
    // getMapsImages($test, $oMySQL);
    // getSpellsImages($test, $oMySQL);
    // getRunesImages($test, $oMySQL);
    // getMasteriesImages($test, $oMySQL);
    
    
    // INSERT DATA IN DB
    
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
    
    function addMasteries($test, $oMySQL)
    {
            $request = $test->getAllMasteries();
            //$test->debug($request);

            foreach ($request['data'] as $mastery) {
               
               $full_description = '';
               foreach($mastery['sanitizedDescription'] as $description) {
                   $full_description .= $description;
                   $full_description .= ' | ';
               }   
            
                $toInsert = array(
                  'ranks' => $mastery['ranks'],
                  'mastery_id' => $mastery['id'],
                  'description' => $full_description,
                  'mastery_name' => $mastery['name'],
                  'prereq' => $mastery['prereq'],
                  'masteryTree' => $mastery['masteryTree'],
                  'image_full' => $mastery['image']['full'],
                  'image_sprite' => $mastery['image']['sprite']
                );

                @$oMySQL->insert('rt_masteries', $toInsert);
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
            //$test->debug($request);

            foreach ($request['data'] as $spells) {
                $toInsert = array(
                  'spell_id' => $spells['id'],
                  'description' => $spells['sanitizedDescription'],
                  'spell_name' => $spells['name'],
                  'costType' => $spells['costType'],
                  'cooldownBurn' => $spells['cooldownBurn'],
                  'rangeBurn' => $spells['rangeBurn'],
                  'key' => $spells['key'],
                  'summonerLevel' => $spells['summonerLevel'],
                  'image_full' => $spells['image']['full'],
                  'image_sprite' => $spells['image']['sprite']
                );

                @$oMySQL->insert('rt_spells', $toInsert);
            }

    }
    
    function addItems($test, $oMySQL)
    {
            $request = $test->getAllItems();
            //$test->debug($request);

            foreach ($request['data'] as $item) {
                $toInsert = array(
                  'item_id' => $item['id'],
                  'description' => $item['sanitizedDescription'],
                  'item_name' => $item['name'],
                  'group' => $item['group'],
                  'image_full' => $item['image']['full'],
                  'image_sprite' => $item['image']['sprite']
                );

                @$oMySQL->insert('rt_items', $toInsert);
            }

    }
    
    function addRunes($test, $oMySQL)
    {
            $request = $test->getAllRunes();
            //$test->debug($request);

            foreach ($request['data'] as $rune) {

               $tags = '';
               foreach($rune['tags'] as $description) {
                   $tags .= $description;
                   $tags .= ' | ';
               }
                
                $toInsert = array(
                  'rune_id' => $rune['id'],
                  'description' => $rune['sanitizedDescription'],
                  'rune_name' => $rune['name'],
                  'tags' => $tags,
                  'isRune' => $rune['rune']['isRune'],
                  'tier' => $rune['rune']['tier'],
                  'type' => $rune['rune']['type'],
                  'image_full' => $rune['image']['full'],
                  'image_sprite' => $rune['image']['sprite']
                );

                @$oMySQL->insert('rt_runes', $toInsert);
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
    
    // END INSERT DATA IN DB
 
    // DISPLAY DB DATA
    
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
    
    // END DISPLAY DB DATA

    // GET IMAGES
    
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
    
    function getItemsImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/items';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/item/';
        $items = $oMySQL->select('rt_items');
        foreach ($items as $item) {
            $img = $image_prefix . $item['image_full'];
            echo $img . '<br/>';
            echo $dir . '/' .$item['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $item['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }
    
    function getMapsImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/maps';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/map/';
        
        $items = $oMySQL->select('rt_maps');
        foreach ($items as $item) {
            $img = $image_prefix . $item['image_full'];
            echo $img . '<br/>';
            echo $dir . '/' .$item['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $item['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }
    
        function getMasteriesImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/masteries';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/mastery/';
        
        $items = $oMySQL->select('rt_masteries');
        foreach ($items as $item) {
            $img = $image_prefix . $item['image_full'];
            echo $img . '<br/>';
            echo $dir . '/' .$item['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $item['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }
    
        function getRunesImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/runes';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/rune/';
        
        $items = $oMySQL->select('rt_runes');
        foreach ($items as $item) {
            $img = $image_prefix . $item['image_full'];
            echo $img . '<br/>';
            echo $dir . '/' .$item['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $item['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }
    
    function getSpellsImages($test, $oMySQL)
    {
        $dir =  getcwd() . '/assets/images/spells';
        $image_prefix = 'http://ddragon.leagueoflegends.com/cdn/5.2.1/img/spell/';
        
        $items = $oMySQL->select('rt_spells');
        foreach ($items as $item) {
            $img = $image_prefix . $item['image_full'];
            echo $img . '<br/>';
            echo $dir . '/' .$item['image_full'] .'<br/>';
            file_put_contents($dir . '/' . $item['image_full'], file_get_contents($img));
            //echo file_get_contents($img);            
        }
    }
    
    // END GET IMAGES