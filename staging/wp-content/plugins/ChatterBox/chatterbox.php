<?php
/*
Plugin Name: ChatterBox
Plugin URI: 
Description: A real-time chatbox plug-in for wordpress
Version: 2.0
Author: Froilan Philip Gaviola
Author URI: 
License: GPLv2 or later
*/

function chatterbox_activation(){
	register_activation_hook(__FILE__, 'chatterbox_activation');
}

function chatterbox_deactivation(){
	register_deactivation_hook(__FILE__, 'chatterbox_deactivation');
}

add_action('wp_enqueue_scripts', 'cb_styles');
function cb_styles(){

	wp_register_style('chatterbox', plugins_url('css/style.css', __FILE__));
  	wp_enqueue_style('chatterbox');
}

add_action('wp_enqueue_scripts', 'cb_server');
function cb_server(){
	// wp_register_script('chatterbox', plugins_url('js/socket.io/node_modules/socket.io-client/lib/socket.js', __FILE__));
	// wp_register_script('chatterbox', plugins_url('js/handler.js', __FILE__));
}


add_shortcode('chatterbox','display_chatbox');
function display_chatbox(){

	$plugins_url = plugins_url();
		echo '
		<div id="wrapper2" style="float: right;margin: -440px -388px 0 0;">
			<div id="menu">  
	        	<div style="clear:both"></div>  
	    	</div>  
	    	<div id="chatbox"></div>
    		<div>
        		<input style ="font-size: 10" type="text" id="inputChat" />
        		<br>
   			</div>
		</div> 	
		<script src="http://localhost/wordpress/wp-content/plugins/ChatterBox/js/jquery.js"></script>
      	<script src="http://localhost/wordpress/wp-content/plugins/ChatterBox/js/fancywebsocket.js"></script>
		<script src="http://localhost/wordpress/wp-content/plugins/ChatterBox/js/chat.js"></script>
	</div>';
}
?>