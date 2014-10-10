<?php
/**
 * The template for displaying Archive pages
 */
get_header(); ?>
<?php

$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			if($adsql->adimage1){
		?>

<div class="ad_1" align="center"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
  <label style="font-size:9px;">ADVERTISEMENT</label>
</div>
<?php
			}
		}
	}
	
	 dynamic_sidebar( 'radioshowsbanner' ); 
 if ( have_posts() ) : ?>
<?php
					 $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				    	$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
                                                'paged' =>  $current_page,
						);
					echo '<div class="box">';
					echo '<h1>'.$wp_query->queried_object->name.'</h1>';
					while ( have_posts() ) : the_post();
						global $post;
						   $radtitle = $post->post_title;
						  // $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						 $wp_query->queried_object->name;
						$term_list_reg = wp_get_post_terms($post->ID, 'radio-shows');
      					   $mlink=(get_term_link( $term_list_reg[0] ));
						   $term_list_reg1 = wp_get_post_terms($post->ID, 'radio-categories');
      					   $mlink1=(get_term_link( $term_list_reg1[0] ));
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $post->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $post->ID).'" class="r-child-h3-a">'.$radtitle.'</a></h3>
								
	   							<a href="'.$mlink.'" style="margin-bottom:0px !important;">'.$term_list_reg[0]->name.':</a>  
								<a href="'.$mlink1.'">'.$term_list_reg1[0]->name.'</a>
	   							<a href="'.get_permalink( $post->ID).'" class="llink">Listen</a>
	   							<div id="social_2">';
								$mtitle=str_replace("?","",$radtitle);
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
	   							<span>'.getPostViews($post->ID).'<span>
	   						</span></span></div>';
	   						$i++;
					endwhile;
					echo '</div>';

					//twentyfourteen_paging_nav();
      if (function_exists(custom_pagination)) {
        custom_pagination($post->max_num_pages,"",$current_page);
      }
else{}
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;
			?>
<?php
//get_sidebar();
get_footer();?>
