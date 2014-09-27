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
				while ( have_posts() ) : the_post();
				//get_template_part( 'content', get_post_format() );
		?>
        <h2>Video</h2>
        <?php $postID = get_the_ID();
			  $youtubtagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true );  ?>
        <h1><?php the_title(); ?></h1>
        <div style="margin-bottom: 10px;"><?php echo $youtubtagline_value; ?></div>
        <div class="date"> <a href="#">Singapore</a> <span><?php the_time('l, F j, Y'); ?></span>
      	<div id="social_3">
        <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
        <a href="http://twitter.com/intent/tweet?text=&url=<?php echo get_permalink( $article->ID);?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>"><div class="message"></div></a>
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
        
     <h2>Related Articles</h2>
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
                  
                   $feat_image = wp_get_attachment_url( get_post_thumbnail_id($row['ID']) );
              ?>
        <li> <img src="<?php  echo $feat_image;?>"> <a href="<?php echo get_permalink( $row['ID']); ?>"><?php echo $row['post_title']; ?></a> </li>
        <?php } } ?>
      </ul>
    </div>
        <h2>Comments</h2>
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
<?php
get_sidebar('radio');
get_footer(); ?>