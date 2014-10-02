<?php
/**
 * The template for displaying Archive pages
*/

get_header(); ?>
<?php dynamic_sidebar( 'tvbanner' ); ?>


<div class="box">
					<h1>Video Segments</h1>
               <?php  $args = array( 'post_type' => 'tvideo');
					  $loop = new WP_Query( $args ); $as =1;
					  while ( $loop->have_posts() ) : $loop->the_post(); 
							 $postID = get_the_ID();
							 $youtubURL_values = get_post_meta( $postID, '_cmb_tvideo_youtub_url', true ); 
			  ?>
					<div class="child">
						<?php $videoID = ShowTvVideoImg($youtubURL_values,$alt = 'Video screenshot', $width='280', $height='150');// twentyfourteen_post_thumbnail( 'thumbnail', array( 'class' => 'video-feature-image' ) );?>
                        <a href="<?php the_permalink() ?>"><?php echo $videoID; ?></a>
                        <?php //$trimtitle = get_the_title();
							  //$shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '…' ); ?>
						<a style="text-decoration: none;" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        <?php $youtubetagline_value = get_post_meta( $postID, '_cmb_tvideo_tagline_text', true ); ?>
                        <?php //$trimtag = $youtubetagline_value;
							  //$shorttag = wp_trim_words( $trimtag, $num_words = 10, $more = '…' ); ?>
						<p class="tvpexcerpt"><?php echo $youtubetagline_value; ?></p>
						<span></span>
					</div>
					<?php endwhile;?>
				</div> 
<?php get_footer();?>