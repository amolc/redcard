<?php
/*
	Template Name: Suzuki Cup Template
*/
//get_header(); ?>
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
	<div class="baba">
		<a href="">#RedCardConnect</a>
		<a href="">#AFFSuzukiCup</a>
		<a href="">#LionKings</a>  
	</div>
	<div class="main row">
	   	<div class="col-sm-7">
	   		<h4 style="padding:8px 0 0 10px;margin:0px;">TOURNAMENT COVERAGE</h4>
	   	</div>
	   	<div class="menu-main-container col-sm-5">
		    <ul class="suzuki-menu">
		    	<li class="menu-item active"><a href="#">NEWS</a></li>
				<li class="menu-item "><a href="#">FIXTURES</a></li>
			</ul>
		</div> 
	</div>
	<img src="/suzuki-images/SuzukiCupiframe-900pxlwidth.jpg" style="width:600px;height:150px;margin:20px 30px">
</div>

<div id="social" class="right top">
      </div>
 
</div>
<style>
.main{height: 28px; color: black; background: URL('/suzuki-images/slice.png'); margin-top: 10px; width: 669px;}
.suzuki-menu{ float: right;}
#header{ width: 950px;
height: 290px;
display: block;
overflow: hidden;
margin: 0 auto;
background: URL('/suzuki-images/r1.jpg'); }

.news{ width: 50; display:block; background: URL('/suzuki-images/news.png'); }
.dada{width:50px; height:30px; display:block; overflow:hidden; margin:0 auto; }
.baba a{font-size:20px; color: #fff; margin-top: 10px; margin-bottom: 10px; margin-right: 15px; margin-left: 30px; }
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

<div id="container">
	<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>
<?php
get_sidebar();
get_footer();?>