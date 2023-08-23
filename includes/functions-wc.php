<?php
if ( ! defined('ABSPATH')) exit;  // if direct access




add_filter( 'woocommerce_product_tabs', 'tabs_product_tab' );
function tabs_product_tab( $tabs ) {

	$prouct_id = get_the_id();
	$tabs_id = get_post_meta( $prouct_id, 'tabs_id', true );
	$tabs_tab_title = get_post_meta( $prouct_id, 'tabs_tab_title', true );

    $tabs_tab_title = !empty($tabs_tab_title) ? $tabs_tab_title : __( 'FAQ', 'tabs' );

	if(!empty($tabs_id)):
		$tabs['tabs_faq'] = array(
			'title' 	=> esc_html($tabs_tab_title),
			'priority' 	=> 50,
			'callback' 	=> 'woo_product_tab_tabs_content'
		);
    endif;


	return $tabs;

}
function woo_product_tab_tabs_content() {

    $prouct_id = get_the_id();
	// The new tab content
	$tabs_id = get_post_meta( $prouct_id, 'tabs_id', true );


	if(!empty($tabs_id)):
		echo do_shortcode('[tabs id="'.$tabs_id.'"]');
    endif;


}

function tabs_ajax_wc_get_tabs(){

	$return = array();

    $nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : '';

    //error_log($nonce);

   if(wp_verify_nonce( $nonce, 'tabs_nonce' )) {

        if(current_user_can( 'manage_options' )) {
            // you can use WP_Query, query_posts() or get_posts() here - it doesn't matter
            $search_results = new WP_Query(array(
                's' => sanitize_text_field($_GET['q']), // the search query
                'post_type' => 'tabs',
                'post_status' => 'publish', // if you don't want drafts to be returned
                'ignore_sticky_posts' => 1,
                'posts_per_page' => -1 // how much to show at once
            ));
            if ($search_results->have_posts()) :
                while ($search_results->have_posts()) : $search_results->the_post();
                    // shorten the title a little
                    $title = (mb_strlen($search_results->post->post_title) > 50) ? mb_substr($search_results->post->post_title, 0, 49) . '...' : $search_results->post->post_title;
                    $return[] = array($search_results->post->ID, $title); // array( Post ID, Post Title )
                endwhile;
            endif;
        }
    }
	echo json_encode( $return );
	die;

}


add_action('wp_ajax_tabs_ajax_wc_get_tabs', 'tabs_ajax_wc_get_tabs');
add_action('wp_ajax_nopriv_tabs_ajax_wc_get_tabs', 'tabs_ajax_wc_get_tabs');