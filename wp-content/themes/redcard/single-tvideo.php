<?php
/**
 * The Template for displaying all single posts
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<style>
#container .left h1{ margin-top:30px; margin-bottom: 10px;}
#container .left .related ul li img{ width:210px;}
</style>
  <div class="left">
		<?php
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='tv-shows' and isactive='1' order by adId DESC LIMIT 0,1";
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
				while ( have_posts() ) : the_post();
				//get_template_part( 'content', get_post_format() );
		
		?>
        
        <h2>Video</h2>
        <?php $postID = get_the_ID();
			  $youtubtagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true );  ?>
        <h1><?php the_title(); ?></h1>
        <div style="margin-bottom: 10px;"><?php echo $youtubtagline_value; ?></div>
        <div class="date">
        
         <?php $term_list_tag = wp_get_post_terms($postID, 'tvcategory');
				 $as =1;
				 if(!empty($term_list_tag))
								  {
									  foreach($term_list_tag as $row)
									  {
										  $mytermArray[$as]['term_id']= $row->term_id;
										  $mytermArray[$as]['name']= $row->name;
										  $mytermArray[$as]['slug']= $row->slug;
										  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
										  $mytermArray[$as]['link']= get_term_link( $row );
										 
										  $as++;
									  }
								  }
		  ?>
       
         <?php if(!empty($mytermArray)){
						 $is =1;
						 $arraycount =  count($mytermArray);
						  foreach($mytermArray as $row){
							  	if($is == $arraycount)
								{
		?>
          <a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>
          <?php } else { ?>
                          <a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>,
                  <?php } ?>
          <?php $is++; ?>
          <?php } } ?> 
          <span><?php the_time('l, F j, Y'); ?></span>
      	<div id="social_3">
        <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink( $article->ID);?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
        <a href="http://twitter.com/intent/tweet?text=<?php echo the_title().' '.get_permalink( $article->ID);?> via @RedCardConnect&url=" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a href="#dis_comments"><div class="message"></div></a>
      </div>
      </div>
      <?php $youtubvid_value = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); ?>
      <div style="margin-bottom: 10px;"><?php echo EmbedVideo($youtubvid_value,$width = 600,$height = 350); ?></div>
      <div style="margin-bottom: 10px;"><?php the_content(); ?></div>
        <?php $field_value = get_post_meta( $post->ID, '_wp_editor_scloud' ); ?>
        <div class="single-rad-vid"><?php echo apply_filters('the_content', $field_value[0] ); ?></div>
		<div class="single-post-image radio-single-image">
        <?php 
				//twentyfourteen_post_thumbnail();
				
				//the_content();
		?>
      	</div>
		<?php endwhile; ?>
         <?php
		 	$postID = get_the_ID();
		    $term_list_reg = wp_get_post_terms($postID, 'tvTags');
				 $as =1;
				 if(!empty($term_list_reg))
								  {
									  foreach($term_list_reg as $row)
									  {
										  $mytermArray[$as]['term_id']= $row->term_id;
										  $mytermArray[$as]['name']= $row->name;
										  $mytermArray[$as]['slug']= $row->slug;
										  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
										  $mytermArray[$as]['link']= get_term_link( $row );
										 
										  $as++;
									  }
								  }
		  ?>
        
         <div class="tags"> <strong>Tags:</strong>      <?php if(!empty($mytermArray)){
						 $is =1;
						 $arraycount =  count($mytermArray);
						  foreach($mytermArray as $row){
							  	if($is == $arraycount)
								{
	?>
    							<a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>
    							<?php } else { ?>
    											<a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>,
    									<?php } ?>
                                <?php $is++; ?>
                                <?php } } ?>	<span><a href="#dis_comment">Comments</a></span> </div>
     <h2>Related Videos</h2>
    <?php $postid = get_the_ID(); ?>
    <?php 
	$args = array(
    'post__not_in '=> $postid,
    'numberposts' => 2,
    'orderby' => 'rand',          
    'post_type' => 'tvideo',
    'post_status' => 'publish');

    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
   
    ?>
    <div class="related related-radio">
      <ul>
        <?php if(!empty($recent_posts)){ 
              foreach($recent_posts as $row){
				  $postID = $row['ID'];
				  $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); 
                  
                 
				   $feat_image = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='280', $height='150');
              ?>
        <li> <?php  echo $feat_image;?> <a href="<?php echo get_permalink( $row['ID']); ?>"><?php echo $row['post_title']; ?></a> </li>
        <?php } } ?>
      </ul>
    </div>
         <h2 id="dis_comment">Comments</h2>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'mekey'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>
    Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
   </div>
<div class="right">
  
  <?php 
 
  if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		<h2>ADVERTISEMENT</h2>
  <div class="ad_right"  align="center">
<a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
<label style="font-size:10px;">Advertisement</label>
</div>

		<?php
		}
	} ?>
  

  <h2>Popular Videos </h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts */  /* if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) */  ?>
        <?php dynamic_sidebar( 'po-po-tv' ); ?>
    </ul>
  </div>
    </div>
</div>
<?php

get_footer(); ?>