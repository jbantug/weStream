<?php
/*
Plugin Name: Navigator
Plugin URI: 
Description: Insert a "navigator" into your WordPress page
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

    add_action('admin_menu', 'navigator_admin_actions');

    function navigator_admin_actions(){
    	add_options_page('weStream navigator','weStream navigator','manage_options',__FILE__,'navigator_admin');
    	wp_enqueue_style( 'navigator', plugins_url( 'nav.css', __FILE__ ), false, false, 'all' );
    }

    function navigator_admin(){
    	?>
    	<script type="text/javascript">
    	function generator(){
    		var code = '[navigator]';
    		document.getElementById("shortcode").value = code;
		document.getElementById("nav_select").css='font: bold;';
    	}
    	</script>
	<script type="text/javascript">
	function myfunction()
	{
	document.getElementById("nav_select")..css='font: bold;';
	}
	</script>
    	<div class="wrap">
    		<b>Input "[navigator]" shortcode on your text editor page to display westream nav.</b>
    	</div>
    	<?php
    }
    	function navigator_plugin( $atts ) {
    		?>
		<div style="width: 960px; float:left;">
    		   <body>
    			<style type="text/css">li,a{text-decoration: none; display: inline-block;}</style>
    			<ul id="menu-main" class="menu">
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/">Home</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/streams">Streams</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/features">Features</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/gamer-of-the-week">Gamer of the week</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/videos">Videos</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/uploads">Upload</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/video-stats">Video Stats</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/user-stats">User Stats</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/tournaments">Tournaments</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/awards">Awards</a>  |</li>
    				<li><a onclick="myfunction()" id="nav_select" href="http://staging.any.tv/westream/bloopers">Bloopers</a></li>
    			</ul>
    		   </body>
		</div>
    		<?php 
    	}
    	add_shortcode('navigator','navigator_plugin');
    	?>