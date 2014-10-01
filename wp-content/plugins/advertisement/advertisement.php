<?php
/**
 * @package syonPolicy
 * @version 1.0.0
 */
/*
Plugin Name: Red Card Advertisement
Plugin URI: http://www.fountaintechies.com/
Description: A direct way to add   advertisements.
Author: Fountain Technologies
Version: 1.0.0.0
Author URI: http://www.fountaintechies.com/
*/
add_action('admin_menu', 'add_program_menu1');
function add_program_menu1()
{
	add_menu_page(__('Advertisments','menu-test'), __('Advertisments','menu-test'), 'manage_options', 'manage-adverts', 'manage_Adverts' );
	
}
register_activation_hook( __FILE__, 'myplugin_activate1' );
register_deactivation_hook( __FILE__, 'myplugin_deactivation' );
function myplugin_activate1()
{
	global $wpdb;
	 $tablename=$wpdb->prefix."adverts";
	$mQuery="CREATE TABLE `$tablename` (
  `adId` int(11) NOT NULL auto_increment,
  `adimage` varchar(255) default NULL,
  `adlink` text,
  `isactive` enum('0','1') default '0',
  PRIMARY KEY  (`adId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$mSql=$wpdb->query($mQuery);
}
function myplugin_deactivation()
{
	global $wpdb;
	 $tablename=$wpdb->prefix."adverts";
	$mQuery="DROP TABLE $tablename";

$mSql=$wpdb->query($mQuery);
}

function m_filter_text1($str)
{
	$str=ltrim(rtrim(strip_tags($str)));
	return $str;
}
function manage_Adverts()
{
	?>
        <style type="text/css">
.mandatory {
	color: red;
}
.maindiv {
	width: 95%;
	height: 100%;
	padding: 20px;
}
</style>
        <?php  $url = plugins_url();?>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link id="bs-css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <link id="bsdp-css" href="<?php echo $url;?>/todayprogramme/datepicker3.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo $url;?>/todayprogramme/bootstrap-datepicker.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="box box-body">
<br/><br/>
<div class="col-md-6" style="background-color:#ebebeb;">
	<form action="" method="post" enctype="multipart/form-data">
    	<div class="form-group">
        	<label>Advertisement image</label>
        </div>
    </form>
</div>
&nbsp;
<div class="col-md-6"></div>
</div>

<?php
	
}
?>
