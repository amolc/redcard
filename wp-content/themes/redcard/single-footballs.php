<?php


get_header(); ?>
  <?php $postID = get_the_ID(); 
						
						  $mytermArray = array();
                          $term_list_reg = wp_get_post_terms($postID, 'footballregions');  
						  $term_list_exc = wp_get_post_terms($postID, 'footballexclusive'); 
						  $term_list_opi = wp_get_post_terms($postID, 'footballopinion');  
						  $term_list_week = wp_get_post_terms($postID, 'footballintheweek'); 
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
						  if(!empty($term_list_exc))
						  {
							  foreach($term_list_exc as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								  $as++;
							  }
						  }
						  if(!empty($term_list_opi))
						  {
							  foreach($term_list_opi as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								  $as++;
							  }
						  }
						   if(!empty($term_list_week))
						  {
							  foreach($term_list_week as $row)
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

<div id="container">
  <div class="left">
    <h2>Football</h2>
    
   <div class="sigle-football-title"> <h1>
      <?php the_title(); ?>
    </h1></div>
    <?php $postID = get_the_ID();
		  $youtubtagline_value = get_post_meta( $postID, '_cmb_footballs_tagline_text', true );  ?>
              <div style="margin-bottom: 10px;  font-weight: bold;"><?php echo $youtubtagline_value; ?></div>

   
    <div class="date">
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
      <span><?php the_time('l, F j, Y'); ?>
      </span>
      <div id="social_3">
         <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>&description=<?php echo the_title();?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
        <a href="http://twitter.com/intent/tweet?text=<?php the_title();?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect"  ><div class="twitter"></div></a>
        <a  href="<?php echo get_permalink( $article->ID);?>#dis_comment"><div class="message"></div></a>
        
      </div>
    </div>
    <div class="post">
      <?php
				while ( have_posts() ) : the_post();
				?>
      <div class="single-post-image">
        <?php 
				twentyfourteen_post_thumbnail();
					the_content();
					?>
      </div>
      <?php
				endwhile;
			?>
    </div>
 
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
    
    <div class="author-bio">
			<div class="authimage"><?php echo get_avatar( get_the_author_meta('email'), '90' ); ?></div>
			<div class="author-info">
				<h3 class="author-title"><?php the_author_link(); ?></h3>
				<p class="author-description"><?php the_author_meta('description'); ?></p>
			</div>
	</div>
	<div style="clear:both;"></div>
    <h2>Related Articles</h2>
    <?php $postid = get_the_ID(); ?>
    <?php 
	$args = array(
    'post__not_in '=> $postid,
    'numberposts' => 2,
    'orderby' => 'rand',          
    'post_type' => 'footballs',
    'post_status' => 'publish');

    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
   
    ?>
    <div class="related">
      <ul>
        <?php if(!empty($recent_posts)){ 
              foreach($recent_posts as $row){
                  
                   $feat_image = wp_get_attachment_url( get_post_thumbnail_id($row['ID']) );
              ?>
        <li> <img src="<?php  echo $feat_image;?>"> <a href="<?php echo get_permalink( $row['ID']); ?>"><?php echo $row['post_title']; ?></a> </li>
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
  <?php get_sidebar('football');?>
</div>
<?php get_footer();?>
