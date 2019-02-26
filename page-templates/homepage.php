<?php
/**
 * Template Name: Homepage
 *
 * @package mozilla_berlin
 */
$id = get_the_ID();
get_header(); ?>

<div class="container">
	<?php
	if( have_rows('featured_slider') ):
	?>
	<div class="row">
		<div class="col-sm-12">
			<script>
				var playerid = [];
			</script>
			<div class="slider-featured">
				<?php
				$i = 0;
				while ( have_rows('featured_slider') ) : the_row();

					if( get_row_layout() == 'posts' ):
						?>
						<?php
						$image = get_sub_field('thumbnail_1');
						?>

						<div class="slide <?php if( $i == 0 ) { echo 'ani'; } ?> slide-article">
							<div class="inner" <?php if( !empty($image) ): ?>style="background-image: url('<?php echo $image['sizes']['featured-slider']; ?>')"<?php endif; ?>>
								<?php
								if( !empty($image) ): ?>
									<img src="<?php echo $image['sizes']['featured-slider']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
								<a class="full" href="<?php echo get_sub_field('url_1')['url']; ?>" target="<?php echo get_sub_field('url_1')['target']; ?>" title="<?php echo get_sub_field('url_1')['title']; ?>"></a>
								<div class="content-wrapper">
									<div class="white-box">
										<a class="no-style" href="<?php echo get_sub_field('url_1')['url']; ?>" target="<?php echo get_sub_field('url_1')['target']; ?>" title="<?php echo get_sub_field('url_1')['title']; ?>">
											<h2 class="headline"><?php the_sub_field('title_1') ?></h2>
											<p><?php the_sub_field('teaser_text_1') ?></p>
										</a>
									</div>
									<div class="additional-teaser-wrapper">
									<?php if (get_sub_field('title_2')) : ?>
										<div class="additional-teaser">
											<a class="no-style" href="<?php echo get_sub_field('url_2')['url']; ?>" target="<?php echo get_sub_field('url_2')['target']; ?>" title="<?php echo get_sub_field('url_3')['title']; ?>">
												<h2 class="headline"><?php the_sub_field('title_2') ?></h2>
												<p><?php the_sub_field('teaser_text_2') ?></p>
											</a>
										</div>
									<?php endif; ?>
									<?php if (get_sub_field('title_3')) : ?>
										<div class="additional-teaser">
											<a class="no-style" href="<?php echo get_sub_field('url_3')['url']; ?>" target="<?php echo get_sub_field('url_3')['target']; ?>" title="<?php echo get_sub_field('url_3')['title']; ?>">
												<h2 class="headline"><?php the_sub_field('title_3') ?></h2>
												<p><?php the_sub_field('teaser_text_3') ?></p>
											</a>
										</div>
									<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="overlay"></div>

						</div>
						<?php

					elseif( get_row_layout() == 'video' ):
						?>

						<div class="slide <?php if( $i == 0 ) { echo 'ani'; } ?> slide-video">


								<div class="video-wrapper">
									<?php
										if( get_sub_field('video_host') == "YouTube" ){
											// echo convertYoutube( get_sub_field('video_url') );
											$output = $i - 1;
											echo '<div class="embed-container youtube"><div id="player'. $output .'"></div></div>';
											?>
											<?php
											if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', get_sub_field('video_url'), $match)) {
												$video_id = $match[1];
											}
											?>
											<script>
												playerid.push('<?php echo $video_id; ?>');
											</script>
											<?php
										}elseif(get_sub_field('video_host') == "Vimeo"){
											echo convertVimeo( get_sub_field('video_url') );
										}

									if ( get_sub_field('url') ) {
										echo '<a class="no-style" href="'.get_sub_field('url')['url'].'" target="'.get_sub_field('url')['target'].'" >';
									}
									?>
									<div class="video-description">
										<h2 class="headline"><?php the_sub_field('title') ?></h2>
										<p><?php the_sub_field('teaser_text') ?></p>
									</div>
									<?php
									if ( get_sub_field('url') ) {
										echo '</a>';
									}
									?>

								</div>


							<div class="overlay"></div>

						</div>

						<?php
					endif;

					$i++;

				endwhile;
				?>
			</div>
		</div>
	</div>
	<?php
	else :
	endif;
	?>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="headline-divider">
				<div class="pixel-bar" <?php if ( get_field('headline_bc_product_news', $id) ) { echo 'style="background-color:'. get_field('headline_bc_product_news', $id) .'"'; } ?>></div>
				<span class="headline" <?php if ( get_field('headline_bc_product_news', $id) ) { echo 'style="background-color:'. get_field('headline_bc_product_news', $id) .'"'; } ?>><?php the_field('headline_product_news', $id); ?></span>
				<?php if ( get_field('link_product_news') ) { ?><a href="<?php echo get_field('link_product_news')['url']; ?>"><?php echo get_field('link_product_news')['title']; ?></a><?php } ?>
			</div>
		</div>
	</div>

	<div class="row" style="display:none;">
		<div class="col-sm-12">
			<ul class="filter">
				<li class="active" data-filter="most-recent"><?php if ( get_field('button_product_news_most_recent') ) { echo get_field('button_product_news_most_recent'); } else { ?>Most Recent<?php } ?></li>
				<li data-filter="most-read"><?php if ( get_field('button_product_news_most_read') ) { echo get_field('button_product_news_most_read'); } else { ?>Most Read<?php } ?></li>
			</ul>
		</div>
	</div>

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
								<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?> title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
								<?php endif; ?>
								<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><h2 class="headline"><?php the_title(); ?></h2></a>
								<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><?php the_excerpt(); ?></a>
								<a style="display:none" class="arrow" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><?php if(get_field('read_more_alternative')){echo get_field('read_more_alternative'); }else{echo 'read more';} ?></a>
							</div>
						</div>
						<?php
					}
				}
				wp_reset_query();
				?>
			</div>
		</div>

		<div class="slider-products-wrapper" id="most-read">
			<?php
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => 12 ));
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						if ( get_field('most_read') == 1 ) {
						?>
							<div class="col-sm-3">
								<div class="teaser">
									<?php if ( has_post_thumbnail() ) : ?>
									<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?> title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<?php endif; ?>
									<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><h2 class="headline"><?php the_title(); ?></h2></a>
									<a class="no-style" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><?php the_excerpt(); ?></a>
									<a style="display:none" class="arrow" <?php if ( get_field('external_url') ) { echo 'href="'.get_field('external_url')['url'].'" target="'.get_field('external_url')['target'].'"'; } else { echo 'href="'.  get_permalink().'"'; }; ?>><?php if(get_field('read_more_alternative')){echo get_field('read_more_alternative'); }else{echo 'read more';} ?></a>
								</div>
							</div>
						<?php
						}
					}
				}
				wp_reset_query();
				?>
		</div>
	</div>
