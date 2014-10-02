<?php
/**
 * The template for displaying Archive pages
 */
get_header(); ?>
<?php dynamic_sidebar( 'radioshowsbanner' ); ?>
			<?php if ( have_posts() ) : ?>
			<?php
					echo '<div class="box">';
					echo '<h1>'.$wp_query->queried_object->name.'</h1>';
					while ( have_posts() ) : the_post();
						global $post;
						   $radtitle = $post->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						 $wp_query->queried_object->name;
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $post->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $post->ID).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
								
	   							<a href="#">'.$wp_query->queried_object->name.'</a>
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
<?php
//get_sidebar();
get_footer();?>
