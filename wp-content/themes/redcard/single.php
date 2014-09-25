<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>
<?php
get_sidebar();
get_footer();?>
