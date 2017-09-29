<?php
/**
 * Template Name: Mozilla Experts
 *
 * @package mozilla_berlin
 */
$id = get_the_ID();
get_header(); ?>

<div class="light">

	<div class="container experts-intro">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="headline"><?php the_title(); ?></h1>
				<p><?php the_field('subheadline') ?></p>
			</div>
		</div>
	</div>

	<div class="container">
		<?php
		if( have_rows('experts') ):
			while ( have_rows('experts') ) : the_row();

				if     ( get_sub_field('column_s') == "1" ) { $column_s = "col-md-offset-none"; } 
				elseif ( get_sub_field('column_s') == "2" ) { $column_s = "col-md-offset-3"; } 
				elseif ( get_sub_field('column_s') == "3" ) { $column_s = "col-md-offset-6"; } 
				elseif ( get_sub_field('column_s') == "4" ) { $column_s = "col-md-offset-9"; };

				if     ( get_sub_field('column_l') == "1" ) { $column_l = "col-md-offset-none"; } 
				elseif ( get_sub_field('column_l') == "2" ) { $column_l = "col-md-offset-3"; } 
				elseif ( get_sub_field('column_l') == "3" ) { $column_l = "col-md-offset-6"; };

				?>
				<div class="row expert-row">
					<div data-margintop="<?php echo get_sub_field('margin'); ?>" class="column <?php if ( get_sub_field('size') == "Half" ) { echo "col-md-6 large " . $column_l; } elseif ( get_sub_field('size') == "Fourth" ) { echo "col-md-3 small " . $column_s; } ?>" style="margin-top: <?php if ( get_sub_field('margin') ) { echo "-". get_sub_field('margin') ."px"; } else { echo "0"; } ?>" data-margin="<?php if ( get_sub_field('margin') ) { echo "-". get_sub_field('margin') ."px"; } else { echo "0"; } ?>" >
						<div class="expert-wrapper">
							<div class="img-wrapper">
								<?php 
								$image = get_sub_field('image');
								if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
								<h2 class="headline"><?php the_sub_field('headline'); ?></h2>
							</div>
							<div class="overlay">
								<div class="row">
									<div class="<?php if ( get_sub_field('size') == "Half" ) { echo "col-md-6"; } else { echo "col-md-12"; } ?>">
										<h3 class="headline"><?php the_sub_field('name'); ?></h3>
										<p class="under-name"><?php the_sub_field('under_name'); ?></p>
									</div>
									<div class="<?php if ( get_sub_field('size') == "Half" ) { echo "col-md-6"; } else { echo "col-md-12"; } ?>">
										<?php
										if( have_rows('social') ): ?>
											<div class="soma-wrapper">
											<?php while ( have_rows('social') ) : the_row();
												if( get_row_layout() == 'youtube' ):
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-youtube-play fa-lg"></i></a>';
												elseif( get_row_layout() == 'facebook' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-facebook fa-lg"></i></a>';
												elseif( get_row_layout() == 'twitter' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-twitter fa-lg"></i></a>';
												elseif( get_row_layout() == 'instagram' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-instagram fa-lg"></i></a>';
												elseif( get_row_layout() == 'linkedin' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-linkedin fa-lg"></i></a>';
												elseif( get_row_layout() == 'email' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-envelope fa-lg"></i></a>';
												elseif( get_row_layout() == 'xing' ): 
													echo '<a target="_blank" href="'.get_sub_field('url').'"><i class="fa fa-xing fa-lg"></i></a>';
												endif;
											endwhile;
											?></div><?php
										else :
										endif;
										?>
									</div>
								</div>
								<p class="title"><?php the_sub_field('headline'); ?></p>
								<?php the_sub_field('text'); ?>
								<div class="show-more-wrapper">
									<div class="button more"><?php if( get_field('button_title_more') ) { echo get_field('button_title_more'); } else { echo 'Show more'; } ?></div>
									<div class="button less"><?php if( get_field('button_title_less') ) { echo get_field('button_title_less'); } else { echo 'Show less'; } ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			endwhile;
		else :
		endif;
		?>
	</div>

</div>

<?php include (TEMPLATEPATH . '/assets/partials/people-loop.php'); ?>

<?php get_footer(); 