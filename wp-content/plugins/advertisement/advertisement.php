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
.mhidden{
	display:none;
}
</style>
        <?php  $url = plugins_url();?>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link id="bs-css" href="<?php echo $url;?>/advertisement/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $url;?>/advertisement/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript">
function validate_advert_form()
{
	var advertimage1=mtrim(document.getElementById("advertimage1").value).toLowerCase();
	var advertimage2=mtrim(document.getElementById("advertimage2").value).toLowerCase();
	var adlink=mtrim(document.getElementById("adlink").value);
	var bgimage=mtrim(document.getElementById("bgimage").value).toLowerCase();
	var bgcss=mtrim(document.getElementById("bgcss").value).toLowerCase();
	var adlink=mtrim(document.getElementById("adlink").value);
	
	if((advertimage1.indexOf(".png")<=0) && (advertimage1.indexOf(".jpg")<=0) && (advertimage1.indexOf(".png")<=0))
	{
		document.getElementById("errormsg").style.display="block";
		document.getElementById("errormsg").innerHTML="Error, Invalid advertisement image I";
		return false;
	}
	if((advertimage2.indexOf(".png")<=0) && (advertimage2.indexOf(".jpg")<=0) && (advertimage2.indexOf(".png")<=0))
	{
		document.getElementById("errormsg").style.display="block";
		document.getElementById("errormsg").innerHTML="Error, Invalid advertisement image II";
		return false;
	}
	if(bgimage.length>0)
	{
				if((bgimage.indexOf(".png")<=0) && (bgimage.indexOf(".jpg")<=0) && (bgimage.indexOf(".png")<=0))
				{
					document.getElementById("errormsg").style.display="block";
					document.getElementById("errormsg").innerHTML="Error, Invalid Background image";
					return false;
				}
	}
	if(bgcss.length>0)
	{
			if((bgcss.indexOf(".css")<=0))
			{
				document.getElementById("errormsg").style.display="block";
				document.getElementById("errormsg").innerHTML="Error, Invalid background css";
				return false;
			}
	}
	 var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
    if (!re.test(adlink)) { 
             document.getElementById("errormsg").style.display="block";
    document.getElementById("errormsg").innerHTML="Error, Invalid advertisement link";
              return false;
         }
					
}

function mtrim(str)
{
	str=str.replace(/\s+/,'');
	return str;
}
</script>
<div class="box box-body">
<br/><br/>
<?php 
if(isset($_POST['plaction']))
{
	if($_POST['plaction']=="submit")
	{
	$advertimage1=$_FILES['advertimage1'];
	$advertimage2=$_FILES['advertimage2'];
	$bgimage=$_FILES['bgimage'];
	$bgcss=$_FILES['bgcss'];
	$displayonpage=$_POST['displayonpage'];
	$text=$_POST['text'];
	$isactive=$_POST['isactive']['0'];
	$movepath=get_plugin_dir();
	echo $movepath;
	}
}
?>
<div class="col-md-6" style="background-color:#fff;padding-top:10px;" >
	<div class="alert alert-danger mhidden" id="errormsg"></div>
	<form action="" method="post" enctype="multipart/form-data" onsubmit="return validate_advert_form()">
    <input type="hidden" name="plaction" id="plaction" value="submit" />
    	<div class="form-group">
        	<label>Advertisement image I(Rectangular)</label>
            <input type="file" name="advertimage1" id="advertimage1" required />
        </div>
        <div class="form-group">
        	<label>Advertisement image II(Square)</label>
            <input type="file" name="advertimage2" id="advertimage2" required />
        </div>
         <div class="form-group">
        	<label>Advertisement Link</label>
            <input type="text" name="adlink" id="adlink" required class="form-control" />
        </div>
        <div class="form-group">
        	<label>Background Image</label>
            <input type="file" name="bgimage" id="bgimage"  />
        </div>
        <div class="form-group">
        	<label>Background CSS</label>
            <input type="file" name="bgcss" id="bgcss"  />
        </div>
        <div class="form-group">
        	<label>Display On Page</label>
				<select name="displayonpage" id="displayonpage" class="form-control">
                	<option value="home">Home Page</option>
                	<option value="tv-articles">Tv Articles</option>
                	<option value="radio-articles">Radio Articles</option>
                	<option value="tv-shows">Tv Shows</option>
                	<option value="radio-shows">Radio Shows</option>                    
                	<option value="football">Football</option>                                        
                	<option value="other-sports">Other Sports</option>                                        
			   </select>
        </div>
        <div class="form-group">
        	<label>Is Published</label>
            <input type="radio" name="isactive[]" id="isactive" value="1" checked> Yes
            <input type="radio" name="isactive[]" id="isactive" value="0"  > No            
        </div>
        <div class="form-group" align="right">
        	<button type="submit" class="btn btn-primary">Add Avertisement</button>
        </div>
    </form>
</div>
&nbsp;
<div class="col-md-6">

</div>
</div>

<?php
	
}
?>
