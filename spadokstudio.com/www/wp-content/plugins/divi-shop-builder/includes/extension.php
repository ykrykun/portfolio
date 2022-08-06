<?php
class AGSDiviWC_Extension extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'divi-shop-builder';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-shop-builder';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * DSWCP_DiviWoocommercePages constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'divi-woocommerce-pages', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		// includes plugin files
		$this->includes();

		parent::__construct( $name, $args );
	}

	/**
	 * includes plugin files
	 *
	 */
	public function includes(){
		include_once $this->plugin_dir . '../vendor/autoload.php';
		include_once $this->plugin_dir . 'helpers.php';
		include_once $this->plugin_dir . 'WoocommerceOverrides.php';
	}

	/**
	 * Overriding parent method to add
	 * @see parent::wp_hook_enqueue_scripts
	 *
	 */
	public function wp_hook_enqueue_scripts(){
		
		if ( et_core_is_fb_enabled() ) {
			$this->_builder_js_data = apply_filters( 'dswcp_builder_js_data', $this->common_localized_scripts() );
		}

		$this->_frontend_js_data = apply_filters( 'dswcp_frontend_js_data', array() );

		parent::wp_hook_enqueue_scripts();
		
		wp_add_inline_script($this->name.'-builder-bundle', 'var dswcp_pre__ = window._;', 'before');
		wp_add_inline_script($this->name.'-builder-bundle', 'window._ = dswcp_pre__;');
		wp_add_inline_script($this->name.'-frontend-bundle', 'var dswcp_pre__ = window._;', 'before');
		wp_add_inline_script($this->name.'-frontend-bundle', 'window._ = dswcp_pre__;');
	}
	
	protected function _set_bundle_dependencies() {
		parent::_set_bundle_dependencies();
		
		$this->_bundle_dependencies['builder'][] = 'wp-hooks';
	}

	/**
	 * Common localized scripts. So all the modules can share it
	 * @return Array
	 */
	private function common_localized_scripts(){
		
		$decimalSeparator = wc_get_price_decimal_separator();
		$thousandSeparator = wc_get_price_thousand_separator();
		
		// The visual builder modules crash if these are the same, so implement a fallback just in case
		if ($decimalSeparator == $thousandSeparator) {
			if ( strlen($decimalSeparator) ) {
				$thousandSeparator = '';
			} else {
				$decimalSeparator = '.';
			}
		}
		
		return array(
			'price_format' 	 => array(
				'currency'           => get_woocommerce_currency_symbol(),
				'decimal_separator'  => $decimalSeparator,
				'thousand_separator' => $thousandSeparator,
				'decimals'           => wc_get_price_decimals(),
				'price_format'       => get_woocommerce_price_format(),
			),
			'checkout_notice' => array(
				'heading' 			 => esc_html__( 'Checkout modules conflict', 'divi-shop-builder' ),
				'content' 			 => esc_html__( 'There are some modules conflict with Checkout modules. Please be ensure to place them on separate rows and not between checkout modules. Find the element by clicking below button', 'divi-shop-builder' ),
				'go_to_button' 		 => esc_html__( 'Go to Element', 'divi-shop-builder' ),
			)
		);
	}
}

// set the plugin instance as a global variable
// so we can use it later
$GLOBALS['dswcp'] = new AGSDiviWC_Extension;
