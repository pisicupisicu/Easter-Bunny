<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/compile.css" type="text/css" rel="stylesheet"/>
<!--        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>        
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once 'includes/config.php';
        require_once 'includes/class.MySQL.php';
        require_once 'static/Champions.php';
        require_once 'static/Spells.php';
        require_once 'static/Masteries.php';
        require_once 'static/Maps.php';
        require_once 'static/Runes.php';
        require_once 'riot/WrapperRiot.php';

        $oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
        $champions = new Champions($oMySQL);
        $spells = new Spells($oMySQL);
        $masteries = new Masteries($oMySQL);
        $maps = new Maps($oMySQL);
        $runes = new Runes($oMySQL);
        
        $summonners = array(
            0 => array('name' => 'Banhammer Live', 'id' => 25132718),
            1 => array('name' => 'Snowflakeyuki', 'id' => 36826926),
            2 => array('name' => 'VivÃ ', 'id' => 48179352),
            3 => array('name' => 'DR luca', 'id' => 27030988),
            4 => array('name' => 'Gekoz', 'id' => 24501468),
            5 => array('name' => 'TakiDzikus', 'id' => 35511199),
            6 => array('name' => 'Hroula', 'id' => 48630926),
            7 => array('name' => 'Lolindyr', 'id' => 51076531),
            8 => array('name' => 'GodJinx', 'id' => 21020094),
            9 => array('name' => 'SUXY', 'id' => 19969803),
            10 => array('name' => 'Bloody Diana', 'id' => 23675633),
            11 => array('name' => 'Lud Ka Struja', 'id' => 25236798)
        );
        
        // https://eune.api.pvp.net/api/lol/eune/v1.4/summoner/by-name/?api_key=b47507e5-3e3b-440f-b442-6c587f02fb14
        // https://eune.api.pvp.net/api/lol/eune/v1.4/summoner/by-name/FNC Rekkles?api_key=b47507e5-3e3b-440f-b442-6c587f02fb14

        $region = $summonerName = '';
        if(isset($_GET['region']) && !empty($_GET['region']))
        {
            $region = strtolower($_GET['region']);
        }
