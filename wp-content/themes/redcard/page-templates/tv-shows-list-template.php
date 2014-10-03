<?php
/**
 * Template Name: TV Shows template
* */
get_header(); 
?>
<?php dynamic_sidebar( 'tvbanner' ); ?>
<div class="left">
  <h2>TV Shows</h2>
	<?php 
		$ad =1; 
		$terms = get_terms( 'tvcategory', array(
													'orderby'    => 'count',
													'hide_empty' => 0
												) );
		
		foreach( $terms as $term ) {
	?>
  <?php $postID = get_the_ID(); 
  
$termlink = get_term_link($term);
 ?>
  <div class="c_list radio-showscss">
    <ul>
      <li>
        <div class="img">
     	 <?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>
          </div>
       <?php ?>
        <div class="text"> <a href="<?php echo $termlink;?>">
          <?php echo $term->name; ?>
          </a>
          <p><?php echo $term->description; ?></p>
        </div>
        <?php
		?>
      </li>
    </ul>
  </div>
  <?php $ad++;  } ?>
</div>
<?php get_sidebar('football');?>
<?php get_footer();?>