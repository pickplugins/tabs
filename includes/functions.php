<?php
if (!defined('ABSPATH')) exit;  // if direct access

function tabs_all_user_roles()
{

    $wp_roles = new WP_Roles();

    //var_dump($wp_roles);
    $roles = $wp_roles->get_names();

    return  $roles;
    // Below code will print the all list of roles.
    //echo '<pre>'.var_export($wp_roles, true).'</pre>';

}


function tabs_old_content($post_id)
{

    $tabs_content_title = get_post_meta($post_id, 'tabs_content_title', true);
    $tabs_content_title_toggled = get_post_meta($post_id, 'tabs_content_title_toggled', true);
    $tabs_content_body = get_post_meta($post_id, 'tabs_content_body', true);
    $tabs_hide = get_post_meta($post_id, 'tabs_hide', true);
    $tabs_section_icon_plus = get_post_meta($post_id, 'tabs_section_icon_plus', true);
    $tabs_section_icon_minus = get_post_meta($post_id, 'tabs_section_icon_minus', true);
    $tabs_active_accordion = get_post_meta($post_id, 'tabs_active_accordion', true);

    $tabs_data = array();

    $i = 0;

    if (!empty($tabs_content_title))
        foreach ($tabs_content_title as $index => $item) {


            $tabs_data[$index]['header'] = $item;
            $tabs_data[$index]['body'] = isset($tabs_content_body[$index]) ? $tabs_content_body[$index] : '';

            $is_active = ($tabs_active_accordion == $i) ? array($i) : array();
            $tabs_data[$index]['is_active'] = $is_active;
            $tabs_data[$index]['toggled_text'] = isset($tabs_content_title_toggled[$index]) ? $tabs_content_title_toggled[$index] : '';

            $active_icon = !empty($tabs_section_icon_plus[$index]) ? '<i class="fa ' . $tabs_section_icon_plus[$index] . '"></i>' : '';
            $inactive_icon = !empty($tabs_section_icon_minus[$index]) ? '<i class="fa ' . $tabs_section_icon_minus[$index] . '"></i>' : '';



            $tabs_data[$index]['active_icon'] = $active_icon;
            $tabs_data[$index]['inactive_icon'] = $inactive_icon;
            $tabs_data[$index]['hide'] = !empty($tabs_hide[$index]) ? 'yes' : 'no';


            $i++;
        }

    return $tabs_data;
}



