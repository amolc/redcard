<?php
/*
Template Name: Radio Articles by Category
The template for displaying Archive pages
*/
get_header(); 

?>
<?php dynamic_sidebar( 'radiobanner' );

$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='radio-articles' and isactive='1' order by adId DESC LIMIT 0,1";
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
	$param_1 = "";
		if(isset($_GET['param']))
		{
			$param_1=$_GET['param'];
		}
	?>
<div class="box">
	<h1>Latest Radio Shows 
    <div class="redsort">
            <select name="dropdown" id="sel"  onchange="changeOpt()">
                <option value="latest" <?php if($param_1 == "latest" ){ echo 'selected="selected"';} ?> >Latest</option>
                <option value="bycategories" <?php if($param_1 == "bycategories" ){ echo 'selected="selected"';} ?> >By Categories</option>
                <option value="byshows" <?php if($param_1 == "byshows" ){ echo 'selected="selected"';} ?> >By Shows</option>
            </select>
<script>
function changeOpt(){
  document.getElementById("sel");
  window.location="?param="+ document.getElementById("sel").value;
}
</script>
    </div></h1>
		<?php
		echo '<div class="box">';
		echo '<h4>' . $term->name. '</h4>';
		$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		if($param_1=="bycategories")
			{

				$categories = get_terms( 'radio-categories', array('orderby' => 'count', 'hide_empty' => 1) );
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
							'post_type'        => 'radio-articles',
							'radio-categories' => $am,
							'order'			=> 'ASC',
							'post_status'      => 'publish',
							'paged' 			=> $current_page,
							);	
			}
		elseif($param_1=="byshows")
			{
				$categories = get_terms( 'radio-shows', array('orderby' => 'count', 'hide_empty' => 1) );
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
							'post_type'        => 'radio-articles',
							'radio-shows' 	  => $am,
							'order'			=> 'ASC',
							'post_status'      => 'publish',
							'paged' 			=> $current_page,
							);			
			}
		else
		{
			$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
                        'paged' 			=>  $current_page,
					);
		}
		
        $i = 1;
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$postID = get_the_ID(); 
		   	echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $postID ).'
			<h3><a href="'.get_permalink( $postID).'" class="r-child-h3-a child-a-left">'.get_the_title().'</a></h3>';
			 $term_list_reg = wp_get_post_terms($postID, 'radio-shows');
			 if(!empty($term_list_reg))
			 {
      			   $mlink=(get_term_link( $term_list_reg[0] ));
			 }
			 $term_list_reg1 = wp_get_post_terms($postID, 'radio-categories');
			 if(!empty($term_list_reg1))
			 {
      			   $mlink1=(get_term_link( $term_list_reg1[0] ));
			 }
			echo '<a href="'.$mlink.'" style="margin-bottom:0px !important;">'.$term_list_reg[0]->name.':</a>  
								<a href="'.$mlink1.'">'.$term_list_reg1[0]->name.'</a>';
	   		echo '<a href="'.get_permalink( $postID).'" class="llink">Listen</a><div id="social_2">';
	?>		
			<a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($postID);?>&description=<?php echo get_the_title();?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title();?> <?php echo get_permalink($postID);?> via @RedCardConnect&url="  >
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink($postID);?>#dis_comment">
      <div class="message"></div>
      </a>
	<?php		
			echo '</div><span>'.getPostViews($postID).'<span></span></span></div>';
   			$i++;
			endwhile;
			echo '</div>';
?>
<?php
wp_pagenavi( array( 'query' => $loop ) );
?>
</div>
<?php get_footer();?>