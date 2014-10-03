<?php
/*
Template Name: Radio Articles by Category
The template for displaying Archive pages
*/
get_header(); 

?>
<?php dynamic_sidebar( 'radiobanner' ); ?>
<div class="box">
	<h1>Radio Segments</h1>
		<?php
		echo '<div class="box">';
		echo '<h4>' . $term->name. '</h4>';
		$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
                        'paged' 			=>  $current_page,
					);
                                        
        $i = 1;
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$postID = get_the_ID(); 
		   	echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $postID ).'
			<h3><a href="'.get_permalink( $postID).'" class="r-child-h3-a child-a-left">'.get_the_title().'</a></h3>';
			$term_list_reg = wp_get_post_terms($postID, 'radio-shows');
		    $mlink=(get_term_link( $term_list_reg[0] ));
			echo "<a href='".$mlink."'>".$term_list_reg[0]->name."</a>";
	   		echo '<a href="'.get_permalink( $postID).'" class="llink">Listen</a><div id="social_2">';
	?>		
			<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($postID);?>&description=<?php echo get_the_title();?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title();?> <?php echo get_permalink($postID);?> via @RedCardConnect&url="  >
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink($postID);?>#dis_comment">
      <div class="message"></div>
      </a>
	<?php		
			echo '</div><span>1,290 views<span></span></span></div>';
   			$i++;
			endwhile;
			echo '</div>';
?>
<?php
      if (function_exists(custom_pagination)) {
        custom_pagination($loop->max_num_pages,"",$current_page);
      }
?>
</div>
<?php get_footer();?>