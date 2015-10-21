<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Extension_Switch_Style_Panel extends FW_Extension {

	private $cache_key = 'wrap-style-panel';

	private $options;

	/**
	 * @internal
	 */
	public function _init() {

		return;
		
		// if(!defined('WP_DEMO')){
		// 	define('WP_DEMO', true);
		// }

		// if ( WP_DEMO === true ){
		// 	$this->check_settings();
		// }

		// if ( WP_DEMO === false && $this->check_admin() ){
		// 	$this->admin_check_settings();
		// } else {
		// 	return;
		// }
	}

	public function check_admin(){
		return (is_admin() || !is_admin() && current_user_can( 'manage_options' ));
	}

	protected function check_settings() {
		$theme_options = fw_extract_only_options( $this->get_parent()->get_options('appearance-settings') );
		$options       = false;

		foreach ( $theme_options as $option_name => $option_settings ) {
			if ( $option_settings['type'] !== 'style' ) {
				unset ( $theme_options[ $option_name ] );
				continue;
			}
			$options = $option_settings;
			break;
		}

		if ( ! empty( $options['predefined'] ) ) {
			$this->options = $options;
			$this->add_theme_actions();
		}
	}

	protected function add_theme_actions() {
		add_action( 'wp_head', array( $this, '_theme_action_print_saved_css' ), 99 );
		add_action( 'wp_footer', array( $this, '_theme_action_print_styling_switcher' ), 10 );
	}

	protected function admin_check_settings(){
		$theme_options = fw_extract_only_options( $this->get_parent()->get_options('appearance-settings') );
		$options       = false;

		foreach ( $theme_options as $option_name => $option_settings ) {
			if ( $option_settings['type'] !== 'style' ) {
				unset ( $theme_options[ $option_name ] );
				continue;
			}
			$options = $option_settings;
			break;
		}

		if ( ! empty( $options['predefined'] ) ) {
			$this->options = $options;
			$this->admin_add_theme_actions();
		}
	}

	protected function admin_add_theme_actions() {
		add_action( 'wp_ajax_save_style', array( $this, '_admin_action_generate_css') );
		add_action( 'wp_head', array( $this, '_localize_script' ), 0);
		add_action( 'wp_head', array( $this, '_theme_action_print_css' ), 99 );
		add_action( 'wp_footer', array( $this, '_theme_action_print_styling_switcher' ), 10 );
	}

	public function _localize_script(){
		echo '<script type="text/javascript">var ajax_path = "' . admin_url('admin-ajax.php') . '"; </script>';
	}

	public function _theme_action_print_css() {
		$css = fw_get_db_extension_data( $this->get_parent()->get_name(), 'css' );
		if ( ! empty( $css ) ) {
			echo $css;
		}
	}

	public function _admin_action_generate_css() {
		$stored_style = htmlspecialchars($_POST['style']);
		fw_set_db_extension_data( $this->get_parent()->get_name(), 'css', $this->generate_initial_css( $this->options['blocks'], $this->options['predefined'][ $stored_style ] ) );
		fw_set_db_extension_data( $this->get_parent()->get_name(), 'options', array('theme_style' => array('predefined' => $stored_style)));
		wp_die();
	}

	/**
	 * @internal
	 */
	public function _theme_action_print_saved_css() {
		$stored_style = FW_Request::COOKIE( $this->cache_key );
		if ( ! empty( $this->options['predefined'][ $stored_style ] ) ) {
			echo $this->generate_initial_css( $this->options['blocks'], $this->options['predefined'][ $stored_style ] );
		};
	}

	private function generate_initial_css( $blocks, $style_options ) {
		$data = FW_Switch_Style_Panel_Css_Generator::get_css( $blocks, $style_options );
		$css  = $data['google_fonts'];
		$css .= '<style data-rel="' . $this->cache_key . '" type="text/css">' . $data['css']  . '</style>';

		return $css;
	}

	/**
	 * @internal
	 */
	public function _theme_action_print_styling_switcher() {

		echo $this->render_view( 'panel', array(
			'options'     => $this->options,
			'description' => fw_get_db_ext_settings_option($this->get_parent()->get_name(), 'switch_style_panel_description')
		) );

		// add static
		{
			wp_enqueue_style(
				'fw-ext-' . $this->get_name(),
				$this->locate_URI( '/static/css/panel.css' ),
				array(),
				fw()->theme->manifest->get_version()
			);
			wp_enqueue_script(
				'fw-ext-' . $this->get_name(),
				$this->locate_URI( '/static/js/panel.js' ),
				array( 'jquery' ),
				fw()->theme->manifest->get_version()
			);

			wp_localize_script( 'fw-ext-' . $this->get_name(), 'fwGoogleFonts', fw_get_google_fonts() );
			wp_localize_script( 'fw-ext-' . $this->get_name(), 'fwSwitchStylePanel', array( 'cache_key' => $this->cache_key ) );
			wp_localize_script( 'fw-ext-' . $this->get_name(), 'fwIsAdmin', array( is_admin() || !is_admin() && current_user_can( 'manage_options' )));
			wp_localize_script( 'fw-ext-' . $this->get_name(), 'fwUseCookie', array( WP_DEMO === true ));
		}

	}
}
