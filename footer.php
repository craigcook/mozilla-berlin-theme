<?php
/**
 * mozilla_berlin
 */
?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<?php if (is_page_template('page-templates/experts-dark.php')) { ?>
						<a class="logo" href="<?php echo get_site_url(); ?>" title="<?php bloginfo(); ?>"><img width="110" height="31" src="<?php echo get_template_directory_uri() ?>/assets/img/mozilla-berlin_logo_footer_black.svg" /></a>
						<?php } else { ?>
								<a class="logo" href="<?php echo get_site_url(); ?>" title="<?php bloginfo(); ?>"><img width="110" height="31" src="<?php echo get_template_directory_uri() ?>/assets/img/mozilla-berlin_logo_footer.svg" /></a>
						<?php } ?>
					</div>
					<div class="col-sm-4 left">
						<h2 class="headline"><?php the_field('navigation_left_headline','options') ?></h2>
						<?php wp_nav_menu(array( 'theme_location' => 'footer_left','container' => 'nav' )); ?>
						<?php
						if( have_rows('social_media_left','options') ): ?>
							<div class="soma-wrapper">
							<?php while ( have_rows('social_media_left','options') ) : the_row();
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
					<div class="col-sm-4 right">
						<h2 class="headline"><?php the_field('navigation_right_headline','options') ?></h2>
						<?php wp_nav_menu(array( 'theme_location' => 'footer_right','container' => 'nav' )); ?>
						<?php
						if( have_rows('social_media_right','options') ): ?>
							<div class="soma-wrapper">
							<?php while ( have_rows('social_media_left','options') ) : the_row();
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
				<div class="row meta">
					<div class="col-sm-12">
						<?php wp_nav_menu(array( 'theme_location' => 'footer_meta','container' => 'nav' )); ?>
					</div>
				</div>
				<div class="row meta">
					<div class="col-sm-9">
						<?php the_field('license_text','options'); ?>
					</div>
					<div class="col-sm-3">
						<?php if ( get_field('language_text','options') ) { ?><span class="lang-text"><?php the_field('language_text','options'); ?></span><?php } ?>
						<?php
						if ( function_exists('icl_object_id') ) {
							$languages = icl_get_languages();
								if(1 < count($languages)){
									foreach($languages as $l){
									   if($l['active']) $langs[] = '<option value="'.$l['url'].'">'.$l['translated_name'].'</option>';
									}
									foreach($languages as $l){
									   if(!$l['active']) $langs[] = '<option value="'.$l['url'].'">'.$l['translated_name'].'</option>';
									}
									?>
									<select id="lang-select" size="1">
										<?php
											echo join(', ', $langs);
										?>
									</select>
									<?php
								} else {
									foreach($languages as $l){
									   if($l['active']) echo '<select id="lang-select" size="1"><option>'.$l['translated_name'].'</option></select>';
									}
								}
						}
						?>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
