<?php
/*
Plugin Name: Tabs by PickPlugins
Plugin URI: https://www.pickplugins.com/item/tabs-html-css3-responsive-accordion-grid-for-wordpress/?ref=dashboard
Description: Fully responsive and mobile ready accordion grid for wordpress.
Version: 1.3.7
Author: PickPlugins
Author URI: http://pickplugins.com
Text Domain: tabs
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class Tabs{
	
	public function __construct(){

		define('tabs_plugin_url', plugins_url('/', __FILE__)  );
		define('tabs_plugin_dir', plugin_dir_path( __FILE__ ) );
        define('tabs_version', '1.3.7' );
        define('tabs_plugin_name', 'Tabs' );
        define('tabs_plugin_basename', plugin_basename( __FILE__ ) );


        require_once( tabs_plugin_dir . 'includes/class-post-types.php');

        require_once( tabs_plugin_dir . 'includes/class-post-meta-tabs.php');
        require_once( tabs_plugin_dir . 'includes/class-post-meta-tabs-hook.php');

        require_once( tabs_plugin_dir . 'includes/class-settings.php');
        require_once( tabs_plugin_dir . 'includes/class-settings-hook.php');

        require_once( tabs_plugin_dir . 'includes/class-post-meta-product.php');
        require_once( tabs_plugin_dir . 'includes/class-admin-notices.php');
        require_once( tabs_plugin_dir . 'includes/functions-data-upgrade.php');



        require_once( tabs_plugin_dir . 'includes/class-settings-tabs.php');
		require_once( tabs_plugin_dir . 'includes/functions.php');
		require_once( tabs_plugin_dir . 'includes/functions-wc.php');
		require_once( tabs_plugin_dir . 'includes/class-shortcodes.php');
		require_once( tabs_plugin_dir . 'includes/duplicate-post.php');



        require_once( tabs_plugin_dir . 'templates/accordion/accordion-hook.php');
        require_once( tabs_plugin_dir . 'templates/tabs/tabs-hook.php');

        require_once( tabs_plugin_dir . 'includes/3rd-party/3rd-party.php');



        add_action( 'wp_enqueue_scripts', array( $this, '_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, '_admin_scripts' ) );
		
		add_action( 'plugins_loaded', array( $this, '_textdomain' ));
        add_filter('cron_schedules', array($this, 'cron_recurrence_interval'));


        require_once( tabs_plugin_dir . 'includes/class-widget-tabs.php');
				
		add_action( 'widgets_init', array( $this, 'widget_register' ) );

        // Display shortcode in widgets
		add_filter('widget_text', 'do_shortcode');
        add_filter( 'plugin_action_links_'.tabs_plugin_basename, array( $this, 'plugin_list_pro_link' ));
	}
	
	public function widget_register() {
		register_widget( 'WidgetTabs' );
	}
	
	public function _textdomain() {

        $locale = apply_filters( 'plugin_locale', get_locale(), 'tabs' );
        load_textdomain('tabs', WP_LANG_DIR .'/tabs/tabs-'. $locale .'.mo' );

        load_plugin_textdomain( 'tabs', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

		}

    function cron_recurrence_interval( $schedules ){

        $schedules['5minute'] = array(
            'interval'  => 300,
            'display'   => __( '5 Minute', 'textdomain' )
        );

        return $schedules;
    }



	
	public function _install(){

        $tabs_plugin_info = get_option('tabs_plugin_info');

        $tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';

        if($tabs_upgrade != 'done'){
            wp_schedule_event(time(), '5minute', 'tabs_cron_upgrade_settings');
            wp_schedule_event(time(), '5minute', 'tabs_cron_upgrade_tabs');
        }



        do_action( 'tabs_action_install' );
		
		}		
		
	public function _uninstall(){
		
		do_action( 'tabs_action_uninstall' );
		}		
		
	public function _deactivation(){
		
		do_action( 'tabs_action_deactivation' );
		}
	
	
	public function _front_scripts(){

        wp_enqueue_script('tabs_js', tabs_plugin_url. 'assets/frontend/js/scripts.js'  , array( 'jquery' ));
        wp_localize_script( 'tabs_js', 'tabs_ajax', array( 'tabs_ajaxurl' => admin_url( 'admin-ajax.php')));

        wp_register_style('tabs-style', tabs_plugin_url. 'assets/frontend/css/style.css');
        wp_register_style('style-tabs', tabs_plugin_url. 'assets/global/css/style-tabs.css');

        wp_register_style('tabs-tabs', tabs_plugin_url. 'assets/global/css/themesTabs.style.css');
        wp_register_style('fontawesome-5',  tabs_plugin_url.'assets/global/css/font-awesome-5.css');
        wp_register_style('fontawesome-4',  tabs_plugin_url.'assets/global/css/font-awesome-4.css');
        wp_register_style('jquery-ui',  tabs_plugin_url.'assets/frontend/css/jquery-ui.css');
        wp_register_style('tabs-themes',  tabs_plugin_url.'assets/global/css/themes.style.css');

		}

	public function _admin_scripts(){
        $screen = get_current_screen();

        //var_dump($screen);


        wp_enqueue_script('tabs_admin_js', tabs_plugin_url. 'assets/admin/js/scripts.js'  , array( 'jquery' ),'20181018');
        wp_localize_script( 'tabs_admin_js', 'tabs_ajax', array( 'tabs_ajaxurl' => admin_url( 'admin-ajax.php'), 'nonce' => wp_create_nonce('tabs_nonce')));

        wp_register_style('settings-tabs', tabs_plugin_url.'assets/settings-tabs/settings-tabs.css');
        wp_register_script('settings-tabs', tabs_plugin_url.'assets/settings-tabs/settings-tabs.js'  , array( 'jquery' ));

        wp_register_style('font-awesome-4', tabs_plugin_url.'assets/global/css/font-awesome-4.css');
        wp_register_style('font-awesome-5', tabs_plugin_url.'assets/global/css/font-awesome-5.css');
        wp_register_script('jquery.lazy', tabs_plugin_url.'assets/admin/js/jquery.lazy.js', array('jquery'));

        if($screen->id =='tabs' || $screen->id =='tabs_page_settings'){
            $settings_tabs_field = new settings_tabs_field();
            $settings_tabs_field->admin_scripts();
        }




    }

    public function plugin_list_pro_link( $links ) {

        $active_plugins = get_option('active_plugins');

        if(!in_array( 'tabs-pro/tabs-pro.php', (array) $active_plugins )){
            $links['get_premium'] = '<a target="_blank" class="" style=" font-weight:bold;" href="https://www.pickplugins.com/item/tabs-html-css3-responsive-accordion-grid-for-wordpress/?ref=dashboard">'.__('Buy Premium!', 'tabs').'</a>';


        }



        return $links;

    }


}

new Tabs();
