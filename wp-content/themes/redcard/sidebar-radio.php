<?php
/**
 * The Sidebar for Football
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class="right">
  <h2></h2>
  <div class="ad_right" align="center"><?php dynamic_sidebar( 'postsponser' ); ?><label style="font-size:10px;">Advertisement</label></div>
  <h2>Popular Audios</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ /* if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) */ ?>
     <?php dynamic_sidebar( 'po-po-radio' ); ?>
     
    </ul>
  </div>
</div>