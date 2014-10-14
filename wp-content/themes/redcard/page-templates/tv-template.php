<?php
/**
 * Template Name: TV template Page
 */
get_header(); 

?>
<?php
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='tv' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			
			if($adsql->adimage1){
				
		?>
		
<div class="ad_1" align="center"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
<label style="font-size:9px;">ADVERTISEMENT</label>
</div>

		<?php
			}
		}
	}
	
	?>
 <?php  dynamic_sidebar( 'tvbanner' ); ?>
 
<?php $param_1 = "";
		if(isset($_GET['param']))
		{
			$param_1=$_GET['param'];
		} ?>
 <div class="box">
	<h1>Latest Videos <div class="redsort">
            <select name="dropdown" id="sel"  onchange="changeOpt()">
                <option value="latest" <?php if($param_1 == "latest" ){ echo 'selected="selected"';} ?> >Latest</option>
                <option value="bycategories" <?php if($param_1 == "bycategories" ){ echo 'selected="selected"';} ?> >By Categories</option>
            </select>
<script>
function changeOpt(){
  document.getElementById("sel");
  window.location="?param="+ document.getElementById("sel").value;
}
</script>
 </div></h1>
 <div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
    
		<?php
		echo '<div class="box">';
		$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if($param_1=="bycategories")
			{
				$categories = get_terms( 'tvcategory', array('orderby' => 'count', 'hide_empty' => 1) );
				$arrcat =  array();										 
				if(!empty($categories))
				{
					foreach($categories as $catId)
						{
							$arrcat[]= $catId->slug;
						}
				}
				$am = implode(',', $arrcat);
				
				$args = array(
							'posts_per_page'   => 10,
							'post_type'        => 'tvideo',
							'tvcategory'	   => $am,
							'order'			=> 'ASC',
							'post_status'      => 'publish',
							'paged' 			=> $current_page,
							);	
			}
		else
		{
			$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'tvideo',
						'post_status'      => 'publish',
                        'paged' 			=>  $current_page,
					);
		}

        $i = 1;
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$postID = get_the_ID(); 
		
			 $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true );
			 $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='150', $height='130');
			 
		   	echo '<div class="r-child list'.$i.'" style="background-color:#00a69c;"><a href="'.get_permalink( $postID).'">'.get_the_post_thumbnail($postID).'</a>
			<h3 style="padding:5px 5px 12px;margin-top:0px !important; background:#333333;"><a href="'.get_permalink( $postID).'" class="r-child-h3-a child-a-left">'.get_the_title().'</a></h3>';
			 				$term_list_reg = wp_get_post_terms($postID, 'tvcategory');
      					   $mlink=(get_term_link( $term_list_reg[0] ));
						  
			echo '<a href="'.$mlink.'" style=" margin-bottom: 13px;margin-top: 17px;;color:white;">'.$term_list_reg[0]->name.'</a>';
	   		echo '<a href="'.get_permalink( $postID).'" class="llink">Watch</a><div id="social_5" style="height: 50px;margin: 10px auto 0;">';
	?>		
			<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($postID);?>&description=<?php echo get_the_title();?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title();?> <?php echo get_permalink($postID);?> via @RedCardConnect&url="  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink($postID);?>#dis_comment">
      <div class="message"></div>
      </a>
	<?php		
			//echo '</div><span>'.getPostViews($postID).'<span></span></span></div>';
			
			echo '</div></div>';
   			$i++;
			endwhile;
			echo '</div>';
?>
<?php
wp_pagenavi( array( 'query' => $loop ) );
wp_reset_postdata();
?>
</div>
<?php get_footer();?>