<?php
/**
 * mozilla_berlin
 */
get_header(); ?>

<div class="container">
	<div class="row">
		<div class="slider-products-wrapper active" id="most-recent">
			<div class="slider-products">
				<?php 
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => 12 ));
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); 
						?>
						<div class="col-sm-3">
							<div class="teaser">
								<a class="no-style" href="<?php the_permalink(); ?>"><img src="http://via.placeholder.com/350x250"></a>
								<a class="no-style" href="<?php the_permalink(); ?>"><h2 class="headline"><?php the_title(); ?></h2></a>
								<p><?php the_field('teaser'); ?></p>
								<a class="arrow" href="<?php the_permalink(); ?>">see how</a>
							</div>
						</div>
						<?php
					}
				}
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer();