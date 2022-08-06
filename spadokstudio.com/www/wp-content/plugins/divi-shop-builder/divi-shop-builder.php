<?php
/**
 * Plugin Name: Divi Shop Builder
 * Plugin URI: https://divi.space
 * Version: 1.1.30
 * Description:  Expand the Divi builder to your WooCommerce Shop, Cart, and Checkout pages. Build and customize all your ecommerce pages with Divi’s drag and drop builder.
 * Author: Divi Space
 * Tested up to: 5.9.2
 * WC tested up to: 6.3.1
 * Text Domain: divi-shop-builder
 * Domain Path: /languages/
 * License: GNU General Public License v3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitLab Plugin URI: https://gitlab.com/aspengrovestudios/divi-shop-builder/
 * AGS Info: ids.aspengrove 859817 ids.divispace 859817 legacy.key ags_divi_wc_license_key legacy.status ags_divi_wc_license_status adminPage admin.php?page=ags-divi-wc docs https://docs.divi.space/docs/plugin/divi-shop-builder/
 *
 */

/*
    Despite the following, this project is licensed exclusively
    under GNU General Public License (GPL) version 3 (no future versions).
    This statement modifies the following text.

    Divi Shop Builder plugin
    Copyright (C) 2021  Aspen Grove Studios

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

    ========

	For the text of the GNU General Public License version 3, and licensing/copyright information for third-party code used in this product, see ./license.txt.

*/

