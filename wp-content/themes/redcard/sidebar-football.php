<?php
/**
 * The Sidebar for Football
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class="right">
  <h2>Sponsor</h2>
  <div class="ad_right"><?php dynamic_sidebar( 'postsponser' ); ?></div>
  <h2>Popular Posts</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
     
    </ul>
  </div>
 
</div>