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
<div class="box">
  <div class="left">
    <h1 class="h1">Featured</h1>
    <ul class="bxslider">
      <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/1.jpg" title="Gerard Pique gets over Spain snub by watching basketball<div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
      <li><img src="<?php echo get_template_directory_uri(); ?>/img/slider/2.jpg" title="<label>The long and winding road</label><div><span class='facebook'></span><span class='twitter'></span><span class='message'></span>1,200 views</div>" /></li>
    </ul>
  </div>
  <div class="right">
    <h1>Connect With us</h1>
    <div id="connect"> Subscribe to our mailing list 
      <!--<input type="text"/>
							<input type="submit" name="submit" value="Submit"/>--> 
      <?php echo do_shortcode('[gsom-optin]'); ?> </div>
    <h1>Tweets</h1>
    <img src="<?php echo get_template_directory_uri(); ?>/img/tweets.png"/> </div>
</div>
<div class="box">
  <h1>Radio Soundbites</h1>
  <div class="r-child"> <img src="<?php echo get_template_directory_uri(); ?>/img/radio_segments/1.jpg" />
    <h3>Live transfer updates</h3>
    <a href="#">In Added Time</a>
    <button>Listen</button>
    <div id="social_2"> <a href="#">
      <div class="facebook"></div>
      </a> <a href="#">
      <div class="twitter"></div>
      </a> <a href="#">
      <div class="message"></div>
      </a> </div>
    <span> 1,200 views </span> </div>
  <div class="r-child"> <img src="<?php echo get_template_directory_uri(); ?>/img/radio_segments/2.jpg" />
    <h3>Falcao on bench against QPR</h3>
    <a href="#">Throwback Thursday</a>
    <button>Listen</button>
    <div id="social_2"> <a href="#">
      <div class="facebook"></div>
      </a> <a href="#">
      <div class="twitter"></div>
      </a> <a href="#">
      <div class="message"></div>
      </a> </div>
    <span> 700 views </span> </div>
  <div class="r-child"> <img src="<?php echo get_template_directory_uri(); ?>/img/radio_segments/3.jpg"/>
    <h3>Casillas accepts fan whistles</h3>
    <a href="#">In Added Time</a>
    <button>Listen</button>
    <div id="social_2"> <a href="#">
      <div class="facebook"></div>
      </a> <a href="#">
      <div class="twitter"></div>
      </a> <a href="#">
      <div class="message"></div>
      </a> </div>
    <span> 1,200 views </span> </div>
  <div class="r-child"> <img src="<?php echo get_template_directory_uri(); ?>/img/radio_segments/4.jpg"/>
    <h3>Van Gaal seeks more balance</h3>
    <a href="#">Throwback Thursday</a>
    <button>Listen</button>
    <div id="social_2"> <a href="#">
      <div class="facebook"></div>
      </a> <a href="#">
      <div class="twitter"></div>
      </a> <a href="#">
      <div class="message"></div>
      </a> </div>
    <span> 700 views </span> </div>
  <div class="r-child last"> <img src="<?php echo get_template_directory_uri(); ?>/img/radio_segments/5.jpg"/>
    <h3>David Moyes for Newcastle</h3>
    <a href="#">Throwback Thursday</a>
    <button>Listen</button>
    <div id="social_2"> <a href="#">
      <div class="facebook"></div>
      </a> <a href="#">
      <div class="twitter"></div>
      </a> <a href="#">
      <div class="message"></div>
      </a> </div>
    <span> 700 views </span> </div>
</div>
<div class="box">
  <div class="left">
    <h1 class="h1">Latest News</h1>
    <?php 
		
			$args = array( 'post_type' => 'footballs','order' => 'DESC','numberposts' => 6);
			$loop = new WP_Query( $args ); $as =1;
			while ( $loop->have_posts() ) : $loop->the_post();
?>
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
    
    <!--<div id="l_n" class="l_l">
							<div class="img">
								<img src="<?php // echo get_template_directory_uri(); ?>/img/news/2.jpg"/>
								<span>Europe</span>
							</div>
							<h1>Van Gaal sees Blind as defensive midfielder</h1>
							<p>
								There were more questions than answers following James Rodriguez's 80 million euro move from Monaco to Real Madrid.
							</p>
							<div class="date" id="date2">
								<span>120 views</span>
								<div id="social_3">
									<div class="facebook"></div>
									<div class="twitter"></div>
									<div class="message"></div>
								</div>
							</div>
						</div>--> 
    
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
