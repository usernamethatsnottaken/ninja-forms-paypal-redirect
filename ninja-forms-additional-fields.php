<?php

/*
 * Plugin name: Ninja Forms Paypal Redirect
 * Description: Enable Paypal redirect after form submission.
 * Version: 1.0.0
 * Author: Stefan Malic
 * Author URI: http://www.stefanmalic.com/
 */

define( 'NF_ADDITIONAL_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define( 'NF_PLUGIN_LINK', plugins_url('nf-paypal-redirect') );

function ninja_forms_paypal_redirect() {
	global $ninja_forms_processing;
	// Get all the fields
	$fields = $ninja_forms_processing->get_all_fields();
	$fields = array_filter($fields);

	// Extract the parameters necessary to do the redirect
	$link = "https://www.paypal.com/cgi-bin/webscr";
	$values = array();
	foreach ($fields as $entry) {
		if( is_array($entry) && $entry[0] == "_s-xclick" ) $values = $entry;
	}

	// If the hosted button ID exists, do the redirect. Don't ask why I used meta redirect, I forgot. wp_redirect() and header() probably didn't work. 
	if( !empty($values[1]) ) {
		$link .= "?cmd=_s-xclick&hosted_button_id=".$values[1];
		echo "<meta http-equiv='refresh' content='3;URL=".$link."' />";
	}
}
add_action('ninja_forms_post_process', 'ninja_forms_paypal_redirect');

require_once NF_ADDITIONAL_PLUGIN_DIR.'/paypal-fields.php';