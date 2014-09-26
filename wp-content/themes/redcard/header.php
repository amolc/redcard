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
<link href="<?php echo get_template_directory_uri(); ?>/slider/jquery.bxslider.css" rel="stylesheet"/>
<script src="<?php echo get_template_directory_uri(); ?>/slider/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/slider/jquery.bxslider.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	$('.bxslider').bxSlider({
		mode: 'fade',
		pager: false,
		captions: true
	});
  });
</script>
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
    <?php wp_nav_menu( array('menu' => 'Header' )); ?>
    <ul>
      <li class="seacrh-li">
        <?php dynamic_sidebar( 'search-menu' ); ?>
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
    <ul class="bxslider">
    <?php	//while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php // twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'home-latest-feature-image' ) );?><?php // echo get_the_title();?>
      <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/2.jpg" title="<label>The long and winding road</label><div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
      <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/1.jpg" title="Gerard Pique gets over Spain snub by watching basketball<div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
      <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/2.jpg" title="<label>The long and winding road</label><div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
       <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/2.jpg" title="<label>The long and winding road</label><div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
       <?php //endwhile; ?>
    </ul>
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
				    	foreach ( $recent_posts as $article ) {
							$thumb = get_the_post_thumbnail( $article[ID]);
						    $radtitle = $article['post_title'];
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="r-child home-radio-post list'.$i.'">'. get_the_post_thumbnail( $article[ID] ).'
	   							<h3><a href="'.get_permalink( $article[ID]).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
	   							<a href="#">In Added Time</a>
	   							<a href="'.get_permalink( $article[ID]).'" class="llink">Listen</a>
	   							<div id="social_2">
	   							<a href="http://www.facebook.com/share.php?u='.get_permalink( $article[ID]).'" target="_blank" title="Share on Facebook" ><div class="facebook"></div></a>
	   							<a href="#"><div class="twitter"></div></a>
	   							<a href="#"><div class="message"></div></a>
	   							</div>
	   							<span>1,290 views<span>
	   						</span></span></div>';
	   						$i++;
						}
				        echo '</div>';
				?>

<div class="box">
  <div class="left">
    <h1 class="h1">Latest News</h1>
	<?php	while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div id="l_n" class="home-latest-image">
    <?php $trimtitle = get_the_title();
	
		  $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '…' ); ?>
      <div class="img">
        <?php twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'home-latest-feature-image' ) );?>
        <span>Singapore</span> </div>
      <div class="text"> <a href="<?php the_permalink() ?>"><?php echo $shorttitle; ?></a>
      <?php $trimcontent = get_the_content();
		    $shortcontent = wp_trim_words( $trimcontent, $num_words = 10, $more = '…' ); ?>
      <p><?php echo $shortcontent; ?></p>
      <div class="date" id="date2"> <span>120 views</span>
          <div id="social_3">
            <div class="facebook"></div>
            <div class="twitter"></div>
            <div class="message"></div>
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
		   	$args = array( 'post_type' => 'tvideo','numberposts' => 1);
			$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
			 foreach($recent_posts as $row){
		?>
        <div class="vid"><?php echo $row['post_content']; ?></div>
        <?php }?>
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