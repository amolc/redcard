<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			

			<header class="page-header">
				<img src="<?php echo get_template_directory_uri(); ?>/images/radio_slide.jpg" class="tv_slide" />
			</header><!-- .page-header -->
			<div class="box">
				<?php dynamic_sidebar( 'radioarchive' ); ?>	
			</div>

			<div class="box">
				<h1>Radio Segments</h1>
				<?php
				$args = array( ' hide_empty = false ' );

				$terms = get_terms('radio-categories', $args);
			
				if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				    foreach ($terms as $term) {
				    	echo '<div class="box">';
				    	echo '<h4>' . $term->name. '</h4>';
				    	$args = array(
						'posts_per_page'   => 5,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
						'tax_query' => array(
								array(
									'taxonomy' => 'radio-categories',
									'field' => 'slug',
									'terms' => $term->slug
								)
							)
						);
				    	$allarts = get_posts();
				    	foreach ( $allarts as $article ) {	
						   echo '<div class="r-child">'. get_the_post_thumbnail( $article->ID ).'
	   							<h3>'.$article->post_title.'</h3>
	   							<a href="#">In Added Time</a>
	   							<button>Listen</button>
	   							<div id="social_2">
	   								<a href="#"><div class="facebook"></div></a>
	   								<a href="#"><div class="twitter"></div></a>
	   								<a href="#"><div class="message"></div></a>
	   							</div>
	   							<span>1,290 views<span>
	   						</span></span></div>';
						}
				    	echo '<div class="lastl"><a href="#">View all in'.$term->name.'</a></div>';
				        echo '</div>';
				    }
				  
				}
				?>
			</div>
			

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();
