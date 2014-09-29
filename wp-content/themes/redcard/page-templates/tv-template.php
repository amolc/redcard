<?php
/**
 * Template Name: TV template Page
 */
get_header(); 
$m_tablename=$wpdb->prefix."programmes";

function my_convert_date($date)
{
	$datearr=explode("-",$date);
	$newdate=strftime("%A, %d %B %Y",mktime(0,0,0,$datearr[1],$datearr[2],$datearr[0]));
	return $newdate;
}
function my_convert_time($time)
{
	$timearr=explode(":",$time);
	$mhour=$timearr[0];
	$mmin=$timearr[1];	
	if($mhour>12)
	{
		$newstr=($mhour-12).":".$mmin." pm";
	}
		else
	{
		$newstr=($mhour).":".$mmin." am";
	}
return $newstr;
}
?>
<img src="<?php echo get_template_directory_uri(); ?>/img/tv_slide.jpg" class="tv_slide"/>

<div class="box">
					<div class="s">
						<h1>On Tonight</h1>
                        <?php 
						$programmequery="select * from $m_tablename where prgdate>=now() order by prgdate";
						$programmesql=$wpdb->get_results($programmequery);
						if(sizeof($programmesql)>0)
						{
								?>
						<ul style="overflow:scroll;height:250px; ">
                        <?php foreach($programmesql as $my_sql)
						{
							?>
							<li>	
								<div class="date" style="width:180px;"><?php echo my_convert_date($my_sql->prgdate);?></div >
								<h2><?php echo $my_sql->prgTitle;?></h2>
								<p><?php echo my_convert_time($my_sql->prgfrom);?> to <?php echo my_convert_time($my_sql->prgto);?><br/><?php echo $my_sql->prgtagline;?></p>
							</li>
							<?php
						}
							?>
						</ul>
	                <?php
						}
						else
						{
					?>
						<ul style="overflow:scroll;height:250px; "><li><h2>No Programme Scheduled</h2></li></ul>
                        <?php
						}
						?>
					</div>
					<div class="b">
						<h1>Featured Video</h1>
                        <?php 
				 		 	$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_featured_checkbox' ORDER BY RAND() LIMIT 0,1";
         					$resultarray = $wpdb->get_results($selectsql) ;
							if(!empty($resultarray)){
								foreach($resultarray as $row)
									{
				 						$youtubURL_values = get_post_meta( $row->post_id, '_cmb_tvideo_youtub_url', true ); 
				 						$videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='320', $height='250');
	  					?>
						<div class="" style=" width:320px; height:250px; margin-left:10px;"><a href ="<?php echo get_permalink($row->post_id); ?>"><?php echo $videoID; ?></a></div>
        				<?php }} ?>
					</div>
					<div class="b" id="no-border">
						<h1>ADVERTISMENT</h1>
						<?php dynamic_sidebar( 'postsponser' ); ?>
					</div>
				</div> 
<div class="box">
					<h1>Video Segments</h1>
               <?php  $args = array( 'post_type' => 'tvideo');
					  $loop = new WP_Query( $args ); $as =1;
					  while ( $loop->have_posts() ) : $loop->the_post(); 
							 $postID = get_the_ID();
							 $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); 
			  ?>
					<div class="child">
						<?php $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='280', $height='150');// twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'video-feature-image' ) );?>
                        <a href="<?php the_permalink() ?>"><?php echo $videoID; ?></a>
                        <?php //$trimtitle = get_the_title();
							  //$shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '…' ); ?>
						<a style="text-decoration: none;" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        <?php $youtubetagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true ); ?>
                        <?php //$trimtag = $youtubetagline_value;
							  //$shorttag = wp_trim_words( $trimtag, $num_words = 10, $more = '…' ); ?>
						<p class="tvpexcerpt"><?php echo $youtubetagline_value; ?></p>
						<span></span>
					</div>
					<?php endwhile;?>
				</div> 
<?php get_footer();?>