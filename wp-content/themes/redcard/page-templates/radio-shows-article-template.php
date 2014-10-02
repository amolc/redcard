<?php
/**
 * Template Name: Radio Shows Articles template
* */
get_header(); 
?>
<?php dynamic_sidebar( 'radioshowsbanner' ); ?>
<div class="left">
  <h2>Radio Shows Articles</h2>
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
          <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?>
          </div>
       <?php ?>
        <div class="text"> <a href="<?php echo $URL_values; ?>">
          <?php the_title(); ?>
          </a>
          <p><?php echo get_the_excerpt(); ?></p>
        </div>
        <?php
		?>
      </li>
    </ul>
  </div>
  <?php endwhile;  ?>
</div>
<?php get_sidebar('football');?>
<?php get_footer();?>