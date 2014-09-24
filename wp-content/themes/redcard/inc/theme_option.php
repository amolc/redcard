<?php


function wp_gear_manager_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');


function _theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === _get_theme_options() )
		add_option( '_theme_options', _get_default_theme_options() );

	register_setting(
		'_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'_theme_options' // Database option, see _get_theme_options()
	);
	$to_array = array( 'site_logo', 'header_add');
	foreach( $to_array as  $t_array ){
		register_setting( '_options', $t_array );
		
	}
}

add_action( 'admin_init', '_theme_options_init' );

function _theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', '' ),   // Name of page
		__( 'Theme Options', '' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;
}

add_action( 'admin_menu', '_theme_options_add_page' );

function _default_schemes() {
	$default_scheme_options = array(
		'Default_theme' => array(
			'value' => 'Default_theme',
			'label' => __( 'Default_theme', '' ),
			'site_logo' => '',
			
			'header_add' => ''
		),
	);

	return apply_filters( '_default_schemes', $default_scheme_options );
}

function _get_default_theme_options() {
	$default_theme_options = array(
		'default_scheme' => 'Default_theme',
		'site_logo' => _get_default_site_logo_url( 'Default_theme' ),
		
		'header_add' => _get_default_header_add( 'Default_theme' )

	);
	return apply_filters( '_default_theme_options', $default_theme_options );
}


function _get_default_site_logo_url( $default_scheme = null ){
	if ( null === $default_scheme ) {
		$options = _get_theme_options();
		$default_scheme = $options['default_scheme'];
	}
	$default_schemes = _default_schemes();
	if ( ! isset( $default_schemes[ $default_scheme ] ) )
		return false;
	return $default_schemes[ $default_scheme ]['site_logo'];
}

/*********/
function _get_default_header_add( $default_scheme = null){
	if ( null === $default_scheme ) {
		$options = _get_theme_options();
		$default_scheme = $options['default_scheme'];
	}
	$default_schemes = _default_schemes();
	if ( ! isset( $default_schemes[ $default_scheme ] ) )
		return false;
	return $default_schemes[ $default_scheme ]['header_add'];
}
/**********/
function _get_theme_options() {
	return get_option( '_theme_options', _get_default_theme_options() );
}

function _theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', '' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>
		<hr>
			<form method="post" enctype="multipart/form-data" action="options.php">
			<?php
					 
				settings_fields( '_options' );
				$options = _get_theme_options();
				$default_options = _get_default_theme_options();
				
				do_settings_sections('site_logo');
				
				
				
				do_settings_sections('header_add');
			

				
				
			?>
				<script language="JavaScript">
												jQuery(document).ready(function() {
														jQuery('.upload_image_button').click(function() {
														 formfield = jQuery(this).prev('input').attr('class');
														
														tb_show('', 'media-upload.php?type=image&TB_iframe=true');
														return false;
													});
																								
														window.send_to_editor = function(html) {
															
															imgurl = jQuery('img',html).attr('src');
															jQuery('.'+formfield).val(imgurl);
															tb_remove();
														}
												});
				</script>

			<b><?php _e( "(Use ' http:// ' for Hyperlinks)", '' );
				//add_option('widgets_grid','above');
				$widgets_grid=get_option('widgets_grid');
				//echo $widgets_grid."hello"; 
				if($widgets_grid=='above'){
					$checked1='checked';
				}
				elseif($widgets_grid=='below'){
					$checked2='checked';
				}
				elseif($widgets_grid=='none'){
					$checked3='checked';
				}
			 ?></b>
			
			<h3 class="title">Theme Options</h3>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="site_logo">Site Logo Url</label></th>
						<td>
								<input  id="site_logo" class="upload_image2" type="text" name="site_logo" value="<?php echo get_option('site_logo'); ?>"></input>
								<input class="upload_image_button" type="button" value="Upload Image" />
						</td>
					</tr>
					
					<tr>	
						<th scope="row"><label for="header_add">Adv below Header.</label></th>
						<td>
							<textarea name="header_add" id="header_add" rows="15" cols="120" ><?php echo get_option('header_add'); ?></textarea>
						
						</td>	
					</tr>	
										
				</table>
				<?php submit_button(); ?>
			</form>
			
	</div>	
			
	<?php
} ?>
