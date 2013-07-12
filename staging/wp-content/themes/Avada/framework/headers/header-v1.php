<header id="header">
	<div class="avada-row" style="margin-top:<?php echo $data['margin_header_top']; ?>;margin-bottom:<?php echo $data['margin_header_bottom']; ?>;">
		<div class="logo" style="margin-left:<?php echo $data['margin_logo_left']; ?>;"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $data['logo']; ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
		<nav id="nav" class="nav-holder">
			<?php wp_nav_menu(array('theme_location' => 'main_navigation', 'depth' => 4, 'container' => false, 'menu_id' => 'nav')); ?>
		</nav>
	</div>
</header>