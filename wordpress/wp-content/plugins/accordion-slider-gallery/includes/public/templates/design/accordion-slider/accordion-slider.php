<style type="text/css">

    .as-panels .as-panel .text-block {
      position: absolute;
      left: 30px;
      bottom: 30px;
      max-width: 400px;
      padding: 20px;
      border-radius: 5px;
      background-color: rgba(0, 0, 0, 0.6);
      color: #fff;
      z-index: 4;
      visibility: hidden;
    }
    .as-panels .as-panel .text-block h3 {
      font-size: 20px;
      font-weight: 700;
    }
    .as-panels:hover .as-panel:hover {
      -ms-flex-negative: 0;
          flex-shrink: 0;
          /*cursor: move;*/
      width: 100%;
    }

    .as-panels .as-panel .text-block {
      bottom: 60px;
    }
    
    .as-panels:hover .as-panel:hover .text-block {
      -webkit-transition-property: all;
      transition-property: all;
      -webkit-transition-duration: 0.2s;
              transition-duration: 0.2s;
      -webkit-transition-timing-function: linear;
              transition-timing-function: linear;
      -webkit-transition-delay: 0.5s;
              transition-delay: 0.5s;
      bottom: 30px;
      opacity: 1;
      visibility: visible;
    }

    <?php echo esc_attr($settings['style']); ?>

</style>

<?php
$width = $settings['width'];
$height = $settings['height'];
$orientation = $settings['orientation'];
$visible_images = $settings['visible_images'];
$image_distance = $settings['image_distance'];
$max_opened_image_size = $settings['max_opened_image_size'];
$open_image_on = $settings['open_image_on'];
$shadow = $settings['shadow'];
$autoplay = $settings['autoplay'];
$mouse_wheel = $settings['mouse_wheel'];
$close_panel_on_mouse_out = $settings['close_panel_on_mouse_out'];
$autoplay_direction = $settings['autoplay_direction'];
$autoplay_delay = $settings['autoplay_delay'];

$shadow       = ($shadow == '1') ? 'true' : 'false';
$autoplay     = ($autoplay == '1') ? 'true' : 'false';
$mouse_wheel  = ($mouse_wheel == '1') ? 'true' : 'false';
$close_panel_on_mouse_out = ($close_panel_on_mouse_out == '1') ? 'true' : 'false';


$slider_conf = compact('visible_images', 'width', 'height', 'orientation','image_distance', 'max_opened_image_size','open_image_on','shadow','autoplay','mouse_wheel', 'close_panel_on_mouse_out', 'autoplay_direction', 'autoplay_delay' );

?>
<div id="my-accordion-<?php echo esc_attr($PostId); ?>" class="accordion-slider accordion-slider-<?php echo esc_attr($PostId); ?>" style="margin-bottom: 100px;">
        <div class="as-panels">
            <?php
            foreach ( $images as $image ): ?>
                    <?php 
                        
                        $image_object = get_post( $image['id'] );

                        if ( is_wp_error( $image_object ) || get_post_type( $image_object ) != 'attachment' ) {
                            continue;
                        }

                        /*--image cropping--*/
                        $id=$image['id'];
                      
                        $url = wp_get_attachment_image_src($id, 'as_accordion_slider', true);
                    
                       ?>  
                        <div class="as-panel">
                            <img class="as-background" src="<?php echo esc_url($url[0]); ?>"/>


                        <?php if($image['title'] || $image['description']) { ?>
                          <div class="text-block">
                            <?php if( ! $settings['hide_title']  ): ?>
                                <h3 style="
                                font-size: <?php echo esc_attr($settings['titleFontSize']) ?>px;
                                font-family: <?php echo esc_attr($settings['font_family']) ?>;
                                color: <?php echo esc_attr($settings['titleColor']) ?>;
                                background-color: <?php echo esc_attr($settings['titleBgColor']) ?>;
                                    margin: 8px 0;
                                    text-align: justify;
                                "><?php echo esc_html($image['title']); ?></h3>
                            <?php endif ?>
                            <div class="text">
                              <?php if( ! $settings['hide_description']  ): ?>
                                <p style="
                                font-size: <?php echo esc_attr($settings['captionFontSize']) ?>px;
                                font-family: <?php echo esc_attr($settings['font_family']) ?>;
                                              color: <?php echo esc_attr($settings['captionColor']) ?>;
                                              background-color: <?php echo esc_attr($settings['captionBgColor']) ?>;
                                                  margin: 0 0 8px 0;
                                                  text-align: justify;
                                "><?php echo wp_kses_post($image['description']); ?></p>
                              <?php endif ?>
                            </div>
                          </div>
                        <?php } ?> 


                        </div>
               <?php endforeach; ?>                      
        </div>
        <div class="wpaas-conf-<?php echo esc_attr($PostId); ?>" style="display: none;"><?php echo esc_html(json_encode($slider_conf)); ?></div>
    </div>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $( '.accordion-slider-<?php echo esc_attr($PostId); ?>' ).each(function( index ) { 
            var slider_id   = $(this).attr('id');  
            var slider_conf = $.parseJSON( $(this).closest('#my-accordion-<?php echo esc_attr($PostId); ?>').find('.wpaas-conf-<?php echo esc_attr($PostId); ?>').text());
                
            if( typeof(slider_id) != 'undefined' && slider_id != '' ) { 
                $('#my-accordion-<?php echo esc_attr($PostId); ?>').WPaccordionSlider({
                width:parseInt(slider_conf.width), 
                height: parseInt(slider_conf.height),
                responsiveMode: 'custom',
                orientation: slider_conf.orientation,
               /* openedPanelSize: '40%',*/
                maxOpenedPanelSize: slider_conf.max_opened_image_size,
                openPanelOn: slider_conf.open_image_on,
                visiblePanels: parseInt(slider_conf.visible_images),
                autoplayDirection: slider_conf.autoplay_direction,
                autoplayDelay: parseInt(slider_conf.autoplay_delay),
                startPanel: -1,
                /*
                startPanel: -1, //start setting
                --closePanelsOnMouseOut: true, 
                mouseDelay: 500, 
                openPanelDuration: 2000,
                closePanelDuration: 1000,
                --autoplayDelay: 3000,
                --autoplayDirection:'backwards',
                autoplayOnHover:'pause',
                --keyboard: true,
                */

                panelDistance: parseInt(slider_conf.image_distance),
                shadow     : (slider_conf.shadow)      == "true"           ? true          : false,
                autoplay   : (slider_conf.autoplay)    == "true"           ? true          : false,
                mouseWheel : (slider_conf.mouse_wheel) == "true"           ? true          : false,    
                closePanelsOnMouseOut : (slider_conf.close_panel_on_mouse_out) == "true"           ? true          : false,    
                   
                breakpoints: {
                    960: {visiblePanels: (parseInt(slider_conf.visible_images) > 5) ? 5 : parseInt(slider_conf.visible_images)},
                    800: {visiblePanels: (parseInt(slider_conf.visible_images) > 3) ? 3 : parseInt(slider_conf.visible_images)},
                    650: {visiblePanels: 3},
                    500: {visiblePanels: 3}
                }
             });
            }
        });
    });
</script>