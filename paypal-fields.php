<?php

// Register the field that will pass on the data necessary for redirect to happen
function ninja_forms_register_field_paypal_link(){
	$args = array(
		'name' => __( 'Paypal Redirect', 'ninja-forms' ),
		'sidebar' => 'template_fields',
		'edit_function' => '',
		'edit_options' => array(
			array(
				'type' => 'text',
				'name' => 'paypal_cmd',
				'label' => __( 'CMD value', 'ninja-forms' ),
				'class' => 'widefat',
				'default' => '_s-xclick'
				),
			array(
				'type' => 'text',
				'name' => 'paypal_hosted_btn',
				'label' => __( 'Hosted button ID', 'ninja-forms' ),
				'class' => 'widefat',
				),
			),
		'display_function' => 'ninja_forms_field_paypal_link_display',
		'save_function' => '',
		'group' => 'standard_fields',
		'edit_label' => false,
		'edit_label_pos' => false,
		'edit_req' => true,
		'edit_custom_class' => true,
		'edit_help' => true,
		'edit_desc' => true,
		'edit_meta' => false,
		'edit_conditional' => true,
		'conditional' => array(
			'value' => array(
				'type' => 'radio',
				),
			),
		'edit_sub_value' => 'nf_field_paypal_link_edit_sub_value',
		'pre_process' => 'nf_field_paypal_link_pre_process',
		);
ninja_forms_register_field('_paypal_link', $args);
}
add_action('init', 'ninja_forms_register_field_paypal_link');

// Add the hidden fields on the form
function ninja_forms_field_paypal_link_display( $field_id, $data, $form_id = '' ){
	
	$cmd = $data['paypal_cmd'];
	$hosted_btn = $data['paypal_hosted_btn'];

	$field_class = ninja_forms_get_field_class( $field_id, $form_id );

	?>
	<input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>[]" id="ninja_forms_field_<?php echo $field_id;?>" value="<?php echo $cmd;?>" data-field-id="<?php echo $field_id; ?>" />	
	<input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>[]" id="ninja_forms_field_<?php echo $field_id;?>" value="<?php echo $hosted_btn;?>" data-field-id="<?php echo $field_id; ?>" />	
	<?php
}

// These two functions are usually used for editing submissions and for doing additional work during form processing.
// Given that we don't need any of that, and since they're necessary to make the plugin work, I've added them, but left them empty.
// So if you need to add some code there, knock yourself out.

function nf_field_paypal_link_edit_sub_value( $field_id, $user_value ) {
}

function nf_field_paypal_link_pre_process( $field_id, $user_value ) {
}