<?php
add_action( 'admin_menu', 'hippoapi_menu_page' ); // menu function

function hippoapi_menu_page() {

	add_menu_page(
		'HippoApi',
		'Hippo Api Options',
		'manage_options',
		'hippoapi-slug',
		'hippoapi_page_content', // page content function
		'dashicons-media-code',
		5
	);

}

function hippoapi_page_content(){
  echo '<div class="wrap">
	<h1>Settings Hippo Api</h1>
	<form method="post" action="options.php">';

		settings_fields( 'hippoapi_settings' );
		do_settings_sections( 'hippoapi-slug' );
		submit_button();

	echo '</form></div>';
}

add_action( 'admin_init',  'hippoapi_register_setting' );

function hippoapi_register_setting(){

	register_setting(
		'hippoapi_settings',
		'authtoken_text',
		'sanitize_text_field'
	);
	register_setting(
		'hippoapi_settings',
		'apiurl_text',
		'sanitize_text_field'
	);

	add_settings_section(
		'hippoapi_settings_section_id',
		'',
		'',
		'hippoapi-slug'
	);

	add_settings_field(
		'authtoken_text',
		'Auth Token',
		'authtoken_text_field_html',
		'hippoapi-slug',
		'hippoapi_settings_section_id',
		array(
			'label_for' => 'authtoken_text',
			'class' => 'hippoapi-class',
		)
	);
	add_settings_field(
		'apiurl_text',
		'Api url',
		'apiurl_text_field_html',
		'hippoapi-slug',
		'hippoapi_settings_section_id',
		array(
			'label_for' => 'apiurl_text',
			'class' => 'hippoapi-class',
		)
	);

}

function authtoken_text_field_html(){
	$text = get_option( 'authtoken_text' );
	printf(
		'<input type="text" id="authtoken_text" name="authtoken_text" value="%s" />',
		esc_attr( $text )
	);
}
function apiurl_text_field_html(){
	$text = get_option( 'apiurl_text' );
	printf(
		'<input type="text" id="apiurl_text" name="apiurl_text" value="%s" />',
		esc_attr( $text )
	);
}
?>
