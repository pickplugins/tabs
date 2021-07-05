<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






add_shortcode('tabs_import_cron_responsive_accordion_collapse', 'tabs_import_cron_responsive_accordion_collapse');
add_action('tabs_import_cron_responsive_accordion_collapse', 'tabs_import_cron_responsive_accordion_collapse');


function tabs_import_cron_responsive_accordion_collapse(){
    $tabs_plugin_info = get_option('tabs_plugin_info');

    $meta_query = array();

        $meta_query[] = array(
        'key' => 'import_done',
        'compare' => 'NOT EXISTS'
    );

    $args = array(
        'post_type'=>'responsive_accordion',
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
            $wpsm_accordion_data       = get_post_meta( $post_id, 'wpsm_accordion_data', true );
            $wpsm_accordion_data       = unserialize( $wpsm_accordion_data );

            $Accordion_Settings = get_post_meta( $post_id, 'Accordion_Settings', true);
            $Accordion_Settings       = unserialize( $Accordion_Settings );

            $acc_sec_title = isset($Accordion_Settings['acc_sec_title']) ? $Accordion_Settings['acc_sec_title'] : 'yes';
            $op_cl_icon = isset($Accordion_Settings['op_cl_icon']) ? $Accordion_Settings['op_cl_icon'] : 'yes';
            $acc_title_icon = isset($Accordion_Settings['acc_title_icon']) ? $Accordion_Settings['acc_title_icon'] : 'yes';
            $acc_radius = isset($Accordion_Settings['acc_radius']) ? $Accordion_Settings['acc_radius'] : 'yes';
            $acc_margin = isset($Accordion_Settings['acc_margin']) ? $Accordion_Settings['acc_margin'] : 'yes';
            $enable_toggle = isset($Accordion_Settings['enable_toggle']) ? $Accordion_Settings['enable_toggle'] : 'yes';
            $enable_ac_border = isset($Accordion_Settings['enable_ac_border']) ? $Accordion_Settings['enable_ac_border'] : 'yes';
            $acc_op_cl_align = isset($Accordion_Settings['acc_op_cl_align']) ? $Accordion_Settings['acc_op_cl_align'] : 'right';
            $acc_title_bg_clr = isset($Accordion_Settings['acc_title_bg_clr']) ? $Accordion_Settings['acc_title_bg_clr'] : '#e8e8e8';
            $acc_title_icon_clr = isset($Accordion_Settings['acc_title_icon_clr']) ? $Accordion_Settings['acc_title_icon_clr'] : '#000000';
            $acc_desc_bg_clr = isset($Accordion_Settings['acc_desc_bg_clr']) ? $Accordion_Settings['acc_desc_bg_clr'] : '#ffffff';
            $acc_desc_font_clr = isset($Accordion_Settings['acc_desc_font_clr']) ? $Accordion_Settings['acc_desc_font_clr'] : '#000000';
            $title_size = isset($Accordion_Settings['title_size']) ? $Accordion_Settings['title_size'] : '18';
            $des_size = isset($Accordion_Settings['des_size']) ? $Accordion_Settings['des_size'] : '16';
            $font_family = isset($Accordion_Settings['font_family']) ? $Accordion_Settings['font_family'] : 'Open Sans';
            $expand_option = isset($Accordion_Settings['expand_option']) ? $Accordion_Settings['expand_option'] : 1;
            $ac_styles = isset($Accordion_Settings['ac_styles']) ? $Accordion_Settings['ac_styles'] : 1;




            //echo '<pre>'.var_export($acc_sec_title, true).'</pre>';

            $tabs_icons_plus = 'plus';
            $tabs_icons_minus = 'minus';


            $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa fa-'.$tabs_icons_plus.'"></i>' : '<i class="fa fa-plus"></i>';
            $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa fa-'.$tabs_icons_minus.'"></i>' : '<i class="fa fa-minus"></i>';

            $tabs_options['icon']['active'] = $tabs_icons_plus;
            $tabs_options['icon']['inactive'] = $tabs_icons_minus;
            $tabs_options['icon']['position'] = $acc_op_cl_align;
            $tabs_options['icon']['color'] = $acc_title_icon_clr;
            $tabs_options['icon']['color_hover'] = '';
            $tabs_options['icon']['font_size'] = $title_size.'px';
            $tabs_options['icon']['background_color'] = '';
            $tabs_options['icon']['padding'] = '';




            $tabs_options['header']['class'] = ($acc_radius == 'yes') ? 'border-semi-round' :'';
            $tabs_options['header']['active_background_color'] = '';
            $tabs_options['header']['background_color'] = $acc_title_bg_clr;
            $tabs_options['header']['background_opacity'] = '';
            $tabs_options['header']['color'] = '';
            $tabs_options['header']['color_hover'] = '';
            $tabs_options['header']['font_size'] = $title_size.'px';
            $tabs_options['header']['font_family'] = $font_family;
            $tabs_options['header']['padding'] = '';
            $tabs_options['header']['margin'] = ($acc_margin == 'yes') ? '5px' :'';


            $tabs_options['body']['class'] = ($enable_ac_border == 'yes') ? 'border-2px' :'';

            $tabs_options['body']['active_background_color'] = '';
            $tabs_options['body']['background_color'] = $acc_desc_bg_clr;
            $tabs_options['body']['background_opacity'] = '';
            $tabs_options['body']['color'] = $acc_desc_font_clr;
            $tabs_options['body']['font_size'] = '';
            $tabs_options['body']['font_family'] = $font_family;
            $tabs_options['body']['padding'] = '';
            $tabs_options['body']['margin'] = '';





            $tabs_options['lazy_load'] = '';
            $tabs_options['lazy_load_src'] = '';
            $tabs_options['hide_edit'] = '';
            $tabs_options['accordion']['collapsible'] =  ($enable_toggle == 'yes') ? 'true' :'false';
            $tabs_options['accordion']['expanded_other'] = ($enable_toggle == 'yes') ? 'yes' :'no';
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

            if(!empty($wpsm_accordion_data))
                foreach ($wpsm_accordion_data as $index => $accordion_single_data){

                    $accordion_title = $accordion_single_data['accordion_title'];
                    $accordion_title_icon = $accordion_single_data['accordion_title_icon'];
                    $enable_single_icon = $accordion_single_data['enable_single_icon'];
                    $accordion_desc = $accordion_single_data['accordion_desc'];




                    $tabs_options['content'][$index]['header'] = ($acc_title_icon =='yes') ? (($enable_single_icon == 'yes') ? '<i class="fa '.$accordion_title_icon.'"></i> '.$accordion_title : $accordion_title) : $accordion_title;

                    $tabs_options['content'][$index]['body'] = $accordion_desc;
                    $tabs_options['content'][$index]['hide'] = 'no';
                    $tabs_options['content'][$index]['toggled_text'] = '';


                    $tabs_options['content'][$index]['is_active'] = ($expand_option == '1' && $i==0) ? 'yes' :'';


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

        wp_clear_scheduled_hook('tabs_import_cron_responsive_accordion_collapse');


    endif;


}


		
		