<?php
// Template Name: Full Width
get_header(); ?>
	<div id="content" class="full-width">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php global $data; if($data['featured_images'] && has_post_thumbnail()): ?>
			<div class="image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('blog-large'); ?>
					<div class="image-extras">
						<div class="image-extras-content">
							<img src="<?php bloginfo('template_directory'); ?>/images/link-ico.png" alt="<?php the_title(); ?>"/>
							<h3><?php the_title(); ?><h3>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php if($data['comments_pages']): ?>
				<?php wp_reset_query(); ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>