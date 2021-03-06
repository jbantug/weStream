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
			if(has_post_thumbnail() ||
			get_post_meta(get_the_ID(), 'pyre_video', true)
			):
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
					<?php
					$i = 2;
					while($i <= $data['posts_slideshow_number']):
					$attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
					if($attachment_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment_id, $size); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment_id); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment_data['image_meta']['title']; ?>" /></a>
						</div>
					</li>
					<?php endif; $i++; endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<?php if($data['blog_layout'] == 'Medium'): ?>
			<?php
			if(has_post_thumbnail() ||
			get_post_meta(get_the_ID(), 'pyre_video', true)
			):
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
										<a class="icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php bloginfo('template_directory'); ?>/images/finder-ico.png" alt="<?php the_title(); ?>" /></a>										<h3><?php the_title(); ?></h3>
									</div>
								</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if($data['posts_slideshow']): ?>
					<?php
					$i = 2;
					while($i <= $data['posts_slideshow_number']):
					$new_attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
					if($new_attachment_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($new_attachment_id, 'blog-medium'); ?>
					<?php $full_image = wp_get_attachment_image_src($new_attachment_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($new_attachment_id->ID); ?>
					<li>
						<div class="image">
								<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment_data['image_meta']['title']; ?>" /></a>
						</div>
					</li>
					<?php endif; $i++; endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endif; ?>