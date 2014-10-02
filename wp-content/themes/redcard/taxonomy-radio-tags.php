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

<?php dynamic_sidebar( 'radiobanner' ); ?>

			<?php if ( have_posts() ) : ?>

			<?php	$term_list_reg = wp_get_post_terms($post->ID, "radio-tags");
					//pr($term_list_reg,1);
					
					echo '<div class="box">';
					echo '<h1>'.$wp_query->queried_object->name.'</h1>';
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
						  // $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $post->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $post->ID).'" class="r-child-h3-a">'.$radtitle.'</a></h3>';
								
	   							 $term_list_reg = wp_get_post_terms($post->ID, "radio-shows");
								//pr($term_list_reg);
								 $mlink=(get_term_link( $term_list_reg[0] ));
								echo "<a href='".$mlink."'>".$term_list_reg[0]->name."</a>";
	   							echo '<a href="'.get_permalink( $post->ID).'" class="llink">Listen</a>
	   							<div id="social_2">';
								$mtitle=str_replace("?","",$radtitlefinal);
								?>
      <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo $mtitle;?> <?php echo get_permalink( $post->ID);?> via @RedCardConnect"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo $mtitle;?> <?php echo get_permalink( $post->ID);?> via @RedCardConnect&url="  >
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink(  $post->ID);?>#dis_comment">
      <div class="message"></div>
      </a>
      <?php
                                echo '</div>
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
