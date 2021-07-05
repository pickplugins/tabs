<?php
if ( ! defined('ABSPATH')) exit;  // if direct access



add_shortcode('tabs_cron_upgrade_settings', 'tabs_cron_upgrade_settings');
add_action('tabs_cron_upgrade_settings', 'tabs_cron_upgrade_settings');

function tabs_cron_upgrade_settings(){

    $tabs_settings = get_option( 'tabs_settings', array() );

    $tabs_track_product_view = get_option( 'tabs_track_product_view' );
    $tabs_settings['track_product_view'] = $tabs_track_product_view;

    $tabs_license = get_option( 'tabs_license' );
    $license_key = isset($tabs_license['license_key']) ? $tabs_license['license_key'] : '';
    $tabs_settings['license_key'] = $license_key;


    $tabs_settings['font_aw_version'] = 'v_4';
    $tabs_settings['tabs_preview'] = 'yes';


    update_option('tabs_settings', $tabs_settings);

    wp_clear_scheduled_hook('tabs_cron_upgrade_settings');

    $tabs_plugin_info = get_option('tabs_plugin_info');
    $tabs_plugin_info['settings_upgrade'] = 'done';

    update_option('tabs_plugin_info', $tabs_plugin_info);

}





add_shortcode('tabs_cron_upgrade_tabs', 'tabs_cron_upgrade_tabs');
add_action('tabs_cron_upgrade_tabs', 'tabs_cron_upgrade_tabs');


