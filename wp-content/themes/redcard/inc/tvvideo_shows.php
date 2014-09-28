<?php


add_action( 'init', 'tv_shows_init' );
/* Register a football post type. */
function tv_shows_init() {
	$labels = array(
		'name'               => _x( 'TV Shows ', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'TV Shows ', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'TV Shows ', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'TV Shows ', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'tv_shows', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New TV Shows  ', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New TV Shows  ', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All TV Shows  ', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search TV Shows ', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent TV Shows :', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'tv-show' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor','thumbnail')
	);

	register_post_type( 'tvideoshow', $args );
}
add_action( 'init', 'register_taxonomy_tvshowcategory' );

function register_taxonomy_tvshowcategory() {
    $labels = array( 
        'name' => _x( 'Category', 'tvshowcategory' ),
        'singular_name' => _x( 'Category', 'tvshowcategory' ),
        'search_items' => _x( 'Search Category', 'tvshowcategory' ),
        'popular_items' => _x( 'Popular Category', 'tvshowcategory' ),
        'all_items' => _x( 'All Category', 'tvshowcategory' ),
        'parent_item' => _x( 'Parent Category', 'tvshowcategory' ),
        'parent_item_colon' => _x( 'Parent Category:', 'tvshowcategory' ),
        'edit_item' => _x( 'Edit Category', 'tvshowcategory' ),
        'update_item' => _x( 'Update Category', 'tvshowcategory' ),
        'add_new_item' => _x( 'Add New Category', 'tvshowcategory' ),
        'new_item_name' => _x( 'New Category', 'tvshowcategory' ),
        'separate_items_with_commas' => _x( 'Separate Category with commas', 'tvshowcategory' ),
        'add_or_remove_items' => _x( 'Add or remove Category', 'tvshowcategory' ),
        'choose_from_most_used' => _x( 'Choose from the most used Category', 'tvshowcategory' ),
        'menu_name' => _x( 'Category', 'tvshowcategory' ),
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
    

   register_taxonomy( 'tvshowcategory', array('tvideoshow'), $args );
}


function be_tvideo_show_metaboxes_strength( $meta_boxes ) {
	$prefix = '_cmb_tvideo_show_'; // Prefix for all fields	
	$meta_boxes[] = array(
		'id' => 'tvideo_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('tvideoshow'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			
			  array(
				'name' => 'Tag Line',
				//'desc' => 'field description (optional)',
				'id'   => $prefix . 'tagline_text',
				'type' => 'text',
			),
                    array(
				'name' => __( 'Youtub URL', 'cmb' ),
				'desc' => __( 'Youtub video Url ', 'cmb' ),
				'id'   => $prefix . 'youtub_url',
				'type' => 'text_url',
				 'protocols' => array('http', 'https'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Featured', 'cmb' ),
				'desc' => __( 'Check it if you want this post featured (optional)', 'cmb' ),
				'id'   => $prefix . 'featured_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Date', 'cmb' ),
				'desc' => __( 'Select a date', 'cmb' ),
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'From Time', 'cmb' ),
				'id'   => $prefix . 'from_time',
				'type' => 'text_time',
			),
			array(
				'name' => __( 'To', 'cmb' ),
				'id'   => $prefix . 'to_time',
				'type' => 'text_time',
			),
               
                    
		),
	);
	
	
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_tvideo_show_metaboxes_strength' );