function tabs_old_options($tabs_id)
{


    $tabs_lazy_load       = get_post_meta($tabs_id, 'tabs_lazy_load', true);
    $tabs_options['lazy_load'] = $tabs_lazy_load;

    $tabs_lazy_load_src   = get_post_meta($tabs_id, 'tabs_lazy_load_src', true);
    $tabs_options['lazy_load_src'] = $tabs_lazy_load_src;

    $tabs_hide_edit       = get_post_meta($tabs_id, 'tabs_hide_edit', true);
    $tabs_options['hide_edit'] = $tabs_hide_edit;

    $tabs_collapsible     = get_post_meta($tabs_id, 'tabs_collapsible', true);
    $tabs_options['accordion']['collapsible'] = $tabs_collapsible;

    $tabs_expaned_other   = get_post_meta($tabs_id, 'tabs_expaned_other', true);
    $tabs_options['accordion']['expanded_other'] = $tabs_expaned_other;

    $tabs_heightStyle     = get_post_meta($tabs_id, 'tabs_heightStyle', true);
    $tabs_options['accordion']['height_style'] = $tabs_heightStyle;

    $tabs_active_event    = get_post_meta($tabs_id, 'tabs_active_event', true);
    $tabs_options['accordion']['active_event'] = $tabs_active_event;

    $enable_search              = get_post_meta($tabs_id, 'enable_search', true);
    $tabs_options['accordion']['enable_search'] = $enable_search;

    $search_placeholder_text              = get_post_meta($tabs_id, 'search_placeholder_text', true);
    $tabs_options['accordion']['search_placeholder_text'] = $search_placeholder_text;

    $tabs_click_scroll_top = get_post_meta($tabs_id, 'tabs_click_scroll_top', true);
    $tabs_options['accordion']['click_scroll_top'] = $tabs_click_scroll_top;

    $tabs_click_scroll_top_offset = get_post_meta($tabs_id, 'tabs_click_scroll_top_offset', true);
    $tabs_options['accordion']['click_scroll_top_offset'] = $tabs_click_scroll_top_offset;

    $tabs_header_toggle   = get_post_meta($tabs_id, 'tabs_header_toggle', true);
    $tabs_options['accordion']['header_toggle'] = $tabs_header_toggle;

    $tabs_animate_style   = get_post_meta($tabs_id, 'tabs_animate_style', true);
    $tabs_options['accordion']['animate_style'] = $tabs_animate_style;

    $tabs_animate_delay   = get_post_meta($tabs_id, 'tabs_animate_delay', true);
    $tabs_options['accordion']['animate_delay'] = $tabs_animate_delay;

    $tabs_expand_collapse_display = get_post_meta($tabs_id, 'tabs_expand_collapse_display', true);
    $tabs_options['accordion']['expand_collapse_display'] = $tabs_expand_collapse_display;

    $expand_collapse_bg_color = get_post_meta($tabs_id, 'expand_collapse_bg_color', true);
    $tabs_options['accordion']['expand_collapse_bg_color'] = $expand_collapse_bg_color;

    $expand_collapse_text = get_post_meta($tabs_id, 'expand_collapse_text', true);
    $tabs_options['accordion']['expand_collapse_text'] = $expand_collapse_text;

    $tabs_child           = get_post_meta($tabs_id, 'tabs_child', true);
    $tabs_options['accordion']['is_child'] = $tabs_child;


    $tabs_click_track = get_post_meta($tabs_id, 'tabs_click_track', true);
    $tabs_options['enable_stats'] = $tabs_click_track;


    $tabs_tabs_collapsible = get_post_meta($tabs_id, 'tabs_tabs_collapsible', true);
    $tabs_options['tabs']['collapsible'] = $tabs_tabs_collapsible;

    $tabs_tabs_active_event = get_post_meta($tabs_id, 'tabs_tabs_active_event', true);
    $tabs_options['tabs']['active_event'] = $tabs_tabs_active_event;

    $tabs_tabs_vertical   = get_post_meta($tabs_id, 'tabs_tabs_vertical', true);
    $tabs_options['tabs']['tabs_vertical'] = $tabs_tabs_vertical;

    $tabs_tabs_vertical_width_ratio = get_post_meta($tabs_id, 'tabs_tabs_vertical_width_ratio', true);
    $tabs_options['tabs']['navs_width_ratio'] = $tabs_tabs_vertical_width_ratio;

    $tabs_tabs_icon_toggle = get_post_meta($tabs_id, 'tabs_tabs_icon_toggle', true);
    $tabs_options['tabs']['tabs_icon_toggle'] = $tabs_tabs_icon_toggle;

    $tabs_icons_plus = get_post_meta($tabs_id, 'tabs_icons_plus', true);
    $tabs_icons_minus = get_post_meta($tabs_id, 'tabs_icons_minus', true);

    $tabs_icons_plus = !empty($tabs_icons_plus) ? '<i class="fa ' . $tabs_icons_plus . '"></i>' : '';
    $tabs_icons_minus = !empty($tabs_icons_minus) ? '<i class="fa ' . $tabs_icons_minus . '"></i>' : '';

    $tabs_options['icon']['active'] = $tabs_icons_plus;
    $tabs_options['icon']['inactive'] = $tabs_icons_minus;

    $tabs_icons_position = get_post_meta($tabs_id, 'tabs_icons_position', true);
    $tabs_options['icon']['position'] = $tabs_icons_position;

    $tabs_icons_color = get_post_meta($tabs_id, 'tabs_icons_color', true);
    $tabs_options['icon']['color'] = $tabs_icons_color;

    $tabs_icons_color_hover = get_post_meta($tabs_id, 'tabs_icons_color_hover', true);
    $tabs_options['icon']['color_hover'] = $tabs_icons_color_hover;

    $tabs_icons_font_size = get_post_meta($tabs_id, 'tabs_icons_font_size', true);
    $tabs_options['icon']['font_size'] = $tabs_icons_font_size;

    $tabs_icons_bg_color = get_post_meta($tabs_id, 'tabs_icons_bg_color', true);
    $tabs_options['icon']['background_color'] = $tabs_icons_bg_color;

    $tabs_icons_padding = get_post_meta($tabs_id, 'tabs_icons_padding', true);
    $tabs_options['icon']['padding'] = $tabs_icons_padding;

    $tabs_themes = get_post_meta($tabs_id, 'tabs_themes', true);
    $tabs_options['accordion']['theme'] = $tabs_themes;

    $header_class = 'border-none';

    if ($tabs_themes == 'flat') {
        $header_class = 'border-none';
    } elseif ($tabs_themes == 'rounded') {
        $header_class = 'border-round';
    } elseif ($tabs_themes == 'semi-rounded') {
        $header_class = 'border-semi-round';
    } elseif ($tabs_themes == 'rounded-top') {
        $header_class = 'border-top-round';
    } elseif ($tabs_themes == 'shadow') {
        $header_class = 'shadow-bottom';
    }



    $tabs_options['header']['class'] = $header_class;

    $tabs_active_bg_color = get_post_meta($tabs_id, 'tabs_active_bg_color', true);
    $tabs_options['header']['active_background_color'] = $tabs_active_bg_color;

    $tabs_default_bg_color = get_post_meta($tabs_id, 'tabs_default_bg_color', true);
    $tabs_options['header']['background_color'] = $tabs_default_bg_color;

    $tabs_header_bg_opacity = get_post_meta($tabs_id, 'tabs_header_bg_opacity', true);
    $tabs_options['header']['background_opacity'] = $tabs_header_bg_opacity;

    $tabs_items_title_color = get_post_meta($tabs_id, 'tabs_items_title_color', true);
    $tabs_options['header']['color'] = $tabs_items_title_color;

    $tabs_items_title_color_hover = get_post_meta($tabs_id, 'tabs_items_title_color_hover', true);
    $tabs_options['header']['color_hover'] = $tabs_items_title_color_hover;

    $tabs_items_title_font_size = get_post_meta($tabs_id, 'tabs_items_title_font_size', true);
    $tabs_options['header']['font_size'] = $tabs_items_title_font_size;

    $tabs_items_title_font_family = get_post_meta($tabs_id, 'tabs_items_title_font_family', true);
    $tabs_options['header']['font_family'] = $tabs_items_title_font_family;

    $tabs_items_title_padding = get_post_meta($tabs_id, 'tabs_items_title_padding', true);
    $tabs_options['header']['padding'] = $tabs_items_title_padding;

    $tabs_items_title_margin = get_post_meta($tabs_id, 'tabs_items_title_margin', true);
    $tabs_options['header']['margin'] = $tabs_items_title_margin;

    $body_class = '';
    $tabs_options['body']['class'] = $body_class;

    $tabs_active_bg_color = get_post_meta($tabs_id, 'tabs_active_bg_color', true);
    $tabs_options['body']['active_background_color'] = $tabs_active_bg_color;

    $tabs_items_content_bg_color = get_post_meta($tabs_id, 'tabs_items_content_bg_color', true);
    $tabs_options['body']['background_color'] = $tabs_items_content_bg_color;

    $tabs_items_content_bg_opacity = get_post_meta($tabs_id, 'tabs_items_content_bg_opacity', true);
    $tabs_options['body']['background_opacity'] = $tabs_items_content_bg_opacity;

    $tabs_items_content_color = get_post_meta($tabs_id, 'tabs_items_content_color', true);
    $tabs_options['body']['color'] = $tabs_items_content_color;



    $tabs_items_content_font_size = get_post_meta($tabs_id, 'tabs_items_content_font_size', true);
    $tabs_options['body']['font_size'] = $tabs_items_content_font_size;

    $tabs_items_content_font_family = get_post_meta($tabs_id, 'tabs_items_content_font_family', true);
    $tabs_options['body']['font_family'] = $tabs_items_content_font_family;


    $tabs_items_content_padding = get_post_meta($tabs_id, 'tabs_items_content_padding', true);
    $tabs_options['body']['padding'] = $tabs_items_content_padding;

    $tabs_items_content_margin = get_post_meta($tabs_id, 'tabs_items_content_margin', true);
    $tabs_options['body']['margin'] = $tabs_items_content_margin;


    //Container options
    $tabs_container_padding = get_post_meta($tabs_id, 'tabs_container_padding', true);
    $tabs_options['container']['padding'] = $tabs_container_padding;

    $tabs_container_bg_color = get_post_meta($tabs_id, 'tabs_container_bg_color', true);
    $tabs_options['container']['background_color'] = $tabs_container_bg_color;

    $tabs_items_content_bg_opacity = get_post_meta($tabs_id, 'tabs_items_content_bg_opacity', true);
    $tabs_options['container']['background_opacity'] = $tabs_items_content_bg_opacity;

    $tabs_bg_img = get_post_meta($tabs_id, 'tabs_bg_img', true);
    $tabs_options['container']['background_img'] = $tabs_bg_img;

    $tabs_container_text_align = get_post_meta($tabs_id, 'tabs_container_text_align', true);
    $tabs_options['container']['text_align'] = $tabs_container_text_align;

    $tabs_width           = get_post_meta($tabs_id, 'tabs_width', true);
    $tabs_width_large     = !empty($tabs_width['large']) ? $tabs_width['large'] : '100%';
    $tabs_width_medium    = !empty($tabs_width['medium']) ? $tabs_width['medium'] : '100%';
    $tabs_width_small     = !empty($tabs_width['small']) ? $tabs_width['small'] : '100%';

    $tabs_options['container']['width_large'] = $tabs_width_large;
    $tabs_options['container']['width_medium'] = $tabs_width_medium;
    $tabs_options['container']['width_small'] = $tabs_width_small;


    // Custom Scripts
    $tabs_custom_css = get_post_meta($tabs_id, 'tabs_custom_css', true);
    $tabs_options['custom_scripts']['custom_css'] = $tabs_custom_css;

    $tabs_custom_js = get_post_meta($tabs_id, 'tabs_custom_js', true);
    $tabs_options['custom_scripts']['custom_js'] = $tabs_custom_js;


    $track_header = get_post_meta($tabs_id, 'track_header', true);
    $tabs_options['track_header'] = $track_header;

    $tabs_content_title = get_post_meta($tabs_id, 'tabs_content_title', true);
    $tabs_content_body = get_post_meta($tabs_id, 'tabs_content_body', true);
    $tabs_content_title_toggled = get_post_meta($tabs_id, 'tabs_content_title_toggled', true);
    $tabs_section_icon_plus = get_post_meta($tabs_id, 'tabs_section_icon_plus', true);
    $tabs_section_icon_minus = get_post_meta($tabs_id, 'tabs_section_icon_minus', true);
    $tabs_hide = get_post_meta($tabs_id, 'tabs_hide', true);
    $tabs_bg_color = get_post_meta($tabs_id, 'tabs_bg_color', true);
    $tabs_header_bg_img = get_post_meta($tabs_id, 'tabs_header_bg_img', true);

    $tabs_active_accordion = get_post_meta($tabs_id, 'tabs_active_accordion', true);

    //var_dump($tabs_content_title);

    $i = 0;

    if (!empty($tabs_content_title))
        foreach ($tabs_content_title as $index => $title) {

            $tabs_options['content'][$index]['header'] = $title;
            $tabs_options['content'][$index]['body'] = isset($tabs_content_body[$index]) ? $tabs_content_body[$index] : '';
            $tabs_options['content'][$index]['hide'] = isset($tabs_hide[$index]) ? $tabs_hide[$index] : '';
            $tabs_options['content'][$index]['toggled_text'] = isset($tabs_content_title_toggled[$index]) ? $tabs_content_title_toggled[$index] : '';

            $tabs_options['content'][$index]['is_active'] = ($tabs_active_accordion == $i) ? 'yes' : 'no';


            $active_icon = !empty($tabs_section_icon_plus[$index]) ? '<i class="fa ' . $tabs_section_icon_plus[$index] . '"></i>' : '';
            $inactive_icon = !empty($tabs_section_icon_minus[$index]) ? '<i class="fa ' . $tabs_section_icon_minus[$index] . '"></i>' : '';

            $tabs_options['content'][$index]['active_icon'] = $active_icon;
            $tabs_options['content'][$index]['inactive_icon'] = $inactive_icon;

            $tabs_options['content'][$index]['background_color'] = isset($tabs_bg_color[$index]) ? $tabs_bg_color[$index] : '';
            $tabs_options['content'][$index]['background_img'] = isset($tabs_header_bg_img[$index]) ? $tabs_header_bg_img[$index] : '';

            $i++;
        }


    return $tabs_options;
}






