<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general-tab' => array(
		'title'   => __( '', 'fw' ),
		'type'    => 'box',
		'options' => array(
			apply_filters( 'fw_ext_styling_settings_options', array() )
		)
	)
);