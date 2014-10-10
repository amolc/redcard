<?php
/**
 * Template Name: Radio Shows Articles template
* */
get_header(); 
?>&nbsp;
<?php dynamic_sidebar( 'radioshowsbanner' ); 
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{

		foreach($advertSql as $adsql)
		{
			if($adsql->adlink1)
			{
			
		?>
		
<div class="ad_1" align="center"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
<label style="font-size:9px;">ADVERTISEMENT</label>
</div>

		<?php
			}
		}
	}

?>
<div class="left">
  <h2>Radio Shows</h2>
  <?php 
			$args = array( 'post_type' => 'radioshowsartcles');
			$loop = new WP_Query( $args ); $sd=0;
			while ( $loop->have_posts() ) : $loop->the_post();
		
	 		 $postID =get_the_ID();
		
				$URL_values="#";
				$URL_values = get_post_meta( $postID, '_cmb_radio_shows_articles_url', true ); 
				
				if(!$URL_values)
				{
					$URL_values="#";
				}
?>
  <div class="c_list radio-showscss">
    <ul>
      <li>
        <div class="img">
     	 <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?>
          </div>
       <?php ?>
        <div class="text"> <a href="<?php echo $URL_values; ?>">
          <?php the_title(); ?>
          </a>
          <p><?php echo get_the_excerpt(); ?></p>
          <div style="clear:both;"></div>
		  <div style="background: #333;width: 45px;"><a style="color: #fff;font-size: 12px;font-weight: bold;padding: 2px 5px;" href="<?php echo $URL_values; ?>">Listen</a></div>
        </div>
        <?php
		?>
      </li>
    </ul>
  </div>
  <?php endwhile;  ?>
</div>
<div class="right">
 <?php
 $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
  if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		  <h2>&nbsp; </h2>
 <div class="ad_right" align="center"><a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a><label style="font-size:10px;">ADVERTISEMENT</label>
</div>

		<?php
		}
	} ?>
 

  <h2>Popular Audios</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ /* if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) */ ?>
     <?php dynamic_sidebar( 'po-po-radio' ); ?>
    </ul>
  </div>
 
</div>
<?php get_footer();?>