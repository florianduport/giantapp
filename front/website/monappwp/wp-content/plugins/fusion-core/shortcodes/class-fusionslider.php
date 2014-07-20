<?php
class FusionSC_FusionSlider {

    public static $parent_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_shortcode( 'fusionslider', array( $this, 'render_parent' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args    Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_parent( $args, $content = '') {

        global $smof_data;
       
		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'name' 	        => '',
			), $args
		);	

        extract( $defaults );

        self::$parent_args = $defaults;

        ob_start();

        $term = $name;

        $term_details = get_term_by( 'slug', $term, 'slide-page' );

        $slider_settings = get_option( 'taxonomy_' . $term_details->term_id );
        $slider_data = '';
        
        if( $slider_settings ) {
            foreach( $slider_settings as $slider_setting => $slider_setting_value ) {
                $slider_data .= 'data-' . $slider_setting . '="' . $slider_setting_value . '" ';
            }
        }

        $slider_class = '';

        if( $slider_settings['slider_width'] == '100%' && ! $slider_settings['full_screen'] ) {
            $slider_class .= ' full-width-slider';
        }

        if( $slider_settings['slider_width'] != '100%' && ! $slider_settings['full_screen'] ) {
            $slider_class .= ' fixed-width-slider';
        }

        $args                = array(
            'post_type'        => 'slide',
            'posts_per_page'   => -1,
            'suppress_filters' => 0
        );
        $args['tax_query'][] = array(
            'taxonomy' => 'slide-page',
            'field'    => 'slug',
            'terms'    => $term
        );

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
        ?>
            <div class="fusion-slider-container <?php echo $slider_class; ?>-container" style="height:<?php echo $slider_settings['slider_height']; ?>;max-width:<?php echo $slider_settings['slider_width']; ?>;">
                <div class="tfs-slider flexslider main-flex<?php echo $slider_class; ?>" style="max-width:<?php echo $slider_settings['slider_width']; ?>;" <?php echo $slider_data; ?>>
                    <ul class="slides" style="width:<?php echo $slider_settings['slider_width']; ?>;">
                        <?php
                        while( $query->have_posts() ): $query->the_post();
                            $metadata = get_metadata( 'post', get_the_ID() );
                            
                            $background_image = '';
                            $background_class = '';

                            $img_width = '';

                            if( isset( $metadata['pyre_type'][0] ) && $metadata['pyre_type'][0] == 'image' && has_post_thumbnail() ) {
                                $image_id = get_post_thumbnail_id();
                                $image_url = wp_get_attachment_image_src( $image_id, 'full', true );
                                $background_image = 'background-image: url(' . $image_url[0] . ');';
                                $background_class = 'background-image';
                                $img_width = $image_url[1];
                            }

                            $video_attributes = '';
                            $youtube_attributes = '';
                            $vimeo_attributes = '';
                            $data_mute = 'no';
                            $data_loop = 'no';
                            $data_autoplay = 'no';

                            if( isset( $metadata['pyre_mute_video'][0] ) && $metadata['pyre_mute_video'][0] == 'yes' ) {
                                $video_attributes = 'muted';
                                $data_mute = 'yes';
                            }

                            if( isset( $metadata['pyre_autoplay_video'][0] ) && $metadata['pyre_autoplay_video'][0] == 'yes' ) {
                                $video_attributes .= ' autoplay';
                                $youtube_attributes .= '&amp;autoplay=0';
                                $vimeo_attributes .= '&amp;autoplay=0';
                                $data_autoplay = 'yes';
                            }

                            if( isset( $metadata['pyre_loop_video'][0] ) && $metadata['pyre_loop_video'][0] == 'yes' ) {
                                $video_attributes .= ' loop';
                                $youtube_attributes .= '&amp;loop=1&amp;playlist=' . $metadata['pyre_youtube_id'][0];
                                $vimeo_attributes .= '&amp;loop=1';
                                $data_loop = 'yes';
                            }

                            if( isset ( $metadata['pyre_hide_video_controls'][0] ) && $metadata['pyre_hide_video_controls'][0] == 'no' ) {
                                $video_attributes .= ' controls';
                                $youtube_attributes .= '&amp;controls=1';
                                $video_zindex = 'z-index: 1;';
                            } else {
                                $youtube_attributes .= '&amp;controls=0';
                                $video_zindex = 'z-index: -99;';
                            }

                            $heading_color = '';

                            if( isset ( $metadata['pyre_heading_color'][0] ) && $metadata['pyre_heading_color'][0] ) {
                                $heading_color = 'color:' . $metadata['pyre_heading_color'][0] . ';';
                            }

                            $heading_bg = '';

                            if( isset ( $metadata['pyre_heading_bg'][0] ) && $metadata['pyre_heading_bg'][0] == 'yes' ) {
                                $heading_bg = 'background-color: rgba(0,0,0, 0.4);';
                            }

                            $caption_color = '';

                            if( isset ( $metadata['pyre_caption_color'][0] ) && $metadata['pyre_caption_color'][0] ) {
                                $caption_color = 'color:' . $metadata['pyre_caption_color'][0] . ';';
                            }

                            $caption_bg = '';

                            if( isset ( $metadata['pyre_caption_bg'][0] ) && $metadata['pyre_caption_bg'][0] == 'yes' ) {
                                $caption_bg = 'background-color: rgba(0, 0, 0, 0.4);';
                            }

                            $video_bg_color = '';

                            if( isset ( $metadata['pyre_video_bg_color'][0] ) && $metadata['pyre_video_bg_color'][0] ) {
                                $video_bg_color_hex = avada_hex2rgb( $metadata['pyre_video_bg_color'][0]  );
                                $video_bg_color = 'background-color: rgba(' . $video_bg_color_hex[0] . ', ' . $video_bg_color_hex[1] . ', ' . $video_bg_color_hex[2] . ', 0.4);';
                            }

                            $video = false;

                            if( isset( $metadata['pyre_type'][0] ) ) {
                                if( isset( $metadata['pyre_type'][0] ) && $metadata['pyre_type'][0] == 'self-hosted-video' || $metadata['pyre_type'][0] == 'youtube' || $metadata['pyre_type'][0] == 'vimeo' ) {
                                    $video = true;
                                }
                            }

                            if( isset ( $metadata['pyre_type'][0] ) &&  $metadata['pyre_type'][0] == 'self-hosted-video' ) {
                                $background_class = 'self-hosted-video-bg';
                            }

                            $heading_font_size = 'font-size:60px;line-height:80px;';
                            if( isset ( $metadata['pyre_heading_font_size'][0] ) && $metadata['pyre_heading_font_size'][0] ) {
                                $line_height = $metadata['pyre_heading_font_size'][0] * 1.4;
                                $heading_font_size = 'font-size:' . $metadata['pyre_heading_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
                            }

                            $caption_font_size = 'font-size: 24px;line-height:38px;';
                            if( isset ( $metadata['pyre_caption_font_size'][0] ) && $metadata['pyre_caption_font_size'][0] ) {
                                $line_height = $metadata['pyre_caption_font_size'][0] * 1.4;
                                $caption_font_size = 'font-size:' . $metadata['pyre_caption_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
                            }
                        ?>
                        <li data-mute="<?php echo $data_mute; ?>" data-loop="<?php echo $data_loop; ?>" data-autoplay="<?php echo $data_autoplay; ?>">
                            <div class="slide-content-container slide-content-<?php echo $metadata['pyre_content_alignment'][0]; ?>">
                                <div class="slide-content">
                                    <?php if( isset ( $metadata['pyre_heading'][0] ) && $metadata['pyre_heading'][0] ): ?>
                                    <div class="heading animated fadeInUp <?php if($heading_bg): echo 'with-bg'; endif; ?>" data-animationtype="fadeInUp" data-animationduration="1"><h2 style="<?php echo $heading_bg; ?><?php echo $heading_color; ?><?php echo $heading_font_size; ?>"><?php echo $metadata['pyre_heading'][0]; ?></h2></div>
                                    <?php endif; ?>
                                    <?php if( isset ( $metadata['pyre_caption'][0] ) && $metadata['pyre_caption'][0] ): ?>
                                    <div class="caption animated fadeInUp <?php if($caption_bg): echo 'with-bg'; endif; ?>" data-animationtype="fadeInUp" data-animationduration="1"><h3 style="<?php echo $caption_bg; ?><?php echo $caption_color; ?><?php echo $caption_font_size; ?>"><?php echo $metadata['pyre_caption'][0]; ?></h3></div>
                                    <?php endif; ?>
                                    <?php if( isset ( $metadata['pyre_link_type'][0] ) && $metadata['pyre_link_type'][0] == 'button' ): ?>
                                    <div class="buttons animated fadeInUp" data-animationtype="fadeInUp" data-animationduration="1">
                                        <?php
                                        if( isset ( $metadata['pyre_button_1'][0] ) && $metadata['pyre_button_1'][0] ) {
                                            echo '<div class="tfs-button-1">' . do_shortcode( $metadata['pyre_button_1'][0] ) . '</div>';
                                        }
                                        if( isset ( $metadata['pyre_button_2'][0] ) && $metadata['pyre_button_2'][0] ) {
                                            echo '<div class="tfs-button-2">' . do_shortcode( $metadata['pyre_button_2'][0] ) . '</div>';
                                        }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if( isset( $metadata['pyre_link_type'][0] ) && $metadata['pyre_link_type'][0] == 'full' && isset( $metadata['pyre_slide_link'][0] ) && $metadata['pyre_slide_link'][0] ): ?>
                            <a href="<?php echo $metadata['pyre_slide_link'][0]; ?>" class="overlay-link"></a>
                            <?php endif; ?>
                            <?php if( isset ( $metadata['pyre_preview_image'][0] ) && $metadata['pyre_preview_image'][0] ): ?>
                            <div class="mobile_video_image" style="background-image: url(<?php echo $metadata['pyre_preview_image'][0]; ?>);"></div>
                            <?php elseif( isset( $metadata['pyre_type'][0] ) && $metadata['pyre_type'][0] == 'self-hosted-video' ): ?>
                            <div class="mobile_video_image" style="background-image: url(<?php echo bloginfo('template_directory'); ?>/images/video_preview.jpg);"></div>
                            <?php endif; ?>
                            <?php if( $video_bg_color && $video == true ): ?>
                            <div class="overlay" style="<?php echo $video_bg_color; ?>"></div>
                            <?php endif; ?>
                            <div class="background <?php echo $background_class; ?>" style="<?php echo $background_image; ?>width:<?php echo $slider_settings['slider_width']; ?>;height:<?php echo $slider_settings['slider_height']; ?>;" data-imgwidth="<?php echo $img_width; ?>">
                                <?php if( isset( $metadata['pyre_type'][0] ) ): if( $metadata['pyre_type'][0] == 'self-hosted-video' && ( $metadata['pyre_webm'][0] || $metadata['pyre_mp4'][0] || $metadata['pyre_ogg'][0] ) ): ?>
                                <video width="1800" height="700" <?php echo $video_attributes; ?> preload="auto">
                                    <?php if( $metadata['pyre_mp4'][0] ): ?>
                                    <source src="<?php echo $metadata['pyre_mp4'][0]; ?>" type="video/mp4">
                                    <?php endif; ?>
                                    <?php if( $metadata['pyre_ogg'][0] ): ?>
                                    <source src="<?php echo $metadata['pyre_ogg'][0]; ?>" type="video/ogg">
                                    <?php endif; ?>
                                    <?php if( $metadata['pyre_webm'][0] ): ?>
                                    <source src="<?php echo $metadata['pyre_webm'][0]; ?>" type="video/webm">
                                    <?php endif; ?>
                                </video>
                                <?php endif; endif; ?>
                                <?php if( isset( $metadata['pyre_type'][0] ) && isset( $metadata['pyre_youtube_id'][0] ) && $metadata['pyre_type'][0] == 'youtube' && $metadata['pyre_youtube_id'][0] ): ?>
                                <div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%">
                                    <iframe frameborder="0" height="100%" width="100%" src="http<?php echo (is_ssl())? 's' : ''; ?>://www.youtube.com/embed/<?php echo $metadata['pyre_youtube_id'][0]; ?>?modestbranding=1&amp;showinfo=0&amp;autohide=1&amp;enablejsapi=1&amp;rel=0<?php echo $youtube_attributes; ?>"></iframe>
                                </div>
                                <?php endif; ?>
                                 <?php if( isset( $metadata['pyre_type'][0] ) && isset( $metadata['pyre_vimeo_id'][0] ) &&  $metadata['pyre_type'][0] == 'vimeo' && $metadata['pyre_vimeo_id'][0] ): ?>
                                 <div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%">
                                    <iframe src="http<?php echo (is_ssl())? 's' : ''; ?>://player.vimeo.com/video/<?php echo $metadata['pyre_vimeo_id'][0]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;badge=0&amp;title=0<?php echo $vimeo_attributes; ?>" height="100%" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php
        }

        $html = ob_get_clean();

        return $html;

    }

}

new FusionSC_FusionSlider();