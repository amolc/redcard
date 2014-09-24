<?php


get_header(); ?>

<div id="container">
  <div class="left">
    <h2>Football</h2>
    <a href="">
    <h1>
      <?php the_title(); ?>
    </h1>
    </a>
    <div class="date"> <a href="#">Singapore</a> <span>
      <?php the_time('l, F j, Y'); ?>
      </span>
      <div id="social_3">
        <div class="facebook"></div>
        <div class="twitter"></div>
        <div class="message"></div>
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
    <div class="tags"> <strong>Tags:</strong> <a href="#">Gerard Pique</a>, <a href="#">Singapore</a> <span>Comments</span> </div>
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
  <?php get_sidebar('football');?>
</div>
</div>
<?php get_footer();?>
