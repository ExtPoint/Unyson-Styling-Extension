<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/*
 * Get prefix with theme name
 * @return string
 */
function get_prefix(){
	$theme_name = preg_replace('/-[0-9]+$/', '', wp_get_theme()->get_stylesheet());
	return $theme_name . '_';
}
/*
 * Get option from styling extension
 * @var $option string
 * @var $default mixed
 * @return mixed
 */
function fw_ext_styling_get( $option, $default = null ) {

	static $options = null;

	if ( $options === null ) {
		$options = fw_get_db_extension_data( 'styling', get_prefix() . 'options', array() );
	}

	if ( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	}

	return $default;
}
