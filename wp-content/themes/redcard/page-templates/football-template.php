<?php
/**
 * Template Name: Football template Page
 
 */
get_header(); 

?>

<div class="left">
  <h2>Football</h2>

      
		<?php 
$args = array( 'post_type' => 'footballs');
$loop = new WP_Query( $args ); $as =1;
while ( $loop->have_posts() ) : $loop->the_post();
		
			if($as ==1){?>
				  <a href="<?php the_permalink() ?>">
                      <h1><?php the_title(); ?></h1>
                      </a>
                      <div class="date"> <a href="#">Singapore</a> <span><?php the_time('l, F j, Y'); ?></span>
                        <div id="social_3">
                          <div class="facebook"></div>
                          <div class="twitter"></div>
                          <div class="message"></div>
                        </div>
                      </div>
                      <img src="<?php echo get_template_directory_uri(); ?>/img/d_post.jpg" class="post_img"/>
                      <div class="f_text"><?php echo get_the_excerpt(); ?>  <a href="<?php the_permalink() ?>">Read More</a> </div>
                      
                      <div class="c_list">
                        <ul>
      
			<?php }
			 ?><li>
 				<div class="img"> <img src="<?php echo get_template_directory_uri(); ?>/img/d_post.jpg"/> <span>Singapore</span> </div>
     			<div class="text">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <p><?php echo get_the_excerpt(); ?>  <a href="<?php the_permalink() ?>">Read More</a></p>
				</div>
                </li>
			<?php $as++; endwhile;?>
      
    </ul>
  </div>
</div>
<?php get_sidebar('football');?>
</div>
<?php get_footer();?>