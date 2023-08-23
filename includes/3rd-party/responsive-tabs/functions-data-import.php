<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






add_shortcode('tabs_import_cron_responsive_tabs', 'tabs_import_cron_responsive_tabs');
add_action('tabs_import_cron_responsive_tabs', 'tabs_import_cron_responsive_tabs');


function tabs_import_cron_responsive_tabs(){
    $tabs_plugin_info = get_option('tabs_plugin_info');

    $meta_query = array();

    $meta_query[] = array(
        'key' => 'import_done',
        'compare' => 'NOT EXISTS'

    );

    $args = array(
        'post_type'=>'rtbs_tabs',
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
            $_rtbs_tabs_head       = get_post_meta( $post_id, '_rtbs_tabs_head', true );



            echo '<pre>'.var_export($_rtbs_tabs_head, true).'</pre>';




            $tabs_icons_plus = 'plus';
            $tabs_icons_minus = 'minus';


            $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa fa-'.$tabs_icons_plus.'"></i>' : '<i class="fa fa-plus"></i>';
            $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa fa-'.$tabs_icons_minus.'"></i>' : '<i class="fa fa-minus"></i>';

            $tabs_options['icon']['active'] = $tabs_icons_plus;
            $tabs_options['icon']['inactive'] = $tabs_icons_minus;
            $tabs_options['icon']['position'] = '';
            $tabs_options['icon']['color'] = '';
            $tabs_options['icon']['color_hover'] = '';
            $tabs_options['icon']['font_size'] = '';
            $tabs_options['icon']['background_color'] = '';
            $tabs_options['icon']['padding'] = '';




            $tabs_options['header']['class'] = '';
            $tabs_options['header']['active_background_color'] = '';
            $tabs_options['header']['background_color'] = '';
            $tabs_options['header']['background_opacity'] = '';
            $tabs_options['header']['color'] = '';
            $tabs_options['header']['color_hover'] = '';
            $tabs_options['header']['font_size'] = '';
            $tabs_options['header']['font_family'] = '';
            $tabs_options['header']['padding'] = '';
            $tabs_options['header']['margin'] = '';


            $tabs_options['body']['class'] = '';

            $tabs_options['body']['active_background_color'] = '';
            $tabs_options['body']['background_color'] = '';
            $tabs_options['body']['background_opacity'] = '';
            $tabs_options['body']['color'] = '';
            $tabs_options['body']['font_size'] = '';
            $tabs_options['body']['font_family'] = '';
            $tabs_options['body']['padding'] = '';
            $tabs_options['body']['margin'] = '';





            $tabs_options['lazy_load'] = 'yes';
            $tabs_options['lazy_load_src'] = '';
            $tabs_options['view_type'] = 'tabs';

            $tabs_options['hide_edit'] = '';
            $tabs_options['accordion']['collapsible'] =  'true';
            $tabs_options['accordion']['expanded_other'] = 'yes';
            $tabs_options['accordion']['height_style'] = 'content';



            $tabs_options['accordion']['active_event'] = '';
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

            if(!empty($_rtbs_tabs_head))
                foreach ($_rtbs_tabs_head as $index => $accordion_single_data){

                    $_rtbs_title = $accordion_single_data['_rtbs_title'];
                    $_rtbs_content = $accordion_single_data['_rtbs_content'];





                    $tabs_options['content'][$index]['header'] = $_rtbs_title;

                    $tabs_options['content'][$index]['body'] = $_rtbs_content;
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

        wp_clear_scheduled_hook('tabs_import_cron_responsive_tabs');


    endif;


}


		
		