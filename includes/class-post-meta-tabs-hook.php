<?php

/*
* @Author 		PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access




add_action('tabs_metabox_content_shortcode', 'tabs_metabox_content_shortcode',10, 2);

function tabs_metabox_content_shortcode($post_id){

    $settings_tabs_field = new settings_tabs_field();


    ?>
    <div class="section">
        <div class="section-title"><?php echo __('Shortcodes','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Simply copy these shortcode and user under content','tabs');?></p>


        <?php


        ob_start();

        ?>

        <div class="copy-to-clipboard">
            <input type="text" value="[tabs id='<?php echo esc_attr($post_id);  ?>']"> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('You can use this shortcode under post content','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <input type="text" value="[tabs_pplugins id='<?php echo esc_attr($post_id);  ?>']"> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('To avoid conflict with 3rd party shortcode also used same <code>[tabs]</code>You can use this shortcode under post content.','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[tabs id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('PHP Code, you can use under theme .php files.','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[tabs_pplugins id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('To avoid conflict, PHP code you can use under theme .php files.','tabs'); ?></p>
        </div>



        <?php

        $html = ob_get_clean();

        $args = array(
            'id'		=> 'tabs_shortcodes',
            'title'		=> __('Tabs shortcode','tabs'),
            'details'	=> '',
            'type'		=> 'custom_html',
            'html'		=> $html,


        );

        $settings_tabs_field->generate_field($args);
        ?>

        <?php


        ob_start();

        ?>

        <div class="copy-to-clipboard">
            <input type="text" value="[tabs_accordion id='<?php echo esc_attr($post_id);  ?>']"> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('You can use this shortcode under post content','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <input type="text" value="[tabs_accordion_pplugins id='<?php echo esc_attr($post_id);  ?>']"> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('To avoid conflict with 3rd party shortcode also used same <code>[tabs_accordion]</code>You can use this shortcode under post content','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[tabs_accordion id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('PHP Code, you can use under theme .php files.','tabs'); ?></p>
        </div>

        <div class="copy-to-clipboard">
            <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[tabs_accordion_pplugins id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea> <span class="copied"><?php echo __('Copied','tabs'); ?></span>
            <p class="description"><?php echo __('To avoid conflict, PHP code you can use under theme .php files.','tabs'); ?></p>
        </div>



        <style type="text/css">
            .copy-to-clipboard{}
            .copy-to-clipboard .copied{
                display: none;
                background: #e5e5e5;
                padding: 4px 10px;
                line-height: normal;
            }
        </style>

        <script>
            jQuery(document).ready(function($){


                $(document).on('click', '.copy-to-clipboard input, .copy-to-clipboard textarea', function () {

                    $(this).focus();
                    $(this).select();
                    document.execCommand('copy');

                    $(this).parent().children('.copied').fadeIn().fadeOut(2000);
                })

            })


        </script>




        <?php

        $html = ob_get_clean();

        $args = array(
            'id'		=> 'tabs_shortcodes',
            'title'		=> __('Accordion shortcodes','tabs'),
            'details'	=> '',
            'type'		=> 'custom_html',
            'html'		=> $html,


        );

        $settings_tabs_field->generate_field($args);
        ?>










    </div>
    <?php
}


add_action('tabs_metabox_content_general', 'tabs_metabox_content_general', 10);

function tabs_metabox_content_general($post_id){

    $settings_tabs_field = new settings_tabs_field();
    $tabs_options = get_post_meta($post_id, 'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $lazy_load = isset($tabs_options['lazy_load']) ? $tabs_options['lazy_load'] : 'yes';
    $lazy_load_src = isset($tabs_options['lazy_load_src']) ? $tabs_options['lazy_load_src'] : '';
    $hide_edit = isset($tabs_options['hide_edit']) ? $tabs_options['hide_edit'] : '';
    $enable_autoembed = isset($tabs_options['enable_autoembed']) ? $tabs_options['enable_autoembed'] : '';
    $enable_shortcode = isset($tabs_options['enable_shortcode']) ? $tabs_options['enable_shortcode'] : '';
    $enable_wpautop = isset($tabs_options['enable_wpautop']) ? $tabs_options['enable_wpautop'] : '';
    $enable_schema = isset($tabs_options['enable_schema']) ? $tabs_options['enable_schema'] : '';
    $edit_link_access_role = isset($tabs_options['edit_link_access_role']) ? $tabs_options['edit_link_access_role'] : array();

    //var_dump($lazy_load);

    ?>

    <div class="section">
        <div class="section-title"><?php echo __('General options','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Some general options','tabs'); ?></p>

        <?php
        $args = array(
            'id'		=> 'lazy_load',
            'parent'		=> 'tabs_options',
            'title'		=> __('Enable lazy load','tabs'),
            'details'	=> __('Accordion content will be hidden until page load completed.','tabs'),
            'type'		=> 'select',
            'value'		=> $lazy_load,
            'default'		=> 'yes',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'lazy_load_src',
            'parent'		=> 'tabs_options',
            'title'		=> __('Lazy load image','tabs'),
            'details'	=> __('Set custom image source for lazy load icon.','tabs'),
            'type'		=> 'media_url',
            'value'		=> $lazy_load_src,
            'default'		=> '',
            'placeholder' => '',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'hide_edit',
            'parent'		=> 'tabs_options',
            'title'		=> __('Hide edit link','tabs'),
            'details'	=> __('You can display/hide accordion edit link on front-end','tabs'),
            'type'		=> 'select',
            'value'		=> $hide_edit,
            'default'		=> 'yes',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'edit_link_access_role',
            'parent'		=> 'tabs_options',
            'title'		=> __('Who can see edit link','tabs'),
            'details'	=> __('Select which user role can access to edit link.','tabs'),
            'type'		=> 'select',
            'multiple'		=> true,
            'value'		=> $edit_link_access_role,
            'default'		=> array('administrator'),
            'args'		=> tabs_all_user_roles(),
        );

        $settings_tabs_field->generate_field($args);




        $args = array(
            'id'		=> 'enable_autoembed',
            'parent'		=> 'tabs_options',
            'title'		=> __('Enable autoembed','tabs'),
            'details'	=> __('Enable autoembed for content.','tabs'),
            'type'		=> 'select',
            'value'		=> $enable_autoembed,
            'default'		=> 'yes',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'enable_shortcode',
            'parent'		=> 'tabs_options',
            'title'		=> __('Enable shortcode','tabs'),
            'details'	=> __('Enable shortcode for content.','tabs'),
            'type'		=> 'select',
            'value'		=> $enable_shortcode,
            'default'		=> 'yes',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'enable_wpautop',
            'parent'		=> 'tabs_options',
            'title'		=> __('Enable wpautop','tabs'),
            'details'	=> __('Enable wpautop for content.','tabs'),
            'type'		=> 'select',
            'value'		=> $enable_wpautop,
            'default'		=> 'yes',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'enable_schema',
            'parent'		=> 'tabs_options',
            'title'		=> __('Enable schema','tabs'),
            'details'	=> __('Enable schema for accordion or tabs.','tabs'),
            'type'		=> 'select',
            'value'		=> $enable_schema,
            'default'		=> 'no',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);



        ?>

    </div>
        <?php

}

add_action('tabs_metabox_content_accordion_options', 'tabs_metabox_content_accordion_options', 10);

function tabs_metabox_content_accordion_options($post_id){

    $settings_tabs_field = new settings_tabs_field();
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $accordion = isset($tabs_options['accordion']) ? $tabs_options['accordion'] : array();
    $collapsible = isset($accordion['collapsible']) ? $accordion['collapsible'] : 'true';
    $expanded_other = isset($accordion['expanded_other']) ? $accordion['expanded_other'] : 'no';
    $height_style = isset($accordion['height_style']) ? $accordion['height_style'] : 'content';
    $active_event = isset($accordion['active_event']) ? $accordion['active_event'] : 'click';


    ?>

    <div class="section">
        <div class="section-title"><?php echo __('Accordion options','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Some general setting for accordion','tabs'); ?></p>

        <?php
        $args = array(
            'id'		=> 'collapsible',
            'parent'		=> 'tabs_options[accordion]',
            'title'		=> __('Collapsible','tabs'),
            'details'	=> __('Make accordion collapsible.','tabs'),
            'type'		=> 'select',
            'value'		=> $collapsible,
            'default'		=> 'true',
            'args'		=> array(
                'true'	=> __('True','tabs'),
                'false'	=> __('False','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'expanded_other',
            'parent'		=> 'tabs_options[accordion]',
            'title'		=> __('Keep expanded others','tabs'),
            'details'	=> __('This is useful when use collapsible.','tabs'),
            'type'		=> 'select',
            'value'		=> $expanded_other,
            'default'		=> 'no',
            'args'		=> array(
                'no'	=> __('No','tabs'),
                'yes'	=> __('Yes','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'height_style',
            'parent'		=> 'tabs_options[accordion]',
            'title'		=> __('Content height style','tabs'),
            'details'	=> __('accordion content style.','tabs'),
            'type'		=> 'select',
            'value'		=> $height_style,
            'default'		=> 'content',
            'args'		=> array(

                'content'	=> __('Content','tabs'),
                'fill'	=> __('Fill','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'active_event',
            'parent'		=> 'tabs_options[accordion]',
            'title'		=> __('Activate event','tabs'),
            'details'	=> __('Activate event type for header.','tabs'),
            'type'		=> 'select',
            'value'		=> $active_event,
            'default'		=> 'click',
            'args'		=> array(
                'click'	=> __('Click','tabs'),
                'mouseover'	=> __('Mouseover','tabs'),
                'focus'	=> __('Focus','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);
        ?>

    </div>
    <?php


}


add_action('tabs_metabox_content_tabs_options', 'tabs_metabox_content_tabs_options', 10);

function tabs_metabox_content_tabs_options($post_id){

    $settings_tabs_field = new settings_tabs_field();
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $tabs = isset($tabs_options['tabs']) ? $tabs_options['tabs'] : array();
    $collapsible = isset($tabs['collapsible']) ? $tabs['collapsible'] : 'true';
    $active_event = isset($tabs['active_event']) ? $tabs['active_event'] : 'click';
    $navs_alignment = isset($tabs['navs_alignment']) ? $tabs['navs_alignment'] : 'left';


    ?>

    <div class="section">
        <div class="section-title"><?php echo __('Tabs options','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Settings for tabs','tabs'); ?></p>


        <?php
        $args = array(
            'id'		=> 'collapsible',
            'parent'		=> 'tabs_options[tabs]',
            'title'		=> __('Collapsible','tabs'),
            'details'	=> __('Make tabs collapsible.','tabs'),
            'type'		=> 'select',
            'value'		=> $collapsible,
            'default'		=> 'true',
            'args'		=> array(
                'true'	=> __('True','tabs'),
                'false'	=> __('False','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'active_event',
            'parent'		=> 'tabs_options[tabs]',
            'title'		=> __('Activate event','tabs'),
            'details'	=> __('Event for activate tabs','tabs'),
            'type'		=> 'select',
            'value'		=> $active_event,
            'default'		=> 'click',
            'args'		=> array(
                'click'	=> __('Click','tabs'),
                'mouseover'	=> __('Mouseover','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'navs_alignment',
            'parent'		=> 'tabs_options[tabs]',
            'title'		=> __('Navs alignment','tabs'),
            'details'	=> __('Set navs alignment','tabs'),
            'type'		=> 'select',
            'value'		=> $navs_alignment,
            'default'		=> 'left',
            'args'		=> array(
                'left'	=> __('Left','tabs'),
                'right'	=> __('Right','tabs'),
            ),
        );

        $settings_tabs_field->generate_field($args);


        ?>

    </div>
    <?php


}




add_action('tabs_metabox_content_style', 'tabs_metabox_content_style', 10);

function tabs_metabox_content_style($post_id){

    $settings_tabs_field = new settings_tabs_field();
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);

    $icon = isset($tabs_options['icon']) ? $tabs_options['icon'] : array();
    $icon_active = isset($icon['active']) ? $icon['active'] : '';
    $icon_inactive = isset($icon['inactive']) ? $icon['inactive'] : '';
    $icon_color = isset($icon['color']) ? $icon['color'] : '';
    $icon_color_hover = isset($icon['color_hover']) ? $icon['color_hover'] : '';
    $icon_font_size = isset($icon['font_size']) ? $icon['font_size'] : '';
    $icon_background_color = isset($icon['background_color']) ? $icon['background_color'] : '';
    $icon_padding = isset($icon['padding']) ? $icon['padding'] : '';
    $icon_margin = isset($icon['margin']) ? $icon['margin'] : '';
    $icon_position = isset($icon['position']) ? $icon['position'] : '';


    $header = isset($tabs_options['header']) ? $tabs_options['header'] : array();
    $header_class = isset($header['class']) ? $header['class'] : '';
    $header_background_color = isset($header['background_color']) ? $header['background_color'] : '';
    $header_active_background_color = isset($header['active_background_color']) ? $header['active_background_color'] : '';
    $header_color = isset($header['color']) ? $header['color'] : '';
    $header_color_hover = isset($header['color_hover']) ? $header['color_hover'] : '';
    $header_font_size = isset($header['font_size']) ? $header['font_size'] : '';
    $header_font_family = isset($header['font_family']) ? $header['font_family'] : '';

    $header_padding = isset($header['padding']) ? $header['padding'] : '';
    $header_margin = isset($header['margin']) ? $header['margin'] : '';

    $body = isset($tabs_options['body']) ? $tabs_options['body'] : array();
    $body_class = isset($body['class']) ? $body['class'] : '';
    $body_background_color = isset($body['background_color']) ? $body['background_color'] : '';
    $body_active_background_color = isset($body['active_background_color']) ? $body['active_background_color'] : '';
    $body_color = isset($body['color']) ? $body['color'] : '';
    $body_color_hover = isset($body['color_hover']) ? $body['color_hover'] : '';
    $body_font_size = isset($body['font_size']) ? $body['font_size'] : '';
    $body_font_family = isset($body['font_family']) ? $body['font_family'] : '';

    $body_padding = isset($body['padding']) ? $body['padding'] : '';
    $body_margin = isset($body['margin']) ? $body['margin'] : '';

    ?>
    <div class="section">
        <div class="section-title"><?php echo __('Accordion icons','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Customize accordion icons.','tabs'); ?></p>

        <?php

        $args = array(
            'id'		=> 'active',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Active icon','tabs'),
            'details'	=> __('Icon for idle, you can use <a target="_blank" href="https://fontawesome.com/icons">Font Awesome</a> icon html <code>&lt;i class="fas fa-chevron-right">&lt;/i></code>','tabs'),
            'type'		=> 'text_icon',
            'value'		=> $icon_active,
            'default'		=> '',
            'placeholder' => '',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'inactive',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Inactive icon','tabs'),
            'details'	=> __('Icon for activate, you can use <a target="_blank" href="https://fontawesome.com/icons">Font Awesome</a> icon html <code>&lt;i class="fas fa-chevron-down">&lt;/i></code>','tabs'),
            'type'		=> 'text_icon',
            'value'		=> $icon_inactive,
            'default'		=> '',
            'placeholder' => '',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'color',
            'css_id'		=> 'icon_color',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Color','tabs'),
            'details'	=> __('Color for icons','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $icon_color,
            'default'		=> '',
            'placeholder' => '#999999',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'color_hover',
            'css_id'		=> 'icon_color_hover',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Hover color','tabs'),
            'details'	=> __('Color for icons on mousehover','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $icon_color_hover,
            'default'		=> '',
            'placeholder' => '#777777',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'background_color',
            'css_id'		=> 'icon_background_color',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Background color','tabs'),
            'details'	=> __('Background color for icons','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $icon_background_color,
            'default'		=> '',
            'placeholder' => '#777777',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'font_size',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Font size','tabs'),
            'details'	=> __('You can set custom font size.','tabs'),
            'type'		=> 'text',
            'value'		=> $icon_font_size,
            'default'		=> '',
            'placeholder' => '14px',
        );

        $settings_tabs_field->generate_field($args);


        $args = array(
            'id'		=> 'padding',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Padding','tabs'),
            'details'	=> __('Choose icon area padding','tabs'),
            'type'		=> 'text',
            'value'		=> $icon_padding,
            'default'		=> '',
            'placeholder' => '10px',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'margin',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Margin','tabs'),
            'details'	=> __('Choose header area margin','tabs'),
            'type'		=> 'text',
            'value'		=> $icon_margin,
            'default'		=> '',
            'placeholder' => '5px',
        );

        $settings_tabs_field->generate_field($args);


        $args = array(
            'id'		=> 'position',
            'parent'		=> 'tabs_options[icon]',
            'title'		=> __('Position','tabs'),
            'details'	=> __('Set icon position','tabs'),
            'type'		=> 'select',
            'value'		=> $icon_position,
            'default'		=> 'left',
            'args'		=> array(
                'none'	=> __('None','tabs'),
                'left'	=> __('Left','tabs'),
                'right'	=> __('Right','tabs'),
            ),

        );

        $settings_tabs_field->generate_field($args);

        ?>
    </div>


    <div class="section">
        <div class="section-title"><?php echo __('Accordion header style','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Customize accordion header.','tabs'); ?></p>
        <?php

        $args = array(
            'id'		=> 'class',
            'css_id'		=> 'header_background_color',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Add class','tabs'),
            'details'	=> __('Header style class, ex: <code>border-flat, border-semi-round, border-round, border-1px border-2px border-3px, shadow-bottom, shadow-top shadow-bottom-right, shadow-bottom-left</code>','tabs'),
            'type'		=> 'text',
            'value'		=> $header_class,
            'default'		=> '',
            'placeholder' => '',
        );

        $settings_tabs_field->generate_field($args);





        $args = array(
            'id'		=> 'background_color',
            'css_id'		=> 'header_background_color',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Background color','tabs'),
            'details'	=> __('Background color of header on idle','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $header_background_color,
            'default'		=> '',
            'placeholder' => '#eeeeee',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'active_background_color',
            'css_id'		=> 'header_active_background_color',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Active background color','tabs'),
            'details'	=> __('Background color of header on active stats','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $header_active_background_color,
            'default'		=> '',
            'placeholder' => '#dddddd',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'color',
            'css_id'		=> 'header_color',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Color','tabs'),
            'details'	=> __('Font color for accordion headers','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $header_color,
            'default'		=> '',
            'placeholder' => '#999999',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'color_hover',
            'css_id'		=> 'header_color_hover',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Color on hover','tabs'),
            'details'	=> __('Font color for accordion headers','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $header_color_hover,
            'default'		=> '',
            'placeholder' => '#7777777',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'font_size',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Font size','tabs'),
            'details'	=> __('Choose font size for header text','tabs'),
            'type'		=> 'text',
            'value'		=> $header_font_size,
            'default'		=> '',
            'placeholder' => '14px',
        );

        $settings_tabs_field->generate_field($args);


        $args = array(
            'id'		=> 'font_family',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Font family','tabs'),
            'details'	=> __('Choose font family for header text','tabs'),
            'type'		=> 'text',
            'value'		=> $header_font_family,
            'placeholder' => 'Open Sans',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'padding',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Padding','tabs'),
            'details'	=> __('Choose header area padding','tabs'),
            'type'		=> 'text',
            'value'		=> $header_padding,
            'default'		=> '',
            'placeholder' => '10px',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'margin',
            'parent'		=> 'tabs_options[header]',
            'title'		=> __('Margin','tabs'),
            'details'	=> __('Choose header area margin','tabs'),
            'type'		=> 'text',
            'value'		=> $header_margin,
            'default'		=> '',
            'placeholder' => '5px',
        );

        $settings_tabs_field->generate_field($args);
        ?>

    </div>

    <div class="section">
        <div class="section-title"><?php echo __('Tabs content style','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Customize accordion content.','tabs'); ?></p>

        <?php

        $args = array(
            'id'		=> 'class',
            'css_id'		=> 'header_class',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Add class','tabs'),
            'details'	=> __('Body style class, ex: <code>border-flat, border-semi-round, border-round, border-1px border-2px border-3px, shadow-bottom, shadow-top shadow-bottom-right, shadow-bottom-left</code>','tabs'),
            'type'		=> 'text',
            'value'		=> $body_class,
            'default'		=> '',
            'placeholder' => '',
        );

        $settings_tabs_field->generate_field($args);


        $args = array(
            'id'		=> 'color',
            'css_id'		=> 'body_color_hover',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Color','tabs'),
            'details'	=> __('You can choose custom color for accordion content','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $body_color,
            'default'		=> '',
            'placeholder' => '#999999',
        );

        $settings_tabs_field->generate_field($args);
        ?>


        <?php
        $args = array(
            'id'		=> 'font_size',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Font size','tabs'),
            'details'	=> __('You can set custom font size for accordion content','tabs'),
            'type'		=> 'text',
            'value'		=> $body_font_size,
            'default'		=> '',
            'placeholder' => '10px',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'font_family',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Font family','tabs'),
            'details'	=> __('Choose font family for accordion content text','tabs'),
            'type'		=> 'text',
            'value'		=> $body_font_family,
            'placeholder' => 'Open Sans',
        );

        $settings_tabs_field->generate_field($args);

        ?>

        <?php
        $args = array(
            'id'		=> 'background_color',
            'css_id'		=> 'body_background_color',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Background color','tabs'),
            'details'	=> __('You can choose custom background color for accordion content area','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $body_background_color,
            'default'		=> '#ffffff',
            'placeholder' => '#ffffff',
        );

        $settings_tabs_field->generate_field($args);
        ?>


        <?php
        $args = array(
            'id'		=> 'padding',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Padding','tabs'),
            'details'	=> __('You can set custom padding for accordion content','tabs'),
            'type'		=> 'text',
            'value'		=> $body_padding,
            'default'		=> '',
            'placeholder' => '10px',
        );

        $settings_tabs_field->generate_field($args);
        ?>


        <?php
        $args = array(
            'id'		=> 'margin',
            'parent'		=> 'tabs_options[body]',
            'title'		=> __('Margin','tabs'),
            'details'	=> __('You can set custom margin for accordion content','tabs'),
            'type'		=> 'text',
            'value'		=> $body_margin,
            'default'		=> '',
            'placeholder' => '10px',
        );

        $settings_tabs_field->generate_field($args);

        ?>
    </div>

    <div class="section">
        <div class="section-title"><?php echo __('Container style','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Customize container style optons.','tabs'); ?></p>

        <?php

        $container = isset($tabs_options['container']) ? $tabs_options['container'] : array();
        $container_padding = isset($container['padding']) ? $container['padding'] : '';
        $container_background_color = isset($container['background_color']) ? $container['background_color'] : '';
        $container_text_align = isset($container['text_align']) ? $container['text_align'] : '';
        $container_background_img = isset($container['background_img']) ? $container['background_img'] : '';

        $width_large = isset($container['width_large']) ? $container['width_large'] : '';
        $width_medium = isset($container['width_medium']) ? $container['width_medium'] : '';
        $width_small = isset($container['width_small']) ? $container['width_small'] : '';


        $args = array(
            'id'		=> 'padding',
            'parent'		=> 'tabs_options[container]',
            'title'		=> __('Padding','tabs'),
            'details'	=> __('Set container padding','tabs'),
            'type'		=> 'text',
            'value'		=> $container_padding,
            'default'		=> '',
            'placeholder' => '10px',

        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'background_color',
            'parent'		=> 'tabs_options[container]',
            'title'		=> __('Background color','tabs'),
            'details'	=> __('Set container background color','tabs'),
            'type'		=> 'colorpicker',
            'value'		=> $container_background_color,
            'default'		=> '#ffffff',
            'placeholder' => '',

        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'text_align',
            'parent'		=> 'tabs_options[container]',
            'title'		=> __('Text align','tabs'),
            'details'	=> __('Set container text align','tabs'),
            'type'		=> 'select',
            'value'		=> $container_text_align,
            'default'		=> 'left',
            'args'		=> array(
                'left'	=> __('Left','tabs'),
                'right'	=> __('Right','tabs'),
                'center'	=> __('Center','tabs'),
                'justify'	=> __('Justify','tabs'),

            ),

        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'background_img',
            'parent'		=> 'tabs_options[container]',
            'title'		=> __('Background image','tabs'),
            'details'	=> __('Set container background image','tabs'),
            'type'		=> 'media_url',
            'value'		=> $container_background_img,
            'default'		=> '',
            'placeholder' => '',

        );

        $settings_tabs_field->generate_field($args);



        $args = array(
            'id'		=> 'width',
            'title'		=> __('Container width','tabs'),
            'details'	=> __('Set accordion width.','tabs'),
            'type'		=> 'option_group',
            'options'		=> array(
                array(
                    'id'		=> 'width_large',
                    'parent'		=> 'tabs_options[container]',
                    'title'		=> __('In desktop','tabs'),
                    'details'	=> __('min-width: 1200px, ex: 300px','tabs'),
                    'type'		=> 'text',
                    'value'		=> $width_large,
                    'default'		=> '',
                    'placeholder'   => '',
                ),
                array(
                    'id'		=> 'width_medium',
                    'parent'		=> 'tabs_options[container]',
                    'title'		=> __('In tablet & small desktop','tabs'),
                    'details'	=> __('min-width: 992px, ex: 90%','tabs'),
                    'type'		=> 'text',
                    'value'		=> $width_medium,
                    'default'		=> '',
                    'placeholder'   => '',
                ),
                array(
                    'id'		=> 'width_small',
                    'parent'		=> 'tabs_options[container]',
                    'title'		=> __('In mobile','tabs'),
                    'details'	=> __('min-width: 576px, ex: 90%','tabs'),
                    'type'		=> 'text',
                    'value'		=> $width_small,
                    'default'		=> '',
                    'placeholder'   => '',
                ),
            ),

        );

        $settings_tabs_field->generate_field($args);



        ?>

    </div>

    <?php

}



add_action('tabs_metabox_content_content', 'tabs_metabox_content_content', 10);

function tabs_metabox_content_content($post_id){

    $settings_tabs_field = new settings_tabs_field();
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);

    $tabs_content = isset($tabs_options['content']) ? $tabs_options['content'] : array();


    ?>

    <div class="section">
        <div class="section-title"><?php echo __('Tabs content','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Add you accordion content here.','tabs'); ?></p>

        <?php


        //echo '<pre>'.var_export($tabs_active_accordion, true).'</pre>';
        //echo '<pre>'.var_export($tabs_content_body, true).'</pre>';


        $meta_fields = array(
            array(
                'id'		=> 'header',
                'css_id'		=> 'header_TIMEINDEX',
                'title'		=> __('Header','tabs'),
                'details'	=> __('Accordion header.','tabs'),
                'type'		=> 'text',
                'value'		=> '',
                'default'		=> '',
                'placeholder'		=> 'Header text',
            ),
            array(
                'id'		=> 'body',
                'css_id'		=> 'body_TIMEINDEX',
                'title'		=> __('Accordion body','tabs'),
                'details'	=> __('Accordion body content.','tabs'),
                'type'		=> 'textarea_editor',
                'value'		=> '',
                'default'		=> '',
                'placeholder'		=> 'Content text',
            ),
            array(
                'id'		=> 'hide',
                'css_id'		=> 'hide_TIMEINDEX',
                'title'		=> __('Hide','tabs'),
                'details'	=> __('Hide this.','tabs'),
                'type'		=> 'select',
                'value'		=> '',
                'default'		=> 'false',
                'args'		=> array(
                    'true'	=> __('True','tabs'),
                    'false'	=> __('False','tabs'),
                ),
            ),

            array(
                'id'		=> 'hide_schema',
                'css_id'		=> 'hide_TIMEINDEX',
                'title'		=> __('Hide schema','tabs'),
                'details'	=> __('Hide schema for this.','tabs'),
                'type'		=> 'select',
                'value'		=> '',
                'default'		=> 'false',
                'args'		=> array(
                    'true'	=> __('True','tabs'),
                    'false'	=> __('False','tabs'),
                ),
            ),

        );

        $meta_fields = apply_filters('tabs_content_fields', $meta_fields);

        $args = array(
            'id'		=> 'content',
            'parent'		=> 'tabs_options',
            'title'		=> __('Accordion content','text-domain'),
            'details'	=> __('Set accordion content & title here.','text-domain'),
            'collapsible'=> true,
            'type'		=> 'repeatable',
            'limit'		=> 10,
            'title_field'		=> 'header',
            'value'		=> $tabs_content,
            'fields'    => $meta_fields,
        );

        $settings_tabs_field->generate_field($args);



        ob_start();

        ?>




    </div>
    <?php
}


add_action('tabs_metabox_content_custom_scripts', 'tabs_metabox_content_custom_scripts', 10);

function tabs_metabox_content_custom_scripts($post_id){


    $settings_tabs_field = new settings_tabs_field();

    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);

    $custom_scripts = isset($tabs_options['custom_scripts']) ? $tabs_options['custom_scripts'] : array();
    $custom_js = isset($custom_scripts['custom_js']) ? $custom_scripts['custom_js'] : '';
    $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';


    ?>
    <div class="section">
        <div class="section-title"><?php echo __('Tabs Scripts','tabs'); ?></div>
        <p class="description section-description"><?php echo __('Add your own CSS & Scripts.','tabs'); ?></p>

        <?php
        $args = array(
            'id'		=> 'custom_js',
            'parent'		=> 'tabs_options[custom_scripts]',
            'title'		=> __('Custom Js','tabs'),
            'details'	=> __('You can add custom scripts here, do not use <code>&lt;script&gt; &lt;/script&gt;</code> tag','tabs'),
            'type'		=> 'scripts_js',
            'value'		=> $custom_js,
            'default'		=> '',
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'custom_css',
            'parent'		=> 'tabs_options[custom_scripts]',
            'title'		=> __('Custom CSS','tabs'),
            'details'	=> __('You can add custom css here, do not use <code>  &lt;style&gt; &lt;/style&gt;</code> tag','tabs'),
            'type'		=> 'scripts_css',
            'value'		=> $custom_css,
            'default'		=> '',
        );

        $settings_tabs_field->generate_field($args);
        ?>

    </div>
    <?php


}



add_action('tabs_metabox_content_help_support', 'tabs_metabox_content_help_support');

if(!function_exists('tabs_metabox_content_help_support')) {
    function tabs_metabox_content_help_support($tab){

        $settings_tabs_field = new settings_tabs_field();

        ?>
        <div class="section">

            <div class="section-title"><?php echo __('Get support', 'tabs'); ?></div>
            <p class="description section-description"><?php echo __('Use following to get help and support from our expert team.', 'tabs'); ?></p>

            <?php


            ob_start();
            ?>

            <p><?php echo __('Ask question for free on our forum and get quick reply from our expert team members.', 'tabs'); ?></p>
            <a class="button" href="https://www.pickplugins.com/create-support-ticket/"><?php echo __('Create support ticket', 'tabs'); ?></a>

            <p><?php echo __('Read our documentation before asking your question.', 'tabs'); ?></p>
            <a class="button" href="https://www.pickplugins.com/documentation/tabs/"><?php echo __('Documentation', 'tabs'); ?></a>

            <p><?php echo __('Watch video tutorials.', 'tabs'); ?></p>
            <a class="button" href="https://www.youtube.com/playlist?list=PL0QP7T2SN94ZPeQ83jOnteDDrOeDLBuFD"><i class="fab fa-youtube"></i> <?php echo __('All tutorials', 'tabs'); ?></a>

            <ul>
                <li><i class="far fa-dot-circle"></i> <a href="https://www.youtube.com/watch?v=4ZGMA6hOoxs">Tabs - data migration</a></li>


            </ul>



            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'get_support',
                //'parent'		=> '',
                'title'		=> __('Ask question','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ob_start();
            ?>

            <p class="">We wish your 2 minutes to write your feedback about the <b>Tabs</b> plugin. give us <span style="color: #ffae19"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>

            <a target="_blank" href="https://wordpress.org/plugins/tabs/#reviews" class="button"><i class="fab fa-wordpress"></i> Write a review</a>


            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'reviews',
                //'parent'		=> '',
                'title'		=> __('Submit reviews','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);




            ?>



        </div>
        <?php


    }
}



add_action('tabs_metabox_content_buy_pro', 'tabs_settings_content_buy_pro');




add_action('tabs_post_meta_save','tabs_post_meta_save');

function tabs_post_meta_save($job_id){

    $tabs_options = isset($_POST['tabs_options']) ? tabs_recursive_sanitize_arr($_POST['tabs_options']) : '';
    update_post_meta($job_id, 'tabs_options', $tabs_options);


}
