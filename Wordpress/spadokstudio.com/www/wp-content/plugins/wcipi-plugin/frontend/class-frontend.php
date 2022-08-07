<?php

class Wcipi_Frontend {

	function __construct() {

		add_action('wp_enqueue_scripts', array($this, 'register_js_css'));

		if (get_option(WCIPI_SETTINGS_PREFIX.'validation') === 'yes') {
			add_action('woocommerce_after_checkout_validation', array($this, 'after_checkout_validation'));
		}

	}

	/**
	 * Register CSS and JS scripts
	 */
	function register_js_css() {

		wp_enqueue_style( WCIPI_SETTINGS_PREFIX.'intlTelInput', WCIPI_URL.'css/wcipi-intlTelInput.min.css', array(), WCIPI_VERSION_NUM );
		wp_enqueue_style( WCIPI_SETTINGS_PREFIX.'intlTelInputMainCss', WCIPI_URL.'css/wcipi-styles.css', array(WCIPI_SETTINGS_PREFIX.'intlTelInput'), WCIPI_VERSION_NUM );

		wp_enqueue_script( WCIPI_SETTINGS_PREFIX.'intlTelInput', WCIPI_URL.'js/wcipi-intlTelInput-jquery.min.js', array( 'jquery' ), WCIPI_VERSION_NUM, true );

		wp_enqueue_script( WCIPI_SETTINGS_PREFIX.'intlTelInputMainJs', WCIPI_URL.'js/wcipi-main.js', array( WCIPI_SETTINGS_PREFIX.'intlTelInput' ), WCIPI_VERSION_NUM, true );

		// Localize main.js variables...
		$autoset_ip = $this->is_autoset_ip_enabled();
		$only_selected_countries = $this->is_only_selected_countries_enabled();
		$default_country = get_option(WCIPI_SETTINGS_PREFIX.'default_country');
		$ipinfo_token = get_option(WCIPI_SETTINGS_PREFIX.'ipinfo_token');
		$only_countries = json_encode(get_option(WCIPI_SETTINGS_PREFIX.'selected_countries_array', []));

		$preferred_countries = apply_filters(WCIPI_PREFIX.'preferred_countries', []);

		wp_localize_script(WCIPI_SETTINGS_PREFIX.'intlTelInputMainJs', 'wipiMainJsVars', array(
			'utilsScript' => WCIPI_URL.'/js/wcipi-utils.js',
			'autoSetIp' =>  $autoset_ip,
			'initialCountry' =>  $default_country,
			'onlySelectedCountries' =>  $only_selected_countries,
			'onlyCountries' =>  $only_countries,
			'preferredCountries' =>  $preferred_countries,
			'ipInfoToken' =>  $ipinfo_token,
			'wpiElements' =>  WCIPI_ELEMENTS
		));

		wp_enqueue_script( WCIPI_SETTINGS_PREFIX.'intlTelInputValidation', WCIPI_URL.'js/wcipi-phone-validate.js', array( WCIPI_SETTINGS_PREFIX.'intlTelInputMainJs' ), WCIPI_VERSION_NUM, true );

		// Localize phone-validate.js variables...
		$validation_success_message = $this->get_validation_success_message();
		$validation_fail_message = $this->get_validation_fail_message();

		wp_localize_script( WCIPI_SETTINGS_PREFIX.'intlTelInputValidation', 'wipiValidationJsVars', array(
			'wpiElements' =>  WCIPI_ELEMENTS,
			'successMessage' =>  $validation_success_message,
			'failMessage' =>  $validation_fail_message
		));
	}

 	function is_autoset_ip_enabled(){
		return get_option(WCIPI_SETTINGS_PREFIX.'autoset') === 'yes' ? true : false;
	}

	function is_only_selected_countries_enabled(){
		return get_option(WCIPI_SETTINGS_PREFIX.'only_selected_countries') === 'yes' ? true : false;
	}

	function get_validation_success_message(){
		$validation_success_message = get_option(WCIPI_SETTINGS_PREFIX.'validation_success_msg');

		if (empty($validation_success_message)) {
			$validation_success_message = esc_attr__('✓ Valid', WCIPI_TD);
		}

		return $validation_success_message;
	}

	function get_validation_fail_message(){
		$validation_fail_message = get_option(WCIPI_SETTINGS_PREFIX.'validation_fail_msg');

		if (empty($validation_fail_message)) {
			$validation_fail_message = esc_attr__('Invalid number', WCIPI_TD);
		}

		return $validation_fail_message;
	}

	function after_checkout_validation( $posted ) {

		$billing_phone = $posted['billing_phone'];

		if ( strlen($billing_phone) > 0 ) {

			if(!preg_match('/^[+]\d{5,40}$/', trim($billing_phone))) { // just a basic phone validation

				// adding wc_add_notice with a second parameter of "error" will stop the form...
				$message = sprintf(esc_attr__( '<strong>%s</strong> is a required field', 'woocommerce' ), esc_attr__('Phone Number', 'woocommerce'));
				wc_add_notice( $message, 'error' );
			}
		}

	}

}

new Wcipi_Frontend();