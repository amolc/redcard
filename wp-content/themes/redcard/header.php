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
<style>

.mainSliderDetail{ background-color: #000;height: 60px;width: 600px;}
.mainSliderDetail .mstitle{border: 0 solid #000;font-weight: 700;margin-left: 15px;margin-bottom: 5px;color: #fff;overflow: hidden;font-size: 18px;float: left;margin-top: 5px;width: 450px;}
.mainSliderDetail .mssocile{margin-top: 5px;float: left;width: 120px;margin-left: 10px;}
.mainSliderDetail .mssocile .facebook{
	background: url("<?php echo get_template_directory_uri(); ?>/img/social_4.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    float: left;height: 30px;padding: 0;width: 30px;}
.mainSliderDetail .mssocile .twitter{
	background: url("<?php echo get_template_directory_uri(); ?>/img/social_4.png") repeat scroll -30px 0 rgba(0, 0, 0, 0);
    float: left;height: 30px;padding: 0;width: 30px;}
.mainSliderDetail .mssocile	.message {
    background: url("<?php echo get_template_directory_uri(); ?>/img/social_4.png") repeat scroll -60px 0 rgba(0, 0, 0, 0);
    float: left;height: 30px;padding: 0;width: 30px;}
.viewcount{color: #428bca;float: left;}
.prevmain{ left: 1%;position: absolute;top: 39%;width: 20px;z-index: 999;}
.nextmain {position: absolute; right: 1%;top: 40%;z-index: 999;}

</style>
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
    <?php //shailan_dropdown_menu(); ?>
    <ul class="serch2">
      <li class="seacrh-li">
        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
	<button type="submit" class="search-submit" style="width:30px;" ><i class="fa fa-search"></i></button>
</form>
      </li>
    </ul>
  </div>
</div>
<div id="container">
<?php dynamic_sidebar( 'container-image' ); ?>
<?php if(is_front_page()){ ?>
<?php $args = array( 'post_type' => 'footballs','order' => 'DESC','numberposts' => 4);
	  $loop = new WP_Query( $args ); $as =1;?>
<div class="box">
  <div class="left">
    <h1 class="h1">Featured</h1>
    <div class="myslider">
        <div class="prevmain"><img src="<?php echo get_template_directory_uri(); ?>/jcarousel/images/prev.jpg" alt="prev" /></div>
        <div id="mainSlider">
        <ul >
      
          <?php 
          
                 $selectsql = "SELECT *  FROM `rd_postmeta` WHERE `meta_key` = '_cmb_footballs_featured_checkbox' ORDER BY RAND() LIMIT 0,5";
             $resultarray = $wpdb->get_results($selectsql) ;
            if(!empty($resultarray)){
                $mstr="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;";
                foreach($resultarray as $row)
                {
                    
                 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($row->post_id) );
          ?>
          <li><img src="<?php echo $feat_image; ?>" height="350" width="621" title="<?php echo get_the_title( $row->post_id ); ?>" /> 
          <div class="mainSliderDetail"> 
          <span class="mstitle"><?php echo get_the_title( $row->post_id ); ?> </span>
          <span class="mssocile">
          <span class='facebook'></span>
          <span class='twitter'></span>
          <span class='message'></span>
          <span class='viewcount'>1,200 views</span>
          
          </span>
        </div></li>
        <?php } }?>
           
        </ul>
        </div>
        <div class="nextmain"><img src="<?php echo get_template_directory_uri(); ?>/jcarousel/images/next.jpg" alt="next" /></div>
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
    <h1>Connect With us</h1>
    <div id="connect"> Subscribe to our mailing list 
      <?php echo do_shortcode('[gsom-optin]'); ?> </div>
  <!--  <h1>Tweets</h1> -->
 
   <div class="tweetcss"> <a class="twitter-timeline" href="https://twitter.com/RedCardConnect" data-widget-id="515153763913322496">Tweets by @RedCardConnect</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> </div>
    
    </div>
</div>

  
				<?php
				    	echo '<div class="box">';
						echo '<h1>Radio Soundbites</h1>';
				    	$args = array(
						'posts_per_page'   => 5,
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
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '?' );
						   echo '<li style="width:151px;margin-right: 15px;"><div class="r-child home-radio-post list'.$i.'">'. get_the_post_thumbnail( $article[ID] ).'
	   							<h3><a href="'.get_permalink( $article[ID]).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
	   							<a href="#">In Added Time</a>
	   							<a href="'.get_permalink( $article[ID]).'" class="llink">Listen</a>
	   							<div id="social_2">';
								//$mtitle=str_replace("?","",$radtitlefinal);
								?>
	   							  <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink(  $article[ID]));?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
           <a href="http://twitter.com/intent/tweet?text=<?php echo $mtitle;?> <?php echo get_permalink( $article[ID]);?> via @RedCardConnect&url="  ><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink(  $article[ID]);?>&body=<?php echo get_permalink(  $article[ID]);?>"><div class="message"></div></a>
        
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
	<?php	while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div id="l_n" class="home-latest-image">
    <?php  //$trimtitle = get_the_title();
	
		 // $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '…' ); ?>
      <div class="img">
        <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'home-latest-feature-image' ) );?>
        <span>Singapore</span> </div>
      <div class="text"> <a href="<?php the_permalink() ?>"  style="text-decoration:none;"><?php echo get_the_title(); ?></a>
      <?php $trimcontent = get_the_content();
		    $shortcontent = wp_trim_words( $trimcontent, $num_words = 10, $more = '…' ); ?>
      <p><?php echo $shortcontent; ?></p>
      <div class="date" id="date2"> <span>120 views</span>
          <div id="social_3">
             <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;" href="http://www.facebook.com/share.php?u=<?php echo urlencode(the_permalink());?>"  title="Share on Facebook" ><div class="facebook" ></div></a>
       <a href="http://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?> <?php the_permalink() ?> via @RedCardConnect&url=" ><div class="twitter"></div></a>
        <a onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=400');return false;"  target="_blank" href="mailto:?subject=<?php echo get_permalink( $article->ID);?>&body=<?php echo the_permalink();?>"><div class="message"></div></a>
        
          </div>
        </div>
      </div>
    </div>
    <?php endwhile;?>
  
  </div>
  <div class="right">
    <h1>Featured Video</h1>
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
      <?php dynamic_sidebar( 'postsponser' ); ?>
    </div>
    <h2>Popular Posts</h2>
    <div class="popular">
      <ul>
        <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar 1') ) ?>
      </ul>
    </div>
  </div>
</div>
<?php } ?>