<?php
/**
 * Template Name: Mozilla Experts Dark
 *
 * @package mozilla_berlin
 */
$id = get_the_ID();
get_header(); ?>

<div class="dark">
	<div class="container experts-intro">
		<div class="row">
			<div class="col-sm-7">
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
				elseif ( get_sub_field('column_s') == "2" ) { $column_s = "col-md-offset-4"; } 
				elseif ( get_sub_field('column_s') == "3" ) { $column_s = "col-md-offset-8"; };

				if     ( get_sub_field('column_l') == "1" ) { $column_l = "col-md-offset-none"; } 
				elseif ( get_sub_field('column_l') == "2" ) { $column_l = "col-md-offset-4"; };

				?>
				<div class="row expert-row">
					<div data-margintop="<?php if (get_sub_field('margin_top')){echo get_sub_field('margin_top');}else{echo "0";}; ?>" class="column <?php if ( get_sub_field('size') == "2x1" ) { echo "col-md-8 twoxone " . $column_l; } elseif ( get_sub_field('size') == "1x1" || get_sub_field('size') == "1x2" ) { echo "col-md-4 onexone " . $column_s; } ?>" style="<?php if ( get_sub_field('margin_top') ){ echo "margin-top:-".get_sub_field('margin_top')."px;"; }; ?>" >
						<div class="expert-wrapper" style="<?php if ( get_sub_field('margin_left') ){ echo "margin-left:".get_sub_field('margin_left')."px;"; };if ( get_sub_field('margin_right') ){ echo "margin-right:".get_sub_field('margin_right')."px;"; }; ?>" data-marginleft="<?php if (get_sub_field('margin_left')){echo get_sub_field('margin_left');}else{echo "0";}; ?>" data-marginright="<?php if (get_sub_field('margin_right')){echo get_sub_field('margin_right');}else{echo "0";}; ?>" >
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
									<div class="<?php if ( get_sub_field('size') == "2x1" ) { echo "col-md-7"; } else { echo "col-md-12"; } ?>">
										<div class="content">
											<h3 class="headline"><?php the_sub_field('name'); ?></h3>
											<p class="name-additional"><?php the_sub_field('name_additional'); ?></p>
											<?php the_sub_field('text'); ?>
											<?php if ( get_sub_field('contact_cta') ) {
												echo '<a class="button" href="'.get_sub_field('contact_cta')['url'].'" traget="'.get_sub_field('contact_cta')['target'].'" title="'.get_sub_field('contact_cta')['title'].'">'.get_sub_field('contact_cta')['title'].'</a>';
											} ?>
										</div>
									</div>
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

<?php get_footer();