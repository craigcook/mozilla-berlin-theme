<?php
/**
 * Template Name: About
 *
 * @package mozilla_berlin
 */
get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		
		<div class="post-intro" style="background-image: url('<?php echo get_field('intro_image')['sizes']['intro']; ?>')">
			<div class="intro-text-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<h1><?php the_title(); ?></h1>
							<?php the_field('subheadline'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container page-content">
			<?php get_template_part( 'assets/partials/page-content' ); ?>
		</div>
		
		<?php
	}
}
?>

<?php

// check if the repeater field has rows of data
if( have_rows('editors') ):
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="headline-divider">
				<div class="pixel-bar"></div>
				<span class="headline"><?php the_field('headline_the_editors'); ?></span>
			</div>
		</div>
	</div>

		<?php
			$i = 1;
			$open = false;
			while ( have_rows('editors') ) : the_row();
			if ( $i % 2 == 1 ) { echo '<div class="row">'; $open = true; };
				?>
				<div class="col-sm-6">
					<div class="teaser-whitebox-overlap">
						<div class="inner">
							<?php 
							$image = get_sub_field('image');
							if( !empty($image) ): ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
							<div class="white-box">
								<h2 class="headline"><?php the_sub_field('title'); ?></h2>
							</div>
						</div>
						<div class="white-box-after">
							<p><?php the_sub_field('text'); ?></p>
							<?php
							if( have_rows('social_media') ): ?>
								<div class="soma-wrapper">
								<?php while ( have_rows('social_media') ) : the_row();
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
				</div>	
				<?php
				if ( $i % 2 == 0 ) { echo '</div>'; $open = false; };
				$i++;
			endwhile;
			if ( $open == true ) { echo '</div>'; };
		?>

</div>
<?php
else :
endif;
?>

<?php get_footer(); 