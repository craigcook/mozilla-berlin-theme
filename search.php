<?php
/**
 * mozilla_berlin
 */
get_header(); ?>

<div class="container">
	<main class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-8'); ?>>
			<?php get_template_part( 'assets/partials/single-loop' ); ?>
			
			<footer>
				<?php comments_template(); ?> 
			</footer>
		</article>
		<aside class="col-sm-4">
			<?php get_sidebar(); ?>
		</aside>
	</main>
</div>

<?php get_footer();