//        $id = 1;
//
//        $summonerName = $summonners[$id]['name'];
//        $summonerId = $summonners[$id]['id'];
        
        //displayError();die;


        $test = new WrapperRiot($region, $oMySQL);
        //$test->getLeague($summoner_id);
        //$structure = $test->getCurrentGame($summoner_id);        
        //displayCurrentGame($test, 'home', $summoner_id, $champions, $spells, $masteries);
        //displayCurrentGame($test, 'away', $summoner_id, $champions, $spells, $masteries);
        
        if(isset($_GET['name']) && !empty($_GET['name']))
        {
            $summonerName  = $_GET['name'];
            //$summonerId = $test->getSummonerId($_GET['name']);
            //echo $summonerId;                
        }
        
        try {
            $structure = getData($test, $summonerName, $champions, $spells, $masteries, $maps, $runes);
            displayCurrentGameHeader($summonerName, $region, $structure);
            displayCurrentGame('home', $structure);
            displayCurrentGame('away', $structure);
            displayCurrentGameBottom();
        } catch (Exception $ex) {
            //displayError($summonerName, $ex->getTraceAsString());
            displayError($summonerName);
        }
        
        function getData(WrapperRiot $test, $summonerName, $champions, $spells, $masteries, $maps, $runes)
        {
            $teams = array('home', 'away');
            $summonerId = $test->getSummonerId($summonerName);
            $structure = $test->getCurrentGame($summonerId);
            $map = $maps->getMapsById($structure['mapId']);
            $structure['map'] = $map['map_name'];
                        
            for ($i = 0; $i < 5; $i++) {
                foreach ($teams as $team) {
                    $structure[$team]['users'][$i]['champion'] = $champions->getChampionsById($structure[$team]['users'][$i]['championId']);
                    $structure[$team]['users'][$i]['spell1'] = $spells->getSpellsById($structure[$team]['users'][$i]['spell1Id']);
                    $structure[$team]['users'][$i]['spell2'] = $spells->getSpellsById($structure[$team]['users'][$i]['spell2Id']);
                    
                    $currentSummonerId = $test->getSummonerId($structure[$team]['users'][$i]['summonerName']);
                    $matchStats = $test->getMatchStats($currentSummonerId, $structure[$team]['users'][$i]['championId']);
                    $structure[$team]['users'][$i]['matchStats']['total'] = $matchStats['total'];
                    $structure[$team]['users'][$i]['matchStats']['avg_kills'] = $matchStats['avg_kills'];
                    $structure[$team]['users'][$i]['matchStats']['avg_assists'] = $matchStats['avg_assists'];
                    $structure[$team]['users'][$i]['matchStats']['avg_deaths'] = $matchStats['avg_deaths'];
                    
                    $currentUser = $test->getUserLeagueInfo($currentSummonerId);
                    $structure['queue'] = $currentUser['queue'];
                    $structure[$team]['users'][$i]['tier'] = $currentUser['tier'];
                    $structure[$team]['users'][$i]['division'] = $currentUser['division'];
                    $structure[$team]['users'][$i]['leaguePoints'] = $currentUser['leaguePoints'];
                    
                    $masteriesCurrentUser = $masteries->computeMasteries($structure[$team]['users'][$i]['masteries']);
                    $structure[$team]['users'][$i]['Offense'] = $masteriesCurrentUser['Offense'];
                    $structure[$team]['users'][$i]['Defense'] = $masteriesCurrentUser['Defense'];
                    $structure[$team]['users'][$i]['Utility'] = $masteriesCurrentUser['Utility'];
                    
                    $structure[$team]['users'][$i]['runes_description'] = '';
                    
                    foreach ($structure[$team]['users'][$i]['runes'] as $rune) {
                        $tempRune = $runes->getRunesById($rune['runeId']);
                        // $structure[$team]['users'][$i]['runes_description'] .= $tempRune['description'] .'-'. $tempRune['rune_id']. PHP_EOL;
                        $structure[$team]['users'][$i]['runes_description'] .= $tempRune['description'] . PHP_EOL;
                    }                                        
                    
                    $stats = $test->getStats($currentSummonerId);
                    $structure[$team]['users'][$i]['unranked_wins'] = $stats['unranked_wins'];
                    $structure[$team]['users'][$i]['ranked_wins'] = $stats['ranked_wins'];
                    $structure[$team]['users'][$i]['ranked_losses'] = $stats['ranked_losses'];                   
                }
            }
            
            foreach ($teams as $team) {
                for ($i = 0; $i < 3; $i++) {
                    $bannedChampion = $champions->getChampionsById($structure[$team]['bannedChampions'][$i]['championId']);
                    $structure[$team]['bannedChampions'][$i]['img'] = $bannedChampion['image_full'];
                    $structure[$team]['bannedChampions'][$i]['name'] = $bannedChampion['name'];
                }                                
            }
            
            
            return $structure;
        }
        
        function displayCurrentGameHeader($summonerName, $region, $structure)
        {
            ?>
        <div class="noxia-search-results" >
            <div class="noxia-search j-noxia-search">
                <div class="header-bar">
                    <h2><?php echo $summonerName; ?> <small><?php echo $structure['map']; ?>, <?php echo $structure['queue']; ?> - <?php echo strtoupper($region); ?></small></h2>
                </div>                    
            <?php
        }
        
        function displayCurrentGameBottom()
        {
            ?>
            </div>
        </div>                
            <?php
        }
                
        function displayCurrentGame($team, $structure) 
        {
            ?>
        <div class="team-<?php echo $team == 'home' ? '1' : '2'; ?>">

            <table>
                <thead>
                    <tr>
                        <th class="name">Name</th>
                        <th class="champion">Champion</th>

                        <th class="current-season">Current Season</th>

                        <th class="nw">Wins</th>            
                        <th class="rw">Ranked Wins</th>
                        <th class="kd"><span title="&lt;h2&gt;Champion KDA&lt;/h2&gt;The average kills, deaths and assists of this player, for this champion." class="tip">KDA</span></th>
                        <th class="runes">Runes</th>
                        <th class="masteries">Masteries</th>
                    </tr>
                </thead>

            <?php
            for ($i = 0; $i < 5; $i++) { ?>    
                <tr class="<?php if ($i == 1) echo 'searched'; ?> ">
                    <td class="name">
                        <a onclick="Noxia.trackOutboundLink(this, 'OffSiteLinks', 'OPGG Click Europe Nordic &amp; East');" target="outbound" href="http://eune.op.gg/summoner/userName=qwickpl">
                            <span><?php echo $structure[$team]['users'][$i]['summonerName']; ?></span>
                        </a>

                    </td>

                    <td class="champion">
                        <img src="assets/images/champions/<?php echo $structure[$team]['users'][$i]['champion']['image_full']; ?>" alt="<?php echo $structure[$team]['users'][$i]['champion']['name']; ?>" width="28px" height="28px"/>
                        <i class="icon champions-lol-28 master-yi"></i>

                        <div class="summoner-spells">
                            <img src="assets/images/spells/<?php echo $structure[$team]['users'][$i]['spell1']['image_full']; ?>" alt="<?php echo $structure[$team]['users'][$i]['spell1']['spell_name']; ?>" width="28px" height="28px" title="<?php echo $structure[$team]['users'][$i]['spell1']['spell_name']; ?>" width="28px" height="28px"/>
                            <img src="assets/images/spells/<?php echo $structure[$team]['users'][$i]['spell2']['image_full']; ?>" alt="<?php echo $structure[$team]['users'][$i]['spell2']['spell_name']; ?>" width="28px" height="28px" title="<?php echo $structure[$team]['users'][$i]['spell2']['spell_name']; ?>" width="28px" height="28px"/>
                        </div>

                        <span><?php echo $structure[$team]['users'][$i]['champion']['name']; ?>

                            (<b title="&lt;h2&gt;Champion Games&lt;/h2&gt;The number of games played with this champion." class="num-games tip"><?php echo $structure[$team]['users'][$i]['matchStats']['total']; ?></b>)</span>

                    </td>

                    <td class="current-season">
                        <div class="ranking">
                            <img src="assets/images/divisions/<?php echo strtolower($structure[$team]['users'][$i]['tier']); ?>.png" width="28px" height="28px"/><?php echo $structure[$team]['users'][$i]['tier']; ?> <?php echo $structure[$team]['users'][$i]['division']; ?> (<b><?php echo $structure[$team]['users'][$i]['leaguePoints']; ?> LP</b>)

                        </div>
                    </td>  


                    <td class="normal-wins">
                        <span title="&lt;h2&gt;Summoner Level&lt;/h2&gt;Level 30" class="normal-wins-span tip"><?php echo htmlentities($structure[$team]['users'][$i]['unranked_wins']); ?></span>
                    </td>

                    <td class="ranked-wins-losses">
                        <div>
                            <span class="ranked-wins"><?php echo $structure[$team]['users'][$i]['ranked_wins']; ?></span>
                            <span class="slash">/</span><span class="ranked-losses"><?php echo $structure[$team]['users'][$i]['ranked_losses']; ?></span>
                        </div>
                    </td>    
                    <td class="champion-kda">

                        <span class="kills"><?php echo $structure[$team]['users'][$i]['matchStats']['avg_kills']; ?></span><span class="slash">/</span><span class="deaths"><?php echo $structure[$team]['users'][$i]['matchStats']['avg_deaths']; ?></span><span class="slash">/</span><span class="assists"><?php echo $structure[$team]['users'][$i]['matchStats']['avg_assists']; ?></span>
                    </td>


                    <td class="runes">
                        <span class="tip" title="<?php echo $structure[$team]['users'][$i]['runes_description']; ?>">Runes<div class="tooltip-html"><div><h2>Runes</h2>+19.8% attack speed<br>+1.44 magic resist per level (25.92 at level 18)<br>+11.97 health per level (215.46 at level 18)<br>+8.52 armor</div></div></span>
                    </td> 

                    <td class="masteries j-masteries-modal-link">
                        <div class="j-masteries-modal-html hide">

                        </div>

                        <a class="green-button tip" data-toggle="modal" data-target="#myModal<?php echo '-'.$team.'-'.$i;?>" data-toggle="tooltip" title="<?php echo $structure[$team]['users'][$i]['Offense'] . '/' . $structure[$team]['users'][$i]['Defense'] . '/' . $structure[$team]['users'][$i]['Utility']; ?>">
                            <div class="tooltip-html" >
                                <h2></h2>                     
                                <p><b>21</b> Offense
                                    <br><b>9</b> Defense
                                    <br><b>0</b> Utility</p>
                                <p>Note: Click button for full mastery tree.</p>
                            </div>
                            <span class="offense"><?php echo $structure[$team]['users'][$i]['Offense']; ?></span>/<span class="defense"><?php echo $structure[$team]['users'][$i]['Defense']; ?></span>/<span class="utility"><?php echo $structure[$team]['users'][$i]['Utility']; ?></span>
                        </a>
                    </td>

                </tr>    
                
                

<!--         Modal 
        <div class="modal fade" id="myModal<?php echo '-'.$team.'-'.$i; ?>" role="dialog">
            <div class="modal-dialog" style="width:880px;">

                 Modal content
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Masteries</h4>
                    </div>
                    <div class="modal-body">

                        <table class="talent-table">                           
                            <tr>
                                <td>
                                        jkhkjh
                                </td>
                            </tr>
                        </table>

                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
         END Modal -->
                
                                <?php
                                }
                                ?>


            </table>
            
            <div class="team-footer">                
                <div>
                    <span>Banned Champions</span>
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                    <img src="assets/images/champions/<?php echo $structure[$team]['bannedChampions'][$i]['img']; ?>" title="<?php echo 'Ban #' . $i . ' ' . $structure[$team]['bannedChampions'][$i]['name']; ?>" width="28px" height="28px"/>                    
                    <?php } ?>                    
                </div>
            </div>
            
        </div>                                        

