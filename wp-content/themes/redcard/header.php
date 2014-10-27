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
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" type="image/x-icon"/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
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
			if($adsql->adimage1){
		?>
		
<div class="ad_1" align="center" style="margin-bottom: 2px;"><a href="<?php echo urldecode($adsql->adlink1);?>" target="_blank"><img width="731" height="93" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage1;?>" /></a>
<label style="font-size:9px;">ADVERTISEMENT</label>
</div>

		<?php
			}
		}
	}
}
 ?>
<?php if(is_front_page()){ ?>

<div class="box home-top-box">
  <div class="left">
    <h1 class="h1">Featured</h1>
    <div class="myslider" style="height:420px;">
      <div class="prevmain" style="cursor:pointer;color:#efefef;"><i class="fa fa-2x  fa-chevron-left"></i></div>
      <div id="mainSlider" style="height:420px;">
        <ul style="height:420px;">
          <?php 
             $selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_footballs_featured_checkbox'  ORDER BY RAND() LIMIT 0,5";
			 /*$selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_featured_featured_checkbox'  ORDER BY RAND() LIMIT 0,5";*/
             $resultarray = $wpdb->get_results($selectsql) ;

			 	
            if(!empty($resultarray)){
                $mstr="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;";
                foreach($resultarray as $row)
                {
					
					$tagLine = get_post_meta( $row->post_id, '_cmb_featured_tagline_text', true );  
                    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($row->post_id) );
         			 ?>
          <li>
        <a href="<?php echo get_permalink( $row->post_id);?>">  <img src="<?php echo $feat_image; ?>" height="350" width="621" title="<?php echo get_the_title( $row->post_id ); ?>" /></a>
            <div class="mainSliderDetail"  style="height:70px !important;">
             <span class="mstitle">
                 <p style="font-size: 18px; font-weight: 700; color: #fff; overflow: hidden; margin-bottom: 3px;"> <a href="<?php echo get_permalink( $row->post_id);?>" style="color:white;"> <?php //echo get_the_title( $row->post_id ); ?> </a></p>
                 <p style="color: #fff;font-size: 13px; font-weight:normal !important;"><?php  echo $tagLine ; ?></p>
             </span>
             <span class="mssocile" style="padding-top:8px;">
             <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink( $row->post_id);?>&description=<?php echo get_the_title( $row->post_id ); ?> "  title="Share on Facebook" ><span class='facebook'></span></a>
             <a href="http://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title( $row->post_id ));?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect&url="  ><span class='twitter'></span></a>
             <a  href="<?php echo get_permalink(  $row->post_id);?>#dis_comments"><span class='message'></span></a> <span class='viewcount'><?php //echo getPostViews($row->post_id);?></span> </span> </div>
          </li>
          <?php } } ?>
        </ul>
      </div>
      <div class="nextmain" style="cursor:pointer;color:#efefef;"><i class="fa fa-2x  fa-chevron-right"></i></div>
    </div>
    <script type="text/javascript">
		$(function() {
    		$("#mainSlider").jCarouselLite({
        		btnNext: ".nextmain",
        		btnPrev: ".prevmain",
				auto: 5000,
    			speed: 2000,
        		visible: 1
    		});
		});</script> 
  </div>
  <div class="right">
    <h1 class="homeRighth1" style=" margin: 22px 0 13px;">Connect With us</h1>
    <div id="connect"> Subscribe to our mailing list <?php echo do_shortcode('[gsom-optin]'); ?> </div>
    <!--  <h1>Tweets</h1> -->
    
    <div class="tweetcss" style="height:244px;"> <a class="twitter-timeline" href="https://twitter.com/RedCardConnect" data-widget-id="515153763913322496">Tweets by @RedCardConnect</a> 
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> </div>
  </div>
</div>
<?php
				    	echo '<div class="box" style=" margin-bottom: 10px;">';

						echo '<h1>Radio Soundbites</h1>';
				    	$args = array(
						'posts_per_page'   => 10,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
						);
						$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
				    	$i = 1;
						?>
