<?php
/**
 * The Sidebar for Football
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class="right">
 <?php /*?> <h2>ADVERTISEMENT</h2>
  <div class="ad_right"><?php dynamic_sidebar( 'postsponser' ); ?></div><?php */?>
        <?php if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			if($adsql->adimage2){
		?>
		
<div class="ad_right" align="center"><a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
<label style="font-size:10px;">ADVERTISEMENT</label>
</div>

		<?php
			}
		}
	} ?>
  <h2>Popular Posts</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
     
    </ul>
  </div>
 
</div>