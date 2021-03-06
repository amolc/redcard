<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */

add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes()
{
	if ( !class_exists( 'cmb_Meta_Box' ) )
	{
		require_once( 'custom-metaboxes/init.php' );
	}
}

require_once locate_template('/inc/theme_option.php');            // Theme Options
require_once locate_template('/inc/social_option.php');            // Social Theme Options
require_once locate_template('/inc/radio_artciles.php');


require_once locate_template('/inc/radio_shows.php');            // Utility functions
require_once locate_template('/inc/tvvideo_shows.php');
require_once locate_template('/inc/other-sports.php');
require_once locate_template('/inc/featured.php');
//require_once locate_template('/inc/tv-show-list.php');
require_once locate_template('/inc/radio-shows-articles.php');


if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );


	register_sidebar( array(
		'name'          => __( 'Header Social', 'twentyfourteen' ),
		'id'            => 'header-social',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Search on Menu', 'twentyfourteen' ),
		'id'            => 'search-menu',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2nd Left Column', 'twentyfourteen' ),
		'id'            => 'footer-left-2',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'twentyfourteen' ),
		'id'            => 'footer-right',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Image above Container', 'twentyfourteen' ),
		'id'            => 'container-image',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Post Sponser', 'twentyfourteen' ),
		'id'            => 'postsponser',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Radio Banner', 'twentyfourteen' ),
		'id'            => 'radiobanner',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'TV Banner', 'twentyfourteen' ),
		'id'            => 'tvbanner',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Radio Shows Banner', 'twentyfourteen' ),
		'id'            => 'radioshowsbanner',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'TV Shows Banner', 'twentyfourteen' ),
		'id'            => 'tvshowsbanner',
		'description'   => __( '' ),
		'before_widget' => '<div class="ad_1">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => __( 'Popular posts for TV', 'twentyfourteen' ),
		'id'            => 'po-po-tv',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Popular posts for Radio', 'twentyfourteen' ),
		'id'            => 'po-po-radio',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Advertisement on Radio Single Page', 'twentyfourteen' ),
		'id'            => 'ads-radio',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Popular posts for Other Sports', 'twentyfourteen' ),
		'id'            => 'po-po-other-sports',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Suzuki Sidebar', 'twentyfourteen' ),
		'id'            => 'suzuki-sidebar',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Suzuki Sidebar Fixture', 'twentyfourteen' ),
		'id'            => 'suzuki-sidebar-fixture',
		'description'   => __( '' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
		) );


}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}
function pr($array,$isDie = 0)
{
 echo "<pre>";
 print_r($array);
 echo "</pre>";

 if($isDie > 0 )
 { die(); }
}
/* */
add_theme_support( 'post-thumbnails' );
/**/
if ( function_exists( 'add_theme_support' ) ) {
 add_theme_support('post-thumbnails');
 set_post_thumbnail_size( 160, 100 );
 }
if ( function_exists( 'add_image_size' ) ) {
 add_image_size( 'featImg', 350, 200, true );
 add_image_size( 'realImg', 200, 120, true );

 }
 if ( function_exists('register_sidebar') )
{    register_sidebar(); }

