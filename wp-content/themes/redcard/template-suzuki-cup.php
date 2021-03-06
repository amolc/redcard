<?php
/*
	Template Name: Suzuki Cup Template
*/
get_header(); ?>


 <div id="suzuki-header">
	<div class="main">
		<div class="row" >
		   	<div class="col-sm-6">
		   		<h4 style="padding:8px 0 0 10px;margin:0px;color:#028f44; ">TOURNAMENT COVERAGE</h4>
		   	</div>
		   	<div class="col-sm-6">
			    <ul class="suzuki-menu">
			    	<li class="menu-item "><a href="http://redcardconnect.com/footballtags/aff-suzuki-cup/">NEWS</a></li>
					<li class="menu-item active"><a href="/suzuki-fixtures">FIXTURES</a></li>
				</ul>
			</div>					
		</div>	
		<?php if (has_post_thumbnail( $post->ID ) ): ?>
      <div class="row">
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>      
      <a class="col-sm-12" >
      <img src="<?php echo $image[0]; ?>" style="height:150px;margin:20px 30px"> 
      </a>
      </div>
      <?php endif; ?>
		<div style="clear:both;"></div>
	</div>
	
	
</div>

<style>
.main{ color: black; background: URL('/suzuki-images/slice.png') repeat-x; margin-top: 10px; width: 620px;}
.suzuki-menu{ float: right;}
#suzuki-header{ padding: 10px 0;
	background: URL('/suzuki-images/r1.jpg') 0 0; background-size: 100%; margin-top: 15px; font-family: 'FF DIN'; }

.news{ width: 50; display:block; background: URL('/suzuki-images/news.png'); }
.dada{width:50px; height:30px; display:block; overflow:hidden; margin:0 auto; }

.raj{background:URL('/suzuki-images/r.jpg'); }
.suzuki-menu > li a{ color: #fff;}
.suzuki-menu > li{ width: 96px;
	margin: 0 20px;
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


<div class="left">
	<h2>Football &gt; <span style="color:#028f44;">AFF Suzuki Cup</span> </h2>
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>

</div>

<div class="right">
 
  <?php
  $m_table=$wpdb->prefix."adverts";
	$advertQuery="select * from $m_table where page='football-opinions' and isactive='1' order by adId DESC LIMIT 0,1";
	$advertSql=$wpdb->get_results($advertQuery);
	
	if(sizeof($advertSql)>0)
	{
		foreach($advertSql as $adsql)
		{
			?>
			 <h2>&nbsp;</h2>
			  <div class="ad_right" align="center">
              <a href="<?php echo urldecode($adsql->adlink2);?>" target="_blank"><img width="302" height="252" alt="" class="attachment-full" style="max-width: 100%;" src="<?php echo plugins_url();?>/advertisement/<?php echo $adsql->adimage2;?>" /></a>
              <label style="font-size:10px;">ADVERTISEMENT</label>
              </div>
			<?php
		}
	}
		?>
  
  
  <h2>&nbsp;</h2>
  <div class="popular">
    <ul>
      <?php /* For Popular Posts*/ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('suzuki-sidebar-fixture') ) ?>
     
    </ul>
  </div>
 
</div>

<?php get_footer();?>