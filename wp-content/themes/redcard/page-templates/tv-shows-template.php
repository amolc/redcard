<?php
/**
 * Template Name: TV Show template Page
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
				 		 	$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_featured_checkbox' ORDER BY RAND() LIMIT 0,1";
         					$resultarray = $wpdb->get_results($selectsql) ;
							if(!empty($resultarray)){
								foreach($resultarray as $row)
									{
				 						$youtubURL_values = get_post_meta( $row->post_id, '_cmb_tvideo_show_youtub_url', true ); 
				 						$videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='320', $height='250');
	  					?>
						<div class="" style=" width:320px; height:250px; margin-left:10px;"><a href =""><?php echo $videoID; ?></a></div>
        				<?php }} ?>
					</div>
					<div class="b" id="no-border">
						<h1>ADVERTISMENT</h1>
						<?php dynamic_sidebar( 'postsponser' ); ?>
					</div>
				</div> 

<div class="box">
				<h1>Shows</h1>
				<?php
				     
						 
						$today=date('m/d/Y');
						
				    	$args = array(
										'post_type'        => 'tvideoshow',
										'post_status'      => 'publish',
										'post_status'   => 'publish',
										'meta_key' => '_cmb_tvideo_show_test_textdate',
										'meta_value'      => $today
										);
						$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_from_time'";
						$metafrom = $wpdb->get_results($selectsql) ;
						$metafrom[0]->meta_value;
						
						$selectsqlto = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_to_time'";
						$metato = $wpdb->get_results($selectsqlto) ;
						$metato[0]->meta_value;
						
						$allarts = get_posts( $args );
						if(sizeof($allarts)>0)
						{
							   echo '<div class="box">';
						echo '<h1> '.mysql2date('F j, Y ', $today).' </h1>';
				    	$i = 1;
				    	foreach ( $allarts as $article ) {
							
						   $radtitle = $article->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="g-child list'.$i.'">'. get_the_post_thumbnail( $article->ID ).'<h3 style=" margin-bottom: 15px;"><div class="r-child-shop-h3-a">'.$radtitlefinal.'</div></h3>
						  <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">From</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metafrom[0]->meta_value.'</div>
						   <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">To</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metato[0]->meta_value.'</div>
						   <div id="social_tvshow" >';
								?>
								  <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
         <a href="http://twitter.com/intent/tweet?text=via @RedCardConnect&url=<?php echo get_permalink( $article->ID);?>"   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>"><div class="message"></div></a>
        
								<?php
	   								
	   						echo '</div>
	   						</span></span></div>';
	   						$i++;
							
						}

				        echo '</div>';
						}
						?>
                        
                        
                        
                        
                        <?php
				 
						$today=date('m/d/Y', strtotime(' +1 day'));
					
				    	$args = array(
										'post_type'        => 'tvideoshow',
										'post_status'      => 'publish',
										'post_status'   => 'publish',
										'meta_key' => '_cmb_tvideo_show_test_textdate',
										'meta_value'      => $today
										);
						$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_from_time'";
						$metafrom = $wpdb->get_results($selectsql) ;
						$metafrom[0]->meta_value;
						
						$selectsqlto = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_to_time'";
						$metato = $wpdb->get_results($selectsqlto) ;
						$metato[0]->meta_value;				
						
						$allarts = get_posts( $args );
						if(sizeof($allarts)>0)
						{
							   echo '<div class="box">';
						echo '<h1> '.mysql2date('F j, Y ', $today).' </h1>';
				    	$i = 1;
				    	foreach ( $allarts as $article ) {
						   $radtitle = $article->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="g-child list'.$i.'">'. get_the_post_thumbnail( $article->ID ).'<h3 style=" margin-bottom: 15px;"><div class="r-child-shop-h3-a">'.$radtitlefinal.'</div></h3>
						  <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">From</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metafrom[0]->meta_value.'</div>
						   <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">To</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metato[0]->meta_value.'</div>
						   <div id="social_tvshow" >';
								?>
								  <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
        <a href="http://twitter.com/intent/tweet?text=&url=<?php echo get_permalink( $article->ID);?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>"><div class="message"></div></a>
        
								<?php
	   								
	   						echo '</div>
	   						</span></span></div>';
	   						$i++;
							
						}

				        echo '</div>';
						}
						?>
                        
                         <?php
				       
						$today=date('m/d/Y', strtotime(' +2 day'));
						
						
				    	$args = array(
										'post_type'        => 'tvideoshow',
										'post_status'      => 'publish',
										'post_status'   => 'publish',
										'meta_key' => '_cmb_tvideo_show_test_textdate',
										'meta_value'      => $today
										);
										
						$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_from_time'";
						$metafrom = $wpdb->get_results($selectsql) ;
						$metafrom[0]->meta_value;
						
						$selectsqlto = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_show_to_time'";
						$metato = $wpdb->get_results($selectsqlto) ;
						$metato[0]->meta_value;
						
						$allarts = get_posts( $args );
					    if(sizeof($allarts)>0)
						{
							   echo '<div class="box">';
						echo '<h1> '.mysql2date('F j, Y ', $today).' </h1>';
				    	$i = 1;
				    	foreach ( $allarts as $article ) {
						   $radtitle = $article->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="g-child list'.$i.'">'. get_the_post_thumbnail( $article->ID ).'<h3 style=" margin-bottom: 15px;"><div class="r-child-shop-h3-a">'.$radtitlefinal.'</div></h3>
						   <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">From</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metafrom[0]->meta_value.'</div>
						   <div style="color: rgb(255, 255, 255); font-size: 14px; margin-top:5px;margin-bottom:5px;">To</div> <div style="color: rgb(255, 255, 255); font-size: 13px;" >'.$metato[0]->meta_value.'</div>
						   <div id="social_tvshow" >';
								?>
								  <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink( $article->ID));?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
        <a href="http://twitter.com/intent/tweet?text=&url=<?php echo get_permalink( $article->ID);?>" target="_blank" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo get_permalink( $article->ID);?>"><div class="message"></div></a>
        
								<?php
	   								
	   						echo '</div>
	   						</span></span></div>';
	   						$i++;
							
						}

				        echo '</div>';}?>
                        
			</div>                
<?php get_footer();?>