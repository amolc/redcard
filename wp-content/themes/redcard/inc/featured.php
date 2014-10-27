<?php

add_action( 'init', 'featured_init' );
/* Register a Featured post type. */
function featured_init() {
	$labels = array(
		'name'               => _x( 'Featured', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Featured', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Featured', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Featured', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'featured', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Featured', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Featured', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Featured', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Featured', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Featured', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Featured', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Featured:', 'your-plugin-textdomain' ),
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
		//'rewrite'            => array( 'slug' => 'othersports' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title',  'thumbnail', )
	);
	register_post_type( 'featured', $args );
}

/****/

function be_featured_metaboxes( $meta_boxes ) {
	$prefix = '_cmb_featured_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'featured_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('featured'), // post type
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
								'name' => __( 'URL', 'cmb' ),
								'desc' => __( 'field description (optional)', 'cmb' ),
								'id'   => $prefix . 'url',
								'type' => 'text_url',
							),
						),
		);
return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_featured_metaboxes' );

?>