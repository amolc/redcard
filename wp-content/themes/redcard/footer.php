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
                <ul class="serch2">
                  <li class="seacrh-li">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                      <label> <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                      </label>
                      <button type="submit" class="search-submit" style="width:30px;background: transparent;border: medium none;" ><i class="fa fa-search" style="color: #fff;"></i></button>
                    </form>
                  </li>
                </ul>
                <?php dynamic_sidebar( 'footer-right' ); ?>
                <div id="social" class="social-bottom"><?php dynamic_sidebar( 'header-social' ); ?></div>
            </div>
        </div>
    </div>

<script>
$( ".widget_sp_image-image-link img" ).addClass( "desaturate" );
</script>

<?php wp_footer(); ?>
    <script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'redcardconnect'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script> 
</body>
</html>