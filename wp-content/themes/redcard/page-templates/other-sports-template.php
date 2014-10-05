<?php
/**
 * Template Name: Other Sports template Page
 */
get_header(); 
?>

<div class="left">
  <h2>Other Sports</h2>
		<?php 
			$args = array( 'post_type' => 'other_sports');
			$loop = new WP_Query( $args ); $as =1;
			if($loop->have_posts())
			{
			while ( $loop->have_posts() ) : $loop->the_post();
			if($as ==1)
			{
		?>
				  <a href="<?php the_permalink() ?>"><h1><?php the_title(); ?></h1></a>
                  <div class="date"> <a href="#">Singapore</a> <span><?php the_time('l, F j, Y'); ?></span>
                     <div id="social_3">
                          <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect"  title="Share on Facebook" ><div class="facebook" ></div></a>
          <a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>"><div class="message"></div></a>
                      </div>
                  </div>
                  <div class="footballs-top-image-latest"><?php twentyfourteen_post_thumbnail();?></div>
                  <div class="f_text"><?php echo get_the_excerpt(); ?>  <a href="<?php the_permalink() ?>">Read More</a> </div>
                  <div class="c_list">
                      <ul>
		<?php } ?>
        				<li>
 							<div class="img"> <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?> <span>Singapore</span> </div>
	 						<div class="text">
                            	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                <p><?php echo get_the_excerpt(); ?>  <a href="<?php the_permalink() ?>">Read More</a></p>
							</div>
                		</li>
                      
		
         </ul>
     </div>
     <?php $as++; endwhile;
			}else
			{
				?>
		<h3 style="font-family: 'FF DIN';">Watch this space!</h3>
  		<h4 style="font-family: 'FF DIN';">The place for the hardest hitting stories from the world of MMA, the ace articles served up for tennis, heart-stopping motorsports news, golf gossip and more!</h4>
		<?php
			}
	 ?>
</div>
<div class="right">
 
  <?php
  $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='other-sports' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			?>
			 <h2>ADVERTISEMENT</h2>
			  <div class="ad_right" align="center">
              <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
              <label style="font-size:10px;">Advertisement</label>
              </div>
			<?php
		}
	}
		?>
  
  
  <h2>Popular Posts</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
     
    </ul>
  </div>
 
</div>

<?php get_footer();?>