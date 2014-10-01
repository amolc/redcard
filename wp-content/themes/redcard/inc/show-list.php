<?php

add_action( 'init', 'shows_list_init' );
/* Register a Shows List post type. */
function shows_list_init() {
	$labels = array(
		'name'               => _x( 'Shows List', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Shows List', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Shows List', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Shows List', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New Shows List', 'showslist', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Shows List', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Shows List', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Shows List', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Shows List', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Shows List', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Shows List', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Shows List:', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'all-shows-list' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type( 'showslist', $args );
}

?>