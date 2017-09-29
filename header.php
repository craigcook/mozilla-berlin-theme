<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="header-inner">
						<a class="logo" href="<?php echo get_site_url(); ?>" title="<?php bloginfo(); ?>">
							<?php if ( is_front_page() ) { ?>
								<h1><img src="<?php echo get_template_directory_uri();?>/assets/img/mozilla-berlin_logo.svg" width="200" height="31" alt="Mozilla Berlin" /></h1>
							<?php } else { ?>
								<img src="<?php echo get_template_directory_uri();?>/assets/img/mozilla-berlin_logo.svg" width="200" height="31" alt="Mozilla Berlin" />
							<?php } ?>
						</a>
						<div class="nav-wrappper">
							<?php wp_nav_menu(array( 'theme_location' => 'primary','container' => 'nav' )); ?>
							<div class="toggle-nav"><span></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
