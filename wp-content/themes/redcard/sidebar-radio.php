<?php
/**
 * The Sidebar for Football
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class="right">
  <?php
 $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-shows' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
  if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		  <h2></h2>
 <div class="ad_right" align="center"><a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a><label style="font-size:10px;">Advertisement</label>
</div>

		<?php
		}
	} ?>
  <h2>Popular Audios</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ /* if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) */ ?>
     <?php dynamic_sidebar( 'po-po-radio' ); ?>
     
    </ul>
  </div>
</div>