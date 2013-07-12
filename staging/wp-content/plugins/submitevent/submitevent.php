<?php
/*
Plugin Name: SubmitEvent section
Plugin URI: 
Description: Insert a "Submit Event section" into your WordPress page.
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

    wp_enqueue_style( 'broadcast', plugins_url( 'broadcast_table.css', __FILE__ ), false, false, 'all' );

 
    function submitevent_admin(){
      ?>

      <script type="text/javascript">
      function generator(){
        var code = '[submitevent]';
        document.getElementById("shortcode").value = code;
      }
      </script>

      <?php
    }
    function submitevent_plugin( $atts ) {
      
      extract( shortcode_atts( array(

        ), $atts ) );
        ?>
        <div><form action="<?php echo $PHP_SELF;?>" method="POST">
          <h1>Submit Event</h1>
          <table>
            <tr><td><b>Event:</b></td><td><input type="text" name="eventname"></td></tr>
            <tr><td><b>Date:</b></td><td><input type="text" name="eventdate"></td></tr>
            <tr><td><b>Description:</b></td><td><input type="text" name="description"></td></tr>
            <tr><td><b>Organizer:</b></td><td><input type="text" name="organizer"></td></tr>
            <tr><td><input type="submit" value="Submit"></td></tr>
          </table></form>
        </div>
        
        <?php

        global $wpdb;

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

     add_shortcode('submitevent','submitevent_plugin');
     ?>