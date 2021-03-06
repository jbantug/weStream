			<style type="text/css">
			<?php if(get_post_meta($post->ID, 'pyre_fimg_width', true)): ?>
			#post-<?php echo $post->ID; ?> .post-slideshow,
			#post-<?php echo $post->ID; ?> .floated-post-slideshow,
			#post-<?php echo $post->ID; ?> .post-slideshow .image > img,
			#post-<?php echo $post->ID; ?> .floated-post-slideshow .image > img
			{width:<?php echo get_post_meta($post->ID, 'pyre_fimg_width', true); ?> !important;}
			<?php endif; ?>

			<?php if(get_post_meta($post->ID, 'pyre_fimg_height', true)): ?>
			#post-<?php echo $post->ID; ?> .post-slideshow,
			#post-<?php echo $post->ID; ?> .floated-post-slideshow,
			#post-<?php echo $post->ID; ?> .post-slideshow .image > img,
			#post-<?php echo $post->ID; ?> .floated-post-slideshow .image > img
			{height:<?php echo get_post_meta($post->ID, 'pyre_fimg_height', true); ?> !important;}
			<?php endif; ?>
			</style>
			<?php
			if($data['blog_full_width']) {
				$size = 'full';
			} else {
				$size = 'blog-large';
			}
			?>
			<?php if($data['blog_layout'] == 'Large'): ?>
			<?php
			$args = array(
			    'post_type' => 'attachment',
			    'numberposts' => $data['posts_slideshow_number']-1,
			    'post_status' => null,
			    'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_mime_type' => 'image',
				'exclude' => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			if($attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
			?>
			<div class="flexslider post-slideshow">
				<ul class="slides">
					<?php if(get_post_meta(get_the_ID(), 'pyre_video', true)): ?>
					<li class="full-video">
						<?php echo get_post_meta(get_the_ID(), 'pyre_video', true); ?>
					</li>
					<?php endif; ?>
					<?php if(has_post_thumbnail()): ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>"><?php the_post_thumbnail($size); ?></a>
								<div class="image-extras">
									<div class="image-extras-content">
										<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
										<a class="icon" href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/link-ico.png" alt="<?php the_title(); ?>"/></a>
										<?php
										if(get_post_meta($post->ID, 'pyre_video_url', true)) {
											$full_image[0] = get_post_meta($post->ID, 'pyre_video_url', true);
										}
										?>
										<a class="icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php bloginfo('template_directory'); ?>/images/finder-ico.png" alt="<?php the_title(); ?>" /></a>
										<h3><?php the_title(); ?></h3>
									</div>
								</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if($data['posts_slideshow']): ?>
					<?php foreach($attachments as $attachment): ?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, $size); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a>
						</div>
					</li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if($data['blog_layout'] == 'Medium'): ?>
			<?php
			$args = array(
			    'post_type' => 'attachment',
			    'numberposts' => $data['posts_slideshow_number']-1,
			    'post_status' => null,
			    'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_mime_type' => 'image',
				'exclude' => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			if($attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
			?>
			<div class="flexslider blog-medium-image floated-post-slideshow">
				<ul class="slides">
					<?php if(get_post_meta(get_the_ID(), 'pyre_video', true)): ?>
					<li class="full-video">
						<?php echo get_post_meta(get_the_ID(), 'pyre_video', true); ?>
					</li>
					<?php endif; ?>
					<?php if(has_post_thumbnail()): ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>"><?php the_post_thumbnail('blog-medium'); ?></a>
								<div class="image-extras">
									<div class="image-extras-content">
										<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
										<a class="icon" href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/link-ico.png" alt="<?php the_title(); ?>"/></a>
										<?php
										if(get_post_meta($post->ID, 'pyre_video_url', true)) {
											$full_image[0] = get_post_meta($post->ID, 'pyre_video_url', true);
										}
										?>
										<a class="icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php bloginfo('template_directory'); ?>/images/finder-ico.png" alt="<?php the_title(); ?>" /></a>
										<h3><?php the_title(); ?></h3>
									</div>
								</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if($data['posts_slideshow']): ?>
					<?php foreach($attachments as $attachment): ?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'blog-medium'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a>
						</div>
					</li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endif; ?>