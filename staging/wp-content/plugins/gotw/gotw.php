<?php
/*
Plugin Name: weStream Gamer of the Week
Plugin URI: 
Description: Insert a "gamer of the week" into your WordPress page (controlled by the admin).
Version: 1.1
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

  add_action('admin_menu', 'gotw_admin_actions');

  function gotw_admin_actions(){
    add_options_page('weStream Gamer of the Week','weStream Gamer of the Week','manage_options',__FILE__,'gotw_admin');
  }

  function gotw_admin(){
?>
    <script type="text/javascript">
      function generator(){
        var ign = document.getElementById("ign").value;
        var game = document.getElementById("game").value;
        var name = document.getElementById("name").value;
        var site = document.getElementById("uri").value;
        var photo = document.getElementById("photo").value;
        var msg = document.getElementById("msg").value;
        var code = '[gotw ign="'+ign+'" game="'+game+'" name="'+name+'" site="'+site+'" photo="'+photo+'" msg="'+msg+'"]';
        document.getElementById("shortcode").value = code;
      }
    </script>

    <div class="wrap">
       <b>Gamer of the Week</b> for your gaming site!
    </div>
    <br>
    <div>
      To display your "Gamer of the Week" for your WordPress site, simply follow the format below:
      <br><br>		
      Format:
      <br>
      [gotw ign="player_ign" game="game_played" name="player_name" site="player_uri" photo="photo_url" msg="player_message"]
      <br><br>
      Example:
      <br>
      [gotw ign="MangRey86" game="Dota 2" name="Rey Necesito" site="http://www.facebook.com/reyzman18 " photo="http://2damnfunny.com/wp-content/uploads/2013/06/Evil-Animal-Crossing-Villager-Meme-Gif.gif" msg="I am the best gamer in the world!"]
      <br><br>
      Or you can use the shortcode generator:
      <table>
        <tr>
          <td>
            <b>In-game name:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='ign' type='text'>
          </td>
        </tr>
        <tr>
          <td>
            <b>Game played:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='game' type='text'>
          </td>
        </tr>
        <tr>
          <td>
            <b>Real Name:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='name' type='text'>
          </td>
        </tr>
        <tr>
          <td>
            <b>Site/Channel:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='uri' type='text'>
          </td>
        </tr>
        <tr>
          <td>
            <b>Photo link/URL:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id='photo' type='text'>
          </td>
        </tr>
        <tr>
          <td>
            <b>Player Message:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <textarea id='msg' rows="3" cols="23"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='button' value='Generate Shortcode' onclick='generator()' >
          </td>
        </tr>
        <tr>
          <td>
            <b>Generated shortcode:</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <textarea id='shortcode' rows="4" cols="23"></textarea>
          </td>
        </tr>
      </table>
    </div>
    <br><br>
    Paste the generated shortcode in the Wordpress page where you want to use it.
<?php
  }
  
  function gotw_plugin( $atts ) {
    extract( shortcode_atts( array(
      'ign' => 'No Available',	
      'game' => 'Not Available',
      'name' => 'Not Available',
      'site' => 'Not Available',
      'photo' => 'http://tekstovi-pesama.com/g_img2/0/n/216476/none-3.jpg',
      'msg' => 'None',
      ), $atts ) );

?>
    <style type="text/css">
      td {vertical-align: top;}
      table {width: 560px; height: 305px; border: solid 2px; padding: 10px;}
      #title {font-size: 3px; font-weight:900;}
    </style>
    <div id="gotw" style="margin-top: 30px; margin-left: -90px;">
      <font size="5"><b>Gamer of the Week</b></font>
      <table>
<!--         <thead>
          <th colspan="2"><td id="title">Gamer of the Week</td></th>
        </thead>
        <tbody> -->
          <tr>
            <td colspan="2">
             
            </td>
          </tr>
          <tr>
            <td>
              <img src="<?= $photo ?>" height="140px" width="140px">
            </td>
            <td>
              <font size="2.5"><b>IGN: </b></font><?= $ign; ?><hr>
              <font size="2.5"><b>Main Game: </b></font><?= $game; ?><hr>
              <font size="2.5"><b>Real Name: </b></font><?= $name; ?><hr>
              <font size="2.5"><b>LiveStream Channel: </b></font><a href="<?= $site; ?>" target="_blank"><?= $site; ?></a><hr>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <font size="2.5"><b>PRO Tips:</b></font><br><?= $msg; ?>
            </td>
          </tr>
<!--         </tbody> -->
      </table>
    </div>
<?php
  }

  add_shortcode('gotw','gotw_plugin');
?>