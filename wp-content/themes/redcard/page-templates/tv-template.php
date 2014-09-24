<?php
/**
 * Template Name: TV template Page
 */
get_header(); 

?>
<img src="<?php echo get_template_directory_uri(); ?>/img/tv_slide.jpg" class="tv_slide"/>
<div class="box">
					<div class="s">
						<h1>On Tonight</h1>
						<ul>
							<li>	
								<span class="date">Monday, 15 September 2014</span>
								<h2>David Chidgey (Chelsea Fancast)</h2>
								<p>10.30 am to 11.30am<br/> Drivetime</p>
							</li>
							<li>	
								<span class="date">Monday, 15 September 2014</span>
								<h2>David Chidgey (Chelsea Fancast)</h2>
								<p>10.30 am to 11.30am<br/> Drivetime</p>
							</li>
						</ul>
						<a href="#">View all schedule</a>
					</div>
					
					<div class="b">
						<h1>Featured Video</h1>
						<iframe width="340" height="255" src="http://www.youtube.com/embed/g5xT54X9mIM" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="b" id="no-border">
						<h1>Sponsor</h1>
						<?php dynamic_sidebar( 'postsponser' ); ?>
					</div>
				</div> <!-- end box -->
		
<div class="box">
					<h1>Video Segments</h1>
					<div class="child">
						<img src="<?php echo get_template_directory_uri(); ?>/img/video_segments/1.jpg"/>
						<a href="#">Casting Season 6</a>
						<p>We need homecooks! Do you have what it takes to be the next MASTERCHEF?</p>
						<span>Drivetime</span>
					</div>
					
					<div class="child">
						<img src="<?php echo get_template_directory_uri(); ?>/img/video_segments/2.jpg"/>
						<a href="#">So you think you can dance?</a>
						<p>Your Top 10 Season 11 dancers are going on tour!</p>
						<span>Crossbar Challenge</span>
					</div>
					
					
					<div class="child" id="no-margin">
						<img src="<?php echo get_template_directory_uri(); ?>/img/video_segments/3.jpg"/>
						<a href="#">Gotham</a>
						<p>Watch The Legend Reborn Preview Special, Series Premiere MON Sept 22 at 8/7c!</p>
						<span>Two Guys, One Mic</span>
					</div>
					
					<div class="child">
						<img src="<?php echo get_template_directory_uri(); ?>/img/video_segments/4.jpg"/>
						<a href="#">Geylang International FC</a>
						<p>Share your thoughts and help shape the future of Utopia.</p>
						<span>Back of the Net</span>
					</div>

					<div class="child">
						<img src="<?php echo get_template_directory_uri(); ?>/img/video_segments/5.jpg"/>
						<a href="#">So you think you can dance?</a>
						<p>Your Top 10 Season 11 dancers are going on tour!</p>
						<span>Hollywood pass</span>
					</div>
				
				</div> <!-- end box -->
</div>
<?php get_footer();?>