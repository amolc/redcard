<?php
/*
	Template Name: Radio Articles by Category
*/
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>

				<?php dynamic_sidebar( 'radiobanner' ); ?>


			<div class="box">
				<h1>Radio Segments</h1>
				<?php


				    	echo '<div class="box">';
				    	echo '<h4>' . $term->name. '</h4>';
				    	$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
						);
				    	$allarts = get_posts( $args );
						//pr($allarts,1);
					

                         
						  
				    	$i = 1;
				    	foreach ( $allarts as $article ) {
						   $radtitle = $article->post_title;
						  // $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $article->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $article->ID).'" class="r-child-h3-a child-a-left">'.$radtitle.'</a></h3>';
								
								 $term_list_reg = wp_get_post_terms($article->ID, 'radio-shows');
								//pr($term_list_reg);
								 $mlink=(get_term_link( $term_list_reg[0] ));
								echo "<a href='".$mlink."'>".$term_list_reg[0]->name."</a>";
	   							echo '<a href="'.get_permalink( $article->ID).'" class="llink">Listen</a>
	   							<div id="social_2">';
								?>
								  <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=
								  <?php echo $radtitle." ".get_permalink( $article->ID);?> via @RedCardConnect"  title="Share on Facebook" ><div class="facebook" ></div></a>
       <a href="http://twitter.com/intent/tweet?text=<?php echo $radtitle. get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a href="<?php echo get_permalink( $article->ID);?>#dis_comment"><div class="message"></div></a>
        
								<?php
	   								
	   							echo '</div>
	   							<span>1,290 views<span>
	   						</span></span></div>';
	   						$i++;
						}

				        echo '</div>';

				  

				?>
			</div>
			


<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();
