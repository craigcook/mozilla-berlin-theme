<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mozilla_berlin
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
								<?php if ( has_post_thumbnail() ) : ?>
								<a class="no-style" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
								<?php endif; ?>
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