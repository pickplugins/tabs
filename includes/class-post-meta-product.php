<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_tabs_post_meta_product{
	
	public function __construct(){

		//meta box action for "tabs"
		add_action('add_meta_boxes', array($this, '_post_meta_product'));
		add_action('save_post', array($this, '_post_meta_product_save'));



		}


	public function _post_meta_product($post_type){

        add_meta_box('tabs_product_metabox',__( 'Product FAQ Tab', 'tabs' ),array($this, 'meta_box_tabs_data'), 'product', 'side', 'high');

		}






	public function meta_box_tabs_data($post) {


        global $post;
        wp_nonce_field( 'meta_boxes_tabs_wc_input', 'meta_boxes_tabs_wc_input_nonce' );


        $tabs_id = get_post_meta( $post->ID, 'tabs_id', true );
        $tabs_tab_title = get_post_meta( $post->ID, 'tabs_tab_title', true );

        //var_dump($tabs_id);
        ?>


        <select style="width: 100%;" id="tabs_id" name="tabs_id">
            <option>Select accordion</option>
            <?php if(!empty($tabs_id)): ?>
            <option value="<?php echo esc_attr($tabs_id); ?>" selected><?php echo esc_html(get_the_title($tabs_id)); ?></option>
            <?php endif; ?>
        </select>

        <span class="clear-faq-tab button">Clear</span>

        <p>
            <input style="width: 100%;" type="text" placeholder="Tab title" value="<?php echo esc_attr($tabs_tab_title); ?>" name="tabs_tab_title">
        </p>


        <script>
            jQuery(document).ready(function($) {
                $(document).on('click', ".clear-faq-tab", function() {
                    $('#tabs_id').select2('destroy').val('').select2();
                })

                console.log(tabs_ajax.nonce);

                $('#tabs_id').select2({
                    ajax: {
                        url: tabs_ajax.tabs_ajaxurl, // AJAX URL is predefined in WordPress admin
                        dataType: 'json',
                        delay: 250, // delay in ms while typing when to perform a AJAX search
                        data: function (params) {
                            return {
                                q: params.term, // search query
                                action: 'tabs_ajax_wc_get_tabs', // AJAX action for admin-ajax.php
                                "nonce" : tabs_ajax.nonce,
                            };
                        },
                        processResults: function( data ) {
                            var options = [];
                            if ( data ) {

                                // data is the array of arrays, and each of them contains ID and the Label of the option
                                $.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
                                    options.push( { id: text[0], text: text[1]  } );
                                });

                            }
                            return {
                                results: options
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 3, // the minimum of symbols to input before perform a search
                    allowClear: true,
                });
            })

        </script>

        <?php


    }



	public function _post_meta_product_save($post_id){

        global $post;


        $active_plugins = get_option('active_plugins');

        if( !empty($post) && $post->post_type=='product' && in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) ){



            /*
             * We need to verify this came from the our screen and with proper authorization,
             * because save_post can be triggered at other times.
             */

            // Check if our nonce is set.
            if ( ! isset( $_POST['meta_boxes_tabs_wc_input_nonce'] ) )
                return $post_id;

            $nonce = sanitize_text_field($_POST['meta_boxes_tabs_wc_input_nonce']);

            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $nonce, 'meta_boxes_tabs_wc_input' ) )
                return $post_id;

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return $post_id;



            /* OK, its safe for us to save the data now. */

            // Sanitize user input.
            $tabs_id = sanitize_text_field( $_POST['tabs_id'] );
            $tabs_tab_title = sanitize_text_field( $_POST['tabs_tab_title'] );

            update_post_meta( $post_id, 'tabs_id', $tabs_id );
            update_post_meta( $post_id, 'tabs_tab_title', $tabs_tab_title );

        }


    }
	}


new class_tabs_post_meta_product();