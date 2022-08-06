<?php

defined( 'ABSPATH' ) || exit;

/**
 * Module class of Woo My Account Avatar
 *
 */
class DSWCP_WooAccountContentItem extends ET_Builder_Module {

    public $slug       		= 'ags_woo_account_content_item';
	public $vb_support 		= 'on';
	public $type 	   		= 'child';
	public $child_title_var = 'item_title';
	// public $advanced_fields = false;
	// public $custom_css_tab  = false;


	protected $module_credits = array(
		'module_uri' => 'https://divi.space/',
		'author'     => 'Divi Space',
		'author_uri' => 'https://divi.space/',
	);

	public function init() {
		$this->name = esc_html__( 'Account Content Item', 'divi-shop-builder' );
		$this->icon  = 'G';

		$this->main_css_element = '%%order_class%% .woocommerce-MyAccount-content';

		$this->settings_modal_toggles = array(
			'general'    => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'divi-shop-builder' ),
				),
			),
			'advanced'	=> array(
				'toggles' => array(
					'dashboard_text'   => array(
						'title'             => esc_html__( 'Dashboard Text', 'divi-shop-builder' ),
						'tabbed_subtoggles' => true,
						'bb_icons_support'  => true,
						'sub_toggles'       => array(
							'p'     => array(
								'name' => 'P',
								'icon' => 'text-left',
							),
							'a'     => array(
								'name' => 'A',
								'icon' => 'text-link',
							),
							'strong'    => array(
								'name' => 'STRONG',
								'icon' => 'text-bold',
							)
						)
					),
					'account_details_labels'   => array(
						'title'             => esc_html__( 'Account Details Labels', 'divi-shop-builder' )
					),
					'account_details_fields'   => array(
						'title'             => esc_html__( 'Account Details Fields', 'divi-shop-builder' )
					),
					'account_details_dropdowns'   => array(
						'title'             => esc_html__( 'Account Details Dropdowns', 'divi-shop-builder' )
					),
					'account_details_buttons'   => array(
						'title'             => esc_html__( 'Account Details Buttons', 'divi-shop-builder' )
					),
					'downloads_table'   => array(
						'title'             => esc_html__( 'Downloads Table', 'divi-shop-builder' )
					),
					'downloads_table_head'   => array(
						'title'             => esc_html__( 'Downloads Table Head', 'divi-shop-builder' )
					),
					'downloads_table_column'   => array(
						'title'             => esc_html__( 'Downloads Table Column', 'divi-shop-builder' )
					),
					'downloads_table_link'   => array(
						'title'             => esc_html__( 'Downloads Table Link', 'divi-shop-builder' )
					),
					'downloads_no_items'   => array(
						'title'             => esc_html__( 'Downloads No Items', 'divi-shop-builder' )
					),
					'downloads_buttons_download'   => array(
						'title'             => esc_html__( 'Downloads Buttons', 'divi-shop-builder' )
					),
					'downloads_buttons_browse'   => array(
						'title'             => esc_html__( 'Browse Products Buttons', 'divi-shop-builder' )
					),
					'orders_table'   => array(
						'title'             => esc_html__( 'Orders Table', 'divi-shop-builder' )
					),
					'orders_table_head'   => array(
						'title'             => esc_html__( 'Orders Table Head', 'divi-shop-builder' )
					),
					'orders_table_column'   => array(
						'title'             => esc_html__( 'Orders Table Column', 'divi-shop-builder' )
					),
					'orders_table_link'   => array(
						'title'             => esc_html__( 'Orders Table Link', 'divi-shop-builder' )
					),
					'orders_no_items'   => array(
						'title'             => esc_html__( 'Orders No Items', 'divi-shop-builder' )
					),
					'orders_buttons'   => array(
						'title'             => esc_html__( 'Orders View Buttons', 'divi-shop-builder' )
					),
					'orders_buttons_browse'   => array(
						'title'             => esc_html__( 'Orders Browse Buttons', 'divi-shop-builder' )
					),
					'orders_buttons_download'   => array(
						'title'             => esc_html__( 'Orders Download Buttons', 'divi-shop-builder' )
					),
					'orders_buttons_order'   => array(
						'title'             => esc_html__( 'Order Again Button', 'divi-shop-builder' )
					),
					'orders_pagination_buttons'   => array(
						'title'             => esc_html__( 'Order Pagination Buttons', 'divi-shop-builder' )
					),
					'address_text'   => array(
						'title'             => esc_html__( 'Address Text', 'divi-shop-builder' )
					),
					'address_billing_title'   => array(
						'title'             => esc_html__( 'Billing Address Title', 'divi-shop-builder' )
					),
					'address_billing_form_title'   => array(
						'title'             => esc_html__( 'Billing Address Form Title', 'divi-shop-builder' )
					),
					'address_shipping_title'   => array(
						'title'             => esc_html__( 'Shipping Address Title', 'divi-shop-builder' )
					),
					'address_shipping_form_title'   => array(
						'title'             => esc_html__( 'Shipping Address Form Title', 'divi-shop-builder' )
					),
					'address_billing'   => array(
						'title'             => esc_html__( 'Billing Address', 'divi-shop-builder' )
					),
					'address_shipping'   => array(
						'title'             => esc_html__( 'Shipping Address', 'divi-shop-builder' )
					),
					'address_billing_label'   => array(
						'title'             => esc_html__( 'Billing Address Labels', 'divi-shop-builder' )
					),
					'address_shipping_label'   => array(
						'title'             => esc_html__( 'Shipping Address Labels', 'divi-shop-builder' )
					),
					'address_billing_field'   => array(
						'title'             => esc_html__( 'Billing Address Fields', 'divi-shop-builder' )
					),
					'address_shipping_field'   => array(
						'title'             => esc_html__( 'Shipping Address Fields', 'divi-shop-builder' )
					),
					'address_buttons'   => array(
						'title'             => esc_html__( 'Address Buttons', 'divi-shop-builder' )
					),
					'address_billing_save_button'   => array(
						'title'             => esc_html__( 'Billing Address Save Button', 'divi-shop-builder' )
					),
					'address_shipping_save_button'   => array(
						'title'             => esc_html__( 'Shipping Address Save Button', 'divi-shop-builder' )
					),
					'address_billing_shipping_wrappers'   => array(
						'title'             => esc_html__( 'Billing/Shipping Wrappers', 'divi-shop-builder' )
					),
					'view_order_text'   => array(
						'title'             => esc_html__( 'View Order Text', 'divi-shop-builder' )
					),
					'view_order_details'   => array(
						'title'             => esc_html__( 'View Order Details', 'divi-shop-builder' )
					),
					'view_order_table_head'   => array(
						'title'             => esc_html__( 'View Order Table Head', 'divi-shop-builder' )
					),
					'view_order_table_column'   => array(
						'title'             => esc_html__( 'View Order Table Column', 'divi-shop-builder' )
					),
					'view_order_table_footer'   => array(
						'title'             => esc_html__( 'View Order Table Footer', 'divi-shop-builder' )
					),
					'view_order_billing'   => array(
						'title'             => esc_html__( 'View Order Billing', 'divi-shop-builder' )
					),
					'view_order_shipping'   => array(
						'title'             => esc_html__( 'View Order Shipping', 'divi-shop-builder' )
					),
				)
			)
		);

		$this->advanced_fields = array(
			'fonts' => array(
				// dashboard font settings start
				'dashboard_text'     => array(
					'label'           => esc_html__( 'Text', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .dashboard-wrapper p",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'dashboard_text',
					'sub_toggle' 	  => 'p',
					'depends_show_if' => 'dashboard'
				),
				'dashboard_link'     => array(
					'label'       => esc_html__( 'Link', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .dashboard-wrapper a",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'dashboard_text',
					'sub_toggle'  => 'a',
					'depends_show_if' => 'dashboard'
				),
				'dashboard_strong'     => array(
					'label'       => esc_html__( 'Bold', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .dashboard-wrapper strong",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'dashboard_text',
					'sub_toggle'  => 'strong',
					'depends_show_if' => 'dashboard'
				),
				// dashboard fonts settings end

				// account details fonts settings start
				'account_details_labels'     => array(
					'label'       => esc_html__( 'Labels', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-account-wrapper .form-row label",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'account_details_labels',
					'toggle_priority' => 10,
					'depends_show_if' => 'edit-account'
				),
				// account details fonts settings end

				// account downloads fonts settings start
				'downloads_th'     => array(
					'label'           => esc_html__( 'Downloads Table Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .downloads-wrapper table thead th, {$this->main_css_element} table th",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'downloads_table_head',
					'depends_show_if' => 'downloads'
				),
				'downloads_td'     => array(
					'label'       => esc_html__( 'Downloads Table Column', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .downloads-wrapper table tbody td",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'downloads_table_column',
					'depends_show_if' => 'downloads'
				),
				'downloads_table_link'     => array(
					'label'       => esc_html__( 'Table Link', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .downloads-wrapper table a:not(.button)",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'downloads_table_link',
					'depends_show_if' => 'downloads'
				),
				'downloads_no_items' => array(
					'label'       => esc_html__( 'No Downloads', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info",
						'important' => array( 'size', 'font-size' ),
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info",
							'important' => true,
						),
					),
					'toggle_slug' => 'downloads_no_items',
					'depends_show_if' => 'downloads'
				),
				// account downloads fonts settings end

				// account orders fonts settings start
				'orders_th'     => array(
					'label'           => esc_html__( 'Orders Table Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table.woocommerce-MyAccount-orders thead th, {$this->main_css_element} table th",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'orders_table_head',
					'depends_show_if' => 'orders'
				),
				'orders_td'     => array(
					'label'       => esc_html__( 'Orders Table Column', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table.woocommerce-MyAccount-orders tbody td",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'orders_table_column',
					'depends_show_if' => 'orders'
				),
				'orders_table_link'     => array(
					'label'       => esc_html__( 'Orders Table Link', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table.woocommerce-MyAccount-orders a:not(.button)",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'orders_table_link',
					'depends_show_if' => 'orders'
				),
				'orders_no_items' => array(
					'label'       => esc_html__( 'No Orders', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .orders-wrapper .woocommerce-Message.woocommerce-Message--info",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'orders_no_items',
					'depends_show_if' => 'orders'
				),
				// account orders fonts settings end

				// account address fonts settings start
				'address_text'     => array(
					'label'           => esc_html__( 'Address Text', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .edit-address-wrapper p",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'address_text',
					'depends_show_if' => 'edit-address'
				),
				'address_billing_title'		 => array(
					'label'       => esc_html__( 'Billing Title', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-address-wrapper .u-column1.woocommerce-Address .woocommerce-Address-title h3",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '22px',
					),
					'toggle_slug' => 'address_billing_title',
					'depends_show_if' => 'edit-address'
				),
				'address_billing_form_title'		 => array(
					'label'       => esc_html__( 'Billing Form Title', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-billing-wrapper form > h3",
					),
					'toggle_slug' => 'address_billing_form_title',
					'depends_show_if' => 'edit-address'
				),
				'address_billing'    => array(
					'label'       => esc_html__( 'Billing Address', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-address-wrapper .u-column1.woocommerce-Address address",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'address_billing',
					'depends_show_if' => 'edit-address'
				),
				'address_shipping_title'     => array(
					'label'       => esc_html__( 'Shipping Title', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-address-wrapper .u-column2.woocommerce-Address .woocommerce-Address-title h3",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '22px',
					),
					'toggle_slug' => 'address_shipping_title',
					'depends_show_if' => 'edit-address'
				),
				'address_shipping_form_title'		 => array(
					'label'       => esc_html__( 'Shipping Form Title', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-shipping-wrapper form > h3",
					),
					'toggle_slug' => 'address_shipping_form_title',
					'depends_show_if' => 'edit-address'
				),
				'address_shipping'   => array(
					'label'       => esc_html__( 'Shipping Address', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-address-wrapper .u-column2.woocommerce-Address address",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'address_shipping',
					'depends_show_if' => 'edit-address'
				),
				'address_billing_label'     => array(
					'label'       => esc_html__( 'Billing Address Labels', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] label",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'address_billing_label',
					'depends_show_if' => 'edit-address'
				),
				'address_shipping_label'     => array(
					'label'       => esc_html__( 'Shipping Address Labels', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] label",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'address_shipping_label',
					'depends_show_if' => 'edit-address'
				),
				// account address fonts settings end

				// account view order fonts settings start
				'view_order_text'     => array(
					'label'           => esc_html__( 'Order Message', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper p:not(address > p)",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_text',
					'depends_show_if' => 'orders'
				),
				'view_order_details'     => array(
					'label'       => esc_html__( 'Order Details Heading', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details .woocommerce-order-details__title",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '26px',
					),
					'toggle_slug' => 'view_order_details',
					'depends_show_if' => 'orders'
				),
				'view_order_table_head'     => array(
					'label'           => esc_html__( 'Order Table Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table thead th",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_head',
					'depends_show_if' => 'orders'
				),
				'view_order_table_column'     => array(
					'label'           => esc_html__( 'Table Column', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table td",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_column',
					'depends_show_if' => 'orders'
				),
				'view_order_table_link'     => array(
					'label'           => esc_html__( 'Table Links', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table td a",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_column',
					'depends_show_if' => 'orders'
				),
				'view_order_table_strong'     => array(
					'label'           => esc_html__( 'Table Column Bold', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table td strong",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_column',
					'depends_show_if' => 'orders'
				),
				'view_order_table_foot_head'     => array(
					'label'           => esc_html__( 'Table Footer Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table tfoot th",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_footer',
					'depends_show_if' => 'orders'
				),
				'view_order_table_foot_column'     => array(
					'label'           => esc_html__( 'Table Footer Column', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-order-details table tfoot td",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_table_footer',
					'depends_show_if' => 'orders'
				),
				'view_order_billing_heading'     => array(
					'label'           => esc_html__( 'Billing Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address h2",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default' => '26px',
					),
					'toggle_slug'     => 'view_order_billing',
					'depends_show_if' => 'orders'
				),
				'view_order_billing_address'     => array(
					'label'           => esc_html__( 'Billing Address', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_billing',
					'depends_show_if' => 'orders'
				),
				'view_order_shipping_heading'     => array(
					'label'           => esc_html__( 'Shipping Heading', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address h2",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default' => '26px',
					),
					'toggle_slug'     => 'view_order_shipping',
					'depends_show_if' => 'orders'
				),
				'view_order_shipping_address'     => array(
					'label'           => esc_html__( 'Shipping Address', 'divi-shop-builder' ),
					'css'             => array(
						'main'  	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'view_order_shipping',
					'depends_show_if' => 'orders'
				),
				// account view order fonts settings end
			),
			'borders' => array(
				// account downloads border settings start
				'downloads_table' => array(
					'label_prefix'	  => esc_html__( 'Downloads Table Border', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads",
							'border_radii' 	=> "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|5px|5px|5px|5px',
						'border_styles' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#eee'
						),
					),
					'toggle_slug'     => 'downloads_table',
					'show_if'	=> array(
						'item' => 'downloads'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'downloads'
				),
				'downloads_table_td' => array(
					'label_prefix'    => esc_html__( 'Downloads Table Column', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td",
							'border_radii' 	=> "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '0px',
							'style' => 'solid',
							'color' => '#eee'
						),
						'composite'     => array(
							'border_top' => array(
								'border_width_top' => '1px',
								'border_style_top' => 'solid',
								'border_color_top' => '#eee',
							),
						)
					),
					'toggle_slug' 	  => 'downloads_table_column',
					'show_if'	=> array(
						'item' => 'downloads'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'downloads'
				),
				// account downloads border settings end

				// account orders border settings start
				'orders_table' => array(
					'label_prefix'	  => esc_html__( 'Orders Table Border', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table",
							'border_radii' 	=> "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#eee'
						),
					),
					'toggle_slug'     => 'orders_table',
					'show_if'	=> array(
						'item' => 'orders'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'orders'
				),
				'orders_table_td' => array(
					'label_prefix'    => esc_html__( 'Orders Table Column', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table td.woocommerce-orders-table__cell",
							'border_radii' 	=> "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table td.woocommerce-orders-table__cell"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '0px',
							'style' => 'solid',
							'color' => '#eee'
						),
						'composite'     => array(
							'border_top' => array(
								'border_width_top' => '1px',
								'border_style_top' => 'solid',
								'border_color_top' => '#eee',
							),
						)
					),
					'toggle_slug' 	  => 'orders_table_column',
					'show_if'	=> array(
						'item' => 'orders'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'orders'
				),
				// account orders border settings end

				// view order border settings start
				'view_order_billing' => array(
					'label_prefix'	  => esc_html__( 'Billing Border', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address",
							'border_radii' 	=> "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|5px|5px|5px|5px',
						'border_styles' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#eee'
						),
						'composite'     => array(
							'border_bottom' => array(
								'border_width_bottom' => '2px',
								'border_style_bottom' => 'solid',
								'border_color_bottom' => '#eee',
							),
							'border_right' => array(
								'border_width_right' => '2px',
								'border_style_right' => 'solid',
								'border_color_right' => '#eee',
							),
						)
					),
					'toggle_slug'     => 'view_order_billing',
					'show_if'	=> array(
						'item' => 'orders'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'orders'
				),
				'view_order_shipping' => array(
					'label_prefix'	  => esc_html__( 'Shipping Border', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address",
							'border_radii' 	=> "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|5px|5px|5px|5px',
						'border_styles' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#eee'
						),
						'composite'     => array(
							'border_bottom' => array(
								'border_width_bottom' => '2px',
								'border_style_bottom' => 'solid',
								'border_color_bottom' => '#eee',
							),
							'border_right' => array(
								'border_width_right' => '2px',
								'border_style_right' => 'solid',
								'border_color_right' => '#eee',
							),
						)
					),
					'toggle_slug'     => 'view_order_shipping',
					'show_if'	=> array(
						'item' => 'orders'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'orders'
				),
				// view order border settings end

				//addresses start
				'address_billing_shipping_wrappers' => array(
					'label_prefix'	  => esc_html__( 'Billing/Shipping Borders', 'divi-shop-builder' ),
					'css'             => array(
						'main' 		  => array(
							'border_styles' => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address",
							'border_radii' 	=> "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address"
						),
						'important'   => 'all',
					),
					'defaults'  => array(
						'border_radii'  => 'on|5px|5px|5px|5px',
						'border_styles' => array(
							'width' => '0px',
							'style' => 'none',
							'color' => '#eee'
						),
					),
					'toggle_slug'     => 'address_billing_shipping_wrappers',
					'show_if'	=> array(
						'item' => 'edit-address'
					),
					'depends_on' => array('item'),
					'depends_show_if' => 'edit-address'
				)

				//addresses end
			),
			'button' => array(
				// account details submit settings start
				'account_details_submit' => array(
					'label'          => esc_html__( 'Submit Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'account_details_buttons',
					'css'            => array(
						'main'         => ".woocommerce {$this->main_css_element} .edit-account-wrapper .woocommerce-EditAccountForm.edit-account p button[type='submit']",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'label' => esc_html__( 'Submit Button Box Shadow', 'divi-shop-builder' ),
						'css' => array(
							'main'      => "{$this->main_css_element} .edit-account-wrapper .woocommerce-EditAccountForm.edit-account p button[type='submit']",
							'important' => true,
						),
						'show_if'	=> array(
							'custom_account_details_submit' => 'on',
							'item'							=> 'edit-account'
						)
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'edit-account'
				),
				// account details submit settings end

				// account downloads button settings start
				'downloads_button_view' => array(
					'label'          => esc_html__( 'Download Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'downloads_buttons_download',
					'css'            => array(
						'main'         => "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td.download-file .button",
						'alignment'    => "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td.download-file",
						'important'    => 'all',
					),
					// doesn't work for child modules
					'text_size' => array (
						'default' => 14
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => ".woocommerce {$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td.download-file .button",
							'important' => true,
						),
					),
					'margin_padding' => array (
						'css' => array (
							'important' => 'padding'
						)
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'downloads'
				),
				'downloads_button_browse' => array(
					'label'          => esc_html__( 'Browse Products Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'downloads_buttons_browse',
					'css'            => array(
						'main'         => "{$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info .button",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => ".woocommerce {$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info .button",
							'important' => true,
						),
					),
					// doesn't work for child modules
					'text_size' => array (
						'default' => 14
					),
					'margin_padding' => array (
						'css' => array (
							'important' => 'padding'
						)
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'downloads'
				),
				// account downloads button settings end

				// account orders button settings start
				'orders_button_view' => array(
					'label'          => esc_html__( 'Orders View Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'orders_buttons',
					'css'            => array(
						'main'         => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button",
						'alignment'    => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button",
							'important' => true,
						),
					),
					'margin_padding' => array (
						'css' => array (
							'main'      => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button",
							'important' => 'all'
						)
					),
					'icon' => array (
						'css' => array (
							'main'      => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button::after",
							'important' => 'all'
						)
					),
					'font_size'   => array(
						'default' =>  '14px',
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'orders'
				),
				'orders_button_browse' => array(
					'label'          => esc_html__( 'Orders Browse Products Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'orders_buttons_browse',
					'css'            => array(
						'main'         => "{$this->main_css_element} .orders-wrapper .woocommerce-Message.woocommerce-Message--info .button",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .orders-wrapper .woocommerce-Message.woocommerce-Message--info .button",
							'important' => true,
						),
						'show_if'	=> array(
							'custom_orders_button_browse' => 'on',
							'item'						=> 'orders'
						)
					),
					'margin_padding' => [
						'css' => [
							'important' => 'all'
						]
					],
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'orders'
				),
				'orders_button_download' => array(
					'label'          => esc_html__( 'Download Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'orders_buttons_download',
					'css'            => array(
						'main'         => ".woocommerce {$this->main_css_element} .view-order-wrapper .button.woocommerce-MyAccount-downloads-file",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => ".woocommerce {$this->main_css_element} .view-order-wrapper .button.woocommerce-MyAccount-downloads-file",
							'important' => true,
						),
					),
					'margin_padding' => [
						'css' => [
							'important' => 'all'
						]
					],
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'orders'
				),
				'orders_button_order' => array(
					'label'          => esc_html__( 'Order Again Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'orders_buttons_order',
					'css'            => array(
						'main'         => ".woocommerce {$this->main_css_element} .view-order-wrapper .order-again .button",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => ".woocommerce {$this->main_css_element} .view-order-wrapper .order-again .button",
							'important' => true,
						),
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'orders'
				),
				'orders_pagination_buttons' => array(
					'label'          => esc_html__( 'Order Pagination Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'orders_pagination_buttons',
					'css'            => array(
						'main'         => ".woocommerce {$this->main_css_element} .orders-wrapper .woocommerce-pagination .woocommerce-button.button",

						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      =>  ".woocommerce {$this->main_css_element} .orders-wrapper .woocommerce-pagination .woocommerce-button.button",
							'important' => true,
						),
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'orders'
				),
				// account orders button settings end

				// account address button settings start
				'address_button_edit' => array(
					'label'          => esc_html__( 'Addresses Edit Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_buttons',
					'css'            => array(
						'main'         => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address .woocommerce-Address-title a.edit",
						'important'    => 'all',
					),
					'border_width' => array(
						'default' => '0px'
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address .woocommerce-Address-title a.edit",
							'important' => true,
						),
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'edit-address'
				),
				'address_billing_button_save' => array(
					'label'          => esc_html__( 'Billing Save Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_billing_save_button',
					'css'            => array(
						'main'         => "{$this->main_css_element} .edit-billing-wrapper .woocommerce-address-fields p button[type='submit']",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .edit-billing-wrapper .woocommerce-address-fields p button[type='submit']",
							'important' => true,
						),
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'edit-address'
				),
				'address_shipping_button_save' => array(
					'label'          => esc_html__( 'Shipping Save Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_shipping_save_button',
					'css'            => array(
						'main'         => "{$this->main_css_element} .edit-shipping-wrapper .woocommerce-address-fields p button[type='submit']",
						'important'    => 'all',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => "{$this->main_css_element} .edit-shipping-wrapper .woocommerce-address-fields p button[type='submit']",
							'important' => true,
						),
					),
					'depends_on'      => array( 'item' ),
					'depends_show_if' => 'edit-address'
				)
				// account address button settings end
			),
			'form_field' => array(
				// account details field & dropdown settings start
				'account_details_fields'         => array(
					'label'           => esc_html__( 'Account Details Fields', 'divi-shop-builder' ),
					'toggle_slug'     => 'account_details_fields',
					'toggle_priority' => 60,
					'css'             => array(
						'background_color'       => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
						'main'                   => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
						'background_color_hover' => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:hover, {$this->main_css_element} .edit-account-wrapper .form-row textarea:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:hover, {$this->main_css_element} .edit-account-wrapper .form-row textarea:hover",
						'focus_text_color'       => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus",
						'placeholder_focus'      => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus::-moz-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
						'margin'                 => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
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
						'name'              => 'account_details_fields',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'show_if'	=> array(
							'item' => 'edit-account'
						)
					),
					'border_styles'   => array(
						'account_details_fields'       => array(
							'name'         => 'account_details_fields',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
									'border_styles' => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_account_details_fields_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_account_details_fields_focus",
										"border_styles_account_details_fields_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'account_details_fields',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-account'
									)
								),
							),
							'label_prefix' => esc_html__( 'Account Details Fields', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-account'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-account'
						)
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:hover, {$this->main_css_element} .edit-account-wrapper .form-row textarea:hover",
								"{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus::-webkit-input-placeholder",
								"{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus::-moz-placeholder",
								"{$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus:focus:-ms-input-placeholder",
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
							'main'      => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
							'padding'   => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
							'margin'    => "{$this->main_css_element} .edit-account-wrapper .form-row input.input-text, {$this->main_css_element} .edit-account-wrapper .form-row textarea",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-account' )
				),
				'account_details_dropdowns'         => array(
					'label'           => esc_html__( 'Account Details Dropdowns', 'divi-shop-builder' ),
					'toggle_slug'     => 'account_details_dropdowns',
					'toggle_priority' => 60,
					'css'             => array(
						'main'                   => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
						'background_color'       => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
						'background_color_hover' => "{$this->main_css_element} .edit-account-wrapper .form-row select:hover, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-account-wrapper .form-row select:focus, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single .select2-selection__rendered",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-account-wrapper .form-row select:hover, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:hover .select2-selection__rendered",
						'focus_text_color'       => "{$this->main_css_element} .edit-account-wrapper .form-row select:focus, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:focus .select2-selection__rendered",
						'placeholder_focus'      => "{$this->main_css_element} .edit-account-wrapper .form-row select:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus::-moz-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-account-wrapper .form-row textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
						'margin'                 => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
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
						'name'              => 'account_details_dropdowns',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'show_if'	=> array(
							'item' => 'edit-account'
						)
					),
					'border_styles'   => array(
						'account_details_dropdowns'       => array(
							'name'         => 'account_details_dropdowns',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
									'border_styles' => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_account_details_dropdowns_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_account_details_dropdowns_focus",
										"border_styles_account_details_dropdowns_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'account_details_dropdowns',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-account'
									)
								),
							),
							'label_prefix' => esc_html__( 'Account Details Dropdowns', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-account'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-account'
						)
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-account-wrapper .form-row select:hover, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single:hover .select2-selection__rendered"
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
							'main'      => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
							'padding'   => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
							'margin'    => "{$this->main_css_element} .edit-account-wrapper .form-row select, {$this->main_css_element} .edit-account-wrapper .form-row .select2.select2-container .select2-selection--single",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-account' )
				),
				// account details field & dropdown settings end

				// account addresses field & dropdown settings start
				'address_billing_fields'         => array(
					'label'           => esc_html__( 'Billing Address Fields', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_billing_field',
					'css'             => array(
						'background_color'       => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
						'main'                   => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
						'background_color_hover' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:focus, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover",
						'focus_text_color'       => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:focus, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:focus",
						'placeholder_focus'      => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:focus::-webkit-input-placeholder, {$this->main_css_element} .form-row[id^='billing_'] input.input-text:focus::-moz-placeholder, {$this->main_css_element} .form-row[id^='billing_'] textarea:focus::-moz-placeholder, {$this->main_css_element} .form-row[id^='billing_'] input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .form-row[id^='billing_'] textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
						'margin'                 => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
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
						'name'              => 'address_billing_fields',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'show_if'	=> array(
							'item' => 'edit-address'
						)
					),
					'border_styles'   => array(
						'address_billing_fields'       => array(
							'name'         => 'address_billing_fields',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
									'border_styles' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_address_billing_fields_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_address_billing_field_focus",
										"border_styles_address_billing_field_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'address_billing_field',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-address'
									)
								),
							),
							'label_prefix' => esc_html__( 'Billing Address Fields', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-address'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-address'
						),
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover",
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover::-webkit-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover::-webkit-input-placeholder",
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover::-moz-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover::-moz-placeholder",
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:hover:-ms-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:hover:-ms-input-placeholder",
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
							'main'      => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
							'padding'   => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
							'margin'    => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-address' )
				),
				'address_billing_dropdowns'         => array(
					'label'           => esc_html__( 'Billing Address Dropdowns', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_billing_field',
					'toggle_priority' => 60,
					'css'             => array(
						'main'                   => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
						'background_color'       => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
						'background_color_hover' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:focus, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single .select2-selection__rendered",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:hover .select2-selection__rendered",
						'focus_text_color'       => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:focus, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:focus .select2-selection__rendered",
						'placeholder_focus'      => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:focus::-moz-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
						'margin'                 => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
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
						'name'              => 'address_billing_dropdowns',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'label_prefix' => esc_html__( 'Billing Address Dropdowns', 'divi-shop-builder' ),
						'show_if'	=> array(
							'item' => 'edit-address'
						)
					),
					'border_styles'   => array(
						'address_billing_dropdowns'       => array(
							'name'         => 'address_billing_dropdowns',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
									'border_styles' => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_address_billing_dropdowns_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_address_billing_field_focus",
										"border_styles_address_billing_field_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'address_billing_field',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-address'
									)
								),
							),
							'label_prefix' => esc_html__( 'Billing Address Dropdowns', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-address'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-address'
						)
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single .select2-selection__rendered",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select:hover, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single:hover .select2-selection__rendered"
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
							'main'      => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
							'padding'   => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
							'margin'    => "{$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] select, {$this->main_css_element} .edit-billing-wrapper .form-row[id^='billing_'] .select2.select2-container .select2-selection--single",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-address' )
				),
				'address_shipping_fields'         => array(
					'label'           => esc_html__( 'Shipping Address Fields', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_shipping_field',
					'css'             => array(
						'background_color'       => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
						'main'                   => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
						'background_color_hover' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover",
						'focus_text_color'       => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus",
						'placeholder_focus'      => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus::-moz-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
						'margin'                 => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
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
						'name'              => 'address_shipping_fields',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'show_if'	=> array(
							'item' => 'edit-address'
						)
					),
					'border_styles'   => array(
						'address_shipping_fields'       => array(
							'name'         => 'address_shipping_fields',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
									'border_styles' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_address_shipping_fields_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_address_shipping_field_focus",
										"border_styles_address_shipping_field_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'address_shipping_field',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-address'
									)
								),
							),
							'label_prefix' => esc_html__( 'Shipping Address Fields', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-address'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-address'
						)
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover",
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover::-webkit-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover::-webkit-input-placeholder",
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover::-moz-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover::-moz-placeholder",
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:hover:-ms-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:hover:-ms-input-placeholder",
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
							'main'      => "{$this->main_css_element} .edit-shipping-wrapper  .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
							'padding'   => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
							'margin'    => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-address' )
				),
				'address_shipping_dropdowns'         => array(
					'label'           => esc_html__( 'Shipping Address Dropdowns', 'divi-shop-builder' ),
					'toggle_slug'     => 'address_shipping_field',
					'toggle_priority' => 60,
					'css'             => array(
						'main'                   => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
						'background_color'       => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
						'background_color_hover' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:hover",
						'focus_background_color' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:focus, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:focus",
						'form_text_color'        => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single .select2-selection__rendered",
						'form_text_color_hover'  => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:hover .select2-selection__rendered",
						'focus_text_color'       => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:focus, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:focus .select2-selection__rendered",
						'placeholder_focus'      => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:focus::-webkit-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus::-moz-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus::-moz-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] input.input-text:focus:-ms-input-placeholder, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] textarea:focus:-ms-input-placeholder",
						'padding'                => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
						'margin'                 => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
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
						'name'              => 'address_shipping_dropdowns',
						'css'               => array(
							'main' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
						),
						'default_on_fronts' => array(
							'color'    => '',
							'position' => '',
						),
						'show_if'	=> array(
							'item' => 'edit-address'
						)
					),
					'border_styles'   => array(
						'address_shipping_dropdowns'       => array(
							'name'         => 'address_shipping_dropdowns',
							'css'          => array(
								'main'      => array(
									'border_radii'  => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
									'border_styles' => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single"
								),
								'important' => 'all',
							),
							'defaults'      => array(
								'border_radii'  => 'on|3px|3px|3px|3px',
								'border_styles' => array(
									'width' => '1px',
									'style' => 'solid',
									'color' => '#bbb'
								),
							),
							'fields_after'    => array(
								'use_address_shipping_dropdowns_focus_border_color' => array(
									'label'            => esc_html__( 'Use Focus Borders', 'divi-shop-builder' ),
									'description'      => esc_html__( 'Enabling this option will add borders to input fields when focused.', 'divi-shop-builder' ),
									'type'             => 'yes_no_button',
									'option_category'  => 'color_option',
									'options'          => array(
										'off' => et_builder_i18n( 'No' ),
										'on'  => et_builder_i18n( 'Yes' ),
									),
									'affects'          => array(
										"border_radii_address_shipping_field_focus",
										"border_styles_address_shipping_field_focus",
									),
									'tab_slug'         => 'advanced',
									'toggle_slug'      => 'address_shipping_field',
									'default_on_front' => 'off',
									'show_if'	=> array(
										'item' => 'edit-address'
									)
								)
							),
							'label_prefix' => esc_html__( 'Shipping Address Dropdowns', 'divi-shop-builder' ),
							'show_if'	=> array(
								'item' => 'edit-address'
							),
							'depends_on' => array('item'),
							'depends_show_if' => 'edit-address'
						)
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => array(
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single .select2-selection__rendered",
							),
							'hover'     => array(
								"{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select:hover, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single:hover .select2-selection__rendered"
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
							'main'      => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
							'padding'   => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
							'margin'    => "{$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] select, {$this->main_css_element} .edit-shipping-wrapper .form-row[id^='shipping_'] .select2.select2-container .select2-selection--single",
							'important' => 'all'
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|true|true',
						),
						'custom_margin' => array(
							'default' => '0|0|0|0|false|false',
						),
					),
					'show_if' => array( 'item' => 'edit-address' )
				),
				// account addresses field & dropdown settings end
			),
			'link_options' => false,
			'text' => false,
		);
	}

	public function get_fields() {

		$menu_items = wc_get_account_menu_items();
		$keys		= array_keys( $menu_items );
		$default 	= reset( $keys );


		return array(
			'item' => array(
				'label'            => esc_html__( 'Content Item', 'divi-shop-builder' ),
				'type'             => 'select',
				'option_category'  => 'basic_option',
				'options'          => $menu_items,
				'description'      => esc_html__( 'Choose which type of navigation view you would like to display.', 'divi-shop-builder' ),
				'toggle_slug'	   => 'main_content',
				'default'		   => $default,
				'affects'		   => array(
					'dashboard_text_font',
					'dashboard_text_text_align',
					'dashboard_text_text_color',
					'dashboard_text_font_size',
					'dashboard_text_letter_spacing',
					'dashboard_text_line_height',
					'dashboard_text_text_shadow_style',
					'dashboard_link_font',
					'dashboard_link_text_align',
					'dashboard_link_text_color',
					'dashboard_link_font_size',
					'dashboard_link_letter_spacing',
					'dashboard_link_line_height',
					'dashboard_link_text_shadow_style',
					'dashboard_strong_font',
					'dashboard_strong_text_align',
					'dashboard_strong_text_color',
					'dashboard_strong_font_size',
					'dashboard_strong_letter_spacing',
					'dashboard_strong_line_height',
					'dashboard_strong_text_shadow_style',
					'account_details_labels_font',
					'account_details_labels_text_align',
					'account_details_labels_text_color',
					'account_details_labels_font_size',
					'account_details_labels_letter_spacing',
					'account_details_labels_line_height',
					'account_details_labels_text_shadow_style',
					'custom_account_details_submit',
					'account_details_submit_text_shadow_style',
					'box_shadow_style_account_details_submit',
					'downloads_th_font',
					'downloads_th_text_align',
					'downloads_th_text_color',
					'downloads_th_font_size',
					'downloads_th_letter_spacing',
					'downloads_th_line_height',
					'downloads_th_text_shadow_style',
					'downloads_td_font',
					'downloads_td_text_align',
					'downloads_td_text_color',
					'downloads_td_font_size',
					'downloads_td_letter_spacing',
					'downloads_td_line_height',
					'downloads_td_text_shadow_style',
					'downloads_table_link_font',
					'downloads_table_link_text_align',
					'downloads_table_link_text_color',
					'downloads_table_link_font_size',
					'downloads_table_link_letter_spacing',
					'downloads_table_link_line_height',
					'downloads_table_link_text_shadow_style',
					'downloads_no_items_font',
					'downloads_no_items_text_align',
					'downloads_no_items_text_color',
					'downloads_no_items_font_size',
					'downloads_no_items_letter_spacing',
					'downloads_no_items_line_height',
					'downloads_no_items_text_shadow_style',
					'orders_th_font',
					'orders_th_text_align',
					'orders_th_text_color',
					'orders_th_font_size',
					'orders_th_letter_spacing',
					'orders_th_line_height',
					'orders_th_text_shadow_style',
					'orders_td_font',
					'orders_td_text_align',
					'orders_td_text_color',
					'orders_td_font_size',
					'orders_td_letter_spacing',
					'orders_td_line_height',
					'orders_td_text_shadow_style',
					'orders_table_link_font',
					'orders_table_link_text_align',
					'orders_table_link_text_color',
					'orders_table_link_font_size',
					'orders_table_link_letter_spacing',
					'orders_table_link_line_height',
					'orders_table_link_text_shadow_style',
					'orders_no_items_font',
					'orders_no_items_text_align',
					'orders_no_items_text_color',
					'orders_no_items_font_size',
					'orders_no_items_letter_spacing',
					'orders_no_items_line_height',
					'orders_no_items_text_shadow_style',
					'address_text_font',
					'address_text_text_align',
					'address_text_text_color',
					'address_text_font_size',
					'address_text_letter_spacing',
					'address_text_line_height',
					'address_text_text_shadow_style',
					'address_billing_title_font',
					'address_billing_title_text_align',
					'address_billing_title_text_color',
					'address_billing_title_font_size',
					'address_billing_title_letter_spacing',
					'address_billing_title_line_height',
					'address_billing_title_text_shadow_style',
					'address_billing_font',
					'address_billing_text_align',
					'address_billing_text_color',
					'address_billing_font_size',
					'address_billing_letter_spacing',
					'address_billing_line_height',
					'address_billing_text_shadow_style',
					'address_shipping_title_font',
					'address_shipping_title_text_align',
					'address_shipping_title_text_color',
					'address_shipping_title_font_size',
					'address_shipping_title_letter_spacing',
					'address_shipping_title_line_height',
					'address_shipping_title_text_shadow_style',
					'address_shipping_font',
					'address_shipping_text_align',
					'address_shipping_text_color',
					'address_shipping_font_size',
					'address_shipping_letter_spacing',
					'address_shipping_line_height',
					'address_shipping_text_shadow_style',
					'address_billing_label_font',
					'address_billing_label_text_align',
					'address_billing_label_text_color',
					'address_billing_label_font_size',
					'address_billing_label_letter_spacing',
					'address_billing_label_line_height',
					'address_billing_label_text_shadow_style',
					'address_shipping_label_font',
					'address_shipping_label_text_align',
					'address_shipping_label_text_color',
					'address_shipping_label_font_size',
					'address_shipping_label_letter_spacing',
					'address_shipping_label_line_height',
					'address_shipping_label_text_shadow_style',
					'view_order_text_font',
					'view_order_text_text_align',
					'view_order_text_text_color',
					'view_order_text_font_size',
					'view_order_text_letter_spacing',
					'view_order_text_line_height',
					'view_order_text_text_shadow_style',
					'view_order_details_font',
					'view_order_details_text_align',
					'view_order_details_text_color',
					'view_order_details_font_size',
					'view_order_details_letter_spacing',
					'view_order_details_line_height',
					'view_order_details_text_shadow_style',
					'view_order_table_head_font',
					'view_order_table_head_text_align',
					'view_order_table_head_text_color',
					'view_order_table_head_font_size',
					'view_order_table_head_letter_spacing',
					'view_order_table_head_line_height',
					'view_order_table_head_text_shadow_style',
					'view_order_table_column_font',
					'view_order_table_column_text_align',
					'view_order_table_column_text_color',
					'view_order_table_column_font_size',
					'view_order_table_column_letter_spacing',
					'view_order_table_column_line_height',
					'view_order_table_column_text_shadow_style',
					'view_order_table_link_font',
					'view_order_table_link_text_align',
					'view_order_table_link_text_color',
					'view_order_table_link_font_size',
					'view_order_table_link_letter_spacing',
					'view_order_table_link_line_height',
					'view_order_table_link_text_shadow_style',
					'view_order_table_strong_font',
					'view_order_table_strong_text_align',
					'view_order_table_strong_text_color',
					'view_order_table_strong_font_size',
					'view_order_table_strong_letter_spacing',
					'view_order_table_strong_line_height',
					'view_order_table_strong_text_shadow_style',
					'view_order_table_foot_head_font',
					'view_order_table_foot_head_text_align',
					'view_order_table_foot_head_text_color',
					'view_order_table_foot_head_font_size',
					'view_order_table_foot_head_letter_spacing',
					'view_order_table_foot_head_line_height',
					'view_order_table_foot_head_text_shadow_style',
					'view_order_table_foot_column_font',
					'view_order_table_foot_column_text_align',
					'view_order_table_foot_column_text_color',
					'view_order_table_foot_column_font_size',
					'view_order_table_foot_column_letter_spacing',
					'view_order_table_foot_column_line_height',
					'view_order_table_foot_column_text_shadow_style',
					'view_order_billing_heading_font',
					'view_order_billing_heading_text_align',
					'view_order_billing_heading_text_color',
					'view_order_billing_heading_font_size',
					'view_order_billing_heading_letter_spacing',
					'view_order_billing_heading_line_height',
					'view_order_billing_heading_text_shadow_style',
					'view_order_billing_address_font',
					'view_order_billing_address_text_align',
					'view_order_billing_address_text_color',
					'view_order_billing_address_font_size',
					'view_order_billing_address_letter_spacing',
					'view_order_billing_address_line_height',
					'view_order_billing_address_text_shadow_style',
					'view_order_shipping_heading_font',
					'view_order_shipping_heading_text_align',
					'view_order_shipping_heading_text_color',
					'view_order_shipping_heading_font_size',
					'view_order_shipping_heading_letter_spacing',
					'view_order_shipping_heading_line_height',
					'view_order_shipping_heading_text_shadow_style',
					'view_order_shipping_address_font',
					'view_order_shipping_address_text_align',
					'view_order_shipping_address_text_color',
					'view_order_shipping_address_font_size',
					'view_order_shipping_address_letter_spacing',
					'view_order_shipping_address_line_height',
					'view_order_shipping_address_text_shadow_style',
					'address_billing_form_title_font',
					'address_billing_form_title_text_align',
					'address_billing_form_title_text_color',
					'address_billing_form_title_font_size',
					'address_billing_form_title_letter_spacing',
					'address_billing_form_title_line_height',
					'address_billing_form_title_text_shadow_style',
					'address_shipping_form_title_font',
					'address_shipping_form_title_text_align',
					'address_shipping_form_title_text_color',
					'address_shipping_form_title_font_size',
					'address_shipping_form_title_letter_spacing',
					'address_shipping_form_title_line_height',
					'address_shipping_form_title_text_shadow_style',
				)
			),
			'item_title' => array(
				'label'        => '',
				'type'         => 'ags_divi_wc_value_mapper',
				'sourceField'  => 'item',
				'valueMap'     => $menu_items,
				'toggle_slug'  => 'main_content'
			),
			'downloads_no_items_bg_color' => array(
				'label'          => esc_html__( 'No downloads notice background color', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'downloads_no_items',
				'default'        => '',
				'show_if'		 => array(
					'item'	=> 'downloads'
				)
			),
			'orders_no_items_bg_color' => array(
				'label'          => esc_html__( 'No orders notice background color', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'orders_no_items',
				'default'        => '',
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'view_order_text_margin'     => array(
				'label'           => esc_html__( 'Order Details Text Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'description'     => esc_html__( 'Set custom margin for the text "Order #0000 was placed on [date] and is currently [stats]" that appears at the top of the View Order page.', 'divi-shop-builder' ),
				'tab_slug'       => 'advanced',
				'toggle_slug'     => 'view_order_text',
				'mobile_options'  => true,
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'billing_address_padding' => array(
				'label'           => esc_html__( 'Billing Address Padding', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'default'         => '6px|12px|6px|12px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'view_order_billing',
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'billing_address_margin' => array(
				'label'           => esc_html__( 'Billing Address Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'view_order_billing',
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'billing_address_background'    => array(
				'label'          => esc_html__( 'Billing Address Background Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Pick a color to use for the Billing Address.', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'view_order_billing',
				'hover'          => 'tabs',
				'mobile_options' => false,
				'sticky'         => true,
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'shipping_address_padding' => array(
				'label'           => esc_html__( 'Shipping Address Padding', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'default'         => '6px|12px|6px|12px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'view_order_shipping',
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'shipping_address_margin' => array(
				'label'           => esc_html__( 'Shipping Address Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'view_order_shipping',
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'shipping_address_background'    => array(
				'label'          => esc_html__( 'Shipping Address Background Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Pick a color to use for the Shipping Address.', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'view_order_shipping',
				'hover'          => 'tabs',
				'mobile_options' => false,
				'sticky'         => true,
				'show_if'		 => array(
					'item'	=> 'orders'
				)
			),
			'address_billing_shipping_padding' => array(
				'label'           => esc_html__( 'Billing Address Padding', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'default'         => '6px|12px|6px|12px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'address_billing_shipping_wrappers',
				'show_if'		 => array(
					'item'	=> 'edit-address'
				)
			),
			'address_billing_shipping_margin' => array(
				'label'           => esc_html__( 'Billing Address Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'responsive'      => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'address_billing_shipping_wrappers',
				'show_if'		 => array(
					'item'	=> 'edit-address'
				)
			),
			'address_billing_shipping_background'    => array(
				'label'          => esc_html__( 'Billing Address Background Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Pick a color to use for the Billing Address.', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'address_billing_shipping_wrappers',
				'hover'          => 'tabs',
				'mobile_options' => false,
				'sticky'         => true,
				'show_if'		 => array(
					'item'	=> 'edit-address'
				)
			),
		);
	}

	public function render( $attrs, $content, $render_slug ){
		global $wp;
		//Fix default text size

//		if( ! empty($this->props['custom_orders_button_view']) && $this->props['custom_orders_button_view'] === 'on' && empty($this->props['orders_button_view_text_size']) ) {
//			self::set_style( $this->slug, array(
//				'selector' 	  => "{$this->main_css_element} .view-order-wrapper > p:first-of-type",
//				'declaration' => "margin: {$value};"
//			));
//		}

		// Order Text Margin
		if ( !empty($this->props['view_order_text_margin'])) {
			$value = explode( '|', $this->props['view_order_text_margin'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		} else {
			$value = '20px';
		}
		self::set_style( $this->slug, array(
			'selector' 	  => "{$this->main_css_element} .view-order-wrapper > p:first-of-type",
			'declaration' => "margin: {$value};"
		));


		// Billing Margin
		if ( !empty($this->props['billing_address_margin'])) {
			$value = explode( '|', $this->props['billing_address_margin'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address",
				'declaration' => "margin: {$value};"
			));
		}

		// Billing Padding
		if ( !empty($this->props['billing_address_padding'])) {
			$value = explode( '|', $this->props['billing_address_padding'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address",
				'declaration' => "padding: {$value};"
			));
		}

		// Billing Background
		if( !empty( $this->props['billing_address_background'] ) ){
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address",
				'declaration' => "background-color: {$this->props['billing_address_background']};"
			));
		}

		// Shipping Padding
		if ( !empty($this->props['shipping_address_padding'])) {
			$value = explode( '|', $this->props['shipping_address_padding'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address",
				'declaration' => "padding: {$value};"
			));
		}
		// Shipping Margin
		if ( !empty($this->props['shipping_address_margin'])) {
			$value = explode( '|', $this->props['shipping_address_margin'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address",
				'declaration' => "margin: {$value};"
			));
		}

		// Shipping Background
		if( !empty( $this->props['shipping_address_background'] ) ){
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address",
				'declaration' => "background-color: {$this->props['shipping_address_background']};"
			));
		}

		// Address Billing Margin
		if ( !empty($this->props['address_billing_shipping_margin'])) {
			$value = explode( '|', $this->props['address_billing_shipping_margin'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address",
				'declaration' => "margin: {$value};"
			));
		}

		// Address Billing Padding
		if ( !empty($this->props['address_billing_shipping_padding'])) {
			$value = explode( '|', $this->props['address_billing_shipping_padding'] );
			$value = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address",
				'declaration' => "padding: {$value};"
			));
		}

		// Address Billing Background
		if( !empty( $this->props['address_billing_shipping_background'] ) ){
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address",
				'declaration' => "background-color: {$this->props['address_billing_shipping_background']};"
			));
		}

		$button_view_use_icon = !empty( $this->props['downloads_button_view_use_icon'] ) ? $this->props['downloads_button_view_use_icon'] : 'off';
		if( $button_view_use_icon === 'on' && !empty( $this->props['downloads_button_view_icon'] ) ){
			$icon = dswcp_decoded_et_icon( $this->props['downloads_button_view_icon'] );
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .downloads-wrapper table.woocommerce-table--order-downloads td.download-file .button::after",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		$button_browse_use_icon = !empty( $this->props['downloads_button_browse_use_icon'] ) ? $this->props['downloads_button_browse_use_icon'] : 'off';
		if( $button_browse_use_icon === 'on' && !empty( $this->props['downloads_button_browse_icon'] ) ){
			$icon = dswcp_decoded_et_icon( $this->props['downloads_button_browse_icon'] );
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info .button::after",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		if( !empty( $this->props['downloads_no_items_bg_color'] ) ){
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .downloads-wrapper .woocommerce-Message.woocommerce-Message--info",
				'declaration' => "background-color:  {$this->props['downloads_no_items_bg_color']} !important;"
			));
		}

		if( !$this->_can_render() ){
			return '';
		}

		$content = '';

		/*switch( $this->props['item'] ){
			case 'edit-address':
				$content = $this->get_edit_address_output();
				break;
			case 'edit-account':
				$content = $this->get_edit_account_output();
				break;
			case 'downloads':
				$content = $this->downloads_output();
				break;
			case 'orders':
				$content = $this->orders_output();
				break;
			default:
				if ( has_action('woocommerce_account_'.$this->props['item'].'_endpoint') ) {
					ob_start();
					do_action('woocommerce_account_'.$this->props['item'].'_endpoint');
					$content = ob_get_clean();
				} else {
					$content = $this->dashboard_output();
				}
				break;
		}*/

		if ( ! empty( $wp->query_vars ) ) {
			foreach ( $wp->query_vars as $key => $value ) {
				if ( 'pagename' === $key ) {
					continue;
				}

				switch( $key ){
					case 'edit-address':
						$content = $this->get_edit_address_output();
						break;
					case 'edit-account':
						$content = $this->get_edit_account_output();
						break;
					case 'downloads':
						$content = $this->downloads_output();
						break;
					case 'orders':
						$content = $this->orders_output();
						break;
					case 'view-order':
						$content = $this->orders_output();
						break;
					default:
						if ( has_action('woocommerce_account_'.$key.'_endpoint') ) {
							ob_start();
							do_action('woocommerce_account_'.$key.'_endpoint', $value);
							$content = ob_get_clean();
						} else{
							$content = $this->dashboard_output();
						}
						break;
				}

			}
		}

		return sprintf( '<div class="woocommerce-MyAccount-content">%s</div>', $content );
	}

	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		if( !$this->_can_render() ){
			return '';
		}

		return parent::_render_module_wrapper( $output, $render_slug );
	}

	protected function _can_render(){


		$endpoint = !empty( $this->props['item'] ) && $this->props['item'] !== 'dashboard' ? $this->props['item'] : '';
		
		switch ($endpoint) {
			case 'orders':
				if ( get_query_var( 'view-order', false ) ) {
					$endpoint = 'view-order';
				}
				break;
				
			case 'subscriptions':
				if ( get_query_var( 'view-subscription', false ) ) {
					$endpoint = 'view-subscription';
				}
				break;
			
			case 'payment-methods':
				if ( get_query_var( 'add-payment-method', false ) !== false ) {
					$endpoint = 'add-payment-method';
				} else if ( get_query_var( 'delete-payment-method', false ) !== false ) {
					$endpoint = 'delete-payment-method';
				} else if ( get_query_var( 'set-default-payment-method', false ) !== false ) {
					$endpoint = 'set-default-payment-method';
				}
				break;
		}
		
        return is_user_logged_in() && WC()->customer && dswcp_is_account_endpoint( $endpoint );
    }


	/**
	 * Override parent method to setup conditional text shadow fields
	 * {@see parent::_set_fields_unprocessed}
	 *
	 * @param Array fields array
	 */
	protected function _set_fields_unprocessed( $fields ) {

		if( !is_array( $fields ) ){
			return;
		}

		$template 			 = ET_Builder_Module_Helper_OptionTemplate::instance();
		$text_shadow_factory = ET_Builder_Module_Fields_Factory::get( 'TextShadow' );
		$flatten_fields 	 =  call_user_func_array('array_merge', array_values( array_filter( $this->advanced_fields, 'is_array' ) ) );

		/**
		 * Parent Code
		 * @see ET_Builder_Element::_set_fields_unprocessed
		 */
		$unprocessed = &self::$_fields_unprocessed;

		foreach ( $fields as $field => $definition ) {
			if ( true === $definition ) {
				continue;
			}

			// Custom code starts
			// button fields conditions
			if( strpos( $field, 'custom' ) === 0 ){
				$button_name = str_replace( 'custom_', '', $field );
				if( isset( $this->advanced_fields['button'][$button_name] ) ){
					$button_setting = $this->advanced_fields['button'][$button_name];
					if( isset( $button_setting['depends_on'] ) ){
						$definition['depends_on'] = $button_setting['depends_on'];
					}
					if( isset( $button_setting['depends_show_if'] ) ){
						$definition['depends_show_if'] = $button_setting['depends_show_if'];
					}
					if( isset( $button_setting['show_if'] ) ){
						$definition['show_if'] = $button_setting['show_if'];
					}
				}
			}

			// form fields conditions
			$form_field_setting = false;
			foreach( $this->advanced_fields['form_field'] as $form_field_name => $form_field ){
				if( substr( $field, 0, strlen( $form_field_name ) ) === $form_field_name ){
					$form_field_setting = $form_field;
					break;
				}
			}
			if( $form_field_setting !== false ){
				$new_show_if = isset( $form_field_setting['show_if'] ) ? $form_field_setting['show_if'] : array();
				$definition['show_if'] = $new_show_if;
			}

			// text shadow conditions
			$shadow_style_string = 'text_shadow_style';
			if(
				( !is_array( $definition ) && $definition === 'text_shadow' ) ||
				( is_array( $definition ) && substr( $field, -( strlen( $shadow_style_string ) ) ) === $shadow_style_string )
			){
				if( $template->is_enabled() && $template->has( 'text_shadow' ) ) {

					$data 		   = $template->get_data( $field );
					$setting 	   = end( $data );
					$field_setting = isset( $setting['prefix'] , $flatten_fields[$setting['prefix']] ) ? $flatten_fields[$setting['prefix']] : [];

				}else{

					$prefix 	   = substr( $key, 0, strlen( '_text_shadow_style' ) );
					$setting 	   = $definition;
					$field_setting = isset( $flatten_fields[$prefix] ) ? $flatten_fields[$prefix] : [];
				}

				$new_show_if = array();

				if( isset( $field_setting['depends_show_if'] ) ){
					$depends_show_if = $field_setting['depends_show_if'];
					$depends_on 	 = isset( $field_setting['depends_on'] ) ? $field_setting['depends_on'] : 'item';
					$new_show_if 	 = is_array( $depends_on ) ? array( $depends_on[0] => $depends_show_if ) : array( $depends_on => $depends_show_if );
				}elseif( isset( $field_setting['show_if'] ) ){
					$new_show_if = $field_setting['show_if'];
				}

				$setting['show_if'] = isset( $setting['show_if'] ) && is_array( $setting['show_if'] ) ? array_merge( $setting['show_if'], $new_show_if ) : $new_show_if;
				$new_definition 	= $text_shadow_factory->get_fields( $setting );

				if( !count( $new_definition ) ){
					continue;
				}

				$field 		= array_keys( $new_definition )[0];
				$definition = array_values( $new_definition )[0];
			}
			// Custom code ends

			// Have to use md5 now because needed by modules cache.
			$key = md5( serialize( $definition ) );
			if ( ! isset( $unprocessed[ $key ] ) ) {
				$unprocessed[ $key ] = $definition;
			}

			$this->fields_unprocessed[ $field ] = $unprocessed[ $key ];
		}
	}

	private function get_edit_address_output() {

		$button_edit_use_icon = !empty( $this->props['address_button_edit_use_icon'] ) ? $this->props['address_button_edit_use_icon'] : 'off';
		if(  $button_edit_use_icon === 'on' && !empty( $this->props['address_button_edit_icon'] ) ){
			$icon 	   = dswcp_decoded_et_icon( $this->props['address_button_edit_icon'] );
			$placement = $this->props['address_button_edit_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-address-wrapper .woocommerce-Address .woocommerce-Address-title a.edit::{$placement}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		$button_billing_use_icon = !empty( $this->props['address_billing_button_save_use_icon'] ) ? $this->props['address_billing_button_save_use_icon'] : 'off';
		if(  $button_billing_use_icon === 'on' && !empty( $this->props['address_billing_button_save_icon'] ) ){
			$icon 	   = dswcp_decoded_et_icon( $this->props['address_billing_button_save_icon'] );
			$placement = $this->props['address_billing_button_save_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-billing-wrapper .woocommerce-address-fields p button[type='submit']::{$placement}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		$button_shipping_use_icon = !empty( $this->props['address_shipping_button_save_use_icon'] ) ? $this->props['address_shipping_button_save_use_icon'] : 'off';
		if(  $button_shipping_use_icon === 'on' && !empty( $this->props['address_shipping_button_save_icon'] ) ){
			$icon 	   = dswcp_decoded_et_icon( $this->props['address_shipping_button_save_icon'] );
			$placement = $this->props['address_shipping_button_save_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-shipping-wrapper .woocommerce-address-fields p button[type='submit']::{$placement}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		$address_type = get_query_var( get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ), false );
		$wrapper_class = $address_type === false || empty($address_type) ? 'edit-address-wrapper' : "edit-{$address_type}-wrapper";

		ob_start();

		woocommerce_account_edit_address($address_type);

		return sprintf( '<div class="%s">%s</div>', $wrapper_class, ob_get_clean() );
	}


	private function get_edit_account_output() {

		$button_submit_use_icon = !empty( $this->props['account_details_submit_use_icon'] ) ? $this->props['account_details_submit_use_icon'] : 'off';
		if( $button_submit_use_icon === 'on' && !empty( $this->props['account_details_submit_icon'] ) ){
			$icon 	   = dswcp_decoded_et_icon( $this->props['account_details_submit_icon'] );
			$placement = $this->props['account_details_submit_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .edit-account-wrapper .woocommerce-EditAccountForm.edit-account p button[type='submit']::{$placement}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		ob_start();

		woocommerce_account_edit_account();

		return sprintf( '<div class="%s">%s</div>', 'edit-account-wrapper', ob_get_clean() );
	}


	private function downloads_output() {

		ob_start();

		woocommerce_account_downloads();

		return sprintf( '<div class="%s">%s</div>', 'downloads-wrapper', ob_get_clean() );
	}


	private function orders_output() {

		$button_view_use_icon = !empty( $this->props['orders_button_view_use_icon'] ) ? $this->props['orders_button_view_use_icon'] : 'off';
		if( $button_view_use_icon === 'on' && !empty( $this->props['orders_button_view_icon'] ) ){
			$icon = dswcp_decoded_et_icon( et_pb_process_font_icon( $this->props['orders_button_view_icon'] ) );
			$position = $this->props['orders_button_view_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button::{$position}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		$button_browser_use_icon = !empty( $this->props['orders_button_browse_use_icon'] ) ? $this->props['orders_button_browse_use_icon'] : 'off';
		if( $button_browser_use_icon === 'on' && !empty( $this->props['orders_button_browse_icon'] ) ){
			$icon = dswcp_decoded_et_icon( $this->props['orders_button_browse_icon'] );
			$position = $this->props['orders_button_browse_icon_placement'] === 'left' ? 'before' : 'after';
			self::set_style( $this->slug, array(
				'selector' 	  => "{$this->main_css_element} .orders-wrapper .woocommerce-Message.woocommerce-Message--info .button::{$position}",
				'declaration' => "content:  '{$icon}' !important; font-family: 'ETmodules' !important;"
			));
		}

		if ( ! empty( $this->props['orders_no_items_bg_color'] ) ) {
			self::set_style( $this->slug, array(
				'selector'    => "{$this->main_css_element} .orders-wrapper .woocommerce-Message.woocommerce-Message--info",
				'declaration' => "background-color: {$this->props['orders_no_items_bg_color']} !important;"
			) );
		}

		$is_view_order = ! empty( get_query_var( 'view-order', 0 ) );

		ob_start();

		if ( $is_view_order ) {
			woocommerce_account_view_order( absint( get_query_var( 'view-order', 0 ) ) );
		} else {
			//woocommerce_account_orders(0);

			//phpcs:ignore ET.Sniffs.ValidatedSanitizedInput.InputNotValidatedNotSanitized
			$page_url  = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$final_url = explode( '/', $page_url );

			if ( isset( $final_url ) ) {
				array_pop( $final_url );
				$pageID = end( $final_url );
				if ( $pageID == 'orders' ) {
					woocommerce_account_orders( 1 );
				} else {
					woocommerce_account_orders( (int) $pageID );
				}
			}
		}

		return sprintf( '<div class="%s">%s</div>', $is_view_order ? 'view-order-wrapper' : 'orders-wrapper', ob_get_clean() );

	}


	private function dashboard_output(){

		ob_start();

		wc_get_template(
			'myaccount/dashboard.php',
			array(
				'current_user' => get_user_by( 'id', get_current_user_id() ),
			)
		);

		return sprintf( '<div class="%s">%s</div>', 'dashboard-wrapper', ob_get_clean() );
	}
}

new DSWCP_WooAccountContentItem;