<?php



if ( ! defined('ABSPATH')) exit;  // if direct access 	

class tabs_post_types{
	
	
	public function __construct(){
		add_action( 'init', array( $this, '_posttype_tabs' ), 0 );



    }
	
	
	public function _posttype_tabs(){
			
		if ( post_type_exists( "tabs" ) )
		return;
	 
		$singular  = __( 'Tabs', 'tabs' );
		$plural    = __( 'Tabs', 'tabs' );

        $tabs_settings = get_option('tabs_settings');
        $tabs_preview= isset($tabs_settings['tabs_preview']) ? $tabs_settings['tabs_preview'] : 'yes';


		register_post_type( "tabs",
			apply_filters( "tabs_posttype", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => $singular,
					'all_items'             => sprintf( __( 'All %s', 'tabs' ), $plural ),
					'add_new' 				=> __( 'Add New', 'tabs' ),
					'add_new_item' 			=> sprintf( __( 'Add %s', 'tabs' ), $singular ),
					'edit' 					=> __( 'Edit', 'tabs' ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'tabs' ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', 'tabs' ), $singular ),
					'view' 					=> sprintf( __( 'View %s', 'tabs' ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', 'tabs' ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', 'tabs' ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', 'tabs' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'tabs' ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', 'tabs' ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', 'tabs' ), $plural ),
				'public' 				=> false,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
                'publicly_queryable' 	=> ($tabs_preview =='yes') ?true : false,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array( 'title', 'custom-fields'  ),
				'show_in_nav_menus' 	=> true,
				//'show_in_menu' 	=> 'edit.php?post_type=team',	
				'menu_icon' => 'dashicons-table-row-after',

			) )
		); 

		

	}


}
	

new tabs_post_types();