//add_filter('the_content','tabs_get_shortcode');
function tabs_get_shortcode($content)
{


    if (strpos($content, '[restabs')) {
        $tabs = tabs_str_between_all($content, "[restabs", "[/restabs]");

        foreach ($tabs as $tab_content) {

            $shortcode_content = tabs_nested_shortcode_content($tab_content, $child_tag = 'restab');
            echo '<pre>' . var_export('#####', true) . '</pre>';
            echo '<pre>' . var_export($shortcode_content, true) . '</pre>';
        }
    }

    return $content;
}




function tabs_str_between_all($string, $start, $end, $includeDelimiters = false,  &$offset = 0)
{
    $strings = [];
    $length = strlen($string);

    while ($offset < $length) {
        $found = tabs_str_between($string, $start, $end, $includeDelimiters, $offset);
        if ($found === null) break;

        $strings[] = $found;
        $offset += strlen($includeDelimiters ? $found : $start . $found . $end); // move offset to the end of the newfound string
    }

    return $strings;
}

function tabs_str_between($string, $start, $end, $includeDelimiters = false, &$offset = 0)
{
    if ($string === '' || $start === '' || $end === '') return null;

    $startLength = strlen($start);
    $endLength = strlen($end);

    $startPos = strpos($string, $start, $offset);
    if ($startPos === false) return null;

    $endPos = strpos($string, $end, $startPos + $startLength);
    if ($endPos === false) return null;

    $length = $endPos - $startPos + ($includeDelimiters ? $endLength : -$startLength);
    if (!$length) return '';

    $offset = $startPos + ($includeDelimiters ? 0 : $startLength);

    $result = substr($string, $offset, $length);

    return ($result !== false ? $result : null);
}









