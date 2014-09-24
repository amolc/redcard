<?php
/* Radio CPT Registration */
add_action( 'init', 'codex_radioarticle_init' );
/**
 * Register a Radio Article post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_radioarticle_init() {
	$labels = array(
		'name'               => _x( 'Radio Articles', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Radio Article', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Radio Articles', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Radio Article', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Radio Article', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Radio Article', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Radio Article', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Radio Article', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Radio Article', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Radio Articles', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Radio Articles', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Radio Articles:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Radio Articles found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Radio Articles found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		//'rewrite'            => array( 'slug' => '' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'radio-articles', $args );

	$labels = array(
		'name'                       => _x( 'Radio Categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Radio Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Radio Categories' ),
		'popular_items'              => __( 'Popular Radio Categories' ),
		'all_items'                  => __( 'All Radio Categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Radio Category' ),
		'update_item'                => __( 'Update Radio Category' ),
		'add_new_item'               => __( 'Add New Radio Category' ),
		'new_item_name'              => __( 'New Radio Category Name' ),
		'separate_items_with_commas' => __( 'Separate Radio Categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Radio Categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used Radio Categories' ),
		'not_found'                  => __( 'No Radio Categories found.' ),
		'menu_name'                  => __( 'Radio Categories' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		//'rewrite'               => array( 'slug' => 'radio-categories' ),
	);

	register_taxonomy( 'radio-categories', 'radio-articles', $args );


	$labels = array(
		'name'               => _x( 'Show Articles', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Show Article', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Show Articles', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Show Article', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Show Article', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Show Article', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Show Article', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Show Article', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Show Article', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Show Articles', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Show Articles', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Show Articles:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Show Articles found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Show Articles found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		//'rewrite'            => array( 'slug' => '' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'show-articles', $args );

	$labels = array(
		'name'                       => _x( 'Show Categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Show Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Show Categories' ),
		'popular_items'              => __( 'Popular Show Categories' ),
		'all_items'                  => __( 'All Show Categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Show Category' ),
		'update_item'                => __( 'Update Show Category' ),
		'add_new_item'               => __( 'Add New Show Category' ),
		'new_item_name'              => __( 'New Show Category Name' ),
		'separate_items_with_commas' => __( 'Separate Show Categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Show Categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used Show Categories' ),
		'not_found'                  => __( 'No Show Categories found.' ),
		'menu_name'                  => __( 'Show Categories' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		//'rewrite'               => array( 'slug' => 'radio-categories' ),
	);

	register_taxonomy( 'show-categories', 'show-articles', $args );
}