function tabs_cron_upgrade_tabs(){

    $meta_query = array();

        $meta_query[] = array(
        'key' => 'tabs_upgrade_status',
        'compare' => 'NOT EXISTS'
    );

    $args = array(
        'post_type'=>'tabs',
        'post_status'=>'any',
        'posts_per_page'=> 10,
        'meta_query'=> $meta_query,

    );


    $tabs_fontawesome_ver = get_option('tabs_fontawesome_ver');

    $wp_query = new WP_Query($args);


    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $tabs_id = get_the_id();
            $tabs_title = get_the_title();
            $tabs_options = array();

            $tabs_options_is_saved = get_post_meta( $tabs_id, 'tabs_options', true );

            //echo $tabs_title.'<br/>';

            $tabs_options['view_type'] = 'tabs';

            $tabs_lazy_load       = get_post_meta( $tabs_id, 'tabs_lazy_load', true );
            $tabs_options['lazy_load'] = $tabs_lazy_load;

            $tabs_lazy_load_src   = get_post_meta( $tabs_id, 'tabs_lazy_load_src', true );
            $tabs_options['lazy_load_src'] = $tabs_lazy_load_src;

            $tabs_hide_edit       = get_post_meta( $tabs_id, 'tabs_hide_edit', true );
            $tabs_options['hide_edit'] = $tabs_hide_edit;

            $tabs_collapsible     = get_post_meta( $tabs_id, 'tabs_collapsible', true );
            $tabs_options['accordion']['collapsible'] = $tabs_collapsible;

            $tabs_expaned_other   = get_post_meta( $tabs_id, 'tabs_expaned_other', true );
            $tabs_options['accordion']['expanded_other'] = $tabs_expaned_other;

            $tabs_heightStyle     = get_post_meta( $tabs_id, 'tabs_heightStyle', true );
            $tabs_options['accordion']['height_style'] = $tabs_heightStyle;

            $tabs_active_event    = get_post_meta( $tabs_id, 'tabs_active_event', true );
            $tabs_options['accordion']['active_event'] = $tabs_active_event;

            $enable_search              = get_post_meta( $tabs_id, 'enable_search', true );
            $tabs_options['accordion']['enable_search'] = $enable_search;

            $search_placeholder_text              = get_post_meta( $tabs_id, 'search_placeholder_text', true );
            $tabs_options['accordion']['search_placeholder_text'] = $search_placeholder_text;

            $tabs_click_scroll_top = get_post_meta( $tabs_id, 'tabs_click_scroll_top', true );
            $tabs_options['accordion']['click_scroll_top'] = $tabs_click_scroll_top;

            $tabs_click_scroll_top_offset = get_post_meta( $tabs_id, 'tabs_click_scroll_top_offset', true );
            $tabs_options['accordion']['click_scroll_top_offset'] = $tabs_click_scroll_top_offset;

            $tabs_header_toggle   = get_post_meta( $tabs_id, 'tabs_header_toggle', true );
            $tabs_options['accordion']['header_toggle'] = $tabs_header_toggle;

            $tabs_animate_style   = get_post_meta( $tabs_id, 'tabs_animate_style', true );
            $tabs_options['accordion']['animate_style'] = $tabs_animate_style;

            $tabs_animate_delay   = get_post_meta( $tabs_id, 'tabs_animate_delay', true );
            $tabs_options['accordion']['animate_delay'] = $tabs_animate_delay;

            $tabs_expand_collapse_display = get_post_meta( $tabs_id, 'tabs_expand_collapse_display', true );
            $tabs_options['accordion']['expand_collapse_display'] = $tabs_expand_collapse_display;

            $expand_collapse_bg_color = get_post_meta( $tabs_id, 'expand_collapse_bg_color', true );
            $tabs_options['accordion']['expand_collapse_bg_color'] = $expand_collapse_bg_color;

            $expand_collapse_text = get_post_meta( $tabs_id, 'expand_collapse_text', true );
            $tabs_options['accordion']['expand_collapse_text'] = $expand_collapse_text;

            $tabs_child           = get_post_meta( $tabs_id, 'tabs_child', true );
            $tabs_options['accordion']['is_child'] = $tabs_child;


            $tabs_click_track = get_post_meta($tabs_id,'tabs_click_track', true);
            $tabs_options['enable_stats'] = $tabs_click_track;


            $tabs_tabs_collapsible = get_post_meta( $tabs_id, 'tabs_items_collapsible', true );
            $tabs_options['tabs']['collapsible'] = $tabs_tabs_collapsible;

            $auto_rotate = get_post_meta( $tabs_id, 'tabs_items_rotate', true );
            $tabs_options['tabs']['auto_rotate'] = $auto_rotate;

            $sethash = get_post_meta( $tabs_id, 'tabs_items_sethash', true );
            $tabs_options['tabs']['sethash'] = $sethash;

            $tabs_animation = get_post_meta( $tabs_id, 'tabs_items_animation', true );
            $tabs_options['tabs']['animation'] = $tabs_animation;

            $animation_duration = get_post_meta( $tabs_id, 'tabs_items_animation_duration', true );
            $tabs_options['tabs']['animation_duration'] = $animation_duration;


            $tabs_tabs_active_event = get_post_meta( $tabs_id, 'tabs_tabs_active_event', true );
            $tabs_options['tabs']['active_event'] = $tabs_tabs_active_event;

            $tabs_vertical   = get_post_meta( $tabs_id, 'tabs_vertical', true );
            $tabs_options['tabs']['tabs_vertical'] = $tabs_vertical;

            $tabs_tabs_vertical_width_ratio = get_post_meta( $tabs_id, 'tabs_tabs_vertical_width_ratio', true );
            $tabs_options['tabs']['navs_width_ratio'] = $tabs_tabs_vertical_width_ratio;

            $tabs_tabs_icon_toggle = get_post_meta( $tabs_id, 'tabs_tabs_icon_toggle', true );
            $tabs_options['tabs']['tabs_icon_toggle'] = $tabs_tabs_icon_toggle;

            $tabs_icons_plus = get_post_meta( $tabs_id, 'tabs_icons_plus', true );
            $tabs_icons_minus = get_post_meta( $tabs_id, 'tabs_icons_minus', true );

            $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa '.$tabs_icons_plus.'"></i>' : '';
            $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa '.$tabs_icons_minus.'"></i>' : '';

            $tabs_options['icon']['active'] = $tabs_icons_plus;
            $tabs_options['icon']['inactive'] = $tabs_icons_minus;

            $tabs_icons_position = get_post_meta( $tabs_id, 'tabs_icons_position', true );
            $tabs_options['icon']['position'] = $tabs_icons_position;

            $tabs_icons_color = get_post_meta( $tabs_id, 'tabs_icons_color', true );
            $tabs_options['icon']['color'] = $tabs_icons_color;

            $tabs_icons_color_hover = get_post_meta( $tabs_id, 'tabs_icons_color_hover', true );
            $tabs_options['icon']['color_hover'] = $tabs_icons_color_hover;

            $tabs_icons_font_size = get_post_meta( $tabs_id, 'tabs_icons_font_size', true );
            $tabs_options['icon']['font_size'] = $tabs_icons_font_size;

            $tabs_icons_bg_color = get_post_meta( $tabs_id, 'tabs_icons_bg_color', true );
            $tabs_options['icon']['background_color'] = $tabs_icons_bg_color;

            $tabs_icons_padding = get_post_meta( $tabs_id, 'tabs_icons_padding', true );
            $tabs_options['icon']['padding'] = $tabs_icons_padding;

            $tabs_themes = get_post_meta( $tabs_id, 'tabs_themes', true );
            //$tabs_options['accordion']['theme'] = $tabs_themes;

            $header_class = 'border-none';

            if($tabs_themes == 'flat'){
                $header_class = 'border-none';
            }elseif($tabs_themes == 'bevel'){
                $header_class = 'bevel';
            }elseif($tabs_themes == 'rounded-top'){
                $header_class = 'border-top-round';
            }elseif($tabs_themes == 'shadow'){
                $header_class = 'shadow-bottom';
            }



            $tabs_options['header']['class'] = $header_class;

            $tabs_active_bg_color = get_post_meta( $tabs_id, 'tabs_active_bg_color', true );
            $tabs_options['header']['active_background_color'] = $tabs_active_bg_color;

            $tabs_default_bg_color = get_post_meta( $tabs_id, 'tabs_default_bg_color', true );
            $tabs_options['header']['background_color'] = $tabs_default_bg_color;

            $tabs_header_bg_opacity = get_post_meta( $tabs_id, 'tabs_header_bg_opacity', true );
            $tabs_options['header']['background_opacity'] = $tabs_header_bg_opacity;

            $tabs_items_title_color = get_post_meta( $tabs_id, 'tabs_items_title_color', true );
            $tabs_options['header']['color'] = $tabs_items_title_color;

            $tabs_items_title_color_hover = get_post_meta( $tabs_id, 'tabs_items_title_color_hover', true );
            $tabs_options['header']['color_hover'] = $tabs_items_title_color_hover;

            $tabs_items_title_font_size = get_post_meta( $tabs_id, 'tabs_items_title_font_size', true );
            $tabs_options['header']['font_size'] = $tabs_items_title_font_size;

            $tabs_items_title_font_family = get_post_meta( $tabs_id, 'tabs_items_title_font_family', true );
            $tabs_options['header']['font_family'] = $tabs_items_title_font_family;

            $tabs_items_title_padding = get_post_meta( $tabs_id, 'tabs_items_title_padding', true );
            $tabs_options['header']['padding'] = $tabs_items_title_padding;

            $tabs_items_title_margin = get_post_meta( $tabs_id, 'tabs_items_title_margin', true );
            $tabs_options['header']['margin'] = $tabs_items_title_margin;

            $body_class = '';
            $tabs_options['body']['class'] = $body_class;

            $tabs_active_bg_color = get_post_meta( $tabs_id, 'tabs_active_bg_color', true );
            $tabs_options['body']['active_background_color'] = $tabs_active_bg_color;

            $tabs_items_content_bg_color = get_post_meta( $tabs_id, 'tabs_items_content_bg_color', true );
            $tabs_options['body']['background_color'] = $tabs_items_content_bg_color;

            $tabs_items_content_bg_opacity = get_post_meta( $tabs_id, 'tabs_items_content_bg_opacity', true );
            $tabs_options['body']['background_opacity'] = $tabs_items_content_bg_opacity;

            $tabs_items_content_color = get_post_meta( $tabs_id, 'tabs_items_content_color', true );
            $tabs_options['body']['color'] = $tabs_items_content_color;



            $tabs_items_content_font_size = get_post_meta( $tabs_id, 'tabs_items_content_font_size', true );
            $tabs_options['body']['font_size'] = $tabs_items_content_font_size;

            $tabs_items_content_font_family = get_post_meta( $tabs_id, 'tabs_items_content_font_family', true );
            $tabs_options['body']['font_family'] = $tabs_items_content_font_family;


            $tabs_items_content_padding = get_post_meta( $tabs_id, 'tabs_items_content_padding', true );
            $tabs_options['body']['padding'] = $tabs_items_content_padding;

            $tabs_items_content_margin = get_post_meta( $tabs_id, 'tabs_items_content_margin', true );
            $tabs_options['body']['margin'] = $tabs_items_content_margin;


            //Container options
            $tabs_container_padding = get_post_meta( $tabs_id, 'tabs_container_padding', true );
            $tabs_options['container']['padding'] = $tabs_container_padding;

            $tabs_container_margin = get_post_meta( $tabs_id, 'tabs_container_margin', true );
            $tabs_options['container']['margin'] = $tabs_container_margin;

            $tabs_container_bg_color = get_post_meta( $tabs_id, 'tabs_container_bg_color', true );
            $tabs_options['container']['background_color'] = $tabs_container_bg_color;

            $tabs_items_content_bg_opacity = get_post_meta( $tabs_id, 'tabs_items_content_bg_opacity', true );
            $tabs_options['container']['background_opacity'] = $tabs_items_content_bg_opacity;

            $tabs_bg_img = get_post_meta( $tabs_id, 'tabs_bg_img', true );
            $tabs_options['container']['background_img'] = $tabs_bg_img;

            $tabs_container_text_align = get_post_meta( $tabs_id, 'tabs_container_text_align', true );
            $tabs_options['container']['text_align'] = $tabs_container_text_align;

            $tabs_width           = get_post_meta( $tabs_id, 'tabs_width', true );
            $tabs_width_large     = !empty($tabs_width['large']) ? $tabs_width['large'] : '100%';
            $tabs_width_medium    = !empty($tabs_width['medium']) ? $tabs_width['medium'] : '100%';
            $tabs_width_small     = !empty($tabs_width['small']) ? $tabs_width['small'] : '100%';

            $tabs_options['container']['width_large'] = $tabs_width_large;
            $tabs_options['container']['width_medium'] = $tabs_width_medium;
            $tabs_options['container']['width_small'] = $tabs_width_small;


            // Custom Scripts
            $tabs_custom_css = get_post_meta($tabs_id,'tabs_custom_css', true);
            $tabs_options['custom_scripts']['custom_css'] = $tabs_custom_css;

            $tabs_custom_js = get_post_meta($tabs_id,'tabs_custom_js', true);
            $tabs_options['custom_scripts']['custom_js'] = $tabs_custom_js;


            $track_header = get_post_meta($tabs_id, 'track_header', true);
            $tabs_options['track_header'] = $track_header;

            $tabs_content_title = get_post_meta($tabs_id,'tabs_content_title', true);
            $tabs_content_title_icon = get_post_meta($tabs_id,'tabs_content_title_icon', true);
            $tabs_content_title_icon_custom = get_post_meta($tabs_id,'tabs_content_title_icon_custom', true);
            $tabs_content_title_icon_font_size = get_post_meta($tabs_id,'tabs_content_title_icon_font_size', true);
            $tabs_content_title_icon_font_color = get_post_meta($tabs_id,'tabs_content_title_icon_font_color', true);
            $tabs_content_title_icon_position = get_post_meta($tabs_id,'tabs_content_title_icon_position', true);

            $tabs_content_body = get_post_meta($tabs_id,'tabs_content_body', true);
            $tabs_content_title_toggled = get_post_meta($tabs_id,'tabs_content_title_toggled', true);
            $tabs_section_icon_plus = get_post_meta($tabs_id,'tabs_section_icon_plus', true);
            $tabs_section_icon_minus = get_post_meta($tabs_id,'tabs_section_icon_minus', true);
            $tabs_hide = get_post_meta($tabs_id,'tabs_hide', true);
            $tabs_bg_color = get_post_meta($tabs_id,'tabs_bg_color', true);
            $tabs_header_bg_img = get_post_meta($tabs_id,'tabs_header_bg_img', true);

            $tabs_active = get_post_meta($tabs_id,'tabs_active', true);

            $i = 0;

            if(!empty($tabs_content_title))
            foreach ($tabs_content_title as $index => $title){

                $tabs_options['content'][$index]['header'] = $title;
                $tabs_options['content'][$index]['body'] = isset($tabs_content_body[$index]) ? $tabs_content_body[$index] : '';
                $tabs_options['content'][$index]['hide'] = isset($tabs_hide[$index]) ? $tabs_hide[$index] : '';
                $tabs_options['content'][$index]['toggled_text'] = isset($tabs_content_title_toggled[$index]) ? $tabs_content_title_toggled[$index] : '';

                $tabs_options['content'][$index]['is_active'] = ($tabs_active == $i) ? 'yes' : 'no';


                $active_icon = !empty($tabs_content_title_icon[$index]) ? $tabs_content_title_icon[$index] : '';
                $inactive_icon = !empty($tabs_content_title_icon[$index]) ? $tabs_content_title_icon[$index] : '';

                $tabs_options['content'][$index]['active_icon'] = $active_icon;
                $tabs_options['content'][$index]['inactive_icon'] = $inactive_icon;

                $active_icon = !empty($tabs_content_title_icon_custom[$index]) ? $tabs_content_title_icon_custom[$index] : '';
                $inactive_icon = !empty($tabs_content_title_icon_custom[$index]) ? $tabs_content_title_icon_custom[$index] : '';

                $tabs_options['content'][$index]['active_icon_custom'] = $active_icon;
                $tabs_options['content'][$index]['inactive_icon_custom'] = $inactive_icon;

                $icon_font_size = !empty($tabs_content_title_icon_font_size[$index]) ? $tabs_content_title_icon_font_size[$index] : '';
                $tabs_options['content'][$index]['icon_font_size'] = $icon_font_size;

                $icon_font_color = !empty($tabs_content_title_icon_font_color[$index]) ? $tabs_content_title_icon_font_color[$index] : '';
                $tabs_options['content'][$index]['icon_font_color'] = $icon_font_color;

                $icon_position = !empty($tabs_content_title_icon_position[$index]) ? $tabs_content_title_icon_position[$index] : '';
                $tabs_options['content'][$index]['icon_position'] = $icon_position;


                $tabs_options['content'][$index]['background_color'] = isset($tabs_bg_color[$index]) ? $tabs_bg_color[$index] : '';
                $tabs_options['content'][$index]['background_img'] = isset($tabs_header_bg_img[$index]) ? $tabs_header_bg_img[$index] : '';

                $i++;
            }




            if(empty($tabs_options_is_saved)){
                update_post_meta($tabs_id, 'tabs_options', $tabs_options);
            }


            update_post_meta($tabs_id, 'tabs_upgrade_status', 'done');



            wp_reset_query();
            wp_reset_postdata();
        endwhile;
    else:

        $tabs_plugin_info = get_option('tabs_plugin_info');
        $tabs_plugin_info['tabs_upgrade'] = 'done';
        update_option('tabs_plugin_info', $tabs_plugin_info);

        wp_clear_scheduled_hook('tabs_cron_upgrade_tabs');


    endif;


}

		
		

		
		