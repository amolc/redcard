<?php
/**
 * Taxonomy for Football In The Week page
 */
get_header(); 
?>
<div class="left">

<h2>In The Week > <?php echo $wp_query->queried_object->name; ?></h2>
<?php
/* $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'footballs','posts_per_page'=>5, 'post_status'=> 'publish', 'paged'=>  $current_page);
			$loop = new WP_Query( $args );*/ $ad =1; 
	while ( $loop->have_posts() ) : $loop->the_post();

if($ad == 1){?>
    <div class="sigle-football-title"> <a href="<?php the_permalink() ?>">
  <h1>
    <?php the_title(); ?>
  </h1>
  </a><p style="font-weight:bold;"><?php
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_footballs_tagline_text',true  );
			echo $youtubtagline_value;?></p>  </div>
  <?php $postID = get_the_ID(); 
						
						  $mytermArray = array();
						  $term_list_week = wp_get_post_terms($postID, 'footballintheweek'); 
						  $as =1;
						
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
    <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text= <?php the_title(); ?> <?php echo get_permalink( $postID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
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
          <span><?php echo $wp_query->queried_object->name; ?></span> </div>
        <div class="text"> <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a>
         <p><?php
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_footballs_tagline_text',true  );
			echo $youtubtagline_value;?></p> 
        </div>
      </li>
      <?php } $ad++; endwhile;?>
    </ul>
  </div>
   <?php
      if (function_exists(custom_pagination)) {
        custom_pagination($loop->max_num_pages,"",$current_page);
      }
?>
</div>
<?php get_sidebar('football');?>
<?php get_footer();?>