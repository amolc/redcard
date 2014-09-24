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

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<img src="<?php echo get_template_directory_uri(); ?>/images/radio_slide.jpg" class="tv_slide" />
			</header><!-- .page-header -->
			<div class="box">
				<?php dynamic_sidebar( 'radioarchive' ); ?>	
			</div>

			<div class="box">
				<h1>Radio Segments</h1>
				<?php
				$args = array( 'hide_empty=false' );

				$terms = get_terms('radio-categories', $args);
				print_r( $terms );
				if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				    $count = count($terms);
				    $i=0;
				    echo '<p class="my_term-archive">';
				    foreach ($terms as $term) {
				        $i++;
				    	echo '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
				    	if ($count != $i) {
				            echo ' &middot; ';
				        }
				        else {
				            echo '</p>';
				        }
				    }
				  
				}
				?>
			</div>
			

			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