define('DIVI_WOO_FILE_PATH', dirname(__FILE__));
include_once( DIVI_WOO_FILE_PATH . '/includes/implementation.php' );
include_once( DIVI_WOO_FILE_PATH . '/includes/product-meta-box.php' );

	/**
	 * Localisation
	 */
	load_plugin_textdomain( 'divi-shop-builder', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    // array of options

	/**
	 * AGS_divi_wc class
	 */
	if ( ! class_exists( 'AGS_divi_wc' ) ) {

		/**
		 * The Product Archive Customiser class
		 */
		final class AGS_divi_wc {

			protected $settings;

			public static 	$pluginBaseUrl;

			// woocommerce-carousel-for-divi\woocommerce-carousel-for-divi.php
			const	PLUGIN_NAME			= 'Divi Shop Builder',
					PLUGIN_AUTHOR		= 'Divi Space',
					PLUGIN_VERSION		= '1.1.30',
					PLUGIN_STORE_URL	= 'https://divi.space/',
					PLUGIN_PAGE			= 'admin.php?page=ags-divi-wc',
					PLUGIN_FILE			= __FILE__;

			/**
			 * The constructor!
			 */
			public function __construct() {

			    
				require __DIR__.'/updater/updater.php';
				
				
				if (ags_divi_wc_has_license_key()) {
                

					add_action( 'wp_enqueue_scripts', array( $this, 'ags_divi_wc_styles' ) );
					add_action( 'init', array( $this, 'ags_divi_wc_setup' ) );
                    add_action('init', 'wp_raise_memory_limit', -1);
					//add_action( 'wp', array( $this, 'ags_divi_wc_options' ) );
					//add_action( 'customize_controls_enqueue_scripts', array( $this, 'ags_divi_wc_customize_preview_css' ) );
					//add_filter('customize_save_response', array( $this, 'ags_divi_wc_customizer_save'));
					add_filter( 'et_fb_get_asset_definitions', array( $this, 'get_asset_definitions' ), 11 );


					add_action( 'divi_extensions_init', 'agswcc_initialize_extension' );
					add_action( 'customizer_register', 'loadCustomizerControls' );

                
				}
				


				// wp-layouts\ags-layouts.php
				self::$pluginBaseUrl = plugin_dir_url(__FILE__);

				// wp-layouts\ags-layouts.php
				add_action('admin_menu', array(__CLASS__, 'registerAdminPage'), 11);
				// wp-layouts\ags-layouts.php
				add_action('admin_enqueue_scripts', array(__CLASS__, 'adminScripts'));
				// divi-switch\functions.php
				add_action('load-plugins.php', array(__CLASS__, 'onLoadPluginsPhp'));
				add_filter( 'woocommerce_settings_pages', array( $this, 'thankyou_page_setting' ), 99, 1 );

			}


			// wp-layouts\ags-layouts.php
			public static function registerAdminPage() {
				/* Admin Pages */
				add_submenu_page('et_divi_options', esc_html__( 'Shop Builder', 'divi-shop-builder'), esc_html__( 'Shop Builder', 'divi-shop-builder'), 'install_plugins', 'ags-divi-wc', array(__CLASS__, 'adminPage'));

			}

			// wp-layouts\ags-layouts.php
			public static function adminScripts() {

				// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- just checking which page we are on
				if ( isset($_GET['page']) && $_GET['page'] == 'ags-divi-wc' ) {
					// wp-layouts\ags-layouts.php
					wp_enqueue_style('ags-layouts-admin', self::$pluginBaseUrl.'/styles/admin.css', array(), self::PLUGIN_VERSION);
					// ags-product-addons
					wp_enqueue_style('ags-divi-wc-addons-admin', self::$pluginBaseUrl .'/includes/addons/css/admin.css', array(), self::PLUGIN_VERSION);

				}

			}

			// divi-switch\functions.php
			public static function pluginActionLinks($links) {

				array_unshift($links, '<a href="admin.php?page=ags-divi-wc">'.esc_html__('Settings', 'divi-shop-builder').'</a>');
				return $links;

			}
			// divi-switch\functions.php
			public static function onLoadPluginsPhp() {

				add_filter('plugin_action_links_'.plugin_basename(__FILE__), array(__CLASS__, 'pluginActionLinks'));

			}

			public static function loadCustomizerControls() {
				include_once( DIVI_WOO_FILE_PATH . '/includes/customizer/class-customizer-control.php' );
			}

			// woocommerce-carousel-for-divi\woocommerce-carousel-for-divi.php
			public static function adminPage() {
				
				if (ags_divi_wc_has_license_key()) {
                
					?>

					<div id="ags_divi_wc-settings-container">
					<div id="ags_divi_wc-settings">

						<div id="ags_divi_wc-settings-header">
							<div class="ags_divi_wc-settings-logo">
								<h2><?php esc_html_e('Divi Shop Builder', 'divi-shop-builder'); ?></h2>
							</div>
							<div id="ags_divi_wc-settings-header-links">
								<a id="ags_divi_wc-settings-header-link-support"
								   href="https://divi.space/docs/divi-shop-builder/"
								   target="_blank"><?php esc_html_e('Documentation', 'divi-shop-builder'); ?></a>
							</div>
						</div>

						<ul id="ags_divi_wc-settings-tabs">
							<li class="ags_divi_wc-settings-active">
								<a href="#about"><?php esc_html_e('About', 'divi-shop-builder'); ?></a>
							</li>
                            <li><a href="#addons"><?php esc_html_e('Addons', 'divi-shop-builder') ?></a></li>
                            
							<li><a href="#license"><?php esc_html_e('License Key', 'divi-shop-builder'); ?></a></li>
                            
						</ul>

						<div id="ags_divi_wc-settings-tabs-content">
							<div id="ags_divi_wc-settings-about" class="ags_divi_wc-settings-active">
                                <h2><?php esc_html_e('Divi Shop Builder', 'divi-shop-builder') ?></h2>
                                <p><?php esc_html_e('Expand the Divi builder to your WooCommerce Shop, Cart, and Checkout pages. Build and customize all your ecommerce pages with Divi’s drag and drop builder.', 'divi-shop-builder') ?></p>
                                <p><?php printf( esc_html__('Divi Shop Builder includes %s 13 modules %s for styling default WooCommerce pages with Divi', 'divi-shop-builder'), '<strong>','</strong>'); ?></p>
                                <ul>
                                    <li><?php esc_html_e('Woo Shop +', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Cart List', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Cart/Checkout Notices', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Cart Totals', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Checkout Billing', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Checkout Coupon', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Checkout Order', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Checkout Shipping', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Thank you module', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Account Content', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Account Navigation', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Account User Image', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Account User Name', 'divi-shop-builder') ?></li>
                                </ul>

                                <h2><?php esc_html_e('Main features', 'divi-shop-builder') ?></h2>
                                <ul>
                                    <li><?php esc_html_e('100+ configurations and styling options for unlimited layout possibilities', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Extend Divi’s drag and drop editor to Shop, Cart, Account, and Checkout pages', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Set what element to show in what order', 'divi-shop-builder') ?> </li>
                                    <li><?php esc_html_e('Build a custom Cart page with the List, Total, and Notices modules', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Customize every Checkout element with Billing, Coupon, Order, and Shipping modules', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Edit form titles and input fields with custom text and style options', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Includes hover effects for product images and CTA button style options', 'divi-shop-builder') ?></li>
                                    <li><?php esc_html_e('Add a list of products to any page with completely custom positioning and style', 'divi-shop-builder') ?> </li>
                                    <li><?php esc_html_e('Lets you edit every aspect of WooCommerce with the Divi builder', 'divi-shop-builder') ?></li>
                                </ul>
                                <a href="https://divi.space/product/divi-shop-builder/" target="_blank"><?php esc_html_e ('Read More about plugin features', 'divi-shop-builder') ?>.</a>

                                <h3><?php esc_html_e ('Product documentation', 'divi-shop-builder') ?></h3>
								<?php printf( esc_html__ ('Get started your adventure with Divi Shop Builder with a %splugin documentation%s that covers the basics ', 'divi-shop-builder'), '<a href="https://divi.space/docs/divi-shop-builder/" target="_blank">', '</a>'  ); ?>

                              <h3><?php esc_html_e('Premade layouts', 'divi-shop-builder') ?></h3>
								<?php printf( esc_html__ ('Divi Shop Builder ships great premade layouts that you can use to jumpstart your design. %sDownload layouts from here%s.', 'divi-shop-builder'), '<a href="http://divishopbuilder.aspengrovestudio.com/" target="_blank">', '</a>'  ); ?>
                            </div>

                            <div id="ags_divi_wc-settings-addons" >
								<?php
								define('AGS_DIVI_SHOP_BUILDER_ADDONS_URL', 'https://divi.space/wp-content/uploads/product-addons/divi-shop-builder.json');
								require_once( plugin_dir_path( __FILE__ ) . '/includes/addons/addons.php');
								AGS_Divi_Shop_Builder_Addons::outputList();
								?>
                            </div>
                            
                            <div id="ags_divi_wc-settings-license">
								<?php ags_divi_wc_license_key_box(); ?>
							</div>
                            
						</div>
					</div>

					<script>
						var ags_divi_wc_tabs_navigate = function () {
							jQuery('#ags_divi_wc-settings-tabs-content > div, #ags_divi_wc-settings-tabs > li').removeClass('ags_divi_wc-settings-active');
							jQuery('#ags_divi_wc-settings-' + location.hash.substr(1)).addClass('ags_divi_wc-settings-active');
							jQuery('#ags_divi_wc-settings-tabs > li:has(a[href="' + location.hash + '"])').addClass('ags_divi_wc-settings-active');
						};

						if (location.hash) {
							ags_divi_wc_tabs_navigate();
						}

						jQuery(window).on('hashchange', ags_divi_wc_tabs_navigate);
					</script>

					<?php
                
				}

				else {
				   ags_divi_wc_activate_page();
				}
				
			}

            /**
             * Create options
             */
            public function ags_divi_wc_options()
            {
			    // array of options
                $default_values = [
                    'columns_desktop' => 4,
                    'columns_tablet' => 3,
                    'columns_mobile' => 1,
                    'product_count' => false,
                    'product_sorting' => true,
					'add_to_cart' => true,
					'default_quantity' => 1,
                    'sale_flash' => true,
                    'thumbnail' => true,
                    'price' => true,
                    'rating' => false,
                    'new_badge' => false,
                    'newness' => 28,
                    'categories' => false,
                    'stock' => false,
                    'description' => false,
                    'new_badge_color' => '#260065',
	                'new_badge_font_color' => '#fff',
	                'new_badge_font_size' => 14,
					'new_badge_font_family' => 'none',
					'new_badge_text_transform' => '',
	                'new_badge_radius' => '5',
	                'new_badge_position' => 'default',
					'new_badge_custom_text' => 'New',
					'sale_badge_custom_text' => 'Sale'
                ];

				$options = array_merge( $default_values, get_option('ags_divi_wc', []) );
				$implementation = new AGS_Divi_WC_Implementation('page', $options);
				$implementation->implement();
              }

            public function ags_divi_wc_customize_preview_css()
            {
                wp_enqueue_style( 'ags-divi-wc-customizer-controls-styles', plugins_url( '/includes/customizer/divi-shop-builder-customizer.css', __FILE__ ) , array(), self::PLUGIN_VERSION );
            }

			/**
			 * Divi Shop Builder setup
			 *
			 * @return void
			 */
			public function ags_divi_wc_setup()
            {
				/*
				add_action( 'customize_register', array( $this, 'ags_divi_wc_customize_register' ) );
	            if (!file_exists(__DIR__ . '/includes/css/divi-shop-builder-styles.css') ) {

		            self::generateCss();
	            }
				*/

				$this->settings = [
					'layout' => [
						'label'            => esc_html__( 'Layout', 'divi-shop-builder' ),
						'description'      => esc_html__( 'Display products in list view or in default grid.', 'divi-shop-builder' ),
						'type'             => 'select',
						'choices'          => [
							'grid' => esc_html__( 'Grid', 'divi-shop-builder' ),
							'list' => esc_html__( 'List', 'divi-shop-builder' ),
							'both' => esc_html__( 'Grid / List View Switch', 'divi-shop-builder' ),
						],
						'default' => 'grid',
						'section'  => 'wc_ags_archive',
					],
					'deafault_view' => [
						'label'            => esc_html__( 'Default Layout', 'divi-shop-builder' ),
						'description'      => esc_html__( 'Default view for the Both layout type.', 'divi-shop-builder' ),
						'type'             => 'select',
						'choices'          => [
							'grid' => esc_html__( 'Grid', 'divi-shop-builder' ),
							'list' => esc_html__( 'List', 'divi-shop-builder' ),
						],
						'default' => 'grid',
						'show_if'     => [
							'layout' => 'both',
						],
						'section'  => 'wc_ags_archive',
					],
					'columns' => [
						'label'    => esc_html__( 'Product columns', 'divi-shop-builder' ),
						'description' => esc_html__('Changes the number of products per row for desktop devices.', 'divi-shop-builder'),
						'default'           => '4',
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'responsive' => true,
						'choices'  => [
										'1' => '1',
										'2' => '2',
										'3' => '3',
										'4' => '4',
										'5' => '5',
										'6' => '6'
						],
						'show_if'     => [
							'layout' => array( 'grid', 'both' ),
						],
					],

					'description_type' => [
						'label'            => esc_html__( 'Description Content', 'divi-shop-builder' ),
						'description'      => esc_html__( 'Once Description is enabled for grid layout, or list view is enabled, for each product you can display the text. Choose if you want to display Short Description, or you want to set a custom text. You can change the custom text on the product edit page, and if it is not set, Short Description will be used.  ', 'divi-shop-builder' ),
						'type'             => 'select',
						'choices'          => [
							'short_description' => esc_html__( 'Display short description', 'divi-shop-builder' ),
							'custom_description' => esc_html__( 'Display custom description', 'divi-shop-builder' ),
						],
						'default' => 'short_description',
						'section'  => 'wc_ags_archive',
					],
					/*
					'columns_tablet' => [
						'label'    => __( 'Product columns for Tablet', 'divi-shop-builder' ),
						'description' => __('Changes the number of products per row for tablet devices.', 'divi-shop-builder'),
						'default'           => '3',
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'choices'  => [
										'1' => '1',
										'2' => '2',
										'3' => '3',
										'4' => '4',
										'5' => '5'
						],
					],
					'columns_mobile' => [
						'label'    => __( 'Product columns for Mobile', 'divi-shop-builder' ),
						'description' => __('Changes the number of products per row for mobile devices.', 'divi-shop-builder'),
						'default'           => '1',
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'choices'  => [
										'1' => '1',
										'2' => '2',
										'3' => '3'
						],
					],
					*/
					'product_count' => [
						'label'    => esc_html__( 'Display product count results', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable the WooCommerce results count. Count results show up on the WooCommerce product archive pages that displays the amount of products you are currently viewing and the total amount of products in your current query.', 'divi-shop-builder'),
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'default'     => 'above',
						'choices'          => [
							'hide' => esc_html__( 'Don\'t display', 'divi-shop-builder' ),
							'above' => esc_html__( 'Above', 'divi-shop-builder' ),
							'below' => esc_html__( 'Below', 'divi-shop-builder' ),
							'abovebelow' => esc_html__( 'Above and below', 'divi-shop-builder' ),
						],
					],
					'product_sorting' => [
						'label'    => esc_html__( 'Display product sorting', 'divi-shop-builder' ),
						'description' => esc_html__('WooCommerce offers the ability to customize the sorting order of products with a few settings changes. Enable or disable display the product sorting on the archive pages. Change default sorting by going to WooCommerce > Settings >> Products >> Default Product Sorting ', 'divi-shop-builder'),
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'default'     => 'above',
						'choices'          => [
							'hide' => esc_html__( 'Don\'t display', 'divi-shop-builder' ),
							'above' => esc_html__( 'Above', 'divi-shop-builder' ),
							'below' => esc_html__( 'Below', 'divi-shop-builder' ),
							'abovebelow' => esc_html__( 'Above and below', 'divi-shop-builder' ),
						],
					],
					'pagination' => [
						'label'    => esc_html__( 'Display pagination', 'divi-shop-builder' ),
						'description' => esc_html__('', 'divi-shop-builder'),
						'default'           => 'below',
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'select',
						'choices'          => [
							'hide' => esc_html__( 'Don\'t display', 'divi-shop-builder' ),
							'above' => esc_html__( 'Above', 'divi-shop-builder' ),
							'below' => esc_html__( 'Below', 'divi-shop-builder' ),
							'abovebelow' => esc_html__( 'Above and below', 'divi-shop-builder' ),
						],
					],
					'sale_flash' => [
						'label'    => esc_html__( 'Display sale flashes', 'divi-shop-builder' ),
						'description' => esc_html__('When a product is on sale in your shop, WooCommerce adds a sales flash to that product to show customers that the product has a sale running to draw their attention to it. Enable/disable displaying the sale badges (flashes) on the archive pages.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'new_badge_pos' => [
						'label'       => esc_html__( 'New Badge Position', 'divi-shop-builder' ),
						'description' => esc_html__( '', 'divi-shop-builder' ),
						'type'        => 'select',
						'default'     => 'no_overlay',
						'choices'     => array(
							'no_overlay'       => esc_html__( 'Don\'t overlay on product image', 'divi-shop-builder' ),
							'overlay_tl'     => esc_html__( 'Overlay on product image - top left', 'divi-shop-builder' ),
							'overlay_tr'         => esc_html__( 'Overlay on product image - top right', 'divi-shop-builder' ),
							'overlay_bl' => esc_html__( 'Overlay on product image - bottom left', 'divi-shop-builder' ),
							'overlay_br'    => esc_html__( 'Overlay on product image - bottom right', 'divi-shop-builder' ),
						),
						'section' => 'wc_ags_archive',
					],

					'new_badge_custom_text' => [
						'label'       => esc_html__( 'New Badge Text', 'divi-shop-builder' ),
						'description' => esc_html__( 'Set custom text that will be displayed in the new badge', 'divi-shop-builder' ),
						'default'     => esc_html__( 'New', 'divi-shop-builder' ),
						'section'     => 'wc_ags_archive',
						'type'        => 'text'
					],
					'sale_badge_pos' => [
						'label'       => esc_html__( 'Sale Badge Position', 'divi-shop-builder' ),
						'description' => esc_html__( '', 'divi-shop-builder' ),
						'type'        => 'select',
						'default'     => 'no_overlay',
						'choices'     => array(
							'no_overlay'       => esc_html__( 'Don\'t overlay on product image', 'divi-shop-builder' ),
							'overlay_tl'     => esc_html__( 'Overlay on product image - top left', 'divi-shop-builder' ),
							'overlay_tr'         => esc_html__( 'Overlay on product image - top right', 'divi-shop-builder' ),
							'overlay_bl' => esc_html__( 'Overlay on product image - bottom left', 'divi-shop-builder' ),
							'overlay_br'    => esc_html__( 'Overlay on product image - bottom right', 'divi-shop-builder' ),
						),
						'section' => 'wc_ags_archive',
					],
					'sale_badge_custom_text' => [
						'label'       => esc_html__( 'Sale Text', 'divi-shop-builder' ),
						'description' => esc_html__( 'Set custom text that will be displayed in the sale badge', 'divi-shop-builder' ),
						'default'     => esc_html__( 'Sale', 'divi-shop-builder' ),
						'section'       => 'wc_ags_archive',
                        'type'        => 'text'
					],
					'add_to_cart' => [
						'label'    => esc_html__( 'Display add to cart buttons', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying "Add to Cart" button on the archive pages.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'quantity' => [
						'label'    => esc_html__( 'Display add to cart quantity field', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying add to cart quantity field on the archive pages.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'default_quantity' => [
						'label'    => esc_html__( 'Add to cart default quantity', 'divi-shop-builder' ),
						'description' => esc_html__('Define a quantity for add to cart quantity field', 'divi-shop-builder'),
						'default'     => 1,
						'section'  => 'wc_ags_archive',
						'type'        => 'range',
						'unitless'    => true,
						'input_attrs' => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1
						),
					],
					'thumbnail' => [
						'label'    => esc_html__( 'Display product image', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying product thumbnails on the archive pages.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'price' => [
						'label'    => esc_html__( 'Display prices', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying product prices on the archive pages.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'rating' => [
						'label'    => esc_html__( 'Display ratings', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying product rating stars on the archive pages, below the image.', 'divi-shop-builder'),
						'default'           => true,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'categories' => [
						'label'    => esc_html__( 'Display categories', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable displaying the product category below the product price.', 'divi-shop-builder'),
						'default'           => false,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'stock' => [
						'label'    => esc_html__( 'Display stock', 'divi-shop-builder' ),
						'description' => esc_html__('Show the "stock quantity" under each product in the shop, category and archive pages.', 'divi-shop-builder'),
						'default'           => false,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					'new_badge' => [
						'label'    => esc_html__( 'Display new badge', 'divi-shop-builder' ),
						'description' => esc_html__('Enable/disable this feature.', 'divi-shop-builder'),
						'default'           => false,
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_checkbox' ],
						'section'  => 'wc_ags_archive',
						'type'     => 'checkbox',
						'show_if_not'     => [
							'layout' => 'grid',
						],
					],
					/*
					'new_badge_position' => [
						'label'    => __( 'Badge position', 'divi-shop-builder' ),
						'default'           => 'default',
						'sanitize_callback' => array( $this, 'ags_divi_wc_sanitize_choices' ),
						'section'  => 'wc_ags_badge',
						'type'     => 'select',
						'choices'  => [
							'default' => 'Below thumbnail',
							'top_left' => 'Top left corner',
							'top_right' => 'Top right corner',
							'bottom_left' => 'Bottom left corner',
							'bottom_right' => 'Bottom right corner',
						],
						'active_callback' => array( $this, 'ags_divi_wc_is_new_badge_enabled' ),
						'child_item' => 'new-badge',
						// Divi/includes/builder/module/Signup.php
						/*
						'show_if'     => [
							'new_badge' => 'on',
						],
						*/
						/* example:
						'show_if_not' => [
							'field' => 'off',
						],
						*/
					//],
					'newness' => [
						'label'           => esc_html__( 'Days', 'divi-shop-builder' ),
						'description' => esc_html__('Show a "NEW" badge for products published in the last X days', 'divi-shop-builder'),
						'default'           => '28', // update in implementation.php too if this changes
						'sanitize_callback' => [ $this, 'ags_divi_wc_sanitize_choices' ],
						'section'         => 'wc_ags_badge',
						'active_callback' => array( $this, 'ags_divi_wc_is_new_badge_enabled' ),
						'child_item' => 'new-badge',
						'type'        => 'range',
						'unitless'    => true,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 365,
							'step' => 1
						),
						/*
						'show_if'     => [
							'new_badge' => 'on',
						],
						*/
					],
					'new_badge_background' => [
						'label'    => esc_html__('New Badge', 'divi-shop-builder'),
						//'default'           => [ 'color' => '#000000' ],
						'section'  => 'wc_ags_badge',
						'type'            => 'background_options',
						'css' => [
							'main' => '.wc-new-badge'
						],
						'child_item' => 'new-badge',
						/*
						'show_if'     => [
							'new_badge' => 'on',
						],
						*/
					],
					'new_badge_text' => [
						'label'    => esc_html__('New Badge', 'divi-shop-builder'),
						'default'           => [ 'size' => 30, 'color' => '#000000' ],
						'section'  => 'wc_ags_badge',
						'type'            => 'text_options',
						'css' => [
							'main' => '.wc-new-badge'
						],
						'child_item' => 'new-badge',
						/*
						'show_if'     => [
							'new_badge' => 'on',
						],
						*/
					],
					'new_badge_border' => [
						'label'    => esc_html__('New Badge', 'divi-shop-builder'),
						//'default'           => [ 'radius' => 5 ],
						'section'  => 'wc_ags_badge',
						'type'            => 'border_options',
						'css' => [
							// divi-shop-builder\includes\css\divi-shop-builder.css
							'main' => 'ul.products li.product .wc-new-badge'
						],
						'child_item' => 'new-badge',
						/*
						'show_if'     => [
							'new_badge' => 'on',
						],
						*/
					],
					'button_style' => [
						'label'    => esc_html__('Button', 'divi-shop-builder'),
						'section'  => 'wc_ags_button',
						'type'     => 'button_options',
						//'use_alignment'            => true,
						'css' => [
							'main' => '.product .button',
							//'alignment' => '.button',
						],
						'box_shadow'     => [
							'css' => [
								'main'      => '.product .button',
								'important' => true,
							],
						],
						'margin_padding' => [
							'css' => [
								'important' => 'all'
							]
						],
						'child_item' => 'button',
					],
					'sort_select' => [
						'label'    => esc_html__('Sorting Dropdown', 'divi-shop-builder'),
						'section'  => 'wc_ags_sort_select',
						'type'            => 'form_field_options',
						'css' => [
							'main' => '.woocommerce-ordering .orderby',
							// Divi\includes\builder\module\Signup.php
							'important'              => array( 'form_text_color' ),
						],
					],
					'quantity_style' => [
						'label'    => esc_html__('Quantity Field', 'divi-shop-builder'),
						'section'  => 'wc_ags_quantity',
						'type'            => 'form_field_options',
						'css' => [
							'main' => '.quantity input.qty',
							// Divi\includes\builder\module\Signup.php
							'important'              => 'all',
						],
					],
					'results_count_text' => [
						'label'    => esc_html__('Results Count', 'divi-shop-builder'),
						//'default'           => [ 'size' => 30, 'color' => '#000000' ],
						'section'  => 'wc_ags_results_count',
						'type'            => 'text_options',
						'css' => [
							'main' => '.woocommerce-result-count'
						],
					],
					'description_text' => [
						'label'    => esc_html__('Product Description', 'divi-shop-builder'),
						//'default'           => [ 'size' => 30, 'color' => '#000000' ],
						'section'  => 'wc_ags_product_description',
						'type'            => 'text_options',
						'css' => [
							'main' => '.ags-divi-wc-product-excerpt'
						],
//						'show_if'     => [
//							'layout' => 'list',
//						],
					],
					'pagination_border' => [
						'label'    => esc_html__('Pagination', 'divi-shop-builder'),
						//'default'           => [ 'radius' => 5 ],
						'section'  => 'wc_ags_pagination',
						'type'            => 'border_options',
						'css' => [
							'main' => '.woocommerce-pagination .page-numbers li'
						],
					],
					'pagination_wrapper_border' => [
						'label'    => esc_html__('Pagination Wrapper', 'divi-shop-builder'),
						'default'  => array(
							'border_styles' => array(
								'width' => '1px',
								'style' => 'solid',
								'color' => '#d3ced2'
							),
						),
						'section'  => 'wc_ags_pagination',
						'type'            => 'border_options',
						'css' => [
							'main' => '.woocommerce-pagination ul.page-numbers'
						],
					],

                    'pagination_active_text_color' => [
                        'label'    => esc_html__('Current Page Text Color', 'divi-shop-builder'),
                        'default' => '#8a7e88',
                        'section'  => 'wc_ags_pagination',
                        'type'            => 'alpha_color',
                        'css' => [
                            'main' => '.woocommerce-pagination .page-numbers li span.current'
                        ]
                    ],

                    'pagination_background_current' => [
                        'label'    => esc_html__('Current Page Text', 'divi-shop-builder'),
                        //'default'           => [ 'color' => '#000000' ],
                        'section'  => 'wc_ags_pagination',
                        'type'            => 'background_options',
                        'css' => [
                            'main' => '.woocommerce-pagination .page-numbers.current'
                        ],
                    ],

					'pagination_background' => [
						'label'    => esc_html__('Pagination Color', 'divi-shop-builder'),
						//'default'           => [ 'color' => '#000000' ],
						'section'  => 'wc_ags_pagination',
						'type'            => 'background_options',
						'css' => [
							'main' => '.woocommerce-pagination .page-numbers'
						],
					],

                    'pagination_text' => [
                        'label'    => esc_html__('Pagination', 'divi-shop-builder'),
                        //'default'           => [ 'size' => 30, 'color' => '#000000' ],
                        'section'  => 'wc_ags_pagination',
                        'type'            => 'text_options',
                        'css' => [
                            'main' => '.woocommerce-pagination .page-numbers'
                        ],
                        'options_priority' => array(
                            'pagination_text_text_color' => 0,
                        ),
                    ],

					'product_background' => [
						'label'    => esc_html__('Product', 'divi-shop-builder'),
						//'default'           => [ 'color' => '#000000' ],
						'section'  => 'wc_ags_product',
						'type'            => 'background_options',
						'css' => [
							'main' => 'li.product'
						],
					],

					'product_border' => [
						'label'    => esc_html__('Product', 'divi-shop-builder'),
						//'default'           => [ 'radius' => 5 ],
						'section'  => 'wc_ags_product',
						'type'            => 'border_options',
						'css' => [
							'main' => 'li.product'
						],
					],

				];




                /* temporarily disabled - rather than changing the Divi option we should re-implement this setting here so that it can be used for both the customizer and the module

                if ( isset( get_option('et_divi')['divi_woocommerce_archive_num_posts'] ) )
                {
                    $wp_customize->add_setting('et_divi[divi_woocommerce_archive_num_posts]', array(
                        'default' => '12',
                        'type' => 'option',
                        'transport' => 'refresh',
                        'sanitize_callback' => 'absint',
                        'capability' => 'edit_theme_options'
                    ));

                    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'et_divi[divi_woocommerce_archive_num_posts]', array(
                        'label' => esc_html__('Number of Products displayed', 'divi-shop-builder'),
                        'description' => esc_html__('Here you can designate how many WooCommerce products are displayed on the archive page. This option works independently from the Settings > Reading options in wp-admin.', 'divi-shop-builder'),
                        'section' => 'wc_ags_archive',
                        'settings' => 'et_divi[divi_woocommerce_archive_num_posts]',
                        'type' => 'number'

                    )));
                }
				*/

				/* temporarily disabled - this doesn't map well into the settings array, do we really need it?

                $wp_customize->add_setting( 'wc_ags_archive_description_2', array() );

                $wp_customize->add_control( new AGS_Divi_WC_Customizer_HTML_Control( $wp_customize, 'wc_ags_archive_description_2', array(
                    'section' => 'wc_ags_archive',
                    'content' =>  __( '<span class="ags-woo-title">Additional Customizations</span>', 'divi-shop-builder' ) . '</p>',
                ) ) );
				*/

				/*
				WooCommerce Subscriptions support
				
				Find the WCS_Query instance and hook add_menu_items() in admin requests.
				
				Note: If there is an admin_init hook in future, this could probably be moved there
				instead of in the init hook with an is_admin() check.
				*/
				if (is_admin()) {
					foreach ($GLOBALS['wp_filter']['init'][10] as $hook) {
						if (!empty($hook['function']) && is_array($hook['function']) && is_a($hook['function'][0], 'WCS_Query')) {
							$wcs_query = $hook['function'][0];
							add_filter( 'woocommerce_account_menu_items', [ $wcs_query, 'add_menu_items' ] );
							break;
						}
					}
				}


            }

			function get_settings($context='all') {
				if ($context == 'all') {
					$contextSettings = $this->settings;
				} else {
					$contextSettings = [];
					foreach ($this->settings as $settingId => $setting) {
						if ( !isset($setting['contexts']) || in_array($context, $setting['contexts']) ) {
							$contextSettings[$settingId] = $setting;
						}
					}
				}

				return $this->expand_settings($context, $contextSettings);
			}

			function expand_settings($context, $settings) {

				switch ($context) {
					case 'page':
						$expandedSettings = [];
						foreach ($settings as $settingId => $setting) {

								switch ($setting['type']) {

									case 'text_options':

										$commonParams = [];

										if (isset($setting['show_if'])) {
											$commonParams['show_if'] = $setting['show_if'];
										}
										if (isset($setting['show_if_not'])) {
											$commonParams['show_if_not'] = $setting['show_if_not'];
										}

										$expandedSettings[$settingId.'_font_family'] = array_merge($commonParams, [
											'label'	      => sprintf(esc_html__('%s Font Family', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'et_sanitize_font_choices',
											'section'     => $setting['section'],
											'type'        => 'select_option',
											'choices'	=> self::get_font_choices(),
										]);

										if (isset($setting['default']['font_family'])) {
											$expandedSettings[$settingId.'_font_family']['default'] = $setting['default']['font_family'];
										}


										$expandedSettings[$settingId.'_size'] = array_merge($commonParams, [
											'label'	      => sprintf(esc_html__('%s Font Size', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'absint',
											'section'     => $setting['section'],
											'type'        => 'range',
											'input_attrs' => array(
												'min'  => 12,
												'max'  => 50,
												'step' => 1
											),
										]);

										if (isset($setting['default']['font_size'])) {
											$expandedSettings[$settingId.'_font_size']['default'] = $setting['default']['font_size'];
										}

										$expandedSettings[$settingId.'_transform'] = array_merge($commonParams, [
											'label'    => sprintf(esc_html__('%s Font Style', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'et_sanitize_font_style',
											'section'  => $setting['section'],
											'choices'     => et_divi_font_style_choices(),
											'type'        => 'font_style',
										]);

										if (isset($setting['default']['text_transform'])) {
											$expandedSettings[$settingId.'_text_transform']['default'] = $setting['default']['text_transform'];
										}

										$expandedSettings[$settingId.'_color'] = array_merge($commonParams, [
											'label'    => sprintf(esc_html__('%s Text Color', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'et_sanitize_alpha_color',
											'type'            => 'alpha_color',
											'section'  => $setting['section'],
										]);

										if (isset($setting['default']['font_color'])) {
											$expandedSettings[$settingId.'_font_color']['default'] = $setting['default']['font_color'];
										}

										break;

									case 'border_options':

										$commonParams = [];

										if (isset($setting['show_if'])) {
											$commonParams['show_if'] = $setting['show_if'];
										}
										if (isset($setting['show_if_not'])) {
											$commonParams['show_if_not'] = $setting['show_if_not'];
										}

										$expandedSettings[$settingId.'_radius'] = array_merge($commonParams, [
											'label'	      => sprintf(esc_html__('%s Border Radius', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'absint',
											'section'     => $setting['section'],
											'type'        => 'range',
											'input_attrs' => array(
												'min'  => 0,
												'max'  => 50,
												'step' => 1
											),
										]);

										if (isset($setting['default']['radius'])) {
											$expandedSettings[$settingId.'_radius']['default'] = $setting['default']['radius'];
										}

										break;

									case 'background_options':

										$commonParams = [];

										if (isset($setting['show_if'])) {
											$commonParams['show_if'] = $setting['show_if'];
										}
										if (isset($setting['show_if_not'])) {
											$commonParams['show_if_not'] = $setting['show_if_not'];
										}

										$expandedSettings[$settingId.'_color'] = array_merge($commonParams, [
											'label'    => sprintf(esc_html__('%s Background Color', 'divi-shop-builder'), $setting['label']),
											'sanitize_callback' => 'et_sanitize_alpha_color',
											'section'  => $setting['section'],
											'type'            => 'alpha_color',
										]);

										if (isset($setting['default']['color'])) {
											$expandedSettings[$settingId.'_color']['default'] = $setting['default']['color'];
										}

										break;

									default:
										$expandedSettings[$settingId] = $setting;
								}
						}

						break;
					default:
						$expandedSettings = $settings;
				}

				return $expandedSettings;
			}

			static function get_font_choices() {

	            /**
	             * Code from Elegant Themes
	             */
            	$site_domain = get_locale();

	            $google_fonts = et_builder_get_fonts( array(
		            'prepend_standard_fonts' => false,
	            ) );

	            $user_fonts = et_builder_get_custom_fonts();

	            // combine google fonts with custom user fonts
	            $google_fonts = array_merge( $user_fonts, $google_fonts );

	            $et_domain_fonts = array(
		            'ru_RU' => 'cyrillic',
		            'uk'    => 'cyrillic',
		            'bg_BG' => 'cyrillic',
		            'vi'    => 'vietnamese',
		            'el'    => 'greek',
		            'ar'    => 'arabic',
		            'he_IL' => 'hebrew',
		            'th'    => 'thai',
		            'si_lk' => 'sinhala',
		            'bn_bd' => 'bengali',
		            'ta_lk' => 'tamil',
		            'te'    => 'telegu',
		            'km'    => 'khmer',
		            'kn'    => 'kannada',
		            'ml_in' => 'malayalam',
	            );

	            $et_one_font_languages = et_get_one_font_languages();

	            $font_choices = array();
	            $font_choices['none'] = array(
		            'label' => 'Default Theme Font'
	            );

	            $removed_fonts_mapping = et_builder_old_fonts_mapping();

	            foreach ( $google_fonts as $google_font_name => $google_font_properties ) {
		            $use_parent_font = false;

		            if ( isset( $removed_fonts_mapping[ $google_font_name ] ) ) {
			            $parent_font = $removed_fonts_mapping[ $google_font_name ]['parent_font'];
			            $google_font_properties['character_set'] = $google_fonts[ $parent_font ]['character_set'];
			            $use_parent_font = true;
		            }

		            if ( '' !== $site_domain && isset( $et_domain_fonts[$site_domain] ) && isset( $google_font_properties['character_set'] ) && false === strpos( $google_font_properties['character_set'], $et_domain_fonts[$site_domain] ) ) {
			            continue;
		            }

		            $font_choices[ $google_font_name ] = array(
			            'label' => $google_font_name,
			            'data'  => array(
				            'parent_font'    => $use_parent_font ? $google_font_properties['parent_font'] : '',
				            'parent_styles'  => $use_parent_font ? $google_fonts[$parent_font]['styles'] : $google_font_properties['styles'],
				            'current_styles' => $use_parent_font && isset( $google_fonts[$parent_font]['styles'] ) && isset( $google_font_properties['styles'] ) ? $google_font_properties['styles'] : '',
				            'parent_subset'  => $use_parent_font && isset( $google_fonts[$parent_font]['character_set'] ) ? $google_fonts[$parent_font]['character_set'] : '',
				            'standard'       => isset( $google_font_properties['standard'] ) && $google_font_properties['standard'] ? 'on' : 'off',
			            )
		            );
	            }

	            /**
	             * End code from Elegant Themes
	             */

				return $font_choices;
			}

			/**
			 * Add settings to the Customizer
			 *
			 * @param  array $wp_customize the Customiser settings object.
			 * @return void
			 */
			public function ags_divi_wc_customize_register( $wp_customize )
            {

            	// Create panel
                $wp_customize->add_panel('wc_ags', array(
                    'title' => esc_html__('Divi Shop Builder', 'divi-shop-builder'),
                    'priority' => 2,
                ));

                // Create sections
                $wp_customize->add_section('wc_ags_archive', array(
                    'title' => esc_html__('Product Archive', 'divi-shop-builder'),
                    'panel' => 'wc_ags',
                    'priority' => 1,
                    'description' => esc_html__('Customize the WooCommerce shop page, category page, archive pages.', 'divi-shop-builder'),
                ));

                // Create sections
                $wp_customize->add_section('wc_ags_badge', array(
                    'title' => esc_html__('New Badge', 'divi-shop-builder'),
                    'panel' => 'wc_ags',
                    'priority' => 2,
                    'description' => esc_html__('Display the NEW badge on the product that was recently added to your WooCommerce website. Settings is basing on the product publishing date.', 'divi-shop-builder'),
                ));

                // Product Overlay
                $wp_customize->add_section('wc_ags_overlay', array(
                    'title' => esc_html__('Product Overlay', 'divi-shop-builder'),
                    'panel' => 'wc_ags',
                    'priority' => 3,
                    'description' => esc_html__('Enables a product overlay with the custom text. The product overlay is displayed on the shop page, archive product pages and product category pages upon hovering the product image.', 'divi-shop-builder'),
                ));
                // Additional Customizations
                $wp_customize->add_section('wc_ags_add_cus', array(
                    'title' => esc_html__('Additional customizations', 'divi-shop-builder'),
                    'panel' => 'wc_ags',
                    'priority' => 4,
                    'description' => esc_html__('', 'divi-shop-builder'),
                ));

                // Notice about Theme Builder
                $wp_customize->add_setting( 'wc_ags_archive_description', array() );

                $wp_customize->add_control( new AGS_Divi_WC_Customizer_HTML_Control( $wp_customize, 'wc_ags_archive_description', array(
                    'section' => 'wc_ags_archive',
                    'priority' => 1,
                    'content' =>  '<p><span class="ags-woo-notice">'
									.sprintf(
										esc_html__( 'Settings do not work if page is built with the %sDivi Theme Builder%s', 'divi-shop-builder' ),
										'<span class="ags-woo-notice-important">',
										'</span>'
									)
									.'</span></p>',
                ) ) );


				foreach ( $this->get_settings('page') as $settingId => $setting ) {

					switch ( $setting['type'] ) {
						case 'select':
							$controlClass = 'WP_Customize_Control';
							$controlArgs = [
								'type' => 'select',
								'choices'  => $setting['choices']
							];
							break;

						case 'select_option':
							$controlClass = 'ET_Divi_Select_Option';
							$controlArgs = [
								'type' => 'select',
								'choices'  => $setting['choices']
							];
							break;

						case 'checkbox':
							$controlClass = 'WP_Customize_Control';
							$controlArgs = [
								'type' => 'checkbox'
							];
							break;

						case 'text':
							$controlClass = 'WP_Customize_Control';
							$controlArgs = [
								'type' => 'text'
							];
							break;

						case 'alpha_color':
							$controlClass = 'ET_Divi_Customize_Color_Alpha_Control';
							$controlArgs = [];
							break;

						case 'range':
							$controlClass = 'ET_Divi_Range_Option';
							$controlArgs = [
								'input_attrs' => $setting['input_attrs']
							];
							break;

						case 'font_style':
							$controlClass = 'ET_Divi_Font_Style_Option';
							$controlArgs = [
								'type' => 'font_style',
								'choices'  => $setting['choices']
							];
							break;
						default:
							$controlClass = 'WP_Customize_Control';
							$controlArgs  = [
								'type' => !empty( $setting['type'] ) ? $setting['type'] : 'text'
							];
							break;

					}

					if (!empty($setting['excerpt'])) {
						$controlArgs['excerpt'] = $setting['excerpt'];
					}

					if ( !empty($setting['show_if']) || !empty($setting['show_if_not']) ) {
						$controlArgs['active_callback'] = [$this, 'ags_divi_wc_is_control_active'];
					}


					$settingArgs = array(
						'transport'         => 'refresh',
						'sanitize_callback' => $setting['sanitize_callback'],
						'type' => 'option',
						'capability' => 'edit_theme_options'
					);

					if (isset($setting['default'])) {
						$settingArgs['default'] = $setting['default'];
					}

					$wp_customize->add_setting( 'ags_divi_wc['.$settingId.']' , $settingArgs );

					$wp_customize->add_control(
						new $controlClass(
							$wp_customize,
							'ags_divi_wc['.$settingId.']',
							array_merge(
								$controlArgs,
								array(
									'label'    => esc_html($setting['label']),
									'section'  => esc_html($setting['section']),
									'settings' => 'ags_divi_wc['.$settingId.']',
								)
							)
						)
					);

				}
            }

			/**
			 * Checkbox sanitization callback.
			 *
			 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
			 * as a boolean value, either TRUE or FALSE.
			 *
			 * @param bool $checked Whether the checkbox is checked.
			 * @return bool Whether the checkbox is checked.
			 */
			public function ags_divi_wc_sanitize_checkbox( $checked )
            {
				return ( ( isset( $checked ) && true == $checked ) ? true : false );
			}

			/**
			 * Sanitizes choices (selects / radios)
			 * Checks that the input matches one of the available choices
			 *
			 * @param array $input the available choices.
			 * @param array $setting the setting object.
			 */
			public function ags_divi_wc_sanitize_choices( $input, $setting ) {
				// Ensure input is a slug.
				$input = sanitize_key( $input );

				// Get list of choices from the control associated with the setting.
				$choices = $setting->manager->get_control( $setting->id )->choices;

				// If the input is a valid key, return it; otherwise, return the default.
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
			}


			public function ags_divi_wc_is_control_active( $control )
            {
				$settings = $this->get_settings('page');
				$optionValues = get_option('ags_divi_wc', []);
				$optionKey = substr( $control->id, 12, -1 );

				if ( isset( $settings[$optionKey]['show_if'] ) ) {
					foreach ( $settings[$optionKey]['show_if'] as $conditionField => $conditionValue ) {
						if ( !isset($optionValues[$conditionField]) || $optionValues[$conditionField] != $conditionValue ) {
							return false;
						}
					}
				}

				if ( isset( $settings[$optionKey]['show_if_not'] ) ) {
					foreach ( $settings[$optionKey]['show_if_not'] as $conditionField => $conditionValue ) {
						if ( isset($optionValues[$conditionField]) && $optionValues[$conditionField] == $conditionValue ) {
							return false;
						}
					}
				}

				return true;
			}

			/**
			 * Enqueue styles
			 *
			 * @return void
			 */
			function ags_divi_wc_styles()
            {
				wp_enqueue_style( 'ags-styles', plugins_url( '/includes/css/divi-shop-builder.css', __FILE__ ) );
				wp_enqueue_style( 'ags-layout-styles', plugins_url( '/includes/css/divi-shop-builder-columns.css', __FILE__ ) );
				wp_enqueue_style( 'ags-dynamic-styles', plugins_url( '/includes/css/divi-shop-builder-styles.css', __FILE__ ) );
			}

			/**
			 * Generate CSS
			 */
			public static function generateCss() {
				ob_start();
				include( DIVI_WOO_FILE_PATH . '/includes/output/output-css.php' );
				$css = trim(ob_get_clean());
				if (!empty($css)) {
					file_put_contents(DIVI_WOO_FILE_PATH . '/includes/css/divi-shop-builder.css', $css);
				}
				/* Remove output files to force re-generation */
//				@unlink(DIVI_WOO_FILE_PATH .'/includes/divi-style.css');
			}

			public static function ags_divi_wc_customizer_save($saveResult) {
				//if (empty($saveResult['autosaved'])) {
				//@unlink(__DIR__.'/includes/output/style.css');
				self::generateCss();
				//}
				return $saveResult;
			}

			// woocommerce-carousel-for-divi\woocommerce-carousel-for-divi.php
			// Divi\includes\builder\functions.php
			function get_asset_definitions($defs) {

				// for debug:
				//return $defs;

				if( !class_exists( 'AGS_Divi_WC_ModuleShop_Child' ) ){
					return $defs;
				}

				$shortcodes = '';
				foreach ( AGS_Divi_WC_ModuleShop_Child::$TYPES as $type => $label ) {
					$shortcodes .= '[ags_woo_shop_plus_child item="'.$type.'" item_title="'.$label.'" /]';
				}

				$account_nav_shortcodes = '';
				$account_content_shortcodes = '';
				foreach( wc_get_account_menu_items() as $item => $name ) {
					$account_nav_shortcodes 	.= '[ags_woo_account_navigation_item item="'.$item.'" item_title="'.$name.'" /]';

					if( $item === 'customer-logout' ) continue;

					$account_content_shortcodes .= '[ags_woo_account_content_item item="'.$item.'" item_title="'.$name.'" /]';
				}

				return $defs.sprintf(
					'; window.AGS_Divi_WC_Backend=%s;',
					et_fb_remove_site_url_protocol(
						wp_json_encode(
							[
								// Divi\includes\builder\functions.php
								'shopModuleDefaultContent' => et_fb_process_shortcode($shortcodes),
								'accountNavModuleDefaultContent' => et_fb_process_shortcode($account_nav_shortcodes),
								'accountContentModuleDefaultContent' => et_fb_process_shortcode($account_content_shortcodes)
							],
							ET_BUILDER_JSON_ENCODE_OPTIONS
						)
					)
				);
			}


			public function thankyou_page_setting( $settings ){

				$new_settings = array();

				foreach( $settings as $setting ){

					if( $setting['id'] === 'advanced_page_options' && $setting['type'] === 'sectionend' ){
						$new_settings[] = array(
							'title'    => __( 'Thank you page', 'woocommerce' ),
							'desc'     => __( 'Thank you page after the successful checkout', 'divi-shop-builder' ),
							'id'       => 'woocommerce_thankyou_page_id',
							'type'     => 'single_select_page',
							'default'  => '',
							'class'    => 'wc-enhanced-select-nostd',
							'css'      => 'min-width:300px;',
							'args'     => array(
								'exclude' =>
									array(
										wc_get_page_id( 'cart' ),
										wc_get_page_id( 'myaccount' ),
										wc_get_page_id( 'checkout' ),
									),
							),
							'desc_tip' => true,
							'autoload' => false,
						);
					}

					$new_settings[] = $setting;
				}

				$settings = $new_settings;

				return $settings;
			}


		}

		global $ags_divi_wc;


		/**
		 * Creates the extension's main class instance.
		 *
		 * @since 1.0.0
		 */
		function agswcc_initialize_extension() {
			// woocommerce-carousel-for-divi\woocommerce-carousel-for-divi.php
			if ( function_exists('WC') ) {
				require_once plugin_dir_path( __FILE__ ) . 'includes/extension.php';
			}
		}

		$ags_divi_wc = new AGS_divi_wc();

	}
