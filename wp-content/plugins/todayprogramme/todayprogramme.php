<?php
/**
 * @package syonPolicy
 * @version 1.0.0
 */
/*
Plugin Name: Today Programme & Advertisement
Plugin URI: http://www.fountaintechies.com/
Description: A direct way to add today's programme and advertisements.
Author: Fountain Technologies
Version: 1.0.0
Author URI: http://www.fountaintechies.com/
*/
add_action('admin_menu', 'add_program_menu');
function add_program_menu()
{
	add_menu_page(__('Todays Prgoramme','menu-test'), __('Todays Prgoramme','menu-test'), 'manage_options', 'today-programme', 'today_programme' );
	
}
register_activation_hook( __FILE__, 'myplugin_activate' );

function myplugin_activate()
{
	global $wpdb;
	 $tablename=$wpdb->prefix."programmes";
	$mQuery="CREATE TABLE `$tablename` (
  `prgId` int(11) NOT NULL auto_increment,
  `prgTitle` varchar(255) default NULL,
  `prgdate` date default NULL,
  `prgfrom` time default NULL,
  `prgto` time default NULL,
  `prgtagline` text,
  PRIMARY KEY  (`prgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$mSql=$wpdb->query($mQuery);
}
function m_filter_text($str)
{
	$str=ltrim(rtrim(strip_tags($str)));
	return $str;
}
function today_programme()
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
<?php
global $wpdb;
 $tablename=$wpdb->prefix."programmes";
 	if(isset($_GET['delId']))
	{
		$delId=$_GET['delId'];
		$delQuery="delete from $tablename where prgId=$delId";
		$delSql=$wpdb->query($delQuery);
	}
  if(isset($_POST['action']))
{
	$action=$_POST['action'];
	if($action=="action")
	{
	
		$prgtitle=m_filter_text($_POST['prgtitle']);
		$prgdate=m_filter_text($_POST['prgdate']);
		$prgdate=str_replace("/","-",$prgdate);
		$fromhour=m_filter_text($_POST['fromhour']);
		$frommin=m_filter_text($_POST['frommin']);
		$tohour=m_filter_text($_POST['tohour']);
		$tomin=m_filter_text($_POST['tomin']);
		$tagline=m_filter_text($_POST['tagline']);
		$fromtime=$fromhour.":".$frommin;
		$totime=$tohour.":".$tomin;		
		if($tohour<$fromhour)
		{
			?>
			<div class="alert alert-danger">Error, From time must be earlier then to time.</div>
			<?php
		}
		else
		{
		 $checkQuery="select * from $tablename where prgTitle='$prgtitle' and prgdate='$prgdate' and prgfrom='$fromtime' and prgto='$totime' and prgtagline='$tagline'";
		$checkSql=$wpdb->get_results($checkQuery);
		if(sizeof($checkSql)>0)
		{
			?>
			<div class="alert alert-danger">Error, Duplicate submission detected.</div>
			<?php
		}
		else
		{
		$insertQuery="insert into $tablename(prgTitle,prgdate,prgfrom,prgto,prgtagline)";
		$insertQuery.="values('$prgtitle','$prgdate','$fromtime','$totime','$tagline')";
		$insertSql=$wpdb->query($insertQuery);
	
		}
		}
		
	}
}
?>
 <div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="action" value="yes" />
 
  <div class="form-group">
    <label>Title <span class="mandatory">*</span></label>
    <input type="text" name="prgtitle" id="prgtitle" class="form-control" required  />
  </div>
  <div class="form-group">
    <label>Date <span class="mandatory">*</span></label>
    
    <input type="text" name="prgdate" id="prgdate"  data-date-format="yyyy-mm-dd" class="form-control datepicker" required />
    <script type="text/javascript">
	var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     var checkin = $('#prgdate').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
    }
    checkin.hide();
   
	});
				</script> 
                </div>
                <div class="form-group">
                <label>Time </label>
               	<br/>
                <select id="fromhour" name="fromhour" style="width:60px;"> 
                	<option value="null">HH</option>
                    <?php for($i=0;$i<24;$i++)
					{
						if($i<10)
						{
							$i1="0".$i;
						}
						else
						{
							$i1=$i;
						}
						?>
						<option value="<?php echo $i1;?>"><?php echo $i1;?></option>
						<?php 
					}
					?>
                </select>
                <select id="frommin" name="frommin" style="width:60px;"> 
                	<option value="null">MM</option>
                    <?php for($i=0;$i<60;$i++)
					{
						if($i<10)
						{
							$i1="0".$i;
						}
						else
						{
							$i1=$i;
						}
						?>
						<option value="<?php echo $i1;?>"><?php echo $i1;?></option>
						<?php 
					}
					?>
                </select>
                To
                <select id="tohour" name="tohour" style="width:60px;"> 
                	<option value="null">HH</option>
                    <?php for($i=0;$i<24;$i++)
					{
						if($i<10)
						{
							$i1="0".$i;
						}
						else
						{
							$i1=$i;
						}
						?>
						<option value="<?php echo $i1;?>"><?php echo $i1;?></option>
						<?php 
					}
					?>
                </select>
                <select id="tomin" name="tomin" style="width:60px;"> 
                	<option value="null">MM</option>
                    <?php for($i=0;$i<60;$i++)
					{
						if($i<10)
						{
							$i1="0".$i;
						}
						else
						{
							$i1=$i;
						}
						?>
						<option value="<?php echo $i1;?>"><?php echo $i1;?></option>
						<?php 
					}
					?>
                </select>
                </div>
                <div class="form-group">
                <label>TagLine</label>
                <textarea name="tagline" id="tagline" class="form-control" ></textarea>
                </div>
                <div  align="right">
                <button type="submit" class="btn btn-primary">Save Programme</button>
                </div>
                
 
</form>
 </div>
  <div class="col-md-6">
  &nbsp;
  </div>
  <br/>  <br/>  <br/>
<div class="col-md-12">
<?php 
		$allquery="select * from $tablename where prgdate>now()";
		$allsql=$wpdb->get_results($allquery);
		if(sizeof($allsql)>0)
		{
			?>
			<table class="table table-responsive table-bordered">
            	<thead>
                	<th>#</th>
                	<th>Title</th>                    
                	<th>Date</th> 
                    <th>Time</th>                                         
                    <th>TagLine</th>                                                             
                    <th>&nbsp;</th>  
                    <tbody>
                    	<?php 
						$sno=1;
						foreach($allsql as $mysql)
						{
							?>
							<td><?php echo $sno++;?></td>
                            	<td><?php echo $mysql->prgTitle;?></td>
                                	<td><?php echo $mysql->prgdate;?></td>
                                     	<td><?php echo $mysql->prgfrom;?></td>
                                               	<td><?php echo $mysql->prgtagline;?></td>
                                                   	<td style="text-align:right;">

                                                  <a href="admin.php?page=today-programme&delId=<?php echo $mysql->prgId;?>"><i class="fa fa-ban mandatory"></i></a></td>
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
<br/>
<div class="box box-body">
		
</div>
<?php
}
?>
