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

			<?php
					echo '<div class="box">';
					echo '<h1>RADIO SEGMENTS</h1>';
				    //echo '<h4>' . $term->name. '</h4>';
				
				    	// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						//get_template_part( 'content', get_post_format() );
						global $post;
						   $radtitle = $post->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						  $getCategory =  get_the_category( $post->ID);
						pr($getCategory,1);
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $post->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $post->ID).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
								
	   							<a href="#">In Added Time</a>
	   							<a href="'.get_permalink( $post->ID).'" class="llink">Listen</a>
	   							<div id="social_2">
	   								<a href="http://www.facebook.com/share.php?u='.get_permalink( $post->ID) .'" target="_blank" title="Share on Facebook" ><div class="facebook"></div></a>
	   								<a href="#"><div class="twitter"></div></a>
	   								<a href="#"><div class="message"></div></a>
	   							</div>
	   							<span>1,290 views<span>
	   						</span></span></div>';
	   						$i++;
						
				    	
				        


					endwhile;

					echo '</div>';
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
//get_sidebar();
get_footer();?>
