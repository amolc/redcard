<?php
/**
 * Taxonomy for Football Region page
 */
get_header(); ?>
<div id="suzuki-header">
  <div class="baba">
    <a >#RedCardConnect</a>
    <a >#AFFSuzukiCup</a>
    <a >#LionKings</a>  
  </div>
  <div class="main">
    <div class="row" >
        <div class="col-sm-7">
          <h4 style="padding:8px 0 0 10px;margin:0px;">TOURNAMENT COVERAGE</h4>
        </div>
        <div class="col-sm-5">
          <ul class="suzuki-menu">
            <li class="menu-item active"><a href="http://redcardconnect.com/footballtags/aff-suzuki-cup/">NEWS</a></li>
          <li class="menu-item "><a href="/suzuki-fixtures">FIXTURES</a></li>
        </ul>
      </div>          
    </div>  
      <div class="row">
      <a class="col-sm-12" href="http://redcardconnect.com/suzuki-fixtures/">
      <img src="<?php echo z_taxonomy_image_url($wp_query->queried_object->term_id, NULL, TRUE); ?>" style="width:600px;height:150px;margin:20px 30px" />  
      </a>
      </div>
      
    <div style="clear:both;"></div>
  </div>
  
  
</div>

<style>
.main{ color: black; background: URL('/suzuki-images/slice.png') repeat-x; margin-top: 10px; width: 620px;}
.suzuki-menu{ float: right;}
#suzuki-header{background: URL('/suzuki-images/r1.jpg') 0 0; background-size: 100%; margin-top: 15px; font-family: 'FF DIN';}

.news{ width: 50; display:block; background: URL('/suzuki-images/news.png'); }
.dada{width:50px; height:30px; display:block; overflow:hidden; margin:0 auto; }
.baba a{ font-size:18px; color: #fff; margin:15px 0 0 10px; }
.raj{background:URL('/suzuki-images/r.jpg'); }
.suzuki-menu > li a{ color: #fff;}
.suzuki-menu > li{ width: 96px;
  top: -5px;
  list-style: none;
  text-align: center;
float: left;
margin-left: 0px;
position: relative;
padding: 13px 11px;
cursor: pointer;
background: url("/suzuki-images/fixture.png") no-repeat -3px -1px transparent;}
.suzuki-menu > li:hover, .suzuki-menu > li.active {
color: #fff;
background: URL('/suzuki-images/news.png') no-repeat 0 0 transparent;  }

</style>

<?php
$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='football-regions' and isactive='1' order by adId DESC LIMIT 0,1";
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
<div class="left">
  <h2>Football > <span style="color:#028f44;"><?php echo $wp_query->queried_object->name; ?></span> </h2>
  <?php
	$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
$ad =1;
	global $wp_query;

	if(have_posts())
	{
 		while ( have_posts() ) : the_post();

	if($ad == 1){?>
  <div class="sigle-football-title"> <a href="<?php the_permalink() ?>">
    <h1>
      <?php the_title(); ?>
    </h1>
    </a>
    <p style="font-weight:bold;">
      <?php
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_footballs_tagline_text',true  );
			echo $youtubtagline_value;?>
    </p>
  </div>
  <?php $postID = get_the_ID(); 
						
						  $mytermArray = array();
                          $term_list_reg = wp_get_post_terms($postID, 'footballregions');  
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
    <span>
    <?php the_time('l, F j, Y'); ?>
    </span>
    <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink( $article->ID);?>&description=<?php the_title(); ?> via @RedCardConnect"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text= <?php the_title(); ?> <?php echo get_permalink( $article->ID);?> via @RedCardConnect&url="   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;">
      <div class="twitter"></div>
      </a> <a  href="<?php echo get_permalink( $article->ID);?>#dis_comment">
      <div class="message"></div>
      </a> </div>
  </div>
  <div class="footballs-top-image-latest">
    <?php twentyfourteen_post_thumbnail();?>
  </div>
  <div class="f_text">
    <?php /*?><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink() ?>">Read More</a><?php */?>
  </div>
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
          $youtubtagline_value = get_post_meta($post->ID, '_cmb_footballs_tagline_text',true  );
			echo $youtubtagline_value;?>
          </p>
        </div>
      </li>
      <?php } $ad++; endwhile; ?>
    </ul>
  </div>
<?php
						  if (function_exists(custom_pagination)) {
							custom_pagination($wp_query->max_num_pages,"",$current_page);
						  }
					?>  <?php 
   
	}
	else
	{
		?>
  <h3  style="font-family: 'FF DIN';">You are offside!</h3>
  <h4  style="font-family: 'FF DIN';">Keep trying and watch this space, you will find the goal soon enough!</h4>
  <?php
	}
  ?>
 
</div>
<div class="right">
  <?php
  $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='football-regions' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			?>
  <h2>&nbsp;</h2>
  <div class="ad_right" align="center"> <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
    <label style="font-size:10px;">ADVERTISEMENT</label>
  </div>
  <?php
		}
	}
		?>
  <h2>&nbsp;</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ 
      if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('suzuki-sidebar') ) ?>
    </ul>
  </div>
</div>
<?php get_footer();?>