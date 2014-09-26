<?php
/**
 * The template for displaying the footer
 * Contains footer content and the closing of the #main and #page div elements.
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
</div>


<div id="footer">
        <div class="box">
            <div class="col_150">
                <h1>Radio Shows</h1>
                <?php wp_nav_menu( array('menu' => 'Footer Left' )); ?>
            </div>
            <div class="col_150" ><?php dynamic_sidebar( 'footer-left-2' ); ?></div>
            <div class="col_150">
                <h1>About</h1>
                <?php wp_nav_menu( array('menu' => 'Footer Mid' )); ?>
            </div>
            <div class="col_150">
                &nbsp;&nbsp;
            </div>
            <div class="col_300">
                <?php dynamic_sidebar( 'footer-right' ); ?>
                <div id="social" class="social-bottom"><?php dynamic_sidebar( 'header-social' ); ?></div>
            </div>
        </div>
    </div>

<script>
$( ".widget_sp_image-image-link img" ).addClass( "desaturate" );
</script>
	<?php wp_footer(); ?>
    
</body>
</html>