function tabs_nested_shortcode_content($string, $child_tag = 'restab')
{

    $accordion_content = array();

    //echo '<pre>'.var_export($tabs, true).'</pre>';


    $tabs = explode('[' . $child_tag, $string);
    unset($tabs[0]);

    $i = 0;
    foreach ($tabs as $tab) {
        $tab = str_replace('[/' . $child_tag . ']', '', $tab);
        $tab = str_replace(' active="active"', '', $tab);

        $title_content = explode(']', $tab);
        $title = isset($title_content[0]) ? $title_content[0] : '';

        preg_match('/title="(.*?)"/', $title, $output_array);

        $title = $output_array[1];

        //$title = str_replace('title="','', $title);
        //$title = str_replace('"','', $title);
        $acc_title = ltrim($title);

        $acc_content = isset($title_content[1]) ? $title_content[1] : '';

        $accordion_content[$i]['title'] = $acc_title;
        $accordion_content[$i]['content'] = $acc_content;

        $i++;
    }

    //echo '<pre>'.var_export($accordion_content, true).'</pre>';




    return $accordion_content;
}


add_filter('the_content', 'tabs_preview_content');
function tabs_preview_content($content)
{
    if (is_singular('tabs')) {
        $post_id = get_the_id();
        $content .= do_shortcode('[tabs id="' . $post_id . '"]');
    }

    return $content;
}


