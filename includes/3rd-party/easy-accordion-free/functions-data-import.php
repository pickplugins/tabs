<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






add_shortcode('tabs_import_cron_easy_accordion_free', 'tabs_import_cron_easy_accordion_free');
add_action('tabs_import_cron_easy_accordion_free', 'tabs_import_cron_easy_accordion_free');


function tabs_import_cron_easy_accordion_free(){
    $tabs_plugin_info = get_option('tabs_plugin_info');

    $meta_query = array();

        $meta_query[] = array(
        'key' => 'import_done',
        'compare' => 'NOT EXISTS'
    );

    $args = array(
        'post_type'=>'sp_easy_accordion',
        'post_status'=>'publish',
        'posts_per_page'=> 1,
        'meta_query'=> $meta_query,

    );


    $wp_query = new WP_Query($args);


    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();
            $post_title = get_the_title();
            $tabs_options = array();

            //echo $tabs_title.'<br/>';
            $sp_eap_upload_options       = get_post_meta( $post_id, 'sp_eap_upload_options', true );
            $sp_eap_shortcode_options       = get_post_meta( $post_id, 'sp_eap_shortcode_options', true );

            $eap_accordion_type = $sp_eap_upload_options['eap_accordion_type'];
            $accordion_content_source = $sp_eap_upload_options['accordion_content_source'];


            echo '<pre>'.var_export($accordion_content_source, true).'</pre>';


            $eap_accordion_event = $sp_eap_shortcode_options['eap_accordion_event'];
            $eap_mutliple_collapse = $sp_eap_shortcode_options['eap_mutliple_collapse'];
            $eap_accordion_fillspace = $sp_eap_shortcode_options['eap_accordion_fillspace'];
            $eap_preloader = $sp_eap_shortcode_options['eap_preloader'];

            $eap_animation_time = $sp_eap_shortcode_options['eap_animation_time'];
            $eap_icon_size = $sp_eap_shortcode_options['eap_icon_size']['all'];
            $eap_icon_color_set = $sp_eap_shortcode_options['eap_icon_color_set'];
            $eap_icon_position = $sp_eap_shortcode_options['eap_icon_position'];
            $eap_title_color = $sp_eap_shortcode_options['eap_title_color'];
            $eap_header_bg_color = $sp_eap_shortcode_options['eap_header_bg_color'];
            $eap_description_color = $sp_eap_shortcode_options['eap_description_color'];
            $eap_description_bg_color = $sp_eap_shortcode_options['eap_description_bg_color'];




            $tabs_icons_plus = 'plus';
            $tabs_icons_minus = 'minus';


            $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa fa-'.$tabs_icons_plus.'"></i>' : '<i class="fa fa-plus"></i>';
            $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa fa-'.$tabs_icons_minus.'"></i>' : '<i class="fa fa-minus"></i>';

            $tabs_options['icon']['active'] = $tabs_icons_plus;
            $tabs_options['icon']['inactive'] = $tabs_icons_minus;
            $tabs_options['icon']['position'] = $eap_icon_position;
            $tabs_options['icon']['color'] = $eap_icon_color_set;
            $tabs_options['icon']['color_hover'] = '';
            $tabs_options['icon']['font_size'] = $eap_icon_size.'px';
            $tabs_options['icon']['background_color'] = '';
            $tabs_options['icon']['padding'] = '';




            $tabs_options['header']['class'] = '';
            $tabs_options['header']['active_background_color'] = '';
            $tabs_options['header']['background_color'] = $eap_header_bg_color;
            $tabs_options['header']['background_opacity'] = '';
            $tabs_options['header']['color'] = $eap_title_color;
            $tabs_options['header']['color_hover'] = '';
            $tabs_options['header']['font_size'] = '';
            $tabs_options['header']['font_family'] = '';
            $tabs_options['header']['padding'] = '';
            $tabs_options['header']['margin'] = '';


            $tabs_options['body']['class'] = '';

            $tabs_options['body']['active_background_color'] = '';
            $tabs_options['body']['background_color'] = $eap_description_bg_color;
            $tabs_options['body']['background_opacity'] = '';
            $tabs_options['body']['color'] = $eap_description_color;
            $tabs_options['body']['font_size'] = '';
            $tabs_options['body']['font_family'] = '';
            $tabs_options['body']['padding'] = '';
            $tabs_options['body']['margin'] = '';





            $tabs_options['lazy_load'] = !empty($eap_preloader) ? 'yes' : 'no';
            $tabs_options['lazy_load_src'] = '';
            $tabs_options['hide_edit'] = '';
            $tabs_options['accordion']['collapsible'] =  'true';
            $tabs_options['accordion']['expanded_other'] = !empty($eap_mutliple_collapse) ? 'yes' : 'no';
            $tabs_options['accordion']['height_style'] = !empty($eap_accordion_fillspace) ? 'content' : '';

            if($eap_accordion_event == 'ea-click'){
                $active_event = 'click';
            }elseif ($eap_accordion_event == 'ea-hover'){
                $active_event = 'mouseover';
            }else{
                $active_event = 'click';
            }

            $tabs_options['accordion']['active_event'] = $active_event;
            $tabs_options['accordion']['enable_search'] = '';
            $tabs_options['accordion']['search_placeholder_text'] = '';
            $tabs_options['accordion']['click_scroll_top'] = '';
            $tabs_options['accordion']['click_scroll_top_offset'] = '';
            $tabs_options['accordion']['header_toggle'] = '';
            $tabs_options['accordion']['animate_style'] = '';
            $tabs_options['accordion']['animate_delay'] = $eap_animation_time;
            $tabs_options['accordion']['expand_collapse_display'] = '';
            $tabs_options['accordion']['expand_collapse_bg_color'] = '';
            $tabs_options['accordion']['expand_collapse_text'] = '';
            $tabs_options['accordion']['is_child'] = '';










            $i = 0;

            if(!empty($accordion_content_source))
                foreach ($accordion_content_source as $index => $accordion_single_data){

                    $accordion_content_title = $accordion_single_data['accordion_content_title'];
                    $accordion_content_description = $accordion_single_data['accordion_content_description'];





                    $tabs_options['content'][$index]['header'] = $accordion_content_title;

                    $tabs_options['content'][$index]['body'] = $accordion_content_description;
                    $tabs_options['content'][$index]['hide'] = 'no';
                    $tabs_options['content'][$index]['toggled_text'] = '';


                    $tabs_options['content'][$index]['is_active'] = '';


                    $tabs_options['content'][$index]['active_icon'] = '';
                    $tabs_options['content'][$index]['inactive_icon'] = '';

                    $tabs_options['content'][$index]['background_color'] =  '';
                    $tabs_options['content'][$index]['background_img'] =  '';

                    $i++;
                }




            $post_data = array(
                'post_title'    => $post_title,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'   	=> 'tabs',
                'post_author'   => 1,
            );

            $tabs_id = wp_insert_post($post_data);


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

        wp_clear_scheduled_hook('tabs_import_cron_easy_accordion_free');


    endif;


}


		
		