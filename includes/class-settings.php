<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 	


class tabs_class_settings{
	
	
    public function __construct(){

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );

    }
	
	
	public function admin_menu() {

        $tabs_plugin_info = get_option('tabs_plugin_info');
        $tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';


        add_submenu_page( 'edit.php?post_type=tabs', __( 'Settings', 'tabs' ), __( 'Settings', 'tabs' ), 'manage_options', 'settings', array( $this, 'settings' ) );

        if($tabs_upgrade != 'done'){
            //add_submenu_page( 'edit.php?post_type=tabs', __( 'Upgrade status', 'tabs' ), __( 'Upgrade status', 'tabs' ), 'manage_options', 'upgrade_status', array( $this, 'upgrade_status' ) );
        }
	}
	
	public function settings(){
        include( 'menu/settings.php' );
    }

    public function upgrade_status(){
        include( 'menu/upgrade-status.php' );
    }


}

new tabs_class_settings();

