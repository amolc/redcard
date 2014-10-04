<?php
/**
 * Template Name: Football Opinion template Page
 
 */
get_header(); 

?>

<div class="left">
  <h2>Football</h2>
  <?php 
		$ad =1; 
		$terms = get_terms( 'footballopinion', array(
    'orderby'    => 'count',
    'hide_empty' => 0
) );
		
		foreach( $terms as $term ) {
			//$args = array( 'post_type' => 'footballs', );
				$args = array(
			'post_type' => 'footballs',
			'footballopinion' => $term->slug
		);
			$loop = new WP_Query( $args ); 
			while ( $loop->have_posts() ) : $loop->the_post();
		
			if($ad == 1){?>
  <a href="<?php the_permalink() ?>">
  <h1>
    <?php the_title(); ?>
  </h1>
  </a>
  <?php $postID = get_the_ID(); 
						
						  $mytermArray = array();
                          $term_list_reg = wp_get_post_terms($postID, 'footballregions');  
						  $term_list_exc = wp_get_post_terms($postID, 'footballexclusive'); 
						  $term_list_opi = wp_get_post_terms($postID, 'footballopinion');  
						  $term_list_week = wp_get_post_terms($postID, 'footballintheweek'); 
						  $as =1;
						
						  if(!empty($term_list_reg))
						  {
							  foreach($term_list_reg as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								 
								  $as++;
							  }
						  }
						  if(!empty($term_list_exc))
						  {
							  foreach($term_list_exc as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								  $as++;
							  }
						  }
						  if(!empty($term_list_opi))
						  {
							  foreach($term_list_opi as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								  $as++;
							  }
						  }
						   if(!empty($term_list_week))
						  {
							  foreach($term_list_week as $row)
							  {
								  $mytermArray[$as]['term_id']= $row->term_id;
								  $mytermArray[$as]['name']= $row->name;
								  $mytermArray[$as]['slug']= $row->slug;
								  $mytermArray[$as]['term_taxonomy_id']= $row->term_taxonomy_id;
								  $mytermArray[$as]['link']= get_term_link( $row );
								  $as++;
							  }
						  }
						 
						    ?>
  <div class="date">
    <?php if(!empty($mytermArray)){
						 $is =1;
						 $arraycount =  count($mytermArray);
						  foreach($mytermArray as $row){
							  	if($is == $arraycount)
								{
	?>
    							<a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>
    							<?php } else { ?>
    											<a href="<?php echo $row['link']?>"><?php echo $row['name']?></a>,
    									<?php } ?>
                                <?php $is++; ?>
                                <?php } } ?>

    
    <span><?php the_time('l, F j, Y'); ?></span>
    <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php the_title(); ?> <?php echo get_permalink( $article->ID);?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text= <?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
      <div class="twitter"></div>
      </a>  <a  href="<?php echo get_permalink( $article->ID);?>#dis_comment">
      <div class="message"></div>
      </a> </div>
  </div>
  <div class="footballs-top-image-latest">
    <?php twentyfourteen_post_thumbnail();?>
  </div>
  <div class="f_text"><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a> </div>
  <div class="c_list">
    <ul>
      <?php } if($ad > 1) { ?>
      <li>
        <div class="img">
          <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'post-feature-image' ) );?>
          <span>Singapore</span> </div>
        <div class="text"> <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a>
          <p><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a></p>
        </div>
      </li>
      <?php } $ad++; endwhile; }?>
    </ul>
  </div>
</div>


<div class="right">
 
  <?php
  $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='football-article' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			?>
			 <h2>ADVERTISEMENT</h2>
			  <div class="ad_right" align="center">
              <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
              <label style="font-size:10px;">Advertisement</label>
              </div>
			<?php
		}
	}
		?>
  
  
  <h2>Popular Posts</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
     
    </ul>
  </div>
 
</div>

<?php get_footer();?>
