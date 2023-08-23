<?php
if (!defined('ABSPATH')) exit; // if direct access 

class class_tabs_notices
{

    public function __construct()
    {
        add_action('admin_notices', array($this, 'data_upgrade'));
    }

    public function data_upgrade()
    {


        if (current_user_can('administrator')) {

            $tabs_plugin_info = get_option('tabs_plugin_info');
            $tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';


            $actionurl = admin_url() . 'edit.php?post_type=tabs&page=settings&tab=migration&start_migration=yes';
            $actionurl = wp_nonce_url($actionurl,  'tabs_upgrade');

            $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';
            $start_migration = isset($_REQUEST['start_migration']) ? sanitize_text_field($_REQUEST['start_migration']) : '';

            if (wp_verify_nonce($nonce, 'tabs_upgrade')) {
                $tabs_plugin_info['tabs_upgrade'] = 'processing';
                update_option('tabs_plugin_info', $tabs_plugin_info);

                return;
            }


            if (empty($tabs_upgrade) && $start_migration != 'yes') {

?>
                <div class="notice">
                    <p>
                        <?php
                        echo sprintf(__('Data migration required for <b>Tabs by PickPlugins</b> plugin, please <a class="button button-primary" href="%s">click to start</a> migration.', 'tabs'), esc_url_raw($actionurl));
                        ?>
                    </p>

                </div>
<?php


            }
        }
    }
}

new class_tabs_notices();
