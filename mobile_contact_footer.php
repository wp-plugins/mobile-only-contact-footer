<?php
/*
* Plugin Name: Mobile Contact Footer Add-On
* Plugin URI: https://www.tepia.co/
* Description: An editable div that sticks to the footer on mobile devices to display easy to read contact information
* Version: 1.0.0
* Author: Justin Richard
* Author URI: http://justinrichardweb.com/
* License: GPL2
*/

/* BACKEND */
include( 'mobile_contact_footer_admin.php' );

/* FRONTEND */
function mobile_contact_footer(){ 

	//get admin options
	$adminOptions = new MCF_AdminPage();
	$theOptions = $adminOptions->getOptions();
	$fa_pre = 'fa fa-';
	$fa_post = ' fa-3x';
	
	$mcf_phone = 'tel:+' . $theOptions[ 'mcf_section_phone' ];
	$mcf_email = 'mailto:' . $theOptions[ 'mcf_section_email' ];
	$mcf_maps_address = $theOptions[ 'mcf_section_maps' ];
	$mcf_maps_address = urlencode( $mcf_maps_address );
	$mcf_maps = 'https://www.google.com/maps/place/' . $mcf_maps_address;
	$mcf_facebook = $theOptions[ 'mcf_section_social' ];
	$mcf_bg_color = $theOptions[ 'mcf_section_bg_color' ];
	$mcf_icon_color = $theOptions[ 'mcf_section_icon_color' ];
	
	$mcf_icon1 = $theOptions[ 'mcf_section_phone_icon' ];
	$mcf_icon2 = $theOptions[ 'mcf_section_email_icon' ];
	$mcf_icon3 = $theOptions[ 'mcf_section_maps_icon' ];
	$mcf_icon4 = $theOptions[ 'mcf_section_social_icon' ];

?>
	
	<div style="background-color:<?php echo $mcf_bg_color; ?>;" id="mobile-footer">

		<div class="mcf_icon"><a style="color:<?php echo $mcf_icon_color; ?>;" target="_blank" href="<?php echo $mcf_phone; ?>"><i class="<?php echo $fa_pre . $mcf_icon1 . $fa_post; ?>"></i></a></div>
		<div class="mcf_icon"><a style="color:<?php echo $mcf_icon_color; ?>;" target="_blank" href="<?php echo $mcf_email; ?>"><i class="<?php echo $fa_pre . $mcf_icon2 . $fa_post; ?>"></i></a></div>
		<div class="mcf_icon"><a style="color:<?php echo $mcf_icon_color; ?>;" target="_blank" href="<?php echo $mcf_maps; ?>"><i class="<?php echo $fa_pre . $mcf_icon3 . $fa_post; ?>"></i></a></div>
		<div class="mcf_icon"><a style="color:<?php echo $mcf_icon_color; ?>;" target="_blank" href="<?php echo $mcf_facebook; ?>"><i class="<?php echo $fa_pre . $mcf_icon4 . $fa_post; ?>"></i></a></div>
	
	</div>
	
<?php }

function mobile_contact_include_style(){

	wp_enqueue_style(
			'mobile-footer-style', 
			plugins_url( 'mobile_contact_footer.css', __FILE__)
			);
			
	wp_enqueue_style(
			'mcf-fontawesome-style', 
			plugins_url( 'font-awesome-4.3.0/css/font-awesome.min.css', __FILE__)
			);
			
}

add_action( 'wp_footer', 'mobile_contact_footer' );
add_action( 'wp_enqueue_scripts', 'mobile_contact_include_style' );