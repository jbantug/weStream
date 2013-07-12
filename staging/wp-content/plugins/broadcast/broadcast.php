<?php
/*
Plugin Name: Broadcast section
Plugin URI: 
Description: Insert a "Broadcast section" into your WordPress page (controlled by the admin).
Version: 0.1
Author: Lester Infiesto
Author URI: http://www.facebook.com/OreoCookies143
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
    global $wpdb;

    if($wpdb->get_row("SHOW TABLES LIKE '%broadcast'")==1) 
    {
          //table exist
    }
    else {
      $sql="CREATE TABLE broadcast(eventnum INT(10) PRIMARY KEY AUTO_INCREMENT, eventname VARCHAR(255), eventdate VARCHAR(15), description VARCHAR(255), organizer VARCHAR(40), confirmation TINYINT(1))";
      if ($wpdb->query($sql))
      {
        echo "Table broadcast created successfully";
      }
      else
      {
        echo "Error creating table: " . mysql_error();
      }
    }


    add_action('admin_menu', 'broadcast_admin_actions');

    function broadcast_admin_actions(){
      add_options_page('weStream Broadcast section','weStream Broadcast section','manage_options',__FILE__,'broadcast_admin');
    }

    function broadcast_admin(){
      ?>

      <script type="text/javascript">
      function generator(){
        var code = '[broadcast]';
        document.getElementById("shortcode").value = code;
      }
      </script>

      <div class="wrap">
       <b>Broadcast section</b> for your gaming site!
     </div>
     <br>
     <div>
      To display your "Broadcast section" for your WordPress/westream site. :
      <br>
      <br>
      <style type='text/css'>table,th,td {border:solid 1px;padding:5px;border-collapse:collapse;text-align:center}</style>
      <table>
        <h3>Pending Events</h3>
        <thead>
          <tr>
            <th>Event</th>
            <th>Date</th>
            <th>Description</th>
            <th>Booker</th>
            <th>Confirmation</th>
          </tr>
        </thead>
        <tbody>
          <form action="<?php echo $PHP_SELF;?>" method="POST">
            <?php
            global $wpdb;
	    
            $boxes = $_POST['checkb_update'];
            
            for($y=0;$y<count($boxes);$y++){
              $value = $boxes[$y];
              if($value == NULL) continue;
              if ($_POST["Accept"]){
                $wpdb->query("UPDATE broadcast SET confirmation=1 WHERE eventnum=".$value);
              }
              if ($_POST["Deny"]){
                $wpdb->query("DELETE FROM broadcast WHERE eventnum=".$value);
              }
              else{}
            }

            $result = $wpdb->get_results("SELECT * FROM broadcast WHERE confirmation=0");
            foreach ($result as $key) {
              echo"<tr>";
              echo "<td>". $key->eventname ."</td>";
              echo "<td>". $key->eventdate."</td>";
              echo "<td>". $key->description."</td>";
              echo "<td>". $key->organizer."</td>";
              echo "<td><input type='checkbox' name='checkb_update[]' value='".$key->eventnum."'></td>";
              echo "</tr>";

            }

            ?>
          </tbody></table><br>
          <input type='submit' value='Add to Broadcast' name='Accept'>
          <input type='submit' value='Deny Event(s)' name='Deny'>
        </form>
        
      </div>

      <div>
        <table>
          <h3>Edit Current Events</h3>
          <thead>
            <tr>
              <th>Event</th>
              <th>Date</th>
              <th>Description</th>
              <th>Booker</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <form action="<?php echo $PHP_SELF;?>" method="POST">
             <?php

             global $wpdb;

             $boxes = $_POST['checkb_delete'];
             
             for($y=0;$y<count($boxes);$y++){
              $value = $boxes[$y];
              if($value == NULL) continue;
              $wpdb->query("DELETE FROM broadcast WHERE eventnum=".$value);
            }

            $result = $wpdb->get_results("SELECT * FROM broadcast WHERE confirmation=1");
            foreach ($result as $key) {
              echo"<tr>";
              echo "<td>". $key->eventname ."</td>";
              echo "<td>". $key->eventdate."</td>";
              echo "<td>". $key->description."</td>";
              echo "<td>". $key->organizer."</td>";
              echo "<td><input type='checkbox' name='checkb_delete[]' value='".$key->eventnum."'></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
          <table><br>
            <input type='submit' value='Delete Event(s)'>
          </form>
        </div>
        <?php
      }
      function broadcast_plugin( $atts ) {
        
        extract( shortcode_atts( array(

          ), $atts ) );
          ?>
	    <div style="float: right; margin: -330px -388px 0 0">
	    <font size="5"><b>Broadcast Section</b></font>
            <table style="border: solid 2px; border-collapse:collapse;">
              <thead>
                <tr style="border: solid 1px; text-align:center;">
                  <th style="border: solid 1px; text-align:center;">EventName</th>
                  <th style="border: solid 1px; text-align:center;">Date</th>
                  <th style="border: solid 1px; text-align:center;">Description</th>
                  <th style="border: solid 1px; text-align:center;">Booker</th>
                </tr>
              </thead>
              <tbody>         
                <?php  

                global $wpdb;

                $result = $wpdb->get_results("SELECT * FROM broadcast WHERE confirmation=1");
                foreach ($result as $key) {
                  echo"<tr style='border: solid 1px; text-align:center;'>";
                  echo "<td style='border: solid 1px; text-align:center;'>". $key->eventname ."</td>";
                  echo "<td style='border: solid 1px; text-align:center;'>". $key->eventdate."</td>";
                  echo "<td style='border: solid 1px; text-align:center;'>". $key->description."</td>";
                  echo "<td style='border: solid 1px; text-align:center;'>". $key->organizer."</td>";
                  echo "</tr>";
                }
         
                ?>
              </tbody>
            </table>
<br>
	   <a href="http://staging.any.tv/live/submitevent/" style="color: #7FFFD4 ; text-decoration: underline; cursor: pointer">Click here to submit event.</a>
          </div>
          <?php
          $eventname=$_POST['eventname'];
          $eventdate=$_POST['eventdate'];
          $description=$_POST['description'];
          $organizer=$_POST['organizer'];
          
          if ($eventname!=NULL && $eventdate!=NULL && $description!=NULL && $organizer!=NULL) {
           $wpdb->query("INSERT INTO broadcast(eventname,eventdate,description, organizer) VALUES('$eventname','$eventdate','$description','$organizer')");
         }
         else{
        }
      }

      add_shortcode('broadcast','broadcast_plugin');
      ?>