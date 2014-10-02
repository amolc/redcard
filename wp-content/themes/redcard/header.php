<?php
/**
 * The Header for our theme
 * Displays all of the <head> section and everything up till <div id="main">
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/slider/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/prettyphoto/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo get_template_directory_uri(); ?>/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jcarousel/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jcarousel/js/jcarousellite_1.0.1.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jcarousel/js/captify.tiny.js"></script>
<?php wp_head(); ?>
</head>

<body>
<div id="header">
  <div class="logo"> <a href="<?php echo site_url(); ?>" title="Redcard"> <img alt="Redcard" src="<?php echo get_option('site_logo'); ?>" /> </a> </div>
  <div id="social" class="right top">
    <?php dynamic_sidebar( 'header-social' ); ?>
  </div>
</div>

<div id="menu">
  <div class="menu_center">
    <?php  wp_nav_menu( array('menu' => 'Header2' )); ?>
    <ul class="serch2">
      <li class="seacrh-li">
        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
          <label> <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
          </label>
          <button type="submit" class="search-submit" style="width:30px;background: #000;border: medium none;" ><i class="fa fa-search" style="color: #fff;"></i></button>
        </form>
      </li>
    </ul>
  </div>
</div>
<div id="container">
<?php 
if(is_front_page()){
	$m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='home' and isactive='1' order by adId DESC LIMIT 0,1";
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
}
 ?>
<?php if(is_front_page()){ ?>

<div class="box home-top-box">
  <div class="left">
    <h1 class="h1">Featured</h1>
    <div class="myslider">
      <div class="prevmain"><i class="fa fa-2x fa-arrow-left"></i></div>
      <div id="mainSlider">
        <ul >
          <?php 
             $selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_footballs_featured_checkbox'  ORDER BY RAND() LIMIT 0,5";
             $resultarray = $wpdb->get_results($selectsql) ;

			 	
            if(!empty($resultarray)){
                $mstr="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;";
                foreach($resultarray as $row)
                {
					$tagLine = get_post_meta( $row->post_id, '_cmb_footballs_tagline_text', true );  
                  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($row->post_id) );
          ?>
          <li><img src="<?php echo $feat_image; ?>" height="350" width="621" title="<?php echo get_the_title( $row->post_id ); ?>" />
            <div class="mainSliderDetail">
             <span class="mstitle">
                 <p style="font-size: 18px; font-weight: 700; color: #fff; overflow: hidden; margin-bottom: 3px;"><?php echo get_the_title( $row->post_id ); ?> </p>
                 <p style="color: #fff;font-size: 13px;font-weight: bold;"><?php  echo $tagLine ; ?></p>
             </span>
             <span class="mssocile"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_the_title( $row->post_id );?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect"  title="Share on Facebook" ><span class='facebook'></span></a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title( $row->post_id );?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect&url="  ><span class='twitter'></span></a> <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink(  $article[ID]);?>&body=<?php echo get_permalink(  $article[ID]);?>"><span class='message'></span></a> <span class='viewcount'>1,200 views</span> </span> </div>
          </li>
          <?php } }?>
        </ul>
      </div>
      <div class="nextmain"><i class="fa fa-2x fa-arrow-right"></i></div>
    </div>
    <script type="text/javascript">
		$(function() {
    		$("#mainSlider").jCarouselLite({
        		btnNext: ".nextmain",
        		btnPrev: ".prevmain",
        		visible: 1
    		});
		});</script> 
  </div>
  <div class="right">
    <h1 class="homeRighth1">Connect With us</h1>
    <div id="connect"> Subscribe to our mailing list <?php echo do_shortcode('[gsom-optin]'); ?> </div>
    <!--  <h1>Tweets</h1> -->
    
    <div class="tweetcss"> <a class="twitter-timeline" href="https://twitter.com/RedCardConnect" data-widget-id="515153763913322496">Tweets by @RedCardConnect</a> 
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> </div>
  </div>
</div>
<?php
				    	echo '<div class="box">';
						echo '<h1>Radio Soundbites</h1>';
				    	$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
						);
						$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
				    	$i = 1;
						?>
<div id="list">
  <div class="prev"><img src="<?php echo get_template_directory_uri(); ?>/jcarousel/images/prev.jpg" alt="prev" /></div>
  <div class="slider">
    <ul>
      <?php
				    	foreach ( $recent_posts as $article ) {
											
							$thumb = get_the_post_thumbnail( $article[ID]);							
						    $radtitle = $article['post_title'];
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '' );
						   echo '<li style="width:156px;margin-right: 10px;"><div class="r-child home-radio-post list'.$i.'">'. get_the_post_thumbnail( $article[ID] ).'
	   							<h3><a href="'.get_permalink( $article[ID]).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
	   							<a href="#">In Added Time</a>
	   							<a href="'.get_permalink( $article[ID]).'" class="llink">Listen</a>
	   							<div id="social_2">';
								$mtitle=str_replace("?","",$radtitlefinal);
								?>
      <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo $mtitle;?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo $mtitle;?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect&url="  >
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink(  $article[ID]);?>#dis_comment">
      <div class="message"></div>
      </a>
      <?php
                                echo '</div>
	   							<span>1,290 views<span>
	   						</span></span></div></li>';
	   						$i++;
						}
						?>
    </ul>
  </div>
  <div class="next"><img src="<?php echo get_template_directory_uri(); ?>/jcarousel/images/next.jpg" alt="next" /></div>
</div>
<?php
				        echo '</div>';
				?>
<script type="text/javascript">
		$(function() {
    		$(".slider").jCarouselLite({
        		btnNext: ".next",
        		btnPrev: ".prev",
        		visible: 5
    		});
		});</script>
<div class="box">
  <div class="left">
    <h1 class="h1">Latest News</h1>
    <?php $args = array( 'post_type' => 'footballs','order' => 'DESC','numberposts' => 4);
	  $loop = new WP_Query( $args ); $as =1;?>
    <?php	while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div id="l_n" class="home-latest-image">
 
      <div class="img">
        <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'home-latest-feature-image' ) );?>
        <span>Singapore</span> </div>
      <div class="text"> <a href="<?php the_permalink() ?>"  style="text-decoration:none;"><?php echo get_the_title(); ?></a>
        <?php $trimcontent = get_the_content();
		    $shortcontent = wp_trim_words( $trimcontent, $num_words = 10, $more = '…' ); ?>
        <p><?php echo $shortcontent; ?></p>
        <div class="date" id="date2"> <span>120 views</span>
          <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_the_title(); ?> <?php the_permalink() ?> via @RedCardConnect"  title="Share on Facebook" >
            <div class="facebook" ></div>
            </a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?> <?php the_permalink() ?> via @RedCardConnect&url=" >
            <div class="twitter"></div>
            </a> <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo the_permalink();?>">
            <div class="message"></div>
            </a> </div>
        </div>
      </div>
    </div>
    <?php endwhile;?>
  </div>
  <div class="right">
    <h1 class="homeRighth1">Featured Video</h1>
    <div class="ad_right">
      <div class="allvid">
        <?php 
	  
	 		 $selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_featured_checkbox' ORDER BY RAND() LIMIT 0,1";
         $resultarray = $wpdb->get_results($selectsql) ;
		if(!empty($resultarray)){
			foreach($resultarray as $row)
			{
				 $youtubURL_values = get_post_meta( $row->post_id, '_cmb_tvideo_youtub_url', true ); 
				 
				 $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='300', $height='220');
	  ?>
        <div class="vid"><a href ="<?php echo $youtubURL_values; ?>" rel="prettyPhoto"><?php echo $videoID; ?></a></div>
        <?php }}?>
        <script type="text/javascript" charset="utf-8">

    $("a[rel^='prettyPhoto']").prettyPhoto();

</script>
        <div class="view"><a href="<?php echo site_url(); ?>/tv">View All Videos</a></div>
      </div>
      <br/>
      <br/>
      <?php if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
		?>
		
<div class="a d_1" align="center"><a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
</div>

		<?php
		}
	} ?>
    </div>
    <h2>Popular Posts</h2>
    <div class="popular">
      <ul>
        <?php  if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
      </ul>
    </div>
  </div>
</div>
<?php } ?>
