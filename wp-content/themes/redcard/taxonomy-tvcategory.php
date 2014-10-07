<?php
/**
 * Taxonomy for Football Opinion page
 */
get_header(); 
?>
<?php 
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='tv-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		
<div class="ad_1" align="center"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
<label style="font-size:9px;">ADVERTISEMENT</label>
</div>

		<?php
		}
	}
 ?>

<?php dynamic_sidebar( 'tvbanner' ); ?>

<div class="box">
					<h1><?php echo $wp_query->queried_object->name; ?></h1>
                  <?php $as =1;
	global $wp_query;
		
			   			echo '<div class="box">';
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array('post_status'=>'publish','paged'=> $current_page,'posts_per_page'=>10,'tax_query' => array('taxonomy' =>'tvcategory'),);
                                $i = 1;
								$loop = new WP_Query( $args );
					 	while (have_posts() ) : the_post();
							 $postID = get_the_ID();
							 $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); ?>
					<div class="r-child list<?php '.$as.' ?>" style="background-color:#00a69c;">
						<?php $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='150', $height='150');?>
                        <a href="<?php the_permalink() ?>"><?php echo $videoID; ?></a>
						<h3><a style="text-decoration: none;" class="r-child-h3-a" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                       <?php /*?> <?php $youtubetagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true ); ?>
                        <p class="tvpexcerpt"><?php echo $youtubetagline_value; ?></p>
						<span></span><?php */?>
                        <a href="<?php echo get_permalink( $postID);?>" class="llink">Watch</a>
                        <div id="social_5">
                        	<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($postID);?>&description=<?php echo get_the_title();?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
      						<a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title();?> <?php echo get_permalink($postID);?> via @RedCardConnect&url="  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
      						<a href="<?php echo get_permalink($postID);?>#dis_comment"><div class="message"></div></a>
                        </div>
                        <span><?php echo getPostViews($postID); ?><span></span></span>
					</div>
					<?php endwhile;
					echo '</div>';
					?>
                    
                    <?php
						  if (function_exists(custom_pagination)) {
							custom_pagination($wp_query->max_num_pages,"",$current_page);
						  }
					?>
				</div> 
<?php get_footer();?>