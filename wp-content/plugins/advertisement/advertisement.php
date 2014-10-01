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
function get_extension($str)
{
	$str=explode(".",$str);
	$str=$str[sizeof($str)-1];
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
				<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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

	global $wpdb;
	 $tablename=$wpdb->prefix."adverts";
	 
	 if(isset($_GET['delId']))
	 {
		 $delId=$_GET['delId'];
		 $delQuery=$wpdb->query("delete from $tablename where adId=$delId");
		 
	 }
if(isset($_POST['plaction']))
{
	
	if($_POST['plaction']=="submit")
	{
	$advertimage1=$_FILES['advertimage1'];
	$advertimage2=$_FILES['advertimage2'];
	$bgimage=$_FILES['bgimage'];
	$bgcss=$_FILES['bgcss'];
	$displayonpage=$_POST['displayonpage'];
	$adlink=$_POST['adlink'];
	$isactive=$_POST['isactive']['0'];
	$movepath=plugin_dir_path(__FILE__);
	$movepath.="uploads/";
	$movepath1=plugin_dir_path(__FILE__);
	
			
	$adpath1=$movepath."ad1XX".time().".".get_extension($advertimage1['name']);
	$adpath2=$movepath."ad2XX".time().".".get_extension($advertimage2['name']);
	$bgpath=$movepath."bgXX".time().".".get_extension($bgimage['name']);		
	$csspath=$movepath."styleXX".time().".".get_extension($bgcss['name']);
	$move1=move_uploaded_file($advertimage1['tmp_name'],$adpath1);		
	$move2=move_uploaded_file($advertimage2['tmp_name'],$adpath2);		
	$move3=move_uploaded_file($bgimage['tmp_name'],$bgpath);		
	$move4=move_uploaded_file($bgcss['tmp_name'],$csspath);		
	if($move1 && $move2)
	{
		$adpath1=str_replace($movepath1,'',$adpath1);
		$adpath2=str_replace($movepath1,'',$adpath2);
		$bgpath=str_replace($movepath1,'',$bgpath);
		$csspath=str_replace($movepath1,'',$csspath);
		$adlink=urlencode($adlink);
		
								
		$insertquery="insert into $tablename(adimage1,adimage2,adlink,bgcss,bgimage,page,isactive,addate)values('$adpath1','$adpath2','$adlink','$csspath','$bgpath','$displayonpage','$isactive',now())";
		$insertsql=$wpdb->query($insertquery);
	
		if($insertsql)
		{
			?>
			<br/>
            <div class="alert alert-success " style="width:50%;" >Advertisement added successfully.</div>
			<?php
		}
	}
	
	}
}
?>
<div class="col-md-6" style="background-color:#fff;padding-top:10px;" >
	<div class="alert alert-danger mhidden" id="errormsg"></div>
	<form action="" method="post" enctype="multipart/form-data" onsubmit="return validate_advert_form()">
    <input type="hidden" name="plaction" id="plaction" value="submit" />
    	<div class="form-group">
        	<label>Advertisement image I (Rectangular)</label>
            <input type="file" name="advertimage1" id="advertimage1" required />
        </div>
        <div class="form-group">
        	<label>Advertisement image II (Square)</label>
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

<div class="col-md-12">
<br/><br/>
<?php 
		$allquery="select * from $tablename order by addate DESC";
		$allsql=$wpdb->get_results($allquery);
		if(sizeof($allsql)>0)
		{
			?>
			<table class="table table-responsive table-bordered">
            	<thead>
                	<th>#</th>
                	<th>Link</th>                    
                	<th>Ad Images</th> 
                    <th>Display On Page</th>                                         
                    <th>Published</th>                                                             
                    <th>&nbsp;</th>  
                    <tbody>
                    	<?php 
						$sno=1;
						$pluginurl=plugin_dir_url(__FILE__);
						foreach($allsql as $mysql)
						{
							?>
                            <tr>
							<td><?php echo $sno++;?></td>
                            	<td><a href="<?php echo urldecode($mysql->adlink);?>"><?php echo urldecode($mysql->adlink);?></a></td>
                                	
                                     	<td>
                                    <A href="<?php echo $pluginurl;?><?php echo $mysql->adimage1;?>" target="_blank" ><img src="<?php echo $pluginurl;?><?php echo $mysql->adimage1;?>" width="100" height="13" /></A>
                                    <A href="<?php echo $pluginurl;?><?php echo $mysql->adimage2;?>" target="_blank" ><img src="<?php echo $pluginurl;?><?php echo $mysql->adimage2;?>" width="100" height="100" /></A>
                                        
                                        </td>
                                        <td><?php echo $mysql->page;?></td>
                                               	<td>
												<?php if($mysql->isactive)
												{
													echo "Yes";
												}
												else
												{
													echo "No";
												}
												?>
                                                
                                                </td>
                                                   	<td style="text-align:right;">

                                                  <a href="admin.php?page=manage-adverts&delId=<?php echo $mysql->adId;?>"><i class="fa fa-ban mandatory"></i></a></td>
                                                  </tr>
							<?php
						}
						?>
                    </tbody>                                                                               
                </thead>
            </table>
			<?php
		}
?>
</div>
</div>

<?php
	
}
?>
