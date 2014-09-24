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
				</div> 
		
<div class="box">
					<h1>Video Segments</h1>
                  <?php  $args = array( 'post_type' => 'tvideo');
$loop = new WP_Query( $args ); $as =1;
while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="child">
						<?php // twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'video-feature-image' ) );?>
                        <?php the_content(); ?>
						<a href="#"><?php the_title(); ?></a>
						<p><?php echo get_the_excerpt(); ?></p>
						<span></span>
					</div>
					<?php endwhile;?>
					
				
				</div> 

<?php get_footer();?>