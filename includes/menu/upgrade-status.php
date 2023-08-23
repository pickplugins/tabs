<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

$tabs_plugin_info = get_option('tabs_plugin_info');
$tabs_settings_upgrade = isset($tabs_plugin_info['settings_upgrade']) ? $tabs_plugin_info['settings_upgrade'] : '';
$tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';

//echo '<pre>'.var_export($tabs_upgrade, true).'</pre>';
wp_enqueue_style('font-awesome-5');

$url = admin_url().'edit.php?post_type=tabs&page=upgrade_status';

?>
<?php

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><h2><?php echo sprintf(__('%s Settings - Update', 'tabs'), tabs_plugin_name)?></h2>
    <p>tabs settings and tabs options data should automatic upgrade. please wait until all update completed. each loop will take 1 minute to completed, based on your tabs it will take take few minutes to completed.</p>
    <p>If you have any issue please <a href="https://www.pickplugins.com/forum/">create support ticket</a> on our forum</p>
    <p>Don't panic while updating, your old data still saved on database and you can downgrade plugin any time, please <a href="https://wordpress.org/plugins/woocommerce-products-slider/advanced/#plugin-download-history-stats">download from here</a> old version and reinstall.</p>


    <script>
        setTimeout(function(){
            window.location.href = '<?php echo esc_url_raw($url); ?>';
        }, 1000*50);

    </script>

    <h3>Tabs settings upgrade status</h3>

    <?php

    if(!empty($tabs_settings_upgrade)){
        ?>
        <p>Completed</p>
        <?php
    }else{
        ?>
        <p>Pending</p>
        <?php
    }

    ?>




    <h3>Tabs post data upgrade status</h3>
    <?php

    $meta_query = array();

    $meta_query[] = array(
        'key' => 'tabs_upgrade_status',
        'value' => 'done',
        'compare' => '='
    );

    $args = array(
        'post_type'=>'tabs',
        'post_status'=>'any',
        'posts_per_page'=> -1,
        'meta_query'=> $meta_query,

    );

    $wp_query = new WP_Query($args);

    if ( $wp_query->have_posts() ) :
        ?>
        <ul>
        <?php
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $tabs_id = get_the_id();
            $tabs_title = get_the_title();
            ?>
            <li><?php echo esc_html($tabs_title); ?> - Done</li>
            <?php

        endwhile;
        ?>
        </ul>
        <?php

    else:
        ?>
        <p>Pending</p>
        <?php
    endif;


    if($tabs_upgrade == 'done'){
        wp_safe_redirect(esc_url_raw(admin_url().'edit.php?post_type=tabs'));
    }


    ?>



    <p><a class="button" href="<?php echo esc_url_raw(admin_url().'edit.php?post_type=tabs&page=upgrade_status'); ?>">Refresh</a> to check Migration stats. <i class="fas fa-spin fa-spinner"></i></p>












</div>
