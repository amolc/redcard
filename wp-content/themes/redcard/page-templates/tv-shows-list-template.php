<?php
/**
 * Template Name: TV Shows template
* */
get_header(); 
?>
<?php dynamic_sidebar( 'tvshowsbanner' ); ?>
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
     	 <img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($term->term_id); ?>" width="150" height="150" />
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
<div class="right">
  <?php $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='tv-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
	?>
  <h2>ADVERTISEMENT</h2>
  <div class="ad_right" align="center">
  <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
  <label style="font-size:10px;">Advertisement</label>
  </div><?php 
		}
	
 
   }
   ?>
  <h2>Popular Posts</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
     
    </ul>
  </div>
 
</div>
<?php get_footer();?>