<?php } 

    function displayError($summonerName, $error = '')
    {
        ?>
        <div data-character-name="Bloody Diana" data-region-code="EUNE" id="noxia-search-results">
            <div class="error" style="color:#FFF;text-align: center;font-size:18px;">
                The summoner <?php echo $summonerName; ?> is not currently in a game.<br/>
                <?php echo $error; ?>
            </div>                
        </div>
        <div class="search-box hide j-search-box" style="display: block;">            

            <div class="search-scouter">
                <form id="search-form" method="GET" action="http://www.teemo.dev/api/api_search.php" novalidate="novalidate">
                    <input type="search" placeholder="Search player in a match" name="name" id="name-search" class="valid"><input type="submit" value="Search" id="new-search-submit" class="new-search">

                    <div class="new-button-wrapper j-noxia-search">

                        <input type="radio" value="NA" id="NA" name="region">
                        <label title="North America" class="tip" for="NA">
                            NA
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="EUW" id="EUW" name="region">
                        <label title="Europe West" class="tip" for="EUW">
                            EUW
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="EUNE" id="EUNE" name="region" checked="&quot;checked&quot;&quot;">
                        <label title="Europe Nordic &amp; East" class="tip" for="EUNE">
                            EUNE
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="BR" id="BR" name="region">
                        <label title="Brazil" class="tip" for="BR">
                            BR
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="TR" id="TR" name="region">
                        <label title="Turkey" class="tip" for="TR">
                            TR
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="RU" id="RU" name="region">
                        <label title="Russia" class="tip" for="RU">
                            RU
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="LAN" id="LAN" name="region">
                        <label title="Latin America North" class="tip" for="LAN">
                            LAN
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="LAS" id="LAS" name="region">
                        <label title="Latin America South" class="tip" for="LAS">
                            LAS
                            <span class="label-helper"></span>
                        </label>

                        <input type="radio" value="OCE" id="OCE" name="region">
                        <label title="Oceania" class="tip" for="OCE">
                            OCE
                            <span class="label-helper"></span>
                        </label>

                    </div>
                </form>        
            </div>

        </div>
        <?php
    }
?>

    </table>

</div>

</div>


</body>
</html>

