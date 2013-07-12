<?php
    /*
Plugin Name: WeStreamLive
Plugin URI:
Description: Plug your live stream from twitch.tv to your wordpress!
Version: .1
Author: AnyTv
Author URI: 
License:
*/
/*  Copyright 2013  OpenKit 

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


//add to settings
    add_action('admin_menu', 'westreamlive_admin_actions');

    function westreamlive_admin_actions(){
        add_options_page('westreamlive','westreamlive','manage_options', __FILE__, 'westreamlive_admin');

    }


    function westreamlive_admin(){
        ?>
        <div class="wrap">
            <h4>
                We stream here on WESTREAM!
            </h4>
        </div>
        <p>
            Copy-paste the shortcode to your page/post.
        </p>
        <div>
            <form method='POST' action='<?php echo $PHP_SELF;?>'>
                <table>
                    <tr>
                        <td>
                            Choose a player: 
                        </td>
                        <td>
                            <select name="chplayer">
                                <option value='twitch'>Twitch</option>
                                <option value='youtube'>Youtube</option>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <input type='submit' value='GENERATE'>
                        </td>
                    </tr>
                </table>


            </div>
            <?php
            $play = $_POST['chplayer'];
            if($play!=NULL){
                echo "shortcode:<br>";
                echo "<textarea id=\"forshortcode\" rows=\"4\" cols=\"75\">";
                echo "[westream ";
                echo "playername='".$play."' ]";;
                echo "</textarea>";
            }
        }

        function westreamplug( $atts ) {
          /** @var $stream_url LSB_Stream_Summary */
          wp_enqueue_style( 'westreamlive', plugins_url( 'westreamstyle.css', __FILE__ ), false, false, 'all' );
          extract( shortcode_atts( array(
              'playername' =>   '$atts',    
              ), $atts ) );


      //database
          global $wpdb;
          $players=array();
          $players2=array();
          $games=array();
          $ign=array();
          $viewers=array();
          $livev=array();
          $i=0;
          $result = $wpdb->get_results("SELECT * from topplayerlist WHERE streamURI LIKE '%twitch%'");
          foreach ($result as $key) {
            if($key->approved==1){
                if($key->streaming==1){
                    $players[$i]=$key->playerName;
                    $players2[$i]=$key->playerIGN;
                    $games[$i]=$key->gameName;
                    $viewers[$i]=$key->views;
                            //$ign[$i]=strtolower($players[$i]);
                    $i++;
                }
            }
        }
        //set random
        $arrayran=array();
        $range = range(0,$i-1);
        shuffle($range);
        $k=0;
        foreach ($range as $j) {
            $arrayran[$k]=$j;
            $k++;
        }
          //end set random
        //get current views
            $c = count($players);
            for ($x=0; $x < $c; $x++) { 
            $url="https://api.twitch.tv/kraken/streams/".$players[$x];
            $json = file_get_contents($url);
            $jsonDecoded = json_decode($json);
            $livev[$x]=$jsonDecoded->stream->viewers;
            }

        //end of getting the current views
        if($playername=='twitch'){
            $html .= ' <style type="text/css">
            #vidleft{ display:inline-block; float:left;}#tray{display:inline-block; float:right;height: 110px;}
            </style>
            <div id="container" style="margin-left: -90px;">
                <div id="titlebar">'.$games[$arrayran[0]].'
                </div>
                <div id="pltitle">'.$players2[$arrayran[0]].'
                </div>
                <div id="vplayer">
                    V: '.$livev[$arrayran[0]].'
                </div>
                <div id="cplayer">
                    C: 0 
                </div>
                <div id="pplayer">
                    P:$ 0
                </div>
                <div id="vidcount"> streaming: '.count($players).' players
                </div>
                <div id="vidleft">
                    <object type="application/x-shockwave-flash" Stage.showMenu = "false" height="408px" width="620" id="live_embed_player_flash" '
            . 'data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' .$players[$arrayran[0]]. '" bgcolor="#000000">'
            . '<param name="allowFullScreen" value="true" />'
            . '<param name="allowScriptAccess" value="always" />'
            . '<param name="allowNetworking" value="all" />'
            . '<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />'
            . '<param name="flashvars" value="hostname=www.twitch.tv&channel=' .$players[$arrayran[0]]. '&auto_play=true&start_volume=25" />'
            . '</object></div>';

            $html2 .='<div id="vidright"">';
            echo $html;
            echo $html2;
            for($y=0;$y<count($players);$y++){
                $im = "img".strval($y);
                $sl = "slot".strval($y);
                $gt = "gtitle".strval($y);
                $pt = "pltray".strval($y);
                $pv = "pviews".strval($y);
                if(strlen($games[$arrayran[$y]])>12){
                    $temp = substr($games[$arrayran[$y]], 0,8)."...";
                }
                else{
                    $temp = $games[$arrayran[$y]];
                }
                $number = $y+1;
                $inc = 800;
                echo '<div id="sample">
                        <div id="num">
                            <p id="num'.$number.'" style="color:;">'.$number.'
                            </p>
                        </div>
                        <a class="slot" id="slot'.$y.'" href="javascript:var t=setInterval(click(\''.$players[$arrayran[$y]].'\',\''.$im.'\',\''.$sl.'\',\''.$games[$arrayran[$y]].'\',\''.$gt.'\',\''.$pt.'\',\''.$pv.'\',\''.$livev[$arrayran[$y]].'\'),500)">
                            <div id="imageline">
                                <p class="pltray" id="gtitle'.$y.'" style="margin-top:0px;margin-bottom:0;">'.$temp.'
                                </p>
                                <p class="pltray" id="pltray'.$y.'" style="display:inline-block;float:right;margin-top:0px;margin-bottom:0;">'.$players2[$arrayran[$y]].'
                                </p>
                                <img id="img'.$y.'" src="http://static-cdn.jtvnw.net/previews-ttv/live_user_'.$players[$arrayran[$y]].'-160x90.jpg">
                                <br>
                                <p class="pltray" id="pviews'.$y.'" style="display:inline-block;margin-top:0px;width: 52px;">v: '.$livev[$arrayran[$y]].'
                                </p>
                                <p class="pltray" style="display:inline-block;margin-top:0px;width: 50px;"> &#09;c: 0 
                                </p>
                                <p class="pltray" style="display:inline-block;margin-top:0px;width: 50px;"> &#09;p:$ 0.0
                                </p>
                            </div>
                        </a>
                    </div>';
            }
            echo "</div></div>";
            ?>
            <script type='text/javascript'>
            var current1='<?php echo $players[$arrayran[0]];?>';
            var view1='<?php echo $livev[$arrayran[0]];?>';
            var gamen='<?php echo $games[$arrayran[0]];?>';
            function click(a,image,slot,gamename,gtitle,ptray,plviews,viewcount){
                // var numb=num.toString();
                var b=a;
                var temp;
                var c="<object type='application/x-shockwave-flash' height='408px' width='620px' id='live_embed_player_flash' data='http://www.twitch.tv/widgets/live_embed_player.swf?channel=";
                var d="' bgcolor='#000000'><param name='allowFullScreen' value='true' /><param name='allowScriptAccess' value='always' /><param name='allowNetworking' value='all' /><param name='movie' value='http://www.twitch.tv/widgets/live_embed_player.swf' /><param name='flashvars' value='hostname=www.twitch.tv&channel=";
                var e="&auto_play=true&start_volume=25' /></object>";
                if (gamen.length>12){
                    var sub = gamen.length;
                    sub = sub-8;
                    temp = gamen.substring(0,gamen.length-sub)+"...";
                }
                else{
                    temp = gamen;
                }
                document.getElementById("vidleft").innerHTML=c+b+d+b+e;
                //document.getElementById(image).src="http://static-cdn.jtvnw.net/previews-ttv/live_user_"+current1+"-160x90.jpg";
                document.getElementById("titlebar").innerHTML="\t"+gamename;
                document.getElementById("pltitle").innerHTML="\t"+b;
                document.getElementById("vplayer").innerHTML="V: "+viewcount;
                current1 = b;
                view1 = viewcount;
                gamen=gamename;
            }
            </script>
            <?php
        }
    }
    add_shortcode('westream','westreamplug');
    ?>