</div>

<div class="container" id="people-of-mozilla">
	<div class="row">
		<div class="col-sm-12">
			<div class="headline-divider">
				<div class="pixel-bar" <?php if ( get_field('headline_bc_people_of_mozilla', $id) ) { echo 'style="background-color:'. get_field('headline_bc_people_of_mozilla', $id) .'"'; } ?>></div>
				<span class="headline" <?php if ( get_field('headline_bc_people_of_mozilla', $id) ) { echo 'style="background-color:'. get_field('headline_bc_people_of_mozilla', $id) .'"'; } ?>><?php the_field('headline_people_of_mozilla', $id); ?></span>
			</div>
		</div>
	</div>

	<?php
	query_posts(array( 'post_type' => 'people' ));
	if ( have_posts() ) {
		$i = 1;
		$open = false;
		while ( have_posts() ) {
			the_post();
            if ($i == 1) { echo '<div class="inital">'; }
			if ( $i % 2 == 1 ) { echo '<div class="row">'; $open = true; };
			?>
			<div class="col-sm-6">
				<div class="teaser-whitebox-overlap">
					<div class="inner">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('2col-thumbnail'); ?>
							</a>
						<?php endif; ?>
						<a class="no-style" href="<?php the_permalink(); ?>">
							<div class="white-box">
								<h2 class="headline"><?php the_title(); ?></h2>
							</div>
						</a>
					</div>
					<div style="display:none" class="white-box-after">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>"><?php if(get_field('read_more_alternative')){echo get_field('read_more_alternative'); }else{echo 'read more';} ?></a>
					</div>
				</div>
			</div>
			<?php
			if ( $i % 2 == 0 ) { echo '</div>'; $open = false; };
            if ($i == 4) { echo '</div><div class="more-people">'; }
			$i++;
		}
		if ( $open == true ) { echo '</div>'; };
        if ( $i >= 4 ) { echo "</div>"; };
	}
	wp_reset_query();
	?>
	<div class="button show-more-people"><?php the_field('button_text_people_of_mozilla', $id); ?></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="headline-divider small">
				<div class="pixel-bar" <?php if ( get_field('headline_bc_join', $id) ) { echo 'style="background-color:'. get_field('headline_bc_join', $id) .'"'; } ?>></div>
				<span class="headline" <?php if ( get_field('headline_bc_join', $id) ) { echo 'style="background-color:'. get_field('headline_bc_join', $id) .'"'; } ?>><?php the_field('headline_join', $id); ?></span>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row social-media-wrapper">
		<div class="col-sm-12">
			<h2 class="headline"><?php the_field('subheadline_socialmedia', $id); ?></h2>
		</div>
	</div>

	<?php include (TEMPLATEPATH . '/assets/partials/socialmedia.php'); ?>

</div>

