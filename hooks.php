<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! function_exists( '_action_print_quick_css' ) ) {
	/**
	 * Print styling css on front-end
	 * @internal
	 */
	function _action_print_quick_css() {

		$quick_css = fw_ext_styling_get('quick_css', '');
		if(!empty($quick_css)) {
			echo '<style type="text/css">' . $quick_css . '</style>';
		}
	}
	add_action( 'wp_head', '_action_print_quick_css', 100 );
}

function generate_additional_css(){

	$theme_style = fw_ext_styling_get('theme_style', '');
	$accent = ($theme_style !== '' && !empty($theme_style['blocks']['main_color']['accent']))
		? $theme_style['blocks']['main_color']['accent']
		: '#4eaade';

	return 'a.button, .contact-form input[type=submit] { background-color: '. $accent .';}'.
		'a.button:active, a.button:hover, .contact-form input[type=submit]:active, .contact-form input[type=submit]:hover {background-color: '. $accent .';}'.
		'a.button.button-inverted {color: '. $accent .' !important; border-color: '. $accent .' !important;}'.
		'.button {background-color: '. $accent .';}'.
		'.button:active, .button:hover {background-color: '. $accent .';}'.
		'.button.button-inverted {color: '. $accent .' !important; border-color: '. $accent .' !important;}'.
		'.button.button-inverted a{color: '. $accent .' !important; border-color: '. $accent .' !important;}'.
		'.nav-menu-hiddens {border-top-color: ' . $accent . ' !important;}' .
		'.sub-menu {border-top-color: ' . $accent . ' !important;}' .
		'.unordered li:before {color: ' . $accent . ';}'.
		'.ordered li:before {color: ' . $accent . ';}' .
		'.nav-menu .sub-menu li a:hover:before{border-color: transparent transparent transparent ' . $accent . ';}' .
		'.fw-testimonials .fw-testimonials-pagination a.selected {background-color: ' . $accent . ';}' .
		'.fw-accordion .fw-accordion-title.ui-state-active {color: ' . $accent . ';}' .
		'.fw-accordion .fw-accordion-title.ui-state-active:after {color: ' . $accent . ';}' .
		'.nav-dots .item.active {background-color: ' . $accent . ';}'.
		'.latest-blog-post .thumb-container .date .item.day {color: ' . $accent . ';}' .
		'.latest-blog-post .thumb-container .date:before {  border-color: #fff ' . $accent . $accent . ' #fff;}' .
		'.fw-team-member-image.active{  box-shadow: 0 0 0 7px ' . $accent . ', 0 0 0 1px #e5e5e5;}'.
		'.fw-subscribe-content:before{color: ' . $accent .'}' .
		'.portfolio-tabs .item.active {background-color: ' . $accent .';}'.
		'.portfolio-tabs .item.active:after {  border-color: ' . $accent .' transparent transparent transparent;}' .
		'.fw-pricing .fw-package-wrap.highlight-col .fw-heading-row {background: ' . $accent . '}' .
		'.fw-package .fw-pricing-row span {color: ' . $accent .';}' .
		'.btn-group button[data-calendar-nav] {color: ' . $accent .';}'.
		'.cal-day-today {background-color: ' . $accent .';}' .
		'.cal-month-day:hover span.pull-left {color: ' . $accent .' !important;}' .
		'a:hover{color: ' .  $accent .';}' .
		'.mightyslider_carouselSimple_skin .mSButtons, .mightyslider_carouselSimple_skin .mSButtons:hover {background-color: ' . $accent . '}';
}

if ( ! function_exists( '_action_print_additional_css' ) ) {
	/**
	 * Print styling css on front-end
	 * @internal
	 */
	function _action_print_additional_css()	{
		echo '<style type="text/css">' . generate_additional_css() . '</style>';
	}
	add_action( 'wp_head', '_action_print_additional_css', 100 );
}