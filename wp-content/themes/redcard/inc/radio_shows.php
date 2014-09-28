<?php
add_action( 'init', 'radio_shows_init' );
/* Register a football post type. */
function radio_shows_init() {
	$labels = array(
		'name'               => _x( 'Radio Shows ', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Radio Shows ', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Radio Shows ', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Radio Shows ', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'radioshows', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Radio Shows  ', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Radio Shows ', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Radio Shows ', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Radio Shows ', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Radio Shows ', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Radio Shows ', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Radio Shows :', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Post found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Posts found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'radioshows' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor','thumbnail')
	);

	register_post_type( 'radioshows', $args );
}

add_action( 'init', 'register_taxonomy_radioshowscategory' );

function register_taxonomy_radioshowscategory() {
    $labels = array( 
        'name' => _x( 'Category', 'radioshowcategory' ),
        'singular_name' => _x( 'Category', 'radioshowcategory' ),
        'search_items' => _x( 'Search Category', 'radioshowcategory' ),
        'popular_items' => _x( 'Popular Category', 'radioshowcategory' ),
        'all_items' => _x( 'All Category', 'radioshowcategory' ),
        'parent_item' => _x( 'Parent Category', 'radioshowcategory' ),
        'parent_item_colon' => _x( 'Parent Category:', 'radioshowcategory' ),
        'edit_item' => _x( 'Edit Category', 'radioshowcategory' ),
        'update_item' => _x( 'Update Category', 'radioshowcategory' ),
        'add_new_item' => _x( 'Add New Category', 'radioshowcategory' ),
        'new_item_name' => _x( 'New Category', 'radioshowcategory' ),
        'separate_items_with_commas' => _x( 'Separate Category with commas', 'radioshowcategory' ),
        'add_or_remove_items' => _x( 'Add or remove Category', 'radioshowcategory' ),
        'choose_from_most_used' => _x( 'Choose from the most used Category', 'radioshowcategory' ),
        'menu_name' => _x( 'Category', 'radioshowcategory' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => radio,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    

   register_taxonomy( 'radioshowcategory', array('radioshows'), $args );
}


function be_radioshows_metaboxes_strength( $meta_boxes ) {
	$prefix = '_cmb_radioshows_'; // Prefix for all fields	
	$meta_boxes[] = array(
		'id' => 'radioshows_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('radioshows'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			
			  array(
				'name' => 'Tag Line',
				'id'   => $prefix . 'tagline_text',
				'type' => 'text',
			),
                   
			array(
				'name' => __( 'Featured', 'cmb' ),
				'desc' => __( 'Check it if you want this post featured (optional)', 'cmb' ),
				'id'   => $prefix . 'featured_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Date Picker', 'cmb' ),
				'desc' => __( 'Select a date (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
               
                    
		),
	);
	
	
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_radioshows_metaboxes_strength' );