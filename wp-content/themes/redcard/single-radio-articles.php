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
</style>
  <div class="left">
		<?php
				while ( have_posts() ) : the_post();
				//get_template_part( 'content', get_post_format() );
		?>
        <h2>Radio</h2>
        <h1><?php the_title(); ?></h1>
        <div class="date"> <a href="#">Singapore</a> <span>
      <?php the_time('l, F j, Y'); ?>
      </span>
      <div id="social_3">
        <div class="facebook"></div>
        <div class="twitter"></div>
        <div class="message"></div>
      </div>
    </div>
        <?php $all_meta = get_post_meta($post->ID);?>
        <div class="single-rad-vid"><?php echo $all_meta['_oembed_f1323014c18094c603c874db4bb5064e'][0]; ?></div>
		<div class="single-post-image radio-single-image">
        <?php 
				//twentyfourteen_post_thumbnail();
				
				the_content();
		?>
      	</div>
		<?php endwhile; ?>
   </div>
<?php
get_sidebar('radio');
get_footer(); ?>