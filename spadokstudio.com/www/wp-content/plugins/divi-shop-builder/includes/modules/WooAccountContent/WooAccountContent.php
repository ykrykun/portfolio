<?php

defined( 'ABSPATH' ) || exit;

/**
 * Module class of Woo My Account Content
 *
 */
class DSWCP_WooAccountContent extends ET_Builder_Module {

    public $slug       = 'ags_woo_account_content';
	public $vb_support = 'on';
	public $child_slug = 'ags_woo_account_content_item';

	protected $module_credits = array(
		'module_uri' => 'https://divi.space/',
		'author'     => 'Divi Space',
		'author_uri' => 'https://divi.space/',
	);

	public function init() {
		$this->name = esc_html__( 'Account Content', 'divi-shop-builder' );
		$this->icon  = 'a';

		$this->main_css_element = '%%order_class%% .woocommerce-MyAccount-content';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content'     => esc_html__( 'Contents', 'divi-shop-builder' )
				)
			),
			'advanced' => array(
				'toggles' => array(
					'account_content_body'   => array(
						'title'             => esc_html__( 'Texts & Links', 'divi-shop-builder' ),
						'priority'          => 10,
						'tabbed_subtoggles' => true,
						'bb_icons_support'  => true,
						'sub_toggles'       => array(
							'p'     => array(
								'name' => 'p',
								'icon' => 'text-left',
							),
							'a'     => array(
								'name' => 'a',
								'icon' => 'text-link',
							)
						),
					),
					'account_content_headings' => array (
						'title'             => esc_html__( 'Headings', 'divi-shop-builder' ),
						'priority'          => 20,
					),
					'mark' => array (
						'title'             => esc_html__( 'Mark Highlight', 'divi-shop-builder' ),
						'priority'          => 35,
					),
					'buttons' => array (
						'title'             => esc_html__( 'Buttons', 'divi-shop-builder' ),
						'priority'          => 40,
					),
					'tables' => array (
						'title'             => esc_html__( 'Tables', 'divi-shop-builder' ),
						'priority'          => 45,
					),
					'tables_th' => array (
						'title'             => esc_html__( 'Table Headings', 'divi-shop-builder' ),
						'priority'          => 50,
					),
					'tables_td' => array (
						'title'             => esc_html__( 'Table Columns', 'divi-shop-builder' ),
						'priority'          => 55,
					),
					'labels' => array (
						'title'             => esc_html__( 'Form Labels', 'divi-shop-builder' ),
						'priority'          => 60,
					),
					'fields' => array (
						'title'             => esc_html__( 'Form Fields', 'divi-shop-builder' ),
						'priority'          => 65,
					),
					'dropdowns' => array (
						'title'             => esc_html__( 'Form Dropdowns', 'divi-shop-builder' ),
						'priority'          => 70,
					),
				)
			)
		);

		$this->advanced_fields = array(
			'fonts' => array(
				'account_content_body'     => array(
					'label'           => esc_html__( '', 'divi-shop-builder' ), // leave empty, text is added by default
					'css'             => array(
						'line_height' => "{$this->main_css_element}",
						'color'       => "{$this->main_css_element}",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'toggle_slug'     => 'account_content_body',
					'sub_toggle'      => 'p',
					'hide_text_align' => true,
				),
				'a'     => array(
					'label'       => esc_html__( 'Link', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} a"
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'account_content_body',
					'sub_toggle'  => 'a',
				),
				'header' => array(
					'label'        => esc_html__( '', 'divi-shop-builder' ),
					'css'          => array(
						'main'      => "{$this->main_css_element} h2, {$this->main_css_element} h1, {$this->main_css_element} h3, {$this->main_css_element} h4, {$this->main_css_element} h5, {$this->main_css_element} h6",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
					),
					'toggle_slug'     => 'account_content_headings',
					'priority' => 2
				),
				'tables_th'     => array(
					'label'           => esc_html__( 'Table Headings', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} table th",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'toggle_slug'     => 'tables_th'
				),
				'tables_td'     => array(
					'label'       => esc_html__( 'Table Columns', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} table td",
					),
					'line_height' => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'toggle_slug' => 'tables_td'
				),
				'mark'			=> array (
					'label'           => esc_html__( 'Highlight Mark', 'divi-shop-builder' ),
					'css'             => array(
						'main'        => "{$this->main_css_element} mark",
						'background-color' => "{$this->main_css_element} mark",
					),
					'toggle_slug'     => 'mark',
				),

			),
			'button' => array(
				'buttons' => array(
					'label'          => esc_html__( 'Buttons', 'divi-shop-builder' ),
					'toggle_slug'     => 'buttons',
					'css'            => array(
						'main'         => "[class*='woocommerce'] .woocommerce-MyAccount-content .button",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'label' => esc_html__( 'Buttons Box Shadow', 'divi-shop-builder' ),
						'css' => array(
							'main'      => ".woocommerce .woocommerce-MyAccount-content .button, .woocommerce-page .woocommerce-MyAccount-content .button",
							'important' => true,
						)
					),
					'use_alignment' => false,
					'margin_padding' => array (
						'css' => array (
							'main'      => ".woocommerce .woocommerce-MyAccount-content .button, .woocommerce-page .woocommerce-MyAccount-content .button",
							'important' => 'all'
						)
					),
					'icon' => array (
						'css' => array (
							'main'      => "[class*='woocommerce'] .woocommerce-MyAccount-content .button::after",
							'important' => 'all'
						)
					)
				)
			),
			'form_field' => array(
				'fields'        => array(
					'label'           => esc_html__( 'Fields', 'divi-shop-builder' ),
					'toggle_slug'     => 'fields',
					'css'             => array(
						'background_color'       => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						'main'                   => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						'background_color_hover' => "{$this->main_css_element} .form-row input.input-text:hover, {$this->main_css_element} .form-row textarea:hover",
						'focus_background_color' => "{$this->main_css_element} .form-row input.input-text:focus, {$this->main_css_element} .form-row textarea:focus",
						'form_text_color'        => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						'form_text_color_hover'  => "{$this->main_css_element} .form-row input.input-text:hover, {$this->main_css_element} .form-row textarea:hover",
						'focus_text_color'       => "{$this->main_css_element} .form-row textarea:focus, {$this->main_css_element} .form-row input.input-text:focus",
						'placeholder_focus'      => "{$this->main_css_element} .form-row input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row textarea:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .form-row textarea:focus::-moz-placeholder, {$this->main_css_element} .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .form-row textarea:focus:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						'margin'                 => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						'important'              => array(
							'background_color',
							'background_color_hover',
							'focus_background_color',
							'form_text_color',
							'form_text_color_hover',
							'text_color',
							'focus_text_color',
							'padding',
							'margin',
						),
					),
					'box_shadow'      => array(
						'name'              => 'fields',
						'css'               => array(
							'main' => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
						),
						'default_on_fronts' => array(
							'color'    => '#000',
							'position' => '',
						)
					),
					'border_styles'   => array(
						'fields'       => array(
							'name'         => 'fields',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
									'border_styles' => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '0px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'label_prefix' => esc_html__( 'Fields', 'divi-shop-builder' ),
						),
						'fields_focus' => array(
							'name'         => 'fields_focus',
							'css'          => array(
								'main' => array(
									'border_radii'  => "{$this->main_css_element} .form-row input.input-text:focus, {$this->main_css_element} .form-row textarea:focus",
									'border_styles' => "{$this->main_css_element} .form-row input.input-text:focus, {$this->main_css_element} .form-row textarea:focus"
								),
								'important' => 'all',
							),
							'label_prefix' => esc_html__( 'Fields On Focus', 'divi-shop-builder' ),
						),
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
							),
							'hover'     => array(
								"{$this->main_css_element} .form-row input.input-text:hover, {$this->main_css_element} .form-row textarea:hover",
								"{$this->main_css_element} .form-row input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row textarea:focus::-webkit-input-placeholder",
								"{$this->main_css_element} .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .form-row textarea:focus::-moz-placeholder",
								"{$this->main_css_element} .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .form-row textarea:focus:focus:-ms-input-placeholder",
							),
							'important' => 'all',
						),
						'font_size'   => array(
							'default' => '14px',
						),
						'line_height' => array(
							'default' => 'normal',
						),
					),
					'margin_padding'  => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
							'padding'   => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
							'margin'    => "{$this->main_css_element} .form-row input.input-text, {$this->main_css_element} .form-row textarea",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					)
				),
				'labels'		=> array (
					'label'           => esc_html__( 'Labels', 'divi-shop-builder' ),
					'toggle_slug'     => 'labels',
					'css'             => array(
						'main'        => "{$this->main_css_element} .form-row label",
					),
					'background'	=> false,
					'box_shadow'     => false,
					'border_styles' => false,
					'font_field'     => array(
						'css'         => array(
							'main'  => "{$this->main_css_element} .form-row label",
						),
						'line_height' => array(
							'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
						),
						'font_size'   => array(
							'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
						),
						'toggle_slug' => 'labels'
					),
					'margin_padding'  => array(
						'css' => array(
							'main'      => "{$this->main_css_element} label",
							'padding'   => "{$this->main_css_element} label",
							'margin'    => "{$this->main_css_element} label",
							'important' => 'all'
						)
					)
				),
				'dropdowns'     => array(
					'label'           => esc_html__( 'Dropdowns', 'divi-shop-builder' ),
					'toggle_slug'     => 'dropdowns',
					'toggle_priority' => 60,
					'css'             => array(
						'main'                   => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
						'background_color'       => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
						'background_color_hover' => "{$this->main_css_element} .form-row select:hover, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:hover",
						'focus_background_color' => "{$this->main_css_element} .form-row select:focus, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus",
						'form_text_color'        => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single .select2-selection__rendered",
						'form_text_color_hover'  => "{$this->main_css_element} .form-row select:hover, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:hover .select2-selection__rendered",
						'focus_text_color'       => "{$this->main_css_element} .form-row select:focus, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus .select2-selection__rendered",
						'placeholder_focus'      => "{$this->main_css_element} .form-row select:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .form-row textarea:focus::-moz-placeholder, {$this->main_css_element} .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .form-row textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
						'margin'                 => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
						'important'              => array(
							'background_color',
							'background_color_hover',
							'focus_background_color',
							'form_text_color',
							'form_text_color_hover',
							'text_color',
							'focus_text_color',
							'padding',
							'margin',
						),
					),
					'box_shadow'      => array(
						'name'              => 'dropdowns',
						'css'               => array(
							'main' => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						)
					),
					'border_styles'   => array(),
					'font_field'      => array(
						'css'         => array(
							'main'            => implode(
								', ',
								array(
									"{$this->main_css_element} .form-row select",
									"{$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
									"li.select2-results__option",

								)
							),
							'hover'            => implode(
								', ',
								array(
									"{$this->main_css_element} .form-row select:hover",
									"{$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:hover .select2-selection__rendered",
									".select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]",
								)
							),
							'important' => 'all',
						),
					),
					'margin_padding'  => array(
						'css' => array(
							'main' => implode(
								', ',
								array(
									"{$this->main_css_element} .form-row select",
									"{$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
									"li.select2-results__option",
								)
							),
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array(
						'item' => 'edit-account',
						'item' => 'edit-billing',
						'item' => 'edit-shipping'
						)
				),
			),
			'borders' => array(
				'default' => array(
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element}",
							'border_radii' 	=> "{$this->main_css_element}"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_styles' => array(
							'width' => '0px',
							'style' => 'none',
						),
					)
				),
				'tables' => array(
					'label_prefix'	  => esc_html__( 'Tables Border', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} table",
							'border_radii' 	=> "{$this->main_css_element} table"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'width' => '',
							'style' => 'none',
							'color' => ''
						),
					),
					'toggle_slug'     => 'tables'
				),
				'table_th' => array(
					'label_prefix'    => esc_html__( 'Table Headings', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} table th",
							'border_radii' 	=> "{$this->main_css_element} table th"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'width' => '',
							'style' => 'none',
							'color' => ''
						),
					),
					'toggle_slug' 	  => 'tables_th',
				),
				'table_td' => array(
					'label_prefix'    => esc_html__( 'Table Columns', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} table td",
							'border_radii' 	=> "{$this->main_css_element} table td"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'width' => '',
							'style' => 'none',
							'color' => ''
						),
					),

					'toggle_slug' 	  => 'tables_td',
				),
				'dropdowns_border'       => array(
					'name'         => 'fields',
					'css'          => array(
						'main'      => array(
							'border_radii'  => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single",
							'border_styles' => "{$this->main_css_element} .form-row select, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single"
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Dropdown', 'divi-shop-builder' ),
					'toggle_slug' 	  => 'dropdowns',
					'fields_after' => array(
						'use_focus_border' => array(
							'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
							'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
							'type'             => 'yes_no_button',
							'option_category' => 'basic_option',
							'options'          => array(
								'off' => et_builder_i18n( 'No' ),
								'on'  => et_builder_i18n( 'Yes' ),
							),
							'affects'          => array(
								'border_radii_focus',
								'border_styles_focus',
							),
							'tab_slug'         => 'advanced',
							'toggle_slug'      => 'dropdowns',
							'default_on_front' => 'off',
						),
					),
				),

				'dropdowns_border_focus'       => array(
					'name'         => 'fields_focus',
					'css'          => array(
						'main'      => array(
							'border_radii'  => "{$this->main_css_element} .form-row select:focus, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus",
							'border_styles' => "{$this->main_css_element} .form-row select:focus, {$this->main_css_element} .form-row .select2.select2-container .select2-selection--single:focus"
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Dropdown On Focus', 'divi-shop-builder' ),
					'toggle_slug' 	  => 'dropdowns',
					'depends_on'      => array( 'use_focus_border' ),
					'depends_show_if' => 'on',
				),
			),
			'link_options' => false,
			'text' 		   => false,
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main'      =>  "{$this->main_css_element}"
					)
				)
			)

		);

		add_filter( 'dswcp_builder_js_data', array( $this, 'builder_js_data' ) );
	}

	public function get_fields(){

		$menu_items = wc_get_account_menu_items();
		$keys		= array_keys( $menu_items );

		if( count( $menu_items ) ){
			$menu_items = array_slice( $menu_items, 0, count( $menu_items ) - 1, true ) + array(
				'view-order' => esc_html__( 'View Order', 'divi-shop-builder' ),
				'edit-billing' => esc_html__( 'Edit Billing Address', 'divi-shop-builder' ),
				'edit-shipping' => esc_html__( 'Edit Shipping Address', 'divi-shop-builder' ),
			);
		}

		return array(
			'current_view' => array(
				'label'            => esc_html__( 'Current View', 'divi-shop-builder' ),
				'description'      => esc_html__( 'Choose the view to edit.', 'divi-shop-builder' ),
				'type'             => 'select',
				'option_category'  => 'basic_option',
				'options'          => $menu_items,
				'default'		   => reset( $keys ),
			),
			'mark_background'     => array(
				'label'           => esc_html__( 'Highlight Mark Background', 'divi-shop-builder' ),

				'description'     => esc_html__( 'Set custom background color for mark', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'        => et_builder_accent_color(),
				'tab_slug'       => 'advanced',
				'toggle_slug'     => 'mark',
				'mobile_options'  => false,
				'hover'           => 'tabs',
			),

			'dropdowns_hover_bg_item' => array(
				'label'           => esc_html__( 'Selected Dropdown Option Background Color', 'divi-shop-builder' ),
				'description'     => esc_html__( "Pick a color to use for Selected Dropdown Background. ", 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'        => et_builder_accent_color(),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'dropdowns',
				'hover'           => false,
				'mobile_options'  => false,
			),
			'dropdowns_hover_color_item' => array(
				'label'           => esc_html__( 'Selected Dropdown Option Font Color', 'divi-shop-builder' ),
				'description'     => esc_html__( "Pick a color to use for Selected Dropdown. ", 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'        =>  '#ffffff',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'dropdowns',
				'hover'           => false,
				'mobile_options'  => false,
			),
			'tables_th_padding'     => array(
				'label'           => esc_html__( 'Tables Headings Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'description'     => esc_html__( 'Set custom padding for tables headings.', 'divi-shop-builder' ),
				'tab_slug'       => 'advanced',
				'toggle_slug'     => 'tables_th',
				'mobile_options'  => true,
			),
			'tables_td_padding'     => array(
				'label'           => esc_html__( 'Tables Columns Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'description'     => esc_html__( 'Set custom padding for tables headings.', 'divi-shop-builder' ),
				'tab_slug'       => 'advanced',
				'toggle_slug'     => 'tables_td',
				'mobile_options'  => true,
			),
			'tables_th_bg_color'      => array(
				'default'         => 'rgba(255,255,255,0.9)',
				'label'           => esc_html__( 'Tables Headings Background', 'divi-shop-builder' ),
				'description'     => esc_html__( "Pick a color to use behind for table headings. ", 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tables_th',
				'hover'           => false,
				'mobile_options'  => false,
				'sticky'          => false,
			),
			'tables_td_bg_color'      => array(
				'default'         => 'rgba(255,255,255,0.9)',
				'label'           => esc_html__( 'Tables Columns Background', 'divi-shop-builder' ),
				'description'     => esc_html__( "Pick a color to use behind for table headings. ", 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tables_td',
				'hover'           => false,
				'mobile_options'  => false,
				'sticky'          => false,
			),
		);
	}

	public function render( $attrs, $content, $render_slug ){

		if ( !is_user_logged_in() || isset( $wp->query_vars['lost-password'] ) ) {
			return do_shortcode('[woocommerce_my_account]');
		}
		$button_view_icon = !empty( $this->props['buttons_icon'] ) ? $this->props['buttons_icon'] : 'off';
		
		if( !empty( $this->props['buttons_icon'] ) ){
			$icon = dswcp_decoded_et_icon( et_pb_process_font_icon( $this->props['buttons_icon'] ) );
			$position = $this->props['buttons_icon_placement'] === 'left' ? 'before' : 'after';									
			self::set_style( $this->slug, array(
				'selector' 	  => "%%order_class%% .woocommerce-MyAccount-content .button:{$position}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		// Mark Background
		if( !empty( $this->props['mark_background'] ) ) {
			self::set_style($this->slug, array(
				'selector'    => '%%order_class%% .woocommerce-MyAccount-content mark',
				'declaration' => "background-color: {$this->props['mark_background']} ;"
			));
		}

		// Open Dropdowns Option Hover Background
		if( !empty( $this->props['dropdowns_hover_bg_item'] ) ) {
			self::set_style($this->slug, array(
				'selector'    => '.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]',
				'declaration' => "background-color: {$this->props['dropdowns_hover_bg_item']} !important;"
			));
		}
		// Open Dropdowns Option Hover Color
		if( !empty( $this->props['dropdowns_hover_color_item'] ) ) {
			self::set_style($this->slug, array(
				'selector'    => '.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]',
				'declaration' => "color: {$this->props['dropdowns_hover_color_item']};"
			));
		}

		// Tables Heading Background
		if( !empty( $this->props['tables_th_bg_color'] ) ) {
			self::set_style($this->slug, array(
				'selector'    => '%%order_class%% .woocommerce-MyAccount-content table th',
				'declaration' => "background-color: {$this->props['tables_th_bg_color']}  ;"
			));
		}
		// Tables Columns Background
		if( !empty( $this->props['tables_td_bg_color'] ) ) {
			self::set_style($this->slug, array(
				'selector'    => '%%order_class%% .woocommerce-MyAccount-content table td',
				'declaration' => "background-color: {$this->props['tables_td_bg_color']}  ;"
			));
		}

		// Tables Heading Padding
		if ($this->props['tables_th_padding']) {
			$value = explode( '|', $this->props['tables_th_padding'] );
			$this->props['tables_th_padding'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}

		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'tables_th_padding',
				'selector'       => '%%order_class%% .woocommerce-MyAccount-content table th',
				'css_property'   => 'padding',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		// Tables Columns Padding
		if ($this->props['tables_td_padding']) {
			$value = explode( '|', $this->props['tables_td_padding'] );
			$this->props['tables_td_padding'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}

		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'tables_td_padding',
				'selector'       => '%%order_class%% .woocommerce-MyAccount-content table td',
				'css_property'   => 'padding',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		return sprintf(
			'<div class="woocommerce">%s</div>',
			$this->content
		);
	}

	public function builder_js_data( $data ){
		$locals = array(
			'dashboard_html' => $this->get_output_by_type( 'dashboard' ),
			'downloads_html' => $this->get_output_by_type( 'downloads' ),
			'edit-address_html' => $this->get_output_by_type( 'edit-address' ),
			'edit-account_html' => $this->get_output_by_type( 'edit-account' ),
			'orders_html' => $this->get_output_by_type( 'orders' ),
			'edit-billing_html' => $this->get_output_by_type( 'edit-billing' ),
			'edit-shipping_html' => $this->get_output_by_type( 'edit-shipping' ),
			'subscriptions_html' => $this->get_output_by_type( 'subscriptions' ),
			'i18n' => array(
				'order_placed' => sprintf(
					/* translators: 1: order number 2: order date 3: order status */
					esc_html__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'divi-shop-builder' ),
					'<mark class="order-number">123</mark>',
					'<mark class="order-date">' . wc_format_datetime( new WC_DateTime() ) . '</mark>',
					'<mark class="order-status">Processing</mark>'
				),
				'order_details' => esc_html__( 'Order details', 'divi-shop-builder' ),
				'product' => esc_html__( 'Product', 'divi-shop-builder' ),
				'total' => esc_html__( 'Total', 'divi-shop-builder' ),
				'product_name' => esc_html__( 'My Awesome Product', 'divi-shop-builder' ),
				'subtotal' => esc_html__( 'Subtotal', 'divi-shop-builder' ),
				'shipping' => esc_html__( 'Shipping', 'divi-shop-builder' ),
				'payment_method' => esc_html__( 'Payment method', 'divi-shop-builder' ),
				'billing' => esc_html__( 'Billing address', 'divi-shop-builder' ),
				'shipping' => esc_html__( 'Shipping address', 'divi-shop-builder' ),
			)
		);

		$data['account_contents'] = $locals;

		return $data;
	}

	private function get_output_by_type( $type = 'dashboard' ){

		ob_start();

		switch( $type ){
			case 'downloads':
				wc_load_cart();
				woocommerce_account_downloads();
				break;
			case 'edit-address':
				woocommerce_account_edit_address(false);
				break;
			case 'edit-billing':
				woocommerce_account_edit_address('billing');
				break;
			case 'edit-shipping':
				woocommerce_account_edit_address('shipping');
				break;
			case 'edit-account':
				woocommerce_account_edit_account();
				break;
			case 'orders':
				woocommerce_account_orders(0);
				break;
			default:
				if ( has_action('woocommerce_account_'.$type.'_endpoint') ) {
					do_action('woocommerce_account_'.$type.'_endpoint');
				} else{
					wc_get_template(
						'myaccount/dashboard.php',
						array(
							'current_user' => get_user_by( 'id', get_current_user_id() ),
						)
					);
				}
				break;
		}

		return sprintf( '<div class="%s"><div class="%s">%s</div></div>', 'woocommerce-MyAccount-content', "{$type}-wrapper", ob_get_clean() );
	}
}

new DSWCP_WooAccountContent;