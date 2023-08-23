<?php



if ( ! defined('ABSPATH')) exit;  // if direct access


class class_tabs_shortcodes  {
	
	
    public function __construct(){
		


		add_shortcode( 'tabs', array( $this, 'tabs_display' ) );
        add_shortcode( 'tabs_pplugins', array( $this, 'tabs_display' ) );
        add_shortcode( 'tabs_pickplugins', array( $this, 'tabs_display' ) );

		add_shortcode( 'tabs_accordion', array( $this, 'tabs_accordion_display' ) );
        add_shortcode( 'tabs_accordion_pplugins', array( $this, 'tabs_accordion_display' ) );



    }

    public function tabs_display($atts, $content = null ) {

        $atts = shortcode_atts(
            array(
                'id' => "",
            ),
            $atts);

        $post_id = $atts['id'];

        ob_start();

        $tabs_options = get_post_meta($post_id,'tabs_options', true);
        $view_type = isset($tabs_options['view_type']) ? $tabs_options['view_type'] : 'tabs';


        ob_start();

        if ($view_type == 'tabs'):
            ?><div id="tabs-<?php echo esc_attr($post_id); ?>" class="tabs-<?php echo esc_attr($post_id); ?> tabs tabs">
            <?php
            do_action('tabs_main', $atts);
            ?>
            </div><?php
        else:
            ?><div id="tabs-<?php echo esc_attr($post_id); ?>" class="tabs-<?php echo esc_attr($post_id); ?> tabs">
            <?php
            do_action('tabs_accordion', $atts);
            ?>
            </div><?php
        endif;

        return ob_get_clean();

    }

	
	public function tabs_accordion_display($atts, $content = null ) {

        $atts = shortcode_atts(
            array(
                'id' => "",
                ),
            $atts);
	
        $post_id = $atts['id'];
        $tabs_options = get_post_meta($post_id,'tabs_options', true);
        $view_type = isset($tabs_options['view_type']) ? $tabs_options['view_type'] : 'tabs';


        ob_start();

        ?><div id="tabs-<?php echo esc_attr($post_id); ?>" class="tabs-<?php echo esc_attr($post_id); ?> tabs">
        <?php
        do_action('tabs_accordion', $atts);
        ?>
        </div><?php

        return ob_get_clean();

    }

	

	

}

new class_tabs_shortcodes();