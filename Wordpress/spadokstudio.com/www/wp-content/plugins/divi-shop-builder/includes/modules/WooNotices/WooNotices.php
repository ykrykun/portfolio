<?php

class DSWCP_WooNotices extends ET_Builder_Module {

	public $slug       = 'ags_woo_notices';
	public $vb_support = 'on';


	protected $module_credits = array(
		'module_uri' => 'https://divi.space/',
		'author'     => 'Divi Space',
		'author_uri' => 'https://divi.space/',
	);

	public function init() {
		$this->name = esc_html__( 'Cart/Checkout Notices', 'divi-shop-builder' );
		$this->icon  = '2';


		/**
		 * Toggle Sections of General tab and Design tab
		 *
		 */
		$this->settings_modal_toggles = array(
			'advanced' => array(
				'toggles' => array(
					'notice_info'   => array(
						'title'    => esc_html__( 'Information Notice', 'divi-shop-builder' ),
						'priority' => 45,
					),
					'notice_success'   => array(
						'title'    => esc_html__( 'Success Notice', 'divi-shop-builder' ),
						'priority' => 45,
					),
					'notice_error'   => array(
						'title'    => esc_html__( 'Error Notice', 'divi-shop-builder' ),
						'priority' => 45,
					),
				),
			),
		);

		/**
		 * Desing tab extra fields
		 *
		 */
		$this->advanced_fields = array(
			'link_options' => false,
			'text' => false,
			'background' => false,
			'borders'        => array(
				'default' => array(
					'css'      => array(
						'main' => array(
							'border_radii'  => '%%order_class%% .woocommerce-notices-wrapper > *',
							'border_styles' => '%%order_class%%.ags_woo_notices .woocommerce-notices-wrapper > *',
						),
						'important' => array('border_styles'),
					)
				),
			),
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => '%%order_class%% .woocommerce-notices-wrapper > *',
						'important' => 'all',
					),
				),
			),
			'margin_padding' => array(
				'css'               => array(
					'padding'   => '%%order_class%% .woocommerce-notices-wrapper > *',
					'margin'    => '%%order_class%%',
					'important' => array( 'custom_padding' ),
				),
			),


			'fonts'          => array(
				'info_notice_text' => array(
					'label'           => esc_html__( 'Information Notices Text', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-info',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_info',
				),
				'info_notice_link' => array(
					'label'           => esc_html__( 'Information Notices Link', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-info > a',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_info',
				),
				'success_notice_text' => array(
					'label'           => esc_html__( 'Success Notices Text', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-message',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_success',
				),
				'success_notice_link' => array(
					'label'           => esc_html__( 'Success Notices Link', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-message > a',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_success',
				),
				'error_notice_text' => array(
					'label'           => esc_html__( 'Error Notices Text', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-error',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_error',
				),
				'error_notice_link' => array(
					'label'           => esc_html__( 'Error Notices Link', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => '.woocommerce %%order_class%% .woocommerce-error > a',
						'important' => 'all',
					),
					'font_size'       => array(
						'default' => '18px',
					),
					'toggle_slug'     => 'notice_error',
				),
			),
			'button'         => array(
				'info_notice_button' => array(
					'label'          => esc_html__( 'Information Notice Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'notice_info',
					'css'            => array(
						'main'         => '.woocommerce %%order_class%% .woocommerce-info > .button',
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => '.woocommerce %%order_class%% .woocommerce-info > .button',
							'important' => true,
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
				'success_notice_button' => array(
					'label'          => esc_html__( 'Success Notice Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'notice_success',
					'css'            => array(
						'main'         => '.woocommerce %%order_class%% .woocommerce-message > .button',
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => '.woocommerce %%order_class%% .woocommerce-message > .button',
							'important' => true,
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
				'error_notice_button' => array(
					'label'          => esc_html__( 'Error Notice Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'notice_error',
					'css'            => array(
						'main'         => '.woocommerce %%order_class%% .woocommerce-error > .button',
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => '.woocommerce %%order_class%% .woocommerce-error > .button',
							'important' => true,
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
			),
		);

		/**
		 * Advanced tab custom css fields
		 *
		 */
		$this->custom_css_fields = array(
			'info_notice'         => array(
				'label'    => esc_html__( 'Information Notice', 'divi-shop-builder' ),
				'selector' => '.woocommerce %%order_class%% .woocommerce-info',
			),
			'success_notice'         => array(
				'label'    => esc_html__( 'Success Notice', 'divi-shop-builder' ),
				'selector' => '.woocommerce %%order_class%% .woocommerce-message',
			),
			'error_notice'         => array(
				'label'    => esc_html__( 'Error Notice', 'divi-shop-builder' ),
				'selector' => '.woocommerce %%order_class%% .woocommerce-error',
			),
		);

		add_filter( 'the_content', array( $this, 'override_wc_notices' ), 9);
		add_filter( 'dswcp_builder_js_data', array( $this, 'builder_js_data' ) );
	}


	/**
	 * State/ Content fields to control the table behavior
	 *
	 * @return array
	 *
	 */
	public function get_fields() {
		return array(
			'notice_info_bg_color' => array(
				'label'          => esc_html__( 'Information Notice Background Color', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'notice_info',
				'default'        => '#2ea3f2',
			),
			'notice_success_bg_color' => array(
				'label'          => esc_html__( 'Success Notice Background Color', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'notice_success',
				'default'        => '#2ea3f2',
			),
			'notice_error_bg_color' => array(
				'label'          => esc_html__( 'Error Notice Background Color', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'notice_error',
				'default'        => '#2ea3f2',
			),
			'enable_test_mode'		=> array(
				'label'           => esc_html__( 'Enable Test Mode', 'divi-shop-builder' ),
				'description' 	  => esc_html__( 'Enable test mode show notices per each type on front', 'divi-shop-builder' ),
				'type'            => 'yes_no_button',
				'options' 		  => array(
					'on' 	      => esc_html__( 'Enable', 'divi-shop-builder' ),
					'off' 	      => esc_html__( 'Disable', 'divi-shop-builder' ),
				),
				'option_category' => 'configuration',
				'default'         => 'off'
			)
		);
	}


	/**
	 * Add localized strings of the module
	 *
	 * @param array
	 * @return array
	 */
	public function builder_js_data( $js_data ){
		$locals = array(
			'locals' 		 => array(
				'notice_message' 	 => esc_html__( 'My Awesome Notice.', 'divi-shop-builder' ),
				'notice_link' 		 => esc_html__( 'A link', 'divi-shop-builder' ),
				'notice_button_text' => esc_html__( 'Button', 'divi-shop-builder' ),
			)
		);

		$js_data['notices'] = $locals;

		return $js_data;
	}


	/**
	 * Renders the module elements
	 *
	 */
	public function render( $attrs, $content, $render_slug ) {

		if( !function_exists( 'wc_add_notice' ) ){
			return;
		}

		// to generate notices background color
		$this->generate_styles(
			array(
				'responsive'     => true,
				'render_slug'    => $render_slug,
				'base_attr_name' => 'notice_info_bg_color',
				'css_property'   => 'background-color',
				'selector'       => '.woocommerce %%order_class%% .woocommerce-info',
				'important' 	 => true
			)
		);

		$this->generate_styles(
			array(
				'responsive'     => true,
				'render_slug'    => $render_slug,
				'base_attr_name' => 'notice_success_bg_color',
				'css_property'   => 'background-color',
				'selector'       => '.woocommerce %%order_class%% .woocommerce-message',
				'important' 	 => true
			)
		);

		$this->generate_styles(
			array(
				'responsive'     => true,
				'render_slug'    => $render_slug,
				'base_attr_name' => 'notice_error_bg_color',
				'css_property'   => 'background-color',
				'selector'       => '.woocommerce %%order_class%% .woocommerce-error',
				'important' 	 => true
			)
		);

		$this->generate_test_notices();

		ob_start();

		woocommerce_output_all_notices();

		return ob_get_clean();
	}


	/**
	 * Remove woocommerce notices and output notice module
	 *
	 * @return HTML
	 */
	public function override_wc_notices( $content ){

		if( has_shortcode( $content, $this->slug ) ){

			remove_action( 'woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5 );
			remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
			remove_action( 'woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10 );
			remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
		}

		return $content;
	}


	private function generate_test_notices(){

		if( $this->props['enable_test_mode'] !== 'on' ){
			return;
		}

		$link = sprintf( '<a href="#">%s</a>', esc_html__( 'Test link', 'divi-shop-builder' ) );

		wc_add_notice( esc_html__( 'My awesome info message ', 'divi-shop-builder' ) . $link , 'notice' );

		wc_add_notice( esc_html__( 'My awesome success message ', 'divi-shop-builder' ) . $link, 'success' );

		wc_add_notice( esc_html__( 'My awesome error message ', 'divi-shop-builder' ) . $link, 'error' );
	}
}

new DSWCP_WooNotices;