<div id="list" style="height: 390px;">

  <div class="slider">
    <ul>
      <?php
				    	foreach ( $recent_posts as $article ) {
											
							$thumb = get_the_post_thumbnail( $article[ID]);							
						    $radtitle = $article['post_title'];
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '' );
						   $term_list_reg = wp_get_post_terms($article[ID], 'radio-shows');
      					   $mlink=(get_term_link( $term_list_reg[0] ));
						   $term_list_reg1 = wp_get_post_terms($article[ID], 'radio-categories');
      					   $mlink1=(get_term_link( $term_list_reg1[0] ));
						   echo '<li style="width:165px;margin-right: 19px;">
						   <div class="r-child home-radio-post list'.$i.'">'.get_the_post_thumbnail( $article[ID] ).'
	   							<h3 style="padding:5px 5px 12px;margin-top:0px !important; background:#333333;"><a href="'.get_permalink( $article[ID]).'" class="r-child-h3-a">'.$radtitle.'</a></h3>
								<a href="'.$mlink.'" style="margin-bottom:0px !important;">'.$term_list_reg[0]->name.':</a>  
								<a href="'.$mlink1.'" style="margin-top: 5px; margin-bottom: 15px;">'.$term_list_reg1[0]->name.'</a>
	   							<a href="'.get_permalink( $article[ID]).'" class="llink">Listen</a>
	   							<div id="social_2" style=" height: 55px;padding-top: 8px;">';
								$mtitle=str_replace("?","",$radtitle);
								?>
      <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink( $article[ID]);?>&description=<?php echo $radtitle;?>"  title="Share on Facebook" >
      <div class="facebook" ></div>
      </a> <a href="http://twitter.com/intent/tweet?text=<?php echo $mtitle;?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect&url="  >
      <div class="twitter"></div>
      </a> <a href="<?php echo get_permalink(  $article[ID]);?>#dis_comment">
      <div class="message"></div>
      </a>
      <?php
                                echo '</div>'/*.getPostViews($article[ID])*/.'</div></li>';
	   						$i++;
						}
						?>
    </ul>
  </div>

  <div class="prev"><img src="<?php echo get_template_directory_uri(); ?>/jcarousel/images/prev.jpg" alt="prev" /></div>
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
<div class="box" style=" margin-bottom: 10px;">
  <div class="left">
    <h1 class="h1">Latest News</h1>
    <?php $args = array( 'post_type' => 'footballs','order' => 'DESC','posts_per_page'   => 6);
	  $loop = new WP_Query( $args ); $as =1;?>
    <?php	while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div id="l_n" class="home-latest-image" style="height:370px;">
	<?php  $term_list_reg = wp_get_post_terms($post->ID, 'footballregions'); ?>
      <div class="img"><a href="<?php the_permalink() ?>"><?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'home-latest-feature-image' ) );?></a>
        <span><?php
		$g=0;
		foreach($term_list_reg as $mterm)
		{
			$m_array[$g]=$mterm->name;
			$g++;
		}
		$m_str=implode(",",$m_array);
		echo $m_str;
		 ?></span> </div>
      <div class="text">
      <div style="height:65px; overflow:hidden;">
      <a href="<?php the_permalink() ?>"  style="text-decoration:none;"><?php echo get_the_title(); ?></a>
      <div><span style="color: rgb(175, 175, 175); font-size:12px;"><?php the_time('l, F j, Y'); ?></span></div>
      </div>
        <?php $trimcontent = get_the_content();
		  $youtubtagline_value = get_post_meta( $post->ID, '_cmb_footballs_tagline_text', true ); 
		//  $shortcontent = wp_trim_words( $youtubtagline_value, $num_words = 10, $more = '…' ); ?>
          <p style="height:90px; margin-bottom:0;overflow:hidden;"><?php echo $youtubtagline_value; ?></p>
        <div class="date" id="date2"> <span>
		
		<?php //echo getPostViews(get_the_ID());?></span>
          <div id="social_3"> <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>&description=<?php echo get_the_title();?>"  title="Share on Facebook" >
            <div class="facebook" ></div>
            </a> <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?> <?php the_permalink() ?> via @RedCardConnect&url=" >
            <div class="twitter"></div>
            </a> <a href="<?php echo get_permalink( $article->ID);?>#dis_comments">
            <div class="message"></div>
            </a> </div>
        </div>
      </div>
    </div>
    <?php endwhile;?>
  </div>
  <div class="right">
    <h1 class="homeRighth1"  style="margin: 22px 0px 13px;">Featured Video</h1>
    <div class="ad_right">
      <div class="allvid">
        <?php 
	  
	 		 $selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_tvideo_featured_checkbox' ORDER BY RAND() LIMIT 0,1";
         $resultarray = $wpdb->get_results($selectsql) ;
		if(!empty($resultarray)){
			foreach($resultarray as $row)
			{
				 $youtubURL_values = get_post_meta( $row->post_id, '_cmb_tvideo_youtub_url', true ); 
				 
				 $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='280', $height='220');
	  ?>
        <div class="vid"><a href ="<?php echo $youtubURL_values; ?>"  rel="prettyPhoto"><?php echo $videoID; ?></a></div>
        <div class="view"><a href="<?php echo $youtubURL_values; ?>"  TARGET="_blank">View Video</a></div>
        <?php } } ?>
<script type="text/javascript" charset="utf-8">
    $("a[rel^='prettyPhoto']").prettyPhoto();
</script>
        
      </div>
       <?php if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			if($adsql->adimage2){
		?>
		
<div class="a d_1" align="center" style="margin-top: 25px;"><a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
<label style="font-size:10px;">ADVERTISEMENT</label>
</div>

		<?php
			}
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
