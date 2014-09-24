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
<?php wp_head(); ?>
</head>

<body>
<div id="header">
  <div class="logo">
    <a href="/" title="Redcard">
      <img alt="Redcard" src="<?php echo get_option('site_logo'); ?>" />
    </a>
  </div>
  <div id="social" class="right top">
  <?php dynamic_sidebar( 'header-social' ); ?>
  <!--  <a href="#">
    <div class="facebook"></div>
   </a>
  <a href="#">
    <div class="twitter"></div>
   </a>
   <a href="#">
    <div class="insta"></div>
   </a>
   <a href="#">
    <div class="sound"></div>
   </a>
   <a href="#">
    <div class="youtube"></div>
   </a>
   <a href="#">
    <div class="line"></div>
   </a>-->
  </div>
</div>
<div id="menu">
<div class="menu_center">
<?php wp_nav_menu( array('menu' => 'Header' )); ?>
<ul><li class="seacrh-li"><?php dynamic_sidebar( 'search-menu' ); ?></li></ul></div>
</div>
<div id="container">
<?php dynamic_sidebar( 'container-image' ); ?>