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
}

/*add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    echo $t;
    exit();
    return $t;
}*/