function tabs_ajax_import_json()
{

    $response = array();


    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (wp_verify_nonce($nonce, 'tabs_nonce')) {

        if (current_user_can('manage_options')) {

            $json_file = isset($_POST['json_file']) ? esc_url_raw($_POST['json_file']) : '';
            $string = file_get_contents($json_file);
            $json_a = json_decode($string, true);


            foreach ($json_a as $post_id => $post_data) {

                $meta_fields = tabs_recursive_sanitize_arr($post_data['meta_fields']);


                $title = sanitize_text_field($post_data['title']);

                // Create post object
                $my_post = array(
                    'post_title'    => $title,
                    'post_type' => 'tabs',
                    'post_status'   => 'publish',

                );

                $post_inserted_id = wp_insert_post($my_post);

                foreach ($meta_fields as $meta_key => $meta_value) {
                    update_post_meta($post_inserted_id, $meta_key, $meta_value);
                }
            }


            //$response['json_a'] = $json_a;
            $response['message'] = __('Impor done', '');
        }
    } else {
        $response['message'] = __('You do not have permission', '');
    }




    echo json_encode($response);



    die();
}
add_action('wp_ajax_tabs_ajax_import_json', 'tabs_ajax_import_json');
//add_action('wp_ajax_nopriv_tabs_ajax_import_json', 'tabs_ajax_import_json');







