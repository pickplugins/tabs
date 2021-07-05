<?php
if ( ! defined('ABSPATH')) exit; // if direct access 

class class_tabs_notices{

    public function __construct(){
        //add_action('admin_notices', array( $this, 'data_upgrade' ));
    }

    public function data_upgrade(){



        $tabs_plugin_info = get_option('tabs_plugin_info');
        $tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';


        $actionurl = admin_url().'edit.php?post_type=tabs&page=upgrade_status';
        $actionurl = wp_nonce_url( $actionurl,  'tabs_upgrade' );

        $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';

        if ( wp_verify_nonce( $nonce, 'tabs_upgrade' )  ){
            $tabs_plugin_info['tabs_upgrade'] = 'processing';
            update_option('tabs_plugin_info', $tabs_plugin_info);
            wp_schedule_event(time(), '1minute', 'tabs_cron_upgrade_settings');

            return;
        }


        if(empty($tabs_upgrade)){

            ?>
            <div class="update-nag">
                <?php
                echo sprintf(__('Data migration required for <b>Tabs by PickPlugins</b> plugin, please <a class="button button-primary" href="%s">click to start</a> migration. Watch this <a target="_blank" href="https://www.youtube.com/watch?v=4ZGMA6hOoxs">video</a>  first', 'tabs'), esc_url_raw($actionurl));
                ?>
            </div>
            <?php


        }

    }




}

new class_tabs_notices();