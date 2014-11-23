<?php
/*
	Template Name: Suzuki Cup Template
*/
get_header(); ?>


 <div id="suzuki-header">
	<div class="baba">
		<a href="">#RedCardConnect</a>
		<a href="">#AFFSuzukiCup</a>
		<a href="">#LionKings</a>  
	</div>
	<div class="main">
		<div class="row" >
		   	<div class="col-sm-7">
		   		<h4 style="padding:8px 0 0 10px;margin:0px;">TOURNAMENT COVERAGE</h4>
		   	</div>
		   	<div class="col-sm-5">
			    <ul class="suzuki-menu">
			    	<li class="menu-item active"><a href="#">NEWS</a></li>
					<li class="menu-item "><a href="#">FIXTURES</a></li>
				</ul>
			</div>					
		</div>	
		<div class="row">
			<img class="col-sm-12" src="/suzuki-images/SuzukiCupiframe-900pxlwidth.jpg" style="width:600px;height:150px;margin:20px 30px"> 
		</div>
		<div style="clear:both;"></div>
	</div>
	
	
</div>

<style>
.main{ color: black; background: URL('/suzuki-images/slice.png') repeat-x; margin-top: 10px; width: 620px;}
.suzuki-menu{ float: right;}
#suzuki-header{background: URL('/suzuki-images/r1.jpg') 0 0; background-size: 100%; margin-top: 15px; }

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