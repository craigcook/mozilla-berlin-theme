<?php
// check if the flexible content field has rows of data
if( have_rows('page_content') ):

    // loop through the rows of data
    while ( have_rows('page_content') ) : the_row();

        if( get_row_layout() == 'text' ):
            ?>

            <div class="row element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-offset-2 col-sm-8">
                    <?php the_sub_field('text'); ?>
                </div>
            </div>
            
            <?php
        elseif( get_row_layout() == 'intro_text' ): 
            ?>

            <div class="row intro-text element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-offset-2 col-sm-8">
                    <?php the_sub_field('text'); ?>
                </div>
            </div>

            <?php
        elseif( get_row_layout() == 'image' ): 

            if ( get_sub_field('width') == "Full" ) { echo '</div><div class="container-fluid">'; };
            ?>
            <div class="row element-margin two-images" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="<?php if ( get_sub_field('width') == "Small" ) {echo "col-sm-6 col-sm-offset-3";}elseif(get_sub_field('width') == "Content"){echo "col-sm-8 col-sm-offset-2";}elseif(get_sub_field('width') == "Full"){echo "";} ?>">
                    <?php 
					$image = get_sub_field('image');
					if( !empty($image) ): ?>
						<img src="<?php if ( get_sub_field('width') == "Full" ) { echo $image['url']; } elseif (get_sub_field('width') == "Content") { echo $image['sizes']['contentcol']; } else { echo $image['sizes']['2col']; } ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
                </div>
            </div>
            <?php
			if ( get_sub_field('width') == "Full" ) { echo '</div><div class="container">'; };


        elseif( get_row_layout() == 'text_image' ): 
            $position = get_sub_field('image_position');
            ?>
            <div class="row element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-offset-1 col-sm-10">
                    <div class="row">
                        <div class="<?php if ( $position == "Left" ) { echo "col-sm-6"; } else { echo "col-sm-push-6 col-sm-6"; }; ?>">
                            <?php $image = get_sub_field('image');
                            if( !empty($image) ): ?>
                                <img src="<?php echo $image['sizes']['2col']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="<?php if ( $position == "Left" ) { echo "col-sm-offset-1 col-sm-5"; } else { echo "col-sm-pull-6 col-sm-5"; }; ?>">
                            <?php the_sub_field('text'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        elseif( get_row_layout() == 'slider_gallery' ): 
            $layout = get_sub_field('layout');

            $images = get_sub_field('images');
            ?>
            <div class="row element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-12">
					<div class="row">
						<?php
						if( $images ): ?>
							<div class="<?php if ( $layout == "One Column" ) { echo "page-slider-large"; } else { echo "page-slider"; }; ?>">
								<?php foreach( $images as $image ): ?>
									<div class="<?php if ( $layout == "One Column" ) { echo "col-sm-12"; } else { echo "col-sm-3"; }; ?>">
										<?php if ( $layout == "One Column" ) { ?>
											<img src="<?php echo $image['sizes']['gallery-large']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php } else { ?>
											<img src="<?php echo $image['sizes']['gallery']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php }; ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif;
						?>
					</div>
                </div>
            </div>
            <?php

        elseif( get_row_layout() == 'label' ): 
        	?>
            <div class="row element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="label" style="text-align:<?php if ( get_sub_field('text_alignment') == "Right" ) { echo "right"; } elseif ( get_sub_field('text_alignment') == "Centered" ) { echo "center"; } else { echo "left"; } ?>">
                        <?php the_sub_field('text'); ?>
                    </div>
                </div>
            </div>
            <?php

        elseif( get_row_layout() == 'infobox' ): 
            ?>
            <div class="row element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="infobox">
                        <div><span class="headline"><?php the_sub_field('headline'); ?></span></div>
                        <div><p><?php the_sub_field('text'); ?></p></div>
                        <?php if ( get_sub_field('url') ){ ?><a href="<?php echo get_sub_field('url')['url'] ?>"><?php echo get_sub_field('url')['title'] ?></a><?php } ?>
                    </div>
                </div>
            </div>
            <?php

        elseif( get_row_layout() == 'two_images' ): 
			if ( get_sub_field('width') == "Full" ) { echo '</div><div class="container-fluid">'; };
            ?>
            <div class="row element-margin two-images" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } ?><?php if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } ?>">
                <div class="col-sm-6 left">
                    <?php 
					$image = get_sub_field('image_left');
					if( !empty($image) ): ?>
						<img src="<?php if ( get_sub_field('width') == "Full" ) { echo $image['url']; } else { echo $image['sizes']['2col']; } ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
                </div>
                <div class="col-sm-6 right">
                    <?php 
					$image = get_sub_field('image_right');
					if( !empty($image) ): ?>
						<img src="<?php if ( get_sub_field('width') == "Full" ) { echo $image['url']; } else { echo $image['sizes']['2col']; } ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
                </div>
            </div>
            <?php
			if ( get_sub_field('width') == "Full" ) { echo '</div><div class="container">'; };

        elseif( get_row_layout() == 'background_image' ): 
			echo '</div>';
            ?>
            <div class="background-image element-margin" style="<?php if ( get_sub_field('margin_top') ) { echo "margin-top: ".get_sub_field('margin_top')."px;"; } if ( get_sub_field('margin_bottom') ) { echo "margin-bottom: ".get_sub_field('margin_bottom')."px;"; } if(get_sub_field('image')){echo "background-image:url(".get_sub_field('image')['url'].");";}; if(get_sub_field('height')){echo "height:".get_sub_field('height')."px;";}; if(get_sub_field('proportional_scaling_height_padding_bottom')){echo "padding-bottom:".get_sub_field('proportional_scaling_height_padding_bottom')."%;";}; ?>" ></div>
            <?php 
			echo '<div class="container">';
	

        endif;

    endwhile;

else :

    // no layouts found

endif;