/*** Football Starts ***/
add_action( 'init', 'football_init' );
/* Register a football post type. */
function football_init() {
	$labels = array(
		'name'               => _x( 'Football', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Football', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Football', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Football', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'football', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Football Article', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Football Article', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Football Articles', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Football', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Football:', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'footballs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type( 'footballs', $args );
}


add_action( 'init', 'register_taxonomy_footballtags' );
function register_taxonomy_footballtags() {
$labels = array(
		'name'                       => _x( 'Football Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'Football Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Football Tags' ),
		'popular_items'              => __( 'Popular Football Tags' ),
		'all_items'                  => __( 'All Football Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Football Tag' ),
		'update_item'                => __( 'Update Football Tag' ),
		'add_new_item'               => __( 'Add New Football Tag' ),
		'new_item_name'              => __( 'New Football Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Football Tags with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Football Tags' ),
		'choose_from_most_used'      => __( 'Choose from the most used Football Tags' ),
		'not_found'                  => __( 'No Football Tags found.' ),
		'menu_name'                  => __( 'Football Tags' ),
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
	);
register_taxonomy( 'footballtags', 'footballs', $args );
}


add_action( 'init', 'register_taxonomy_footballregions' );
function register_taxonomy_footballregions() {
    $labels = array(
        'name' => _x( 'Regions', 'footballregions' ),
        'singular_name' => _x( 'Regions', 'footballregions' ),
        'search_items' => _x( 'Search Regions', 'footballregions' ),
        'popular_items' => _x( 'Popular Regions', 'footballregions' ),
        'all_items' => _x( 'All Regions', 'footballregions' ),
        'parent_item' => _x( 'Parent Region', 'footballregions' ),
        'parent_item_colon' => _x( 'Parent Region:', 'footballregions' ),
        'edit_item' => _x( 'Edit Region', 'footballregions' ),
        'update_item' => _x( 'Update Region', 'footballregions' ),
        'add_new_item' => _x( 'Add New Region', 'footballregions' ),
        'new_item_name' => _x( 'New Region', 'footballregions' ),
        'separate_items_with_commas' => _x( 'Separate Region with commas', 'footballregions' ),
        'add_or_remove_items' => _x( 'Add or remove Region', 'footballregions' ),
        'choose_from_most_used' => _x( 'Choose from the most used Region', 'footballregions' ),
        'menu_name' => _x( 'Regions', 'footballregions' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
   register_taxonomy( 'footballregions', array('footballs'), $args );
}



add_action( 'init', 'register_taxonomy_footballexclusive' );
function register_taxonomy_footballexclusive() {
    $labels = array(
        'name' => _x( 'Exclusive', 'footballexclusive' ),
        'singular_name' => _x( 'Exclusive', 'footballexclusive' ),
        'search_items' => _x( 'Search Exclusive', 'footballexclusive' ),
        'popular_items' => _x( 'Popular Exclusive', 'footballexclusive' ),
        'all_items' => _x( 'All Exclusive', 'footballexclusive' ),
        'parent_item' => _x( 'Parent Exclusive', 'footballexclusive' ),
        'parent_item_colon' => _x( 'Parent Exclusive:', 'footballexclusive' ),
        'edit_item' => _x( 'Edit Exclusive', 'footballexclusive' ),
        'update_item' => _x( 'Update Exclusive', 'footballexclusive' ),
        'add_new_item' => _x( 'Add New Exclusive', 'footballexclusive' ),
        'new_item_name' => _x( 'New Exclusive', 'footballexclusive' ),
        'separate_items_with_commas' => _x( 'Separate Exclusive with commas', 'footballexclusive' ),
        'add_or_remove_items' => _x( 'Add or remove Exclusive', 'footballexclusive' ),
        'choose_from_most_used' => _x( 'Choose from the most used Exclusive', 'footballexclusive' ),
        'menu_name' => _x( 'Exclusive', 'footballexclusive' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
   register_taxonomy( 'footballexclusive', array('footballs'), $args );
}

add_action( 'init', 'register_taxonomy_footballopinion' );
function register_taxonomy_footballopinion() {
    $labels = array(
        'name' => _x( 'Opinion', 'footballopinion' ),
        'singular_name' => _x( 'Opinion', 'footballopinion' ),
        'search_items' => _x( 'Search Opinion', 'footballopinion' ),
        'popular_items' => _x( 'Popular Opinion', 'footballopinion' ),
        'all_items' => _x( 'All Opinion', 'footballopinion' ),
        'parent_item' => _x( 'Parent Opinion', 'footballopinion' ),
        'parent_item_colon' => _x( 'Parent Opinion:', 'footballopinion' ),
        'edit_item' => _x( 'Edit Opinion', 'footballopinion' ),
        'update_item' => _x( 'Update Opinion', 'footballopinion' ),
        'add_new_item' => _x( 'Add New Opinion', 'footballopinion' ),
        'new_item_name' => _x( 'New Opinion', 'footballopinion' ),
        'separate_items_with_commas' => _x( 'Separate Opinion with commas', 'footballopinion' ),
        'add_or_remove_items' => _x( 'Add or remove Opinion', 'footballopinion' ),
        'choose_from_most_used' => _x( 'Choose from the most used Opinion', 'footballopinion' ),
        'menu_name' => _x( 'Opinion', 'footballopinion' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
   register_taxonomy( 'footballopinion', array('footballs'), $args );
}

add_action( 'init', 'register_taxonomy_football_intheweek' );
function register_taxonomy_football_intheweek() {
    $labels = array(
        'name' => _x( 'In The Week', 'footballintheweek' ),
        'singular_name' => _x( 'In The Week', 'footballintheweek' ),
        'search_items' => _x( 'Search In The Week', 'footballintheweek' ),
        'popular_items' => _x( 'Popular In The Week', 'footballintheweek' ),
        'all_items' => _x( 'All In The Week', 'footballintheweek' ),
        'parent_item' => _x( 'Parent In The Week', 'footballintheweek' ),
        'parent_item_colon' => _x( 'Parent In The Week:', 'footballintheweek' ),
        'edit_item' => _x( 'Edit In The Week', 'footballintheweek' ),
        'update_item' => _x( 'Update In The Week', 'footballintheweek' ),
        'add_new_item' => _x( 'Add New In The Week', 'footballintheweek' ),
        'new_item_name' => _x( 'New In The Week', 'footballintheweek' ),
        'separate_items_with_commas' => _x( 'Separate In The Week with commas', 'footballintheweek' ),
        'add_or_remove_items' => _x( 'Add or remove In The Week', 'footballintheweek' ),
        'choose_from_most_used' => _x( 'Choose from the most used In The Week', 'footballintheweek' ),
        'menu_name' => _x( 'In The Week', 'footballintheweek' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
   register_taxonomy( 'footballintheweek', array('footballs'), $args );
}

/*** all Football Ends ***/

/*** TV Starts ***/
add_action( 'init', 'tvideo_init' );
/* Register a football post type. */
function tvideo_init() {
	$labels = array(
		'name'               => _x( 'TV Videos', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'TV Video', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'TV Videos', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'TV Video', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'tvideo', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Tv Video ', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Tv Video ', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Tv Video ', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Tv Videos', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Tv Videos:', 'your-plugin-textdomain' ),
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
		'rewrite'            => array( 'slug' => 'tvideo' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor', 'thumbnail' )
	);

	register_post_type( 'tvideo', $args );
}
add_action( 'init', 'register_taxonomy_tvcategory' );

function register_taxonomy_tvcategory() {
    $labels = array(
        'name' => _x( 'Category', 'tvcategory' ),
        'singular_name' => _x( 'Category', 'tvcategory' ),
        'search_items' => _x( 'Search Category', 'tvcategory' ),
        'popular_items' => _x( 'Popular Category', 'tvcategory' ),
        'all_items' => _x( 'All Category', 'tvcategory' ),
        'parent_item' => _x( 'Parent Category', 'tvcategory' ),
        'parent_item_colon' => _x( 'Parent Category:', 'tvcategory' ),
        'edit_item' => _x( 'Edit Category', 'tvcategory' ),
        'update_item' => _x( 'Update Category', 'tvcategory' ),
        'add_new_item' => _x( 'Add New Category', 'tvcategory' ),
        'new_item_name' => _x( 'New Category', 'tvcategory' ),
        'separate_items_with_commas' => _x( 'Separate Category with commas', 'tvcategory' ),
        'add_or_remove_items' => _x( 'Add or remove Category', 'tvcategory' ),
        'choose_from_most_used' => _x( 'Choose from the most used Category', 'tvcategory' ),
        'menu_name' => _x( 'Category', 'tvcategory' ),
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


   register_taxonomy( 'tvcategory', array('tvideo'), $args );
}

$labels = array(
		'name'                       => _x( 'TV Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'TV Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search TV Tags' ),
		'popular_items'              => __( 'Popular TV Tags' ),
		'all_items'                  => __( 'All TV Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit TV Tag' ),
		'update_item'                => __( 'Update TV Tag' ),
		'add_new_item'               => __( 'Add New TV Tag' ),
		'new_item_name'              => __( 'New TV Tag Name' ),
		'separate_items_with_commas' => __( 'Separate TV Tags with commas' ),
		'add_or_remove_items'        => __( 'Add or remove TV Tags' ),
		'choose_from_most_used'      => __( 'Choose from the most used TV Tags' ),
		'not_found'                  => __( 'No TV Tags found.' ),
		'menu_name'                  => __( 'TV Tags' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,

	);

	register_taxonomy( 'tvTags', 'tvideo', $args );

/**/
function be_tvideo_metaboxes_strength( $meta_boxes ) {
	$prefix = '_cmb_tvideo_'; // Prefix for all fields
	$posttype = 'tvideo';
	$meta_boxes[] = array(
		'id' => 'tvideo_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('tvideo'), // post type
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


		),
	);


	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_tvideo_metaboxes_strength' );

/**/
function be_footballs_metaboxes_strength( $meta_boxes ) {
	$prefix = '_cmb_footballs_'; // Prefix for all fields
	$posttype = 'footballs';
	$meta_boxes[] = array(
		'id' => 'footballs_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('footballs'), // post type
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
add_filter( 'cmb_meta_boxes', 'be_footballs_metaboxes_strength' );

/**/
function be_radioarticles_metaboxes_strength( $meta_boxes ) {
	$prefix = '_cmb_radio-articles_'; // Prefix for all fields
	$posttype = 'radio-articles';
	$meta_boxes[] = array(
		'id' => 'radio-articles_metabox',
		'title' => __( 'Additional Detail', 'cmb' ),
		'pages' => array('radio-articles'), // post type
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
add_filter( 'cmb_meta_boxes', 'be_radioarticles_metaboxes_strength' );

/*you tube video image and all*/
function GetVideoIdFromUrl($url) {
 $parts = explode('?v=',$url);
 if (count($parts) == 2) {
  $tmp = explode('&',$parts[1]);
  if (count($tmp)>1) {
   return $tmp[0];
  } else {
   return $parts[1];
  }
 } else {
  return $url;
 }
}

function getVideoID($url)
{
    $videoid = GetVideoIdFromUrl($url);

 if($videoid=="")
 {
 preg_match('/youtube\.com\/v\/([\w\-]+)/', $url, $match);
 $videoid = $match[1];
 }

 return $videoid;

}

function EmbedVideo($videoid,$width = 425,$height = 350) {
 $videoid = getVideoID($videoid);
 return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$videoid.'&autoplay=1"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$videoid.'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
}
function GetImg($videoid,$imgid = 1) {
 $videoid = getVideoID($videoid);
 return "http://img.youtube.com/vi/$videoid/$imgid.jpg";
}

function ShowImg($videoid,$imgid = 1,$alt = 'Video screenshot', $width='120', $height='90') {
 return "<img src='".GetImg($videoid,$imgid)."' width='".$width."' height='".$height."' border='0' alt='".$alt."' title='".$alt."' />";
}
function ShowTvVideoImg($videoid,$alt = 'Video screenshot', $width='120', $height='90') {
 return "<img src='".GetTvVideoImage($videoid)."' width='".$width."' height='".$height."' border='0' alt='".$alt."' title='".$alt."' />";
}

function GetTvVideoImage($videoid) {
 $videoid = getVideoID($videoid);
 return "http://img.youtube.com/vi/$videoid/mqdefault.jpg";
}

/* custom pafination */

function custom_pagination($numpages = '', $pagerange = '', $paged='') {
   if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );
  $paginate_links = paginate_links($pagination_args);
  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }
}


/* for Post Views*/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/* For Twitter */
function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);


/****/
function view_modify_post_table( $column ) {
    $column['views'] = 'Views';
    return $column;
}
add_filter( 'manage_posts_columns', 'view_modify_post_table' );


function views_modify_user_table_row($column_name, $post_id  ) {

//	echo $post_id ;

	echo getPostViews($post_id);
}
add_action('manage_posts_custom_column', 'views_modify_user_table_row',10,2);



/* facebook share count */
function bfan() {
global $post;
$pageID = get_permalink($post->ID);
$info = json_decode(file_get_contents('http://graph.facebook.com/' . $pageID));
update_post_meta($post->ID, 'facebook_scripter_share_count',$info->shares);
echo $info->shares;
}

function count_tweet()
{
global $post;
$pageID = get_permalink($post->ID);
$info = json_decode(file_get_contents('http://cdn.api.twitter.com/1/urls/count.json?url=' . $pageID));

update_post_meta($post->ID, 'tweet_scripter_share_count',$info->count);
echo $info->count;
}

?>