<div class="container teaser-whitebox-large-wrapper">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="headline-responsive" style="<?php if(get_field('link_meet_the_experts_color', $id)){echo 'background-color:'.get_field('link_meet_the_experts_color', $id).';box-shadow: 8px 0 0 '.get_field('link_meet_the_experts_color', $id).', -8px 0 0 '.get_field('link_meet_the_experts_color', $id).';';} ?>" ><?php the_field('headline_meet_the_experts',$id); ?></h2>
			<div class="teaser-whitebox-large">
				<a class="no-style" href="<?php echo get_field('link_meet_the_experts',$id)['url']; ?>" target="<?php echo get_field('link_meet_the_experts',$id)['target']; ?>">
				<div class="background" style="background-image:url('<?php if( get_field('image_meet_the_experts',$id) ){ echo get_field('image_meet_the_experts',$id); }?>')"></div>
				<div class="white-box">
					<h2 class="headline" style="<?php if(get_field('link_meet_the_experts_color', $id)){echo 'background-color:'.get_field('link_meet_the_experts_color', $id).';box-shadow: 8px 0 0 '.get_field('link_meet_the_experts_color', $id).', -8px 0 0 '.get_field('link_meet_the_experts_color', $id).';';} ?>" ><?php the_field('headline_meet_the_experts',$id); ?></h2>
					<p><?php the_field('text_meet_the_experts',$id); ?></p>
				</div>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">

		</div>
	</div>
	<div class="row flex">
        <div class="col-md-6">
            <?php include (TEMPLATEPATH . '/assets/partials/meetup.php'); ?>
        </div>
        <div class="col-md-6 additional-links">
            <div class="row">
               <?php
                if( have_rows('additional_links_image', $id) ):
                    while ( have_rows('additional_links_image', $id) ) : the_row();
                        ?>
                        <div class="col-sm-4 column">
                            <div class="teaser-whitebox-background">
                                <a class="no-style" href="<?php echo get_sub_field('url')['url'];?>">
                                    <div class="background" style="background-image:url('<?php if( get_sub_field('image') ){ echo get_sub_field('image'); }?>')"></div>
                                    <div class="white-box">
                                        <h2 class="headline"><?php the_sub_field('headline') ?></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else :
                endif;
                ?>
            </div>
	    </div>
	</div>
</div>

<div class="newsletter-outer-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="newsletter-wrapper">
					<div class="row">
						<div class="col-sm-6 left">
							<?php
							$image = get_field('image_newsletter', $id);
							if( !empty($image) ): ?>
								<img src="<?php echo $image['sizes']['newsletter']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
							<h2 class="headline"><?php the_field('headline_newsletter', $id); ?></h2>
							<p><?php the_field('text_newsletter', $id); ?></p>
						</div>
						<div class="col-sm-6">
							<div class="newsletter-inner">
								<div class="newsletter" id="newsletter_wrap">
								<form id="newsletter_form" name="newsletter_form" action="https://www.mozilla.org/en-US/newsletter/" method="post">
									<?php // the_field('text_newsletter_form', $id); ?>
									<input type="hidden" id="fmt" name="fmt" value="H">
									<input type="hidden" id="newsletters" name="newsletters" value="mozilla-and-you">

									<div id="newsletter_errors" class="newsletter_errors"></div>

									<div id="newsletter_email" class="form_group">
										<input type="email" id="email" name="email" class="form_input" required placeholder="<?php the_field('text_newsletter_placeholder', $id); ?>" size="30">
									</div>

									<div id="newsletter_privacy" class="form_group form_group-agree">
										<input type="checkbox" id="privacy" name="privacy" required>
										<label for="privacy">
											<?php the_field('text_newsletter_form_privacy', $id); ?>
										</label>
									</div>
									<div id="newsletter_submit">
										<button id="newsletter_submit" type="submit" class="btn btn-success"><?php the_field('button_newsletter', $id); ?></button>
									</div>
								</form>
								<div id="newsletter_thanks" class="newsletter_thanks">
									<?php the_field('text_newsletter_success', $id); ?>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if( have_rows('additional_links_colored_DEL', $id) ):
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="headline-divider small">
				<div class="pixel-bar" <?php if ( get_field('headline_bc_more', $id) ) { echo 'style="background-color:'. get_field('headline_bc_more', $id) .'"'; } ?>></div>
				<span class="headline" <?php if ( get_field('headline_bc_more', $id) ) { echo 'style="background-color:'. get_field('headline_bc_more', $id) .'"'; } ?>><?php the_field('headline_more', $id); ?></span>
			</div>
		</div>
	</div>
</div>
<?php


	echo '<div class="container">';
		echo '<div class="row">';
			while ( have_rows('additional_links_colored', $id) ) : the_row();
				?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="teaser-colored">
						<a href="<?php if( get_sub_field('url') ){ echo get_sub_field('url')['url']; }else{ echo "#"; }; ?>" class="no-style">
							<?php if( get_sub_field('background_color') ){ $color = get_sub_field('background_color'); }else{ $color = "#9194b0"; }; ?>
							<div class="inner">
									<h2 class="headline"><?php the_sub_field('headline'); ?></h2>
									<div class="bg-color" style="background-color: <?php echo $color; ?>"></div>
							</div>
						</a>
					</div>
				</div>
				<?php
			endwhile;
		echo '</div>';
	echo '</div>';
else :
endif;
?>


<?php get_footer(); ?>
