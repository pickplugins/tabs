<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

$tabs_plugin_info = get_option('tabs_plugin_info');
$tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';

$current_tab = isset($_REQUEST['tab']) ? sanitize_text_field($_REQUEST['tab']) : 'general';

$tabs_settings_tab = array();

$tabs_settings_tab[] = array(
    'id' => 'general',
    'title' => sprintf(__('%s General','tabs'),'<i class="fas fa-list-ul"></i>'),
    'priority' => 1,
    'active' => ($current_tab == 'general') ? true : false,
);

$tabs_settings_tab[] = array(
    'id' => '3rd_party_import',
    'title' => sprintf(__('%s 3rd party import','tabs'),'<i class="fas fa-download"></i>'),
    'priority' => 2,
    'active' => ($current_tab == '3rd_party_import') ? true : false,
);

$tabs_settings_tab[] = array(
    'id' => 'help_support',
    'title' => sprintf(__('%s Help & support','tabs'),'<i class="fas fa-hands-helping"></i>'),
    'priority' => 3,
    'active' => ($current_tab == 'help_support') ? true : false,
);

$tabs_settings_tab[] = array(
    'id' => 'buy_pro',
    'title' => sprintf(__('%s Buy Pro','tabs'),'<i class="fas fa-store"></i>'),
    'priority' => 9,
    'active' => ($current_tab == 'buy_pro') ? true : false,
);
if($tabs_upgrade != 'done') {
    $tabs_settings_tab[] = array(
        'id' => 'migration',
        'title' => sprintf(__('%s Migration process', 'tabs'), '<i class="fas fa-spinner fa-spin"></i>'),
        'priority' => 10,
        'active' => ($current_tab == 'migration') ? true : false,
    );
}


$tabs_settings_tab = apply_filters('tabs_settings_tabs', $tabs_settings_tab);

$tabs_sorted = array();

if(!empty($tabs_settings_tab))
foreach ($tabs_settings_tab as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
array_multisort($tabs_sorted, SORT_ASC, $tabs_settings_tab);



$tabs_settings = get_option('tabs_settings');

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><h2><?php echo sprintf(__('%s Settings', 'tabs'), tabs_plugin_name)?></h2>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', esc_url_raw($_SERVER['REQUEST_URI'])); ?>">
	        <input type="hidden" name="tabs_hidden" value="Y">
            <input type="hidden" name="tab" value="<?php echo esc_attr($current_tab); ?>">
            <?php
            if(!empty($_POST['tabs_hidden'])){
                $nonce = sanitize_text_field($_POST['_wpnonce']);
                if(wp_verify_nonce( $nonce, 'tabs_nonce' ) && $_POST['tabs_hidden'] == 'Y') {
                    do_action('tabs_settings_save');
                    ?>
                    <div class="updated notice  is-dismissible"><p><strong><?php _e('Changes Saved.', 'tabs' ); ?></strong></p></div>
                    <?php
                }
            }
            ?>
            <div class="settings-tabs-loading" style="">Loading...</div>
            <div class="settings-tabs vertical has-right-panel" style="display: none">
                <div class="settings-tabs-right-panel">
                    <?php
                    if(!empty($tabs_settings_tab))
                    foreach ($tabs_settings_tab as $tab) {
                        $id = $tab['id'];
                        $active = $tab['active'];
                        ?>
                        <div class="right-panel-content <?php if($active) echo 'active';?> right-panel-content-<?php echo esc_attr($id); ?>">
                            <?php
                            do_action('tabs_settings_tabs_right_panel_'.$id);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <ul class="tab-navs">
                    <?php
                    if(!empty($tabs_settings_tab))
                    foreach ($tabs_settings_tab as $tab){
                        $id = $tab['id'];
                        $title = $tab['title'];
                        $active = $tab['active'];
                        $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                        $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                        $is_pro = isset($tab['is_pro']) ? $tab['is_pro'] : false;
                        $pro_text = isset($tab['pro_text']) ? $tab['pro_text'] : '';
                        ?>
                        <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo esc_attr($data_visible); ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo esc_attr($id); ?>">
                            <?php echo $title; ?>
                            <?php
                            if($is_pro):
                                ?><span class="pro-feature"><?php echo $pro_text; ?></span> <?php
                            endif;
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                if(!empty($tabs_settings_tab))
                foreach ($tabs_settings_tab as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    ?>
                    <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo esc_attr($id); ?>">
                        <?php
                        do_action('tabs_settings_content_'.$id, $tab);
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="clear clearfix"></div>
                <p class="submit">
                    <?php wp_nonce_field( 'tabs_nonce' ); ?>
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','tabs' ); ?>" />
                </p>
            </div>
		</form>
</div>