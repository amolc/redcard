<?php

add_action( 'init', 'radio_shows_articles_init' );
/* Register a Radio Shows Articles post type. */
function radio_shows_articles_init() {
	$labels = array(
		'name'               => _x( 'Radio Shows Articles', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Radio Shows Articles', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Radio Shows Articles', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Radio Shows Articles', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New Radio Shows Article', 'radioshowsartcles', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Radio Shows Article', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Radio Shows Article', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Radio Shows Article', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Radio Shows Articles', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Radio Shows Articles', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Radio Shows Articles', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Radio Shows Articles:', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'radioshowsartcles' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type( 'radioshowsartcles', $args );
}

?>