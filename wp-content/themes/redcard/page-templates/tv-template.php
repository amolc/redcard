<?php
/**
 * Template Name: TV template Page
 */
get_header(); 

?>
<?php dynamic_sidebar( 'tvbanner' );$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='tv' and isactive='1' order by adId DESC LIMIT 0,1";
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


<div class="box">
					<h1>Video Segments</h1>
               <?php  $args = array( 'post_type' => 'tvideo');
					  $loop = new WP_Query( $args ); $as =1;
					  while ( $loop->have_posts() ) : $loop->the_post(); 
							 $postID = get_the_ID();
							 $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); 
			  ?>
					<div class="child">
						<?php $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='280', $height='150');// twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'video-feature-image' ) );?>
                        <a href="<?php the_permalink() ?>"><?php echo $videoID; ?></a>
                        <?php //$trimtitle = get_the_title();
							  //$shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '…' ); ?>
						<a style="text-decoration: none;font-size:16px !important;" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        <?php $youtubetagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true ); ?>
                        <?php //$trimtag = $youtubetagline_value;
							  //$shorttag = wp_trim_words( $trimtag, $num_words = 10, $more = '…' ); ?>
						<p class="tvpexcerpt"><?php echo $youtubetagline_value; ?></p>
						<span></span>
					</div>
					<?php endwhile;?>
				</div> 
<?php get_footer();?>