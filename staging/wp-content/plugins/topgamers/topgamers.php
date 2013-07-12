<?php
/*
Plugin Name: weStream Top Gamers
Plugin URI: 
Description: Top Gamers plugin for weStream. The admin can select which gamer to feature for the "Top Gamer" section on the Home page.
Version: 1.8
Author: Rey Necesito
Author URI: http://www.facebook.com/reyzman18
License:
	Copyright 2013  OpenKit 

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/    

    // $result = $wpdb->get_results("SELECT gameName FROM topplayerlist WHERE streamURI LIKE '%twitch.tv%' ORDER BY views DESC LIMIT 10");
    // foreach($result as $key){
    //     $result2 = $wpdb->get_results("SELECT playerName FROM topplayerlist WHERE gameName LIKE '%".$key->gameName."%' ORDER BY views DESC LIMIT 1");
    //     foreach ($result2 as $key2) {
    //         $url2 = 'https://api.twitch.tv/kraken/channels/'.$key2->playerName.'/videos';
    //         $data2 = file_get_contents($url2);
    //         $json_array2 = json_decode($data2, true);
    //         $views2 = 0;
    //         $user2;
    //         $vid2;   

    //         foreach ($json_array2['videos'] as $videos) {
    //             if($videos['views']>$views){
    //                 $views2 = $videos['views'];
    //                 $user2 = $videos['channel']['name'];
    //                 $vid2 = $videos['url'];
    //             }
    //         }

    //         $wpdb->update('topplayerlist',array('topvideo'=>$vid2),array('playerName'=> $key2->playerName));

    //     }
    // }

    add_action('admin_menu', 'topgamers_admin_actions');

    function topgamers_admin_actions(){
    	add_options_page('weStream Top Gamers','weStream Top Gamers','manage_options',__FILE__,'topgamers_admin');
    }

    function topgamers_admin(){
?>
        <style type='text/css'>
            table,th,td {border:solid 1px;padding:5px;border-collapse:collapse;text-align:center}
        </style>
        <script src='../wp-content/plugins/topgamers/jquery-1.10.1.js'></script>
        <script type="text/javascript">
            jQuery(function(){
                var max = 4;
                var checkboxes = $("input[id='gameselect']");
                                   
                checkboxes.change(function(){
                    var current = checkboxes.filter(':checked').length;
                    checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
                });
            });
        </script>

    	<div class="wrap">
		  Top Gamers plugin for weStream!
    	</div>
        <br>
    	<div>
        
<?php
        global $wpdb;
        $games = $wpdb->get_results("SELECT DISTINCT gameName FROM topplayerlist ORDER BY gameName ASC");
?>
        <b>Select games to display in Categories page: (Maximum of FOUR[4] games)</b><br>

        <table>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Selected</th>
                </tr>
            </thead>
            <tbody>

            <form action="<?php echo $PHP_SELF;?>" method="POST">           
<?php
            $boxes = $_POST['to_display'];
            $dbquery = "UPDATE topplayerlist SET topgamer = CASE  ";
            for($y=0;$y<count($boxes);$y++){
                $value = $boxes[$y];
                if($value == NULL) continue;
                if($_POST["PageUpdate"]){
                    $dbquery = $dbquery."WHEN gameName = '".$value."' THEN 1 ";
                }
                else{}
            }
            $dbquery = $dbquery."ELSE 0 END";
            $wpdb->query($dbquery);
            // if(!empty($_POST['to_display'])){
            //     $query = "UPDATE topplayerlist SET topgamer = CASE  ";
            //     foreach ($_POST['to_display'] as $check) {
            //         $query = $query."WHEN gameName = ".$check." THEN 1 ";
            //     }
            //     $query = $query."ELSE 0 END";
            //     $wpdb->query($query);
            // }

        foreach($games as $row){
            if($row->gameName != NULL){
                echo "<tr><td>";
                echo $row->gameName."</td><td>";
                echo "<input type='checkbox' name='to_display[]' id='gameselect' value='".$row->gameName."'></td>";
                echo "</tr>";
            }
        }
?>
                <tr><td colspan=2><input type='submit' value='Update Page' name='PageUpdate'></td></tr>
            </form>
            </tbody>
        </table>
        <hr>
<?php        

        echo "<b>Select the online streamers to display on the page:</b>";
        $result = $wpdb->get_results("SELECT * FROM topplayerlist WHERE streaming = 1 AND approved = 0");
        echo "
        <table>
            <thead>
                <tr>
                    <th>Player IGN</th>
                    <th>Player Name</th>
                    <th>Stream Site</th>
                    <th>Game</th>
                    <th>Display?</th>
                </tr>
            </thead>
            <tbody>";
        foreach($result as $rowx){
            echo "<tr><td>";
            echo $rowx->playerIGN."</td><td>";
            echo $rowx->playerName."</td><td>";
            echo $rowx->streamURI."</td><td>";
            echo $rowx->gameName."</td><td>";
            echo "<input type='checkbox'></td>";
            echo "</tr>";
        } 
        echo "
                <td>
            </tbody>
        </table>
        <input type='button' value='Update'>"
?>    	</div>
        <hr>
<!--     	<div>
    		<b>Approve pending players' registrations:</b> -->
<?php
        // $result2 = $wpdb->get_results("SELECT * FROM topplayerlist WHERE approved = 0");
        // echo "
        // <table>
        //     <thead>
        //         <tr>
        //             <th>Player IGN</th>
        //             <th>Player Name</th>
        //             <th>Stream Site</th>
        //             <th>Game</th>
        //             <th>Approve</th>
        //         </tr>
        //     </thead>
        //     <tbody>";
        // foreach($result2 as $row){
        //     echo "<tr><td>";
        //     echo $row->playerIGN."</td><td>";
        //     echo $row->playerName."</td><td>";
        //     echo $row->streamURI."</td><td>";
        //     echo $row->gameName."</td><td>";
        //     echo "<input type='checkbox'></td>";
        //     echo "</tr>";
        // }
        // echo "
        //     </tbody>
        // </table>";
?>
<!--     	</div> -->
<?php
    }
    
    function topgamers_plugin(){
?>
        <script src='../wp-content/plugins/topgamers/jquery-1.10.1.js'></script>
        <script type='text/javascript'>
            $(function(){
                function contentSwitcher(settings){
                    var settings = {
                       contentClass : '.content',
                       navigationId : '#gamelist'
                    };
             
                    //Hide all of the content except the first one on the nav
                    $(settings.contentClass).not(':first').hide();
                    $(settings.navigationId).find('li:first').addClass('active');
             
                    //onClick set the active state, 
                    //hide the content panels and show the correct one
                    $(settings.navigationId).find('a').click(function(e){
                        var contentToShow = $(this).attr('href');
                        contentToShow = $(contentToShow);
             
                        //dissable normal link behaviour
                        e.preventDefault();
             
                        //set the proper active class for active state css
                        $(settings.navigationId).find('li').removeClass('active');
                        $(this).parent('li').addClass('active');
             
                        //hide the old content and show the new
                        $(settings.contentClass).hide();
                        contentToShow.show();
                    });
                }
                contentSwitcher();
            });
        </script>

        <style type='text/css'>
            div#gamelist {

            }
            .displayed {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            table#listtable{
                width: 880px;
                padding-bottom: 50px;
            }
            th#gameicon {
                text-align:center;
            }
            tr#playerlist {
                vertical-align: text-top;
                text-align: left;
            }
            td#test{
                padding-left: 45px;
            }
        </style>
        <div id='gamelist' >
            <hr>
            <table id='listtable'>
                <thead id='listheader'>
                    <tr>
<?php
        global $wpdb;
        $topgame = $wpdb->get_results("SELECT DISTINCT gameName FROM  topplayerlist WHERE topgamer = 1 ORDER BY views");
        foreach ($topgame as $row) {
            if(file_exists(getcwd()."/wp-content/plugins/topgamers/".$row->gameName.".png")){
                echo "<th id='gameicon'><a href='#".str_replace(array(" ",":"),array("_","_"),$row->gameName)."'><input type='image' src='../wp-content/plugins/topgamers/".$row->gameName.".png' class='displayed'></a><br>".$row->gameName."</th>";
            }elseif ($row->gameName==="Call of Duty: Black Ops II") {
                echo "<th id='gameicon'><a href='#".str_replace(array(" ",":"),array("_","_"),$row->gameName)."'><input type='image' src='../wordpress/wp-content/plugins/topgamers/Call of Duty Black Ops II.png' class='displayed'></a><br>".$row->gameName."</th>";
            }elseif ($row->gameName==="World of Warcraft: Mists of Pandaria") {
                echo "<th id='gameicon'><a href='#".str_replace(array(" ",":"),array("_","_"),$row->gameName)."'><input type='image' src='../wp-content/plugins/topgamers/World of Warcraft Mists of Pandaria.png' class='displayed'></a><br>".$row->gameName."</th>";
            }elseif ($row->gameName==="Call of Duty: Black Ops II") {
                echo "<th id='gameicon'><a href='#".str_replace(array(" ",":"),array("_","_"),$row->gameName)."'><input type='image' src='../wp-content/plugins/topgamers/Call of Duty Black Ops II.png' class='displayed'></a><br>".$row->gameName."</th>";
            }else{
                echo "<th id='gameicon'><a href='#".str_replace(array(" ",":"),array("_","_"),$row->gameName)."'><input type='image' src='../wp-content/plugins/topgamers/none.png' class='displayed'></a><br>".$row->gameName."</th>";
            }
        }

?>                       
                    </tr>
                </thead>
                <tbody>
                    <tr id='playerlist'>
<?php 
        global $wpdb;
        $topgame2 = $wpdb->get_results("SELECT DISTINCT gameName FROM  topplayerlist WHERE topgamer = 1 ORDER BY views");
        foreach ($topgame2 as $row) {
            $topgamers = $wpdb->get_results("SELECT * FROM  topplayerlist WHERE topgamer = 1 AND gameName = '".$row->gameName."' ORDER BY views DESC LIMIT 5");
            echo "<td id='test'>";
            foreach ($topgamers as $key) {
                if($key->streaming == 1){
                    echo "<a href='".$key->streamURI."' target='_blank' style='color:#75FF47;font-size:15px;font-weight:bold;'>".$key->playerIGN."</a>";
                }else{
                    echo "<a href='".$key->streamURI."' target='_blank' style='color:#9999AA;font-size:15px;'>".$key->playerIGN."</a>";
                }
                // if($key->streaming == 1){
                //     echo "<img src='../wordpress/wp-content/plugins/topgamers/online_now.gif'>";
                // }
                echo "<br/>";
            }
            echo "</td>";
        }

        echo "      </tr>
                </tbody>
            </table>
        </div>";

        //start of all online streams
        $i=0;
        $players=array();
        $uris=array();
        $ids=array();
        $strmvws=array();

        //twitch start
        $result = $wpdb->get_results("select * from topplayerlist where streamURI like '%twitch.tv%' and topgamer = 1 ORDER BY views DESC LIMIT 5");
        foreach ($result as $key) {
            if($key->approved==1){
                if($key->streaming==1){
                    $players[$i]=$key->playerIGN;
                    $uris[$i]=$key->streamURI;
                    $ids[$i]=$key->gameID;
                    $strmvws[$i]=strtolower($players[$i]);
                    $i++;
                }else{
                    $playerstop[$itop]=$key->playerIGN;
                    $uristop[$itop]=$key->topvideo;
                    $idstop[$itop]=$key->gameID;
                    $strmvwstop[$itop]=strtolower($playerstop[$itop]);
                    $itop++;
                }
            }
        }

        $c = count($players);
        echo "<div style='width:700px' id='all' class='content'>";
        for ($x=0; $x < $c; $x++) { 
            $url="https://api.twitch.tv/kraken/streams/".$strmvws[$x];
            $json = file_get_contents($url);
            $jsonDecoded = json_decode($json);
            $b=$jsonDecoded->stream->viewers;
            if($b==NULL){$b=0;}
            echo '<div id="base" style="width:330px; display:inline-block; height:280px">
            <div id="head"><a href="http://www.twitch.tv/'.$strmvws[$x].'" target="_blank">
            <img id="img1" src="http://static-cdn.jtvnw.net/previews-ttv/live_user_'.$strmvws[$x].'-300x200.jpg">
            </div>
            <div id="trunk" style="width:300px">
            <div id="gamer" style="display:inline-block;float:left">'.$players[$x].'
            </div></a>
            <div id="viewers"style="display:inline-block;float:right">
            Viewers: '.$b.'
            </div>
            </div>
            </div>';
        }
        //twitch end

        echo "</div>";
        //end of all online streams


        //start of all top streams
        foreach($topgame2 as $gamekey){
            $itop=0;
            $playerstop=array();
            $uristop=array();
            $idstop=array();
            $strmvwstop=array();

            //twitch start
            $result = $wpdb->get_results("select * from topplayerlist where streamURI like '%twitch.tv%' and topgamer = 1 and gameName like '".$gamekey->gameName."' ORDER BY views DESC LIMIT 5");
            foreach ($result as $key) {
                if($key->approved==1){
                    if($key->streaming==1){
                        $playerstop[$itop]=$key->playerIGN;
                        $uristop[$itop]=$key->streamURI;
                        $idstop[$itop]=$key->gameID;
                        $strmvwstop[$itop]=strtolower($playerstop[$itop]);
                        $itop++;
                    }else{
                        $playerstop[$itop]=$key->playerIGN;
                        $uristop[$itop]=$key->topvideo;
                        $idstop[$itop]=$key->gameID;
                        $strmvwstop[$itop]=strtolower($playerstop[$itop]);
                        $itop++;
                    }
                }
            }

            $ctop = count($playerstop);
            echo "<div style='width:700px' id='".str_replace(array(" ",":"),array("_","_"),$gamekey->gameName)."' class='content'>";
            for ($x=0; $x < $ctop; $x++) { 
                $url="https://api.twitch.tv/kraken/streams/".$strmvwstop[$x];
                $json = file_get_contents($url);
                $jsonDecoded = json_decode($json);
                $b=$jsonDecoded->stream->viewers;
                if($b==NULL){$b=0;}
                echo '<div id="base" style="width:330px; display:inline-block; height:280px">
                <div id="head"><a href="http://www.twitch.tv/'.$strmvwstop[$x].'" target="_blank">
                <img id="img1" src="http://static-cdn.jtvnw.net/previews-ttv/live_user_'.$strmvwstop[$x].'-300x200.jpg">
                </div>
                <div id="trunk" style="width:300px">
                <div id="gamer" style="display:inline-block;float:left">'.$playerstop[$x].'
                </div></a>
                <div id="viewers"style="display:inline-block;float:right">
                Viewers: '.$b.'
                </div>
                </div>
                </div>';
            }
            //twitch end

            echo "</div>";
        }
        echo "<hr>";
        //end of all top streams
    }
    
    add_shortcode('topgamers','topgamers_plugin');
?>