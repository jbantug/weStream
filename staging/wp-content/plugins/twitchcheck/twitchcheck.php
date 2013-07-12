<?php
/*
Plugin Name: weStream Twitch Checker
Plugin URI: 
Description: Checks for online streamers on twitch.tv and reflects it on the weStream database
Version: 1.2
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

    add_action('admin_menu', 'twitchcheck_admin_actions');

    function twitchcheck_admin_actions(){
    	add_options_page('twitch.tv Stream Checker','twitch.tv Stream Checker','manage_options',__FILE__,'twitchcheck_admin');
    }

    function twitchcheck_admin(){

    }

    function twitchcheck_plugin(){
        ini_set('max_execution_time', 60);
    	global $wpdb;
        if($wpdb->get_row("SHOW TABLES LIKE '%topplayerlist'")!=NULL){
            $url = 'http://api.twitch.tv/api/team/anytvnetwork/all_channels.json';
            $data = file_get_contents($url);
            $json_array = json_decode($data, true);

            foreach($json_array['channels'] as $user) {

                if($wpdb->get_row("SELECT * FROM topplayerlist WHERE playerIGN = '".$user['channel']['display_name']."'") != NULL) {
                    

                    if($user['channel']['status'] === "live"){
                        $wpdb->update('topplayerlist',array('streaming'=>1,'streamURI'=>$user['channel']['link'],'gameName'=>$user['channel']['meta_game'],'views'=>$user['channel']['total_views']),array('playerIGN'=> $user['channel']['display_name']));
                    }else{
                        $wpdb->update('topplayerlist',array('streaming'=>0,'streamURI'=>$user['channel']['link'],'gameName'=>$user['channel']['meta_game'],'views'=>$user['channel']['total_views']),array('playerIGN'=> $user['channel']['display_name']));
                    }

                }else{
                    

                    $data = array();
                    if($user['channel']['status'] === "live"){
                        $data = array(
                        'playerIGN' => $user['channel']['display_name'],
                        'playerName' => $user['channel']['name'],
                        'streamURI' => $user['channel']['link'],
                        'gameName' => $user['channel']['meta_game'],
                        'views' => $user['channel']['views'],
                        'approved' => 1,
                        'streaming' => 1
                        );
                    }else{
                        $data = array(
                        'playerIGN' => $user['channel']['display_name'],
                        'playerName' => $user['channel']['name'],
                        'streamURI' => $user['channel']['link'],
                        'gameName' => $user['channel']['meta_game'],
                        'views' => $user['channel']['views'],
                        'approved' => 1,
                        'streaming' => 0
                        );
                    }
                    $wpdb->insert('topplayerlist',$data);


                }

            }
        }else{
            $sql="CREATE TABLE topPlayerList(playerID INT(10) PRIMARY KEY AUTO_INCREMENT, playerIGN VARCHAR(255), playerName VARCHAR(255), streamURI VARCHAR(255), gameName VARCHAR(255), approved INT(0), streaming INT(0), views INT(100), topvideo VARCHAR(255))";
            $wpdb->query($sql);
            $wpdb->print_error();
            $url = 'http://api.twitch.tv/api/team/anytvnetwork/all_channels.json';
            $data = file_get_contents($url);
            $json_array = json_decode($data, true);

            foreach($json_array['channels'] as $user) {

                if($wpdb->get_row("SELECT * FROM topplayerlist WHERE playerIGN = '".$user['channel']['display_name']."'") != NULL) {
                    
                    if($user['channel']['status'] === "live"){
                        $wpdb->update('topplayerlist',array('streaming'=>1,'streamURI'=>$user['channel']['link'],'gameName'=>$user['channel']['meta_game'],'views'=>$user['channel']['total_views']),array('playerIGN'=> $user['channel']['display_name']));
                    }else{
                        $wpdb->update('topplayerlist',array('streaming'=>0,'streamURI'=>$user['channel']['link'],'gameName'=>$user['channel']['meta_game'],'views'=>$user['channel']['total_views']),array('playerIGN'=> $user['channel']['display_name']));
                    }

                }else{
                    
                    $data = array();
                    if($user['channel']['status'] === "live"){
                        $data = array(
                        'playerIGN' => $user['channel']['display_name'],
                        'playerName' => $user['channel']['name'],
                        'streamURI' => $user['channel']['link'],
                        'gameName' => $user['channel']['meta_game'],
                        'views' => $user['channel']['views'],
                        'approved' => 1,
                        'streaming' => 1
                        );
                    }else{
                        $data = array(
                        'playerIGN' => $user['channel']['display_name'],
                        'playerName' => $user['channel']['name'],
                        'streamURI' => $user['channel']['link'],
                        'gameName' => $user['channel']['meta_game'],
                        'views' => $user['channel']['views'],
                        'approved' => 1,
                        'streaming' => 0
                        );
                    }
                    $wpdb->insert('topplayerlist',$data);


                }

            }
        }

        //$result = $wpdb->get_results("SELECT gameName FROM topplayerlist WHERE streamURI LIKE '%twitch.tv%' ORDER BY views DESC LIMIT 10");
        

    }

    add_shortcode('twitchcheck','twitchcheck_plugin');
?>