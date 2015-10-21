<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'theme_style' => array(
		'label'      => false,
		'type'       => 'style',
		'predefined' => $predefined = include( 'includes/predefined-styles.php' ),
		'value'      => $predefined['blue']['blocks'],
		'blocks'     => array(
			'main_color'	=> array(
				'title'				=> __( 'Accent Color', 'unyson' ),
				'elements'		=> array('accent'),
				'css_selector'	=> '.accent'
			),
			'header'  => array(
				'title'        => __( 'Header', 'unyson' ),
				'elements'     => array( 'h1', 'links', 'links_hover', 'background' ),
				//all allowed array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'links', 'links_hover', 'background' )
				'css_selector' => array(
					'#masthead',
					'.primary-navigation .mega-menu',
					'.primary-navigation .mega-col',
					'.primary-navigation .mega-row',
				),
				//css selectors ( string|array )
			),
			'content' => array(
				'title'        => __( 'Content', 'unyson' ),
				'elements'     => array( 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'links', 'links_hover', 'background' ),
				'css_selector' => array('#content article')
			),
			'aside-sidebar' => array(
				'title'        => __( 'Aside Sidebar', 'unyson' ),
				'elements'     => array( 'h2', 'links', 'links_hover', 'background' ),
				'css_selector' => array( '#sidebar', '.site:before' )
			),
			'footer-sidebar' => array(
				'title'        => __( 'Footer Sidebar', 'unyson' ),
				'elements'     => array( 'h2', 'links', 'links_hover', 'background' ),
				'css_selector' => array( '#secondary', '.site:before' )
			),
			'footer'  => array(
				'title'        => __( 'Footer', 'unyson' ),
				'elements'     => array( 'p', 'links', 'links_hover', 'background' ),
				'css_selector' => '#colophon'
			),
		),
	),
	'quick_css'   => array(
		'label' => __( 'Quick CSS', 'unyson' ),
		'desc'  => sprintf(
			__( 'Just want to do some quick CSS changes? Enter them here, they will be %s applied to the theme. ' .
			    'If you need to change major portions of the theme %s please use the custom.css file.', 'fw' ),
			'<br/>',
			'<br/>'
		),
		'type'  => 'textarea',
		'value' => '',
	),
);