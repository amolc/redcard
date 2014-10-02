<?php
/**
 * Template Name: Shows List template Page
 
 */
get_header(); 

?>

<div class="left">
  <h2>Shows List</h2>
  <?php 
		
			$args = array( 'post_type' => 'showslist');
			$loop = new WP_Query( $args ); $ad =1; 
			while ( $loop->have_posts() ) : $loop->the_post();
		
			if($ad == 1){?>
 <div class="sigle-football-title"> <a href="<?php the_permalink() ?>"> <h1> <?php the_title(); ?> </h1> </a></div> 
  <div class="date">
      
    <span style="margin-left:0;"><?php the_time('l, F j, Y'); ?></span>
    <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text= <?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
      <div class="twitter"></div>
      </a> <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>">
      <div class="message"></div>
      </a> </div>
  </div>
  <div class="footballs-top-image-latest">
    <?php twentyfourteen_post_thumbnail();?>
  </div>
  <div class="f_text"><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a> </div>
  <div class="c_list">
    <ul>
      <?php } if($ad > 1) { ?>
      <li>
        <div class="img">
          <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?>
          <span>Singapore</span> </div>
        <div class="text"> <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a></p>
        </div>
      </li>
      <?php } $ad++; endwhile;?>
    </ul>
  </div>
</div>
<?php get_sidebar('football');?>
<?php get_footer();?>
