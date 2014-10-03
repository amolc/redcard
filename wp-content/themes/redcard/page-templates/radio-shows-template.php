<?php
/**
 * Template Name: Radio Schedules Template
 */
get_header(); 

?>
<?php dynamic_sidebar( 'radiobanner' ); ?>
<?php 
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-schedules' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		
<div class="ad_1" align="center"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
<label style="font-size:9px;">ADVERTISEMENT</label>
</div>

		<?php
		}
	}
?>
<div class="box">
				<h1>Schedule</h1>
			<iframe src="http://redcardradio.sg/schedule.php" width="900" height="1000" scrolling="no" frameborder="0"></iframe>
</div>                
<?php get_footer();?>