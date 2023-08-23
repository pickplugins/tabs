<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






add_shortcode('tabs_import_cron_tabs_responsive', 'tabs_import_cron_tabs_responsive');
add_action('tabs_import_cron_tabs_responsive', 'tabs_import_cron_tabs_responsive');


function tabs_import_cron_tabs_responsive(){
    $tabs_plugin_info = get_option('tabs_plugin_info');

    $meta_query = array();

        $meta_query[] = array(
        'key' => 'import_done',
        'compare' => 'NOT EXISTS'
    );

    $args = array(
        'post_type'=>'tabs_responsive',
        'post_status'=>'publish',
        'posts_per_page'=> 1,
        'meta_query'=> $meta_query,
    );


    $tabs_fontawesome_ver = get_option('tabs_fontawesome_ver');

    $wp_query = new WP_Query($args);


    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();
            $post_title = get_the_title();
            $tabs_options = array();

            //echo $tabs_title.'<br/>';
            $wpsm_tabs_r_data       = get_post_meta( $post_id, 'wpsm_tabs_r_data', true );
            $wpsm_tabs_r_data       = unserialize( $wpsm_tabs_r_data );

            $Tabs_R_Settings = get_post_meta( $post_id, 'Tabs_R_Settings', true);
            $Tabs_R_Settings       = unserialize( $Tabs_R_Settings );


            $title_size = isset($Tabs_R_Settings['title_size']) ? $Tabs_R_Settings['title_size'] : '18';
            $tabs_sec_title = isset($Tabs_R_Settings['tabs_sec_title']) ? $Tabs_R_Settings['tabs_sec_title'] : 'yes';
            $show_tabs_title_icon = isset($Tabs_R_Settings['show_tabs_title_icon']) ? $Tabs_R_Settings['show_tabs_title_icon'] : 'yes';
            $show_tabs_icon_align = isset($Tabs_R_Settings['show_tabs_icon_align']) ? $Tabs_R_Settings['show_tabs_icon_align'] : 'left';
            $enable_tabs_border = isset($Tabs_R_Settings['enable_tabs_border']) ? $Tabs_R_Settings['enable_tabs_border'] : 'yes';
            $tabs_title_bg_clr = isset($Tabs_R_Settings['tabs_title_bg_clr']) ? $Tabs_R_Settings['tabs_title_bg_clr'] : '#e8e8e8';
            $tabs_title_icon_clr = isset($Tabs_R_Settings['tabs_title_icon_clr']) ? $Tabs_R_Settings['tabs_title_icon_clr'] : '#000000';
            $select_tabs_title_bg_clr = isset($Tabs_R_Settings['select_tabs_title_bg_clr']) ? $Tabs_R_Settings['select_tabs_title_bg_clr'] : '#000000';
            $select_tabs_title_icon_clr = isset($Tabs_R_Settings['select_tabs_title_icon_clr']) ? $Tabs_R_Settings['select_tabs_title_icon_clr'] : '#000000';
            $tabs_desc_bg_clr = isset($Tabs_R_Settings['tabs_desc_bg_clr']) ? $Tabs_R_Settings['tabs_desc_bg_clr'] : '#000000';
            $tabs_desc_font_clr = isset($Tabs_R_Settings['tabs_desc_font_clr']) ? $Tabs_R_Settings['tabs_desc_font_clr'] : '#000000';
            $des_size = isset($Tabs_R_Settings['des_size']) ? $Tabs_R_Settings['des_size'] : '16';
            $font_family = isset($Tabs_R_Settings['font_family']) ? $Tabs_R_Settings['font_family'] : 'Open Sans';
            $tabs_styles = isset($Tabs_R_Settings['tabs_styles']) ? $Tabs_R_Settings['tabs_styles'] : 1;
            $custom_css = isset($Tabs_R_Settings['custom_css']) ? $Tabs_R_Settings['custom_css'] : 1;
            $tabs_animation = isset($Tabs_R_Settings['tabs_animation']) ? $Tabs_R_Settings['tabs_animation'] : 1;
            $tabs_alignment = isset($Tabs_R_Settings['tabs_alignment']) ? $Tabs_R_Settings['tabs_alignment'] : 1;
            $tabs_position = isset($Tabs_R_Settings['tabs_position']) ? $Tabs_R_Settings['tabs_position'] : 1;
            $tabs_margin = isset($Tabs_R_Settings['tabs_margin']) ? $Tabs_R_Settings['tabs_margin'] : 1;
            $tabs_content_margin = isset($Tabs_R_Settings['tabs_content_margin']) ? $Tabs_R_Settings['tabs_content_margin'] : 1;
            $tabs_display_on_mob = isset($Tabs_R_Settings['tabs_display_on_mob']) ? $Tabs_R_Settings['tabs_display_on_mob'] : 1;
            $tabs_display_mode_mob = isset($Tabs_R_Settings['tabs_display_mode_mob']) ? $Tabs_R_Settings['tabs_display_mode_mob'] : 1;




            echo '<pre>'.var_export($tabs_sec_title, true).'</pre>';

            $tabs_icons_plus = 'plus';
            $tabs_icons_minus = 'minus';


            $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa fa-'.$tabs_icons_plus.'"></i>' : '<i class="fa fa-plus"></i>';
            $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa fa-'.$tabs_icons_minus.'"></i>' : '<i class="fa fa-minus"></i>';

            $tabs_options['icon']['active'] = $tabs_icons_plus;
            $tabs_options['icon']['inactive'] = $tabs_icons_minus;
            $tabs_options['icon']['position'] = $show_tabs_icon_align;
            $tabs_options['icon']['color'] = $tabs_title_icon_clr;
            $tabs_options['icon']['color_hover'] = '';
            $tabs_options['icon']['font_size'] = $title_size.'px';
            $tabs_options['icon']['background_color'] = '';
            $tabs_options['icon']['padding'] = '';




            $tabs_options['header']['class'] = '';
            $tabs_options['header']['active_background_color'] = '';
            $tabs_options['header']['background_color'] = $tabs_title_bg_clr;
            $tabs_options['header']['background_opacity'] = '';
            $tabs_options['header']['color'] = '';
            $tabs_options['header']['color_hover'] = '';
            $tabs_options['header']['font_size'] = $title_size.'px';
            $tabs_options['header']['font_family'] = $font_family;
            $tabs_options['header']['padding'] = '';
            $tabs_options['header']['margin'] = '';


            $tabs_options['body']['class'] = ($enable_tabs_border == 'yes') ? 'border-2px' :'';

            $tabs_options['body']['active_background_color'] = '';
            $tabs_options['body']['background_color'] = '';
            $tabs_options['body']['background_opacity'] = '';
            $tabs_options['body']['color'] = '';
            $tabs_options['body']['font_size'] = '';
            $tabs_options['body']['font_family'] = $font_family;
            $tabs_options['body']['padding'] = '';
            $tabs_options['body']['margin'] = '';





            $tabs_options['lazy_load'] = '';
            $tabs_options['lazy_load_src'] = '';
            $tabs_options['view_type'] = 'tabs';

            $tabs_options['hide_edit'] = '';
            $tabs_options['accordion']['collapsible'] =  'true' ;
            $tabs_options['accordion']['expanded_other'] = 'yes';
            $tabs_options['accordion']['height_style'] = 'content';
            $tabs_options['accordion']['active_event'] = 'click';
            $tabs_options['accordion']['enable_search'] = '';
            $tabs_options['accordion']['search_placeholder_text'] = '';
            $tabs_options['accordion']['click_scroll_top'] = '';
            $tabs_options['accordion']['click_scroll_top_offset'] = '';
            $tabs_options['accordion']['header_toggle'] = '';
            $tabs_options['accordion']['animate_style'] = '';
            $tabs_options['accordion']['animate_delay'] = '';
            $tabs_options['accordion']['expand_collapse_display'] = '';
            $tabs_options['accordion']['expand_collapse_bg_color'] = '';
            $tabs_options['accordion']['expand_collapse_text'] = '';
            $tabs_options['accordion']['is_child'] = '';





            $i = 0;

            if(!empty($wpsm_tabs_r_data))
                foreach ($wpsm_tabs_r_data as $index => $accordion_single_data){

                    $tabs_title = $accordion_single_data['tabs_title'];
                    $tabs_title_icon = $accordion_single_data['tabs_title_icon'];
                    $enable_single_icon = $accordion_single_data['enable_single_icon'];
                    $tabs_desc = $accordion_single_data['tabs_desc'];




                    $tabs_options['content'][$index]['header'] = ($show_tabs_title_icon =='yes') ? (($enable_single_icon == 'yes') ? '<i class="fa '.$tabs_title_icon.'"></i> '.$tabs_title : $tabs_title) : $tabs_title;

                    $tabs_options['content'][$index]['body'] = $tabs_desc;
                    $tabs_options['content'][$index]['hide'] = 'no';
                    $tabs_options['content'][$index]['toggled_text'] = '';


                    $tabs_options['content'][$index]['is_active'] =  'yes';


                    $active_icon = !empty($tabs_section_icon_plus[$index]) ? '<i class="fa '.$enable_single_icon.'"></i>' : '';
                    $inactive_icon = !empty($tabs_section_icon_minus[$index]) ? '<i class="fa '.$tabs_section_icon_minus[$index].'"></i>' : '';

                    $tabs_options['content'][$index]['active_icon'] = $active_icon;
                    $tabs_options['content'][$index]['inactive_icon'] = $inactive_icon;

                    $tabs_options['content'][$index]['background_color'] =  '';
                    $tabs_options['content'][$index]['background_img'] =  '';

                    $i++;
                }

            $tabs_id = wp_insert_post(
                array(
                    'post_title'    => $post_title,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_type'   	=> 'tabs',
                    'post_author'   => 1,
                )
            );

            update_post_meta($tabs_id, 'tabs_options', $tabs_options);
            update_post_meta($post_id, 'import_done', 'done');


            echo '##################';
            echo '<br/>';
            echo 'import done: '.$post_title;
            echo '<br/>';

            wp_reset_query();
            wp_reset_postdata();
        endwhile;
    else:

        $tabs_plugin_info['3rd_party_import'] = 'done';
        update_option('tabs_plugin_info', $tabs_plugin_info);

        wp_clear_scheduled_hook('tabs_import_cron_tabs_responsive');


    endif;


}


		
		