<?php
/**
 * Template Name: Radio Schedules Template
 */
get_header(); 

?>
<?php dynamic_sidebar( 'radiobanner' ); ?>

<div class="box">
				<h1>Shows</h1>
			<iframe src="http://redcardradio.sg/schedule.php" width="900" height="1000" scrolling="no" frameborder="0"></iframe>
</div>                
<?php get_footer();?>