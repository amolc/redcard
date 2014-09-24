<?php

$options_array = array(
			'Social Presence' => array( 'get_key' => 'h3',
										'get_type' => 'header',
									  ),
				
			'Facebook Icon'=> array(
									'get_key' => 'tin_facebook_icon',
									'get_type' => 'file'
									),
			'Facebook Url'=> array(
									'get_key' => 'tin_facebook_url',
									'get_type' => 'url'
									),
			'Twitter Icon'=> array(
									'get_key' => 'tin_twitter_icon',
									'get_type' => 'file'
									),
			'Twitter Url'=> array(
									'get_key' => 'tin_twitter_url',
									'get_type' => 'url'
									),
			'Google+ Icon'=> array(
									'get_key' => 'tin_gplus_icon',
									'get_type' => 'file'
									),
			'Google+ Url'=> array(
									'get_key' => 'tin_gplus_url',
									'get_type' => 'url'
									),
			'LinkedIn Top Icon'=> array(
									'get_key' => 'tin_linkedin_icon',
									'get_type' => 'file'
									),						
			'LinkedIn Url'=> array(
									'get_key' => 'tin_linkedin_url',
									'get_type' => 'url'
									)
			

		);


function tin_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === tin_get_theme_options() )
		add_option( 'tin_theme_options', tin_get_default_theme_options() );

	register_setting(
		'tin_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'tin_theme_options' // Database option, see tin_get_theme_options()
	);
	global $options_array;
	foreach ($options_array as $key=>$option ){
		register_setting( 'tin_options', $option['get_key']);
	}
	
}


add_action( 'admin_init', 'tin_theme_options_init' );

function tin_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Social Links', 'tin' ),   // Name of page
		__( 'Social Links', 'tin' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'social_links',                         // Menu slug, used to uniquely identify the page
		'tin_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;


}
add_action( 'admin_menu', 'tin_theme_options_add_page' );



function tin_default_schemes() {
	$default_array = array('value' => 'Default_theme',
			'label' => __( 'Default_theme', 'tin' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/tin.png' 
			);
	global $options_array;
	foreach ($options_array as $key=>$option ){
		$default_array[$option['get_key']] =' ';
	}
	
	$default_scheme_options = array(
		'Default_theme' => $default_array,
	);

	return apply_filters( 'tin_default_schemes', $default_scheme_options );
}



function tin_get_default_theme_options() {
	$default_theme_options = array( 'default_scheme' => 'Default_theme' );
	global $options_array;	
	foreach ($options_array as $key=>$option ){
		$default_theme_options[$option['get_key']] = tin_get_default( $option,'Default_theme' );
	}	
	
	return apply_filters( 'tin_default_theme_options', $default_theme_options );
}



function tin_get_default( $option ,$default_scheme = null ) {
	if ( null === $default_scheme ) {
		$options = tin_get_theme_options();
		$default_scheme = $options['default_scheme'];
	}

	$default_schemes = tin_default_schemes();
	if ( ! isset( $default_schemes[ $default_scheme ] ) )
		return false;

	return $default_schemes[ $default_scheme ][$option['get_key']];
}



function tin_get_theme_options() {
	return get_option( 'tin_theme_options', tin_get_default_theme_options() );
}

function tin_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'tin' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>
		<hr>
		
		<div id="theme_option_main">
					
			<h1>Social Network</h1>
			<form method="post" enctype="multipart/form-data" action="options.php">
			<?php
					 
				settings_fields( 'tin_options' );
				$options = tin_get_theme_options();
				$default_options = tin_get_default_theme_options();
				global $options_array;	
				
				foreach ($options_array as $key=>$option ){
					do_settings_sections($option['get_key']);
					
				}	
				
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
			
				<p><?php _e( "(Use ' http:// ' for Hyperlinks and icon size should not be greater than 50x50 px)", 'tin' ); ?></p>
					<table class="form-table">
					<?php 	$i=1;
							foreach ($options_array as $key=>$option ){
						
						 ?>
						<tr>
							<th scope="row">
							<?php  if ($option['get_type']=='header') {?>
									<label><?php echo '<'.$option['get_key'].'>'; _e( $key, 'tin' ); echo '</'.$option['get_key'].'>' ?> </h3></label>
								 <?php } 
								  else {  ?>
								<label for="<?php echo $option['get_key']; ?>">	<?php _e( $key, 'tin' ); ?> </label>
								<?php } ?>
							</th>
							<td>
								
									
									<?php  switch ( $option['get_type'] )
									{
										case 'url' : 
											 echo "<input type=". $option['get_type'] ." name=". $option['get_key'] ." id=". $option['get_key'] ." class='regular-text' value=". get_option($option['get_key']) ."></input>";
											 break;
										case 'file' :
									?>
											
											<input class="upload_image<?php echo $i++; ?>" type="text" name="<?php echo $option['get_key']; ?>" value="<?php echo get_option($option['get_key']); ?>"></input>
											<input class="upload_image_button" type="button" value="Upload Image" />
									<?php 
											 break;
										
										 
									}
									?>
								
							</td>
						</tr>

					<?php } ?>
					
			
				</table>
				<?php submit_button(); ?>
			</form>
			
			
			
		</div>
	</div>	
			
	<?php
}
?>
