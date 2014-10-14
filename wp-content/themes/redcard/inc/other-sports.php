<?php

add_action( 'init', 'other_sports_init' );
/* Register a Other Sports post type. */
function other_sports_init() {
	$labels = array(
		'name'               => _x( 'Other Sports', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Other Sports', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Other Sports', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Other Sports', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'other_sports', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Other Sports', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Other Sports', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Other Sports', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Other Sports', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Other Sports:', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'othersports' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type( 'other_sports', $args );
}


add_action( 'init', 'register_taxonomy_othersports_tags' );
function register_taxonomy_othersports_tags() {
$labels = array(
		'name'                       => _x( 'Other Sports Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'Other Sports Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Other Sports Tags' ),
		'popular_items'              => __( 'Popular Other Sports Tags' ),
		'all_items'                  => __( 'All Other Sports Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Other Sport Tag' ),
		'update_item'                => __( 'Update Other Sport Tag' ),
		'add_new_item'               => __( 'Add New Other Sport Tag' ),
		'new_item_name'              => __( 'New Other Sport Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Other Sports Tags with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Other Sports Tags' ),
		'choose_from_most_used'      => __( 'Choose from the most used Other Sports Tags' ),
		'not_found'                  => __( 'No Other Sports Tags found.' ),
		'menu_name'                  => __( 'Other Sports Tags' ),
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
	);
register_taxonomy( 'other-sports-tags', 'other_sports', $args );
}

function be_othersports_metaboxes( $meta_boxes ) {
	$prefix = '_cmb_othersports_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'othersports_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('other_sports'), // post type
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
								'name' => __( 'Featured', 'cmb' ),
								'desc' => __( 'Check it if you want this post featured (optional)', 'cmb' ),
								'id'   => $prefix . 'featured_checkbox',
								'type' => 'checkbox',
								),
						),
		);
return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_othersports_metaboxes' );



?>