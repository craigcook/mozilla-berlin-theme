<div class="container additional-people">
	<div class="row">
		<div class="col-sm-12 text-align-center">
			<h2 class="headline"><?php the_field('headline_more_people_of_mozilla','options'); ?></h2>
		</div>
	</div>
	<div class="row">
		<?php 
		query_posts(array( 'post_type' => 'people', 'posts_per_page' => 3 ));
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); 
				?>
				<div class="col-sm-4">
					<div class="teaser-whitebox-overlap">
						<div class="inner">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('3col-thumbnail'); ?>
								</a>
							<?php endif; ?>
							
						</div>
					</div>
					<div class="white-box">
						<a class="no-style" href="<?php the_permalink(); ?>">
							<h2 class="headline"><?php the_title(); ?></h2>
						</a>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_query();
		?>		
	</div>
</div>