add_shortcode('tabs_youtube', 'tabs_youtube');


function tabs_youtube($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'video_id' => "",
            'width' => "560",
            'height' => "315",

        ),
        $atts
    );

    $video_id = $atts['video_id'];
    $width = $atts['width'];
    $height = $atts['height'];

    $html = '';
    $html .= '<iframe width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="https://www.youtube.com/embed/' . esc_attr($video_id) . '" frameborder="0" allowfullscreen></iframe>';

    return $html;
}











function tabs_add_shortcode_column($columns)
{
    return array_merge(
        $columns,
        array('shortcode' => __('Shortcode', 'tabs'))
    );
}
add_filter('manage_tabs_posts_columns', 'tabs_add_shortcode_column');


function tabs_posts_shortcode_display($column, $post_id)
{
    if ($column == 'shortcode') {
?>
        <input style="background:#bfefff" type="text" onClick="this.select();" value="[tabs <?php echo 'id=&quot;' . esc_attr($post_id) . '&quot;'; ?>]" /><br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();"><?php echo '<?php echo do_shortcode("[tabs id=';
                                                                                            echo "'" . esc_attr($post_id) . "']";
                                                                                            echo '"); ?>'; ?></textarea>
<?php

    }
}

add_action('manage_tabs_posts_custom_column', 'tabs_posts_shortcode_display', 10, 2);






function tabs_paratheme_hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = $r . ',' . $g . ',' . $b;
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}





function tabs_recursive_sanitize_arr($array)
{

    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = tabs_recursive_sanitize_arr($value);
        } else {
            $value = wp_kses_post($value);
            $value = wp_unslash(_wp_specialchars($value, ENT_QUOTES));
        }
    }

    return $array;
}
