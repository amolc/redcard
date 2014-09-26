<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
$m_tablename=$wpdb->prefix."programmes";

function my_convert_date($date)
{
	$datearr=explode("-",$date);
	
	$newdate=strftime("%A, %d %B %Y",mktime(0,0,0,$datearr[1],$datearr[2],$datearr[0]));
	return $newdate;
}
function my_convert_time($time)
{
	$timearr=explode(":",$time);
	$mhour=$timearr[0];
	$mmin=$timearr[1];	
	if($mhour>12)
	{
		$newstr=($mhour-12).":".$mmin." pm";
	}
		else
	{
		$newstr=($mhour).":".$mmin." am";
	}
return $newstr;
}
?>fasdfas
<div class="box">
					<div class="s">
						<h1>On Tonight</h1>
                        <?php 
						$programmequery="select * from $m_tablename where prgdate>=now() order by prgdate";
						$programmesql=$wpdb->get_results($programmequery);
						if(sizeof($programmesql)>0)
						{
								?>
						<ul style="overflow:scroll;height:250px; ">
                        <?php foreach($programmesql as $my_sql)
						{
							?>
							<li>	
								<div class="date" style="width:180px;"><?php echo my_convert_date($my_sql->prgdate);?></div >
								<h2><?php echo $my_sql->prgTitle;?></h2>
								<p><?php echo my_convert_time($my_sql->prgfrom);?> to <?php echo my_convert_time($my_sql->prgto);?><br/><?php echo $my_sql->prgtagline;?></p>
							</li>
							<?php
						}
							?>
						</ul>
					
                        <?php
						}
						else
						{
							?>
						<ul style="overflow:scroll;height:250px; ">
							<li>	
								
								<h2>No Programme Scheduled</h2>
							
							</li>
							
						</ul>
					
                        <?php
						}
						?>
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
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			

			<header class="page-header">
				<img src="<?php echo get_template_directory_uri(); ?>/images/radio_slide.jpg" class="tv_slide" />
			</header><!-- .page-header -->
			<div class="box">
				<?php dynamic_sidebar( 'radioarchive' ); ?>	
			</div>

			<div class="box">
				<h1>Radio Segments</h1>
				<?php
				$args = array( ' hide_empty = true' );

				$terms = get_terms('radio-categories', $args);
			
				if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				    foreach ($terms as $term) {
				    	echo '<div class="box">';
				    	echo '<h4>' . $term->name. '</h4>';
				    	$args = array(
						'posts_per_page'   => 5,
						'post_type'        => 'radio-articles',
						'post_status'      => 'publish',
						'tax_query' => array(
								array(
									'taxonomy' => 'radio-categories',
									'field' => 'slug',
									'terms' => $term->slug
								)
							)
						);
				    	$allarts = get_posts( $args );
				    	$i = 1;
				    	foreach ( $allarts as $article ) {
						   $radtitle = $article->post_title;
						   $radtitlefinal = wp_trim_words( $radtitle, $num_words = 5, $more = '…' );
						   echo '<div class="r-child list'.$i.'">'. get_the_post_thumbnail( $article->ID ).'
						   	 	
	   							<h3><a href="'.get_permalink( $article->ID).'" class="r-child-h3-a">'.$radtitlefinal.'</a></h3>
								
	   							<a href="#">In Added Time</a>
	   							<a href="'.get_permalink( $article->ID).'" class="llink">Listen</a>
	   							<div id="social_2">
	   								<a href="http://www.facebook.com/share.php?u='.get_permalink( $article->ID) .'" target="_blank" title="Share on Facebook" ><div class="facebook"></div></a>
	   								<a href="#"><div class="twitter"></div></a>
	   								<a href="#"><div class="message"></div></a>
	   							</div>
	   							<span>1,290 views<span>
	   						</span></span></div>';
	   						$i++;
						}
				    	echo '<div class="lastl"><a href="'.get_term_link( $term ).'">View all in '.$term->name.'</a></div>';
				        echo '</div>';
				    }
				  
				}
				?>
			</div>
			

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();
