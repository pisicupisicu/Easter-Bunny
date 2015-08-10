<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/compile.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
        require_once 'riot/WrapperRiot.php';

        $oMySQL = new MySQL(DB_NAME, DB_USERNAME, DB_PASSWORD);
        $champions = new Champions($oMySQL);
        $spells = new Spells($oMySQL);
        $masteries = new Masteries($oMySQL);

        $summonners = array(
            0 => array('name' => 'Banhammer Live', 'id' => 25132718),
            1 => array('name' => 'Snowflakeyuki', 'id' => 36826926),
            2 => array('name' => 'Vivà', 'id' => 48179352),
            3 => array('name' => 'DR luca', 'id' => 27030988),
            4 => array('name' => 'Gekoz', 'id' => 24501468),
            5 => array('name' => 'TakiDzikus', 'id' => 35511199),
            6 => array('name' => 'Hroula', 'id' => 48630926),
            7 => array('name' => 'Lolindyr', 'id' => 51076531),
            8 => array('name' => 'GodJinx', 'id' => 21020094),
            9 => array('name' => 'SUXY', 'id' => 19969803),
            10 => array('name' => 'Bloody Diana', 'id' => 23675633),
        );

        // https://eune.api.pvp.net/api/lol/eune/v1.4/summoner/by-name/?api_key=b47507e5-3e3b-440f-b442-6c587f02fb14
        // https://eune.api.pvp.net/api/lol/eune/v1.4/summoner/by-name/FNC Rekkles?api_key=b47507e5-3e3b-440f-b442-6c587f02fb14

        $region = 'eune';
        $id = 10;

        $summoner_name = $summonners[$id]['name'];
        $summoner_id = $summonners[$id]['id'];


        $test = new WrapperRiot($region, $oMySQL);
        //$test->getLeague($summoner_id);
        //$structure = $test->getCurrentGame($summoner_id);        
        displayCurrentGame($test, 'home', $summoner_id, $champions, $spells, $masteries);
        displayCurrentGame($test, 'away', $summoner_id, $champions, $spells, $masteries);

        function displayCurrentGame(WrapperRiot $test, $team, $summoner_id, $champions, $spells, $masteries) {
            $structure = $test->getCurrentGame($summoner_id);
            ?>
            <div class="noxia-search-results" >
                <div class="noxia-search j-noxia-search">
                    <div class="header-bar">
                        <h2>Overkill92 <small>Summoner's Rift, Ranked Solo 5v5 - EUNE</small></h2>
                    </div>
                    <div class="team-1">

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
                            <tbody>
    <?php for ($i = 0; $i < 5; $i++) { ?>    
                                    <tr class="<?php if ($i == 1) echo 'searched'; ?> ">
                                        <td class="name">
                                            <a onclick="Noxia.trackOutboundLink(this, 'OffSiteLinks', 'OPGG Click Europe Nordic &amp; East');" target="outbound" href="http://eune.op.gg/summoner/userName=qwickpl">
                                                <span><?php echo $structure[$team]['users'][$i]['summonerName']; ?></span>
                                            </a>

                                        </td>

        <?php
        $champion = $champions->getChampionsById($structure[$team]['users'][$i]['championId']);
        $spell1 = $spells->getSpellsById($structure[$team]['users'][$i]['spell1Id']);
        $spell2 = $spells->getSpellsById($structure[$team]['users'][$i]['spell2Id']);

        $current_summoner_id = $test->getSummonerId($structure[$team]['users'][$i]['summonerName']);
        //$test->getMatchList($summoner1_id, $structure[$team]['users'][0]['championId']);
        $matchStats = $test->getMatchStats($current_summoner_id, $structure[$team]['users'][$i]['championId']);
        $currentUser = $test->getUserLeagueInfo($current_summoner_id);
        $masteriesCurrentUser = $masteries->computeMasteries($structure[$team]['users'][$i]['masteries']);
        $stats = $test->getStats($current_summoner_id);
        //$test->debug($masteriesCurrentUser);die;
        ?>
                                        <td class="champion">
                                            <img src="assets/images/champions/<?php echo $champion['image_full']; ?>" alt="<?php echo $champion['name']; ?>" width="28px" height="28px"/>
                                            <i class="icon champions-lol-28 master-yi"></i>

                                            <div class="summoner-spells">
                                                <img src="assets/images/spells/<?php echo $spell1['image_full']; ?>" alt="<?php echo $spell1['spell_name']; ?>" width="28px" height="28px" title="<?php echo $spell1['spell_name']; ?>" width="28px" height="28px"/>
                                                <img src="assets/images/spells/<?php echo $spell2['image_full']; ?>" alt="<?php echo $spell2['spell_name']; ?>" width="28px" height="28px" title="<?php echo $spell2['spell_name']; ?>" width="28px" height="28px"/>
                                            </div>

                                            <span><?php echo $champion['name']; ?>

                                                (<b title="&lt;h2&gt;Champion Games&lt;/h2&gt;The number of games played with this champion." class="num-games tip"><?php echo $matchStats['total']; ?></b>)</span>

                                        </td>
                                        
                                        <td class="current-season">
                                            <div class="ranking">
                                                <img src="assets/images/divisions/<?php echo strtolower($currentUser['tier']); ?>.png" width="28px" height="28px"/><?php echo $currentUser['tier']; ?> <?php echo $currentUser['division']; ?> (<b><?php echo $currentUser['leaguePoints']; ?> LP</b>)

                                            </div>
                                        </td>  


                                        <td class="normal-wins">
                                            <span title="&lt;h2&gt;Summoner Level&lt;/h2&gt;Level 30" class="normal-wins-span tip"><?php echo $stats['unranked_wins']; ?></span>
                                        </td>

                                        <td class="ranked-wins-losses">
                                            <div>
                                                <span class="ranked-wins"><?php echo $stats['ranked_wins']; ?></span>
                                                <span class="slash">/</span><span class="ranked-losses"><?php echo $stats['ranked_losses']; ?></span>
                                            </div>
                                        </td>    
                                        <td class="champion-kda">

                                            <span class="kills"><?php echo $matchStats['avg_kills']; ?></span><span class="slash">/</span><span class="deaths"><?php echo $matchStats['avg_deaths']; ?></span><span class="slash">/</span><span class="assists"><?php echo $matchStats['avg_assists']; ?></span>
                                        </td>


                                        <td class="runes">
                                            <span class="tip">Runes<div class="tooltip-html"><div><h2>Runes</h2>+19.8% attack speed<br>+1.44 magic resist per level (25.92 at level 18)<br>+11.97 health per level (215.46 at level 18)<br>+8.52 armor</div></div></span>
                                        </td> 

                                        <td class="masteries j-masteries-modal-link">
                                            <div class="j-masteries-modal-html hide">

                                            </div>

                                            <a class="green-button tip" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" title="<?php echo $masteriesCurrentUser['Offense'] . '/' . $masteriesCurrentUser['Defense'] . '/' . $masteriesCurrentUser['Utility']; ?>">
                                                <div class="tooltip-html" >
                                                    <h2></h2>                     
                                                    <p><b>21</b> Offense
                                                        <br><b>9</b> Defense
                                                        <br><b>0</b> Utility</p>
                                                    <p>Note: Click button for full mastery tree.</p>
                                                </div>
                                                <span class="offense"><?php echo $masteriesCurrentUser['Offense']; ?></span>/<span class="defense"><?php echo $masteriesCurrentUser['Defense']; ?></span>/<span class="utility"><?php echo $masteriesCurrentUser['Utility']; ?></span>
                                            </a>
                                        </td>

                                    </tr>    
                                <?php
                                }
                                ?>


                                </tbody>
                            </table>

                        </div>                                        

                    </div>
                </div>
            </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="width:840px;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Masteries</h4>
                    </div>
                    <div class="modal-body">

                        <table class="talent-table">
                            <tbody>
                                <tr>

                                    <td>
                                        <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/bg/offense.jpg);" class="talent-tree">


                                            <div style="position: absolute; left: 18px; bottom: 455px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Double-Edged Sword</h2>
                                                    <div class="item-description">Melee - Deal an additional 2% damage and receive an additional 1% damage<br>Ranged - Deal an additional 1.5% damage and receive an additional 1.5% damage</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: 0px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Fury</h2>
                                                    <div class="item-description">+1.25% Attack Speed</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -49px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/4</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 455px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Sorcery</h2>
                                                    <div class="item-description">+1.25% Cooldown Reduction</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -98px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">4/4</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Butcher</h2>
                                                    <div class="item-description">Basic attacks and single target spells deal an additional 2 damage to minions and monsters<br><br>This does not trigger off of area of effect damage or damage over time effects</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -147px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 377px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Expose Weakness</h2>
                                                    <div class="item-description">Damaging an enemy with a spell increases allied champions' damage to that enemy by 1% for the next 3 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -196px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Brute Force</h2>
                                                    <div class="item-description">+4 Attack Damage at level 18 (+0.22 Attack Damage per level)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -245px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 377px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Mental Force</h2>
                                                    <div class="item-description">+6 Ability Power at level 18 (+0.33 Ability Power per level)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -294px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Feast</h2>
                                                    <div class="item-description">Killing a unit restores 3 Health and 1 Mana</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -343px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Spell Weaving</h2>
                                                    <div class="item-description">Damaging an enemy champion with a Basic Attack increases Spell Damage by 1%, stacking up to 3 times (max 3% damage increase)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -392px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Martial Mastery</h2>
                                                    <div class="item-description">+4 Attack Damage</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -441px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 299px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Arcane Mastery</h2>
                                                    <div class="item-description">+6 Ability Power</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -490px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 299px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Executioner</h2>
                                                    <div class="item-description">Increases damage dealt to champions below 20% Health by 5%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -539px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Blade Weaving</h2>
                                                    <div class="item-description">Damaging an enemy champion with a spell increases Basic Attack Damage by 1%, stacking up to 3 times (max 3% damage increase)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -588px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Warlord</h2>
                                                    <div class="item-description">Increases bonus Attack Damage by 2%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -637px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 221px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Archmage</h2>
                                                    <div class="item-description">Increases Ability Power by 2%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -686px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 221px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Dangerous Game</h2>
                                                    <div class="item-description">Champion kills and assists restore 5% missing Health and Mana</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -735px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Frenzy</h2>
                                                    <div class="item-description">Critical hits grant +5% Attack Speed for 3 seconds (stacks up to 3 times)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -784px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 143px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Devastating Strikes</h2>
                                                    <div class="item-description">+2% Armor and Magic Penetration</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -833px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 143px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Arcane Blade</h2>
                                                    <div class="item-description">Basic Attacks also deal bonus magic damage equal to 5% of Ability Power</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -882px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 65px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Havoc</h2>
                                                    <div class="item-description">+3% increased damage</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/offense.jpg); background-position: -931px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>
                                            <div class="talent-tree-label">22 Offense</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/bg/defense.jpg);" class="talent-tree">


                                            <div style="position: absolute; left: 18px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Block</h2>
                                                    <div class="item-description">Reduces incoming damage from champion basic attacks by 1</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: 0px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/2</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Recovery</h2>
                                                    <div class="item-description">+1 Health per 5 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -49px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/2</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Swiftness</h2>
                                                    <div class="item-description">Reduces the effectiveness of slows by 7.5%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -98px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/2</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Tough Skin</h2>
                                                    <div class="item-description">Reduces damage taken from neutral monsters by 1<br><br>This does not affect lane minions</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -147px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/2</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Unyielding</h2>
                                                    <div class="item-description">Melee - Reduces all incoming damage from champions by 2<br>Ranged - Reduces all incoming damage from champions by 1</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -196px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Veteran's Scars</h2>
                                                    <div class="item-description">+12 Health</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -245px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Bladed Armor</h2>
                                                    <div class="item-description">Taking Basic Attack Damage from neutral monsters cause them to bleed, dealing physical damage equal to 1% of their current Health each second<br>This does not work against lane minions</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -294px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Tenacious</h2>
                                                    <div class="item-description">Reduces the duration of crowd control effects by 10%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -343px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Juggernaut</h2>
                                                    <div class="item-description">+3% Maximum Health</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -392px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Hardiness</h2>
                                                    <div class="item-description">+2 Armor</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -441px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Resistance</h2>
                                                    <div class="item-description">+2 Magic Resist</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -490px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Perseverance</h2>
                                                    <div class="item-description">Regenerates 0.35% of missing Health every 5 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -539px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Adaptive Armor</h2>
                                                    <div class="item-description">Gain 4% of your bonus Armor as Magic Resist if you have more bonus Armor than bonus Magic Resist<br><br>Gain 4% of your bonus Magic Resist as Armor if you have more bonus Magic Resist than bonus Armor</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -588px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Reinforced Armor</h2>
                                                    <div class="item-description">Reduces the total damage taken from critical strikes by 10%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -637px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Evasive</h2>
                                                    <div class="item-description">Reduces damage taken by 4% from Area of Effect magic damage</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -686px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Second Wind</h2>
                                                    <div class="item-description">Increases self-healing, Health Regen, Lifesteal, and Spellvamp by 10% when below 25% Health</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -735px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Enchanted Armor</h2>
                                                    <div class="item-description">Increases bonus Armor and Magic Resist by 2.5%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -784px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/4</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Oppression</h2>
                                                    <div class="item-description">Reduces damage taken by 2% from enemies that have impaired movement (slows, snares, taunts, stuns, etc.)</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -833px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 65px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Legendary Guardian</h2>
                                                    <div class="item-description">+3 Armor and Magic Resist for each nearby enemy champion</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/defense.jpg); background-position: -882px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>
                                            <div class="talent-tree-label">0 Defense</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/bg/utility.jpg);" class="talent-tree">


                                            <div style="position: absolute; left: 18px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Phasewalker</h2>
                                                    <div class="item-description">Reduces the casting time of Recall by 1 second<br><br>Dominion - Reduces the casting time of Enhanced Recall by 0.5 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: 0px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 455px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Fleet of Foot</h2>
                                                    <div class="item-description">+0.5% Movement Speed</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -49px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/3</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 455px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Expanded Mind</h2>
                                                    <div class="item-description">+25 Mana</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -98px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 455px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Scout</h2>
                                                    <div class="item-description">Increases the cast range of trinket items by 15%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -147px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 377px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Summoner's Insight</h2>
                                                    <div class="item-description">Reduces the cooldown of Summoner Spells by 4%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -196px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">3/3</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 377px;" class="talent-icon-container tip icon-active">
                                                <div class="tooltip-html">
                                                    <h2>Strength of Spirit</h2>
                                                    <div class="item-description">+1 Health Regen per 5 seconds for every 300 maximum Mana</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -245px 0px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-active">1/1</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 377px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Alchemist</h2>
                                                    <div class="item-description">Increases the duration of potions and elixirs by 10%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -294px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Greed</h2>
                                                    <div class="item-description">+0.5 Gold every 10 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -343px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Runic Affinity</h2>
                                                    <div class="item-description">Increases the duration of shrine, relic, quest, and neutral monster buffs by 20%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -392px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Vampirism</h2>
                                                    <div class="item-description">+1% Lifesteal and Spellvamp</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -441px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 299px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Culinary Master</h2>
                                                    <div class="item-description">Health potions are upgraded into Biscuits that restore an additional 20 Health and 10 Mana instantly upon consumption</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -490px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 18px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Scavenger</h2>
                                                    <div class="item-description">+1 Gold each time an ally kills a nearby lane minion</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -539px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Wealth</h2>
                                                    <div class="item-description">+40 Starting Gold</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -588px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Meditation</h2>
                                                    <div class="item-description">Restore 0.5% of missing Mana every 5 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -637px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 204px; bottom: 221px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Inspiration</h2>
                                                    <div class="item-description">+10 Experience every 10 seconds while near a higher level allied champion</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -686px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/2</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Bandit</h2>
                                                    <div class="item-description">Grants +3 Gold (+8 Gold on Melee champion) each time an enemy champion is attacked. This cannot trigger on the same champion more than once every 5 seconds</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -735px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>

                                            <div style="position: absolute; left: 142px; bottom: 143px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Intelligence</h2>
                                                    <div class="item-description">+2% Cooldown Reduction and reduces the cooldown of Activated Items by 8%</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -784px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/3</span>
                                            </div>

                                            <div style="position: absolute; left: 80px; bottom: 65px;" class="talent-icon-container tip icon-disabled">
                                                <div class="tooltip-html">
                                                    <h2>Wanderer</h2>
                                                    <div class="item-description">+20 Movement Speed out of combat</div>
                                                </div>
                                                <div class="iconmedium">
                                                    <div style="background-image: url(http://static-noxia.cursecdn.com/1-0-5647-17720/Skins/Noxia/images/LoL/talents/utility.jpg); background-position: -833px -49px;" class="sprite"></div>
                                                </div>
                                                <span style="display: block;" class="points points-diabled">0/1</span>
                                            </div>
                                            <div class="talent-tree-label">8 Utility</div>
                                        </div>
                                    </td>

                                </tr>
<?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div> <!-- END MODAL -->

</body>
</html>

