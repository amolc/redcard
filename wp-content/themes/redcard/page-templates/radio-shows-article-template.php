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
			$loop = new WP_Query( $args ); $ad =1; 
			while ( $loop->have_posts() ) : $loop->the_post();
?>
  <div class="c_list radio-showscss">
    <ul>

      <li>
        <div class="img">
          <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?>
          </div>
        <div class="text"> <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a></p>
        </div>
      </li>
      <?php  $ad++; endwhile;?>
    </ul>
  </div>
</div>
</div>
<?php get_sidebar('football');?>
<?php get_footer();?>
