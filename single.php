<?php
/**
 * mozilla_berlin
 */
get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		
		<div class="post-intro" style="background-image: url('<?php echo get_field('intro_image')['sizes']['intro'] ?>');<?php if(get_field('height')){echo "height:".get_field('height')."px;";}; if(get_field('proportional_scaling_height_padding_bottom')){echo "padding-bottom:".get_field('proportional_scaling_height_padding_bottom')."%;";}; ?>">
			<div class="intro-text-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
							<h1><?php the_title(); ?></h1>
                            <p><?php the_field('subheadline'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container page-content">
			<div class="row">
				<div class="col-sm-1 col-md-2">
					<div class="share-wrapper">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook." onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						  Share
						  <i class="fa fa-facebook"></i>
						</a>
						<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						  Tweet
						  <i class="fa fa-twitter"></i>
						</a>
					</div>
				</div>
			</div>
			<?php get_template_part( 'assets/partials/page-content' ); ?>
		</div>
		
		<?php
	}
}
?>

<?php get_footer();
