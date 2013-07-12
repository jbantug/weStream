<?php
	/*
Plugin Name: WeStreamUpload
Plugin URI:
Description: Plugin for WeStreams. 
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
    
    function westreamuploadplug() {
        ?>
	<br><br>
        <table>
            <form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data" >
                <tr>
                    <td>
                        Uploader: <input type="text" name="username" size="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="file">Filename:</label>
                        <input type="file" name="file" id="file" size="40" multiple accept='video/*'/><br />
                    </td>
                </tr>
                <tr>
                    <td>    
                        <input type="submit" name="submit" value="Submit" />
                    </td>
                </tr>
            </form>
        </table>
        <?php
        global $wpdb;
        $sql_create_table = "CREATE TABLE IF NOT EXISTS `videos` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `title` varchar(20) NOT NULL,
          `url` varchar(100) NOT NULL,
          `user` varchar(20) NOT NULL,
          activity_date datetime NOT NULL default '0000-00-00 00:00:00',
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
dbDelta( $sql_create_table );

ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');
ini_set('max_input_time', 500);
ini_set('max_execution_time', 500);
ini_set('memory_limit', '1024M');
ini_set("session.gc_maxlifetime","10800");


$upload_dir = wp_upload_dir();
$upload_dir = $upload_dir['basedir'] . "/westreamvid";
$upload_dircheck = wp_mkdir_p($upload_dir); 

if(isset($_POST['submit'])){
    if (file_exists("../wp-content/uploads/uploads/westreamvid/" . $_FILES["file"]["name"]))
    {
        echo $_FILES["file"]["name"] . " already exists. ";
    }
    else
    {
        $title = $_FILES["file"]["name"];
        $username = $_POST["username"];
        $time = date('Y-m-d H:i:s');
        move_uploaded_file($_FILES["file"]["tmp_name"],"../wp-content/uploads/westreamvid/" . $title);
        $url = "../wp-content/uploads/westreamvid/" . $_FILES["file"]["name"];
        $wpdb->query("INSERT INTO videos VALUE('','$title','$url','$username','$time')");
        echo 'Preview: <br><video width="320" height="240" controls>
        <source src="../wp-content/uploads/westreamvid/'. $_FILES["file"]["name"].'" type="video/ogg">
        <source src="../wp-content/uploads/westreamvid/'. $_FILES["file"]["name"].'" type="video/mp4">
        <source src="../wp-content/uploads/westreamvid/'. $_FILES["file"]["name"].'" type="video/webm">
        <object data="../wp-content/uploads/westreamvid/'. $_FILES["file"]["name"].'" width="320" height="240">
        <embed width="320" height="240" src="../wp-content/uploads/westreamvid/'. $_FILES["file"]["name"].'"></object></video>';
        
    }
}
}

add_shortcode('westreamupload','westreamuploadplug');
?>