<?php
/**
 * Taxonomy for Football tags page
 */
get_header(); 
?>

<div class="left">
  <h2><?php echo $wp_query->queried_object->name; ?></h2>
  <?php
 			$ad =1; 

	while (have_posts() ) : the_post();

if($ad == 1){ ?>
  <div class="sigle-football-title">
   <a href="<?php the_permalink() ?>"><h1><?php the_title(); ?></h1></a>
    <p style="font-weight:bold;">
      <?php
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_othersports_tagline_text',true  );
			echo $youtubtagline_value;?>
    </p>
  </div>
  <?php $postID = get_the_ID(); 
		$mytermArray = array();
		$term_list_tag = wp_get_post_terms($postID, 'other-sports-tags'); 
		$as =1;
		if(!empty($term_list_tag))
			  {
				  foreach($term_list_tag as $row)
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
    <span style="margin-left: 0px;"><?php the_time('l, F j, Y'); ?></span>
    <div id="social_3">
      <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text= <?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
      <div class="twitter"></div>
      </a>
      <a  href="<?php echo get_permalink( $article->ID);?>#dis_comment">
      <div class="message"></div>
      </a>
    </div>
  </div>
  <div class="footballs-top-image-latest"><?php twentyfourteen_post_thumbnail();?></div>
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
          <p>
            <?php
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_othersports_tagline_text',true  );
			echo $youtubtagline_value;?>
          </p>
        </div>
      </li>
      <?php } $ad++; endwhile;?>
    </ul>
  </div>
  <?php
      if (function_exists(custom_pagination))
	  {
        custom_pagination($loop->max_num_pages,"",$current_page);
      }
	?>
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
  <h2>&nbsp;</h2>
  <div class="ad_right" align="center"> <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
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
