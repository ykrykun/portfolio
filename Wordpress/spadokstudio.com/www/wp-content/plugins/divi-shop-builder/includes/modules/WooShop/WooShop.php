<?php

// require_once 'helpers/Overlay.php';

use simplehtmldom\HtmlDocument;


class AGS_Divi_WC_ModuleShopGrid extends ET_Builder_Module_Type_PostBased {

	const MAIN_CSS_ELEMENT = '%%order_class%%.ags_woo_shop_plus';

	// Divi\includes\builder\module\Signup.php
	public $module_items_config = array(
		'toggle_slug'      => 'wc_ags_archive',
		'location'    => 'top',
		'show_if'     => array(
			'layout' => array( 'grid', 'both' ),
		),
	);

	function init() {
		$this->name       = esc_html__( 'Woo Shop +', 'divi-shop-builder' );
		$this->plural     = esc_html__( 'Woo Shop +', 'divi-shop-builder' );
		$this->slug       = 'ags_woo_shop_plus';
		$this->vb_support = 'on';
		// woocommerce-carousel-for-divi\includes\modules\WoocommerceCarousel\WoocommerceCarousel.php
		$this->child_slug = 'ags_woo_shop_plus_child';
		$this->icon  = '8';


		$this->main_css_element = self::MAIN_CSS_ELEMENT;

		$this->settings_modal_toggles = self::get_settings_modal_toggles_array();

		$this->advanced_fields = array(
			'fonts'          => array(
				'title'      => array(
					'label' => esc_html__( 'Title', 'divi-shop-builder' ),
					'css'   => array(
						'main'      => "{$this->main_css_element} .woocommerce ul.products li.product h3, {$this->main_css_element} .woocommerce ul.products li.product h1, {$this->main_css_element} .woocommerce ul.products li.product h2, {$this->main_css_element} .woocommerce ul.products li.product h4, {$this->main_css_element} .woocommerce ul.products li.product h5, {$this->main_css_element} .woocommerce ul.products li.product h6",
						'hover'     => "{$this->main_css_element} .woocommerce ul.products li.product h3:hover, {$this->main_css_element} .woocommerce ul.products li.product h1:hover, {$this->main_css_element} .woocommerce ul.products li.product h2:hover, {$this->main_css_element} .woocommerce ul.products li.product h4:hover, {$this->main_css_element} .woocommerce ul.products li.product h5:hover, {$this->main_css_element} .woocommerce ul.products li.product h6:hover, {$this->main_css_element} .woocommerce ul.products li.product h1.hover, {$this->main_css_element} .woocommerce ul.products li.product h2.hover, {$this->main_css_element} .woocommerce ul.products li.product h3.hover, {$this->main_css_element} .woocommerce ul.products li.product h4.hover, {$this->main_css_element} .woocommerce ul.products li.product h5.hover, {$this->main_css_element} .woocommerce ul.products li.product h6.hover",
						'important' => 'plugin_only',
					),
				),
				'price'      => array(
					'label'       => esc_html__( 'Price', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product .price, {$this->main_css_element} .woocommerce ul.products li.product .price .amount",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .price:hover, {$this->main_css_element} .woocommerce ul.products li.product .price:hover .amount, {$this->main_css_element} .woocommerce ul.products li.product .price.hover, {$this->main_css_element} .woocommerce ul.products li.product .price.hover .amount",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'old_price'      => array(
					'label'       => esc_html__( 'Old Price', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product .price del .amount",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .price:hover del .amount, {$this->main_css_element} .woocommerce ul.products li.product .price.hover del .amount",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'category'      => array(
					'label'       => esc_html__( 'Category', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product .categories, {$this->main_css_element} .woocommerce ul.products li.product .categories a",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .categories a:hover",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'in_stock'     => array(
					'label'       => esc_html__( 'In Stock', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product .stock.in-stock",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .stock.in-stock",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
					'text_color' => array(
						'default' => '#85ad74'
					)
				),
				'out_of_stock'  => array(
					'label'       => esc_html__( 'Out of Stock', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product .stock.out-of-stock",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .stock.out-of-stock",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
					'text_color' => array(
						'default' => '#eb4649'
					)
				),
				'back_order'   => array(
					'label'       => esc_html__( 'Available On Backorder', 'divi-shop-builder' ),
					'css'         => array(
						'main'  => "{$this->main_css_element} .woocommerce ul.products li.product.onbackorder .stock.in-stock",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product.onbackorder .stock.in-stock",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
					'text_color' => array(
						'default' => '#85ad74'
					)
				),
				'sale_badge' => array(
					'label'           => esc_html__( 'Sale Badge', 'divi-shop-builder' ),
					'css'             => array(
						'main'      => "{$this->main_css_element} .woocommerce ul.products li.product .ags-divi-wc-sale-badge span.onsale",
						'important' => array( 'line-height', 'font', 'text-shadow', 'size'),
					),
					'hide_text_align' => true,
					'line_height'     => array(
						'default' => '1.3em',
					),
					'font_size'       => array(
						'default' => '20px',
					),
					'letter_spacing'  => array(
						'default' => '0px',
					),
				),
				'sale_price' => array(
					'label'           => esc_html__( 'Sale Price', 'divi-shop-builder' ),
					'css'             => array(
						'main' => "{$this->main_css_element} .woocommerce ul.products li.product .price ins .amount",
					),
					'hide_text_align' => true,
					'font'            => array(
						'default' => '|700|||||||',
					),
					'line_height'     => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'rating'     => array(
					'label'            => esc_html__( 'Star Rating', 'divi-shop-builder' ),
					'css'              => array(
						'main'                 => '%%order_class%% .star-rating',
						'hover'                => '%%order_class%% li.product:hover .star-rating',
						'color'                => '%%order_class%% .star-rating > span:before',
						'color_hover'          => '%%order_class%% li.product:hover .star-rating > span:before',
						'letter_spacing_hover' => '%%order_class%% li.product:hover .star-rating',
						'important'            => array( 'size' ),
					),
					'font_size'        => array(
						'default' => '14px',
					),
					'hide_font'        => true,
					'hide_line_height' => true,
					'hide_text_shadow' => true,
					'text_align'       => array(
						'label' => esc_html__( 'Star Rating Alignment', 'divi-shop-builder' ),
					),
					'font_size'        => array(
						'label' => esc_html__( 'Star Rating Size', 'divi-shop-builder' ),
					),
					'text_color'       => array(
						'label' => esc_html__( 'Star Rating Color', 'divi-shop-builder' ),
					),
					'toggle_slug'      => 'star',
					'options_priority' => array(
						'rating_text_color' => 9,
					),
				),
			),
			'borders'        => array(
				'default' => array(),
				'image'   => array(
					'css'          => array(
						'main'      => array(
							'border_radii'       => "{$this->main_css_element} .et_shop_image > img, {$this->main_css_element} .et_shop_image .et_overlay",
							'border_radii_hover' => "{$this->main_css_element} .et_shop_image > img:hover, {$this->main_css_element} .et_shop_image .et_overlay",
							'border_styles'      => "{$this->main_css_element} .et_shop_image > img",
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Image', 'divi-shop-builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'image',
				),
				'multiview_border' => array(
					'css'          => array(
						'main'      => array(
							'border_radii'       => "{$this->main_css_element} .ags_woo_shop_plus_multiview button",
							'border_styles'      => "{$this->main_css_element} .ags_woo_shop_plus_multiview button",
						),
						'important' => 'all',
					),
					'defaults'  => array(
						'border_radii'  => '||||',
						'border_styles' => array(
							'width' => '2px',
							'style' => 'solid',
							'color' => '#ddd'
						),
						'border_radii'  => 'on|0px|0px|0px|0px'
					),
					'label_prefix' => esc_html__( 'Icons', 'divi-shop-builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'grid_list_view',
				),
				'sale_badge' => array(
					'css'          => array(
						'main'      => array(
							'border_radii'       => "{$this->main_css_element} .woocommerce ul.products li.product .onsale",
							'border_styles'      => "{$this->main_css_element} .woocommerce ul.products li.product .onsale",
						),
						'important' => 'all',
					),
					'defaults'        => array(
						'border_radii'  => 'on|3px|3px|3px|3px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
					'label_prefix' => esc_html__( 'Sale Badge', 'divi-shop-builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'sale_badge',
				),
			),
			'box_shadow'     => array(
				'default' => array(),
				'image'   => array(
					'label'             => esc_html__( 'Image Box Shadow', 'divi-shop-builder' ),
					'option_category'   => 'layout',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'image',
					'css'               => array(
						'main'      => '%%order_class%%.et_pb_module .woocommerce .et_shop_image > img, %%order_class%%.et_pb_module .woocommerce .et_overlay',
						'overlay'   => 'inset',
						'important' => true,
					),
					'default_on_fronts' => array(
						'color'    => '',
						'position' => '',
					),
				),
				'product_shadow'   => array(
					'label'             => esc_html__( 'Product Box Shadow', 'divi-shop-builder' ),
					'option_category'   => 'layout',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'wc_ags_product',
					'css'               => array(
						'main'      => '%%order_class%% li.product',
						//'overlay'   => 'inset',
						//'important' => true,
					),/*
					'default_on_fronts' => array(
						'color'    => '',
						'position' => '',
					),*/
				),
				'multiview_shadow' => array(
					'label'             => esc_html__( 'Icons Box Shadow', 'divi-shop-builder' ),
					'css'          => array(
						'main'      => "{$this->main_css_element} .ags_woo_shop_plus_multiview button",
						'important' => 'all',
					),
					'option_category'   => 'layout',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'grid_list_view',
				)
			),
			'margin_padding' => array(
				'css' => array(
					'main'      => '%%order_class%%',
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'           => array(
				'css' => array(
					'text_shadow' => implode(
						', ',
						array(
							// Title
							"{$this->main_css_element} .woocommerce ul.products h3",
							"{$this->main_css_element} .woocommerce ul.products  h1",
							"{$this->main_css_element} .woocommerce ul.products  h2",
							"{$this->main_css_element} .woocommerce ul.products  h4",
							"{$this->main_css_element} .woocommerce ul.products  h5",
							"{$this->main_css_element} .woocommerce ul.products  h6",
							// Price
							"{$this->main_css_element} .woocommerce ul.products .price",
							"{$this->main_css_element} .woocommerce ul.products .price .amount",

						)
					),
				),
			),
			'filters'        => array(
				'child_filters_target' => array(
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'          => array(
				'css' => array(
					'main' => '%%order_class%% .et_shop_image',
				),
			),
			'scroll_effects' => array(
				'grid_support' => 'yes',
			),
			'button'         => array(
				'button_view_cart' => array(
					'label'          => esc_html__( 'Button', 'divi-shop-builder' ),
					'toggle_slug'     => 'button_view_cart',
					'css'            => array(
						'main'         => '%%order_class%% ul.products li.product .added_to_cart',
						'important'    => 'all',
					),
					'border_width'        => array(
						'default' => '0px',
					),
					'box_shadow'     => array(
						'css' => array(
							'main'      => '%%order_class%% ul.products li.product .added_to_cart',
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

		$this->custom_css_fields = array(
			'product'   => array(
				'label'    => esc_html__( 'Product', 'divi-shop-builder' ),
				'selector' => 'li.product',
			),
			'onsale'    => array(
				'label'    => esc_html__( 'Onsale', 'divi-shop-builder' ),
				'selector' => 'ul.products li.product span.ags-divi-wc-sale-badge span.onsale',
			),
            'new'    => array(
                'label'    => esc_html__( 'New Badge', 'divi-shop-builder' ),
                'selector' => 'li.product .wc-new-badge',
            ),
			'image'     => array(
				'label'    => esc_html__( 'Image', 'divi-shop-builder' ),
				'selector' => '.et_shop_image',
			),
			'overlay'   => array(
				'label'    => esc_html__( 'Overlay', 'divi-shop-builder' ),
				'selector' => '.et_overlay',
			),
			'title'     => array(
				'label'    => esc_html__( 'Title', 'divi-shop-builder' ),
				'selector' => $this->get_title_selector(),
			),
			'button'     => array(
				'label'    => esc_html__( 'Button', 'divi-shop-builder' ),
				'selector' => '.button',
			),
			'rating'    => array(
				'label'    => esc_html__( 'Rating', 'divi-shop-builder' ),
				'selector' => '.star-rating',
			),
			'price'     => array(
				'label'    => esc_html__( 'Price', 'divi-shop-builder' ),
				'selector' => 'li.product .price',
			),
			'price_old' => array(
				'label'    => esc_html__( 'Old Price', 'divi-shop-builder' ),
				'selector' => 'li.product .price del span.amount',
			),
            'description' => array(
                'label'    => esc_html__( 'Description', 'divi-shop-builder' ),
                'selector' => '.ags-divi-wc-product-excerpt',
            ),
            'categories' => array(
                'label'    => esc_html__( 'Categories', 'divi-shop-builder' ),
                'selector' => 'li.product .categories',
            ),
            'in-stock' => array(
                'label'    => esc_html__( 'In Stock', 'divi-shop-builder' ),
                'selector' => 'li.product .in-stock',
            ),
            'out-of-stock' => array(
                'label'    => esc_html__( 'Out of Stock', 'divi-shop-builder' ),
                'selector' => 'li.product .out-of-stock',
            ),
            'pagenavi' => array(
                'label'    => esc_html__( 'Pagenavi', 'divi-shop-builder' ),
                'selector' => '.woocommerce-pagination ul.page-numbers',
            ),
		);
	}

	static function get_settings_modal_toggles_array() {

		return array(
			'general'  => array(
				'toggles' => array(
					'wc_ags_archive' => esc_html__('Products', 'divi-shop-builder'),
					'wc_ags_overlay' => esc_html__('Product Overlay', 'divi-shop-builder'),
					'wc_ags_add_cus' => esc_html__('Additional customizations', 'divi-shop-builder')

				),
			),
			'advanced' => array(
				'toggles' => array(
					'overlay' => esc_html__('Overlay', 'divi-shop-builder'),
					'image'   => esc_html__('Image', 'divi-shop-builder'),
					'star'    => esc_html__('Star Rating', 'divi-shop-builder'),
					'wc_ags_badge' => esc_html__('New Badge', 'divi-shop-builder'),
					'wc_ags_button' => esc_html__('Button', 'divi-shop-builder'),
					'wc_ags_quantity' => esc_html__('Quantity Field', 'divi-shop-builder'),
					'wc_ags_product' => esc_html__('Product Container', 'divi-shop-builder'),
					'wc_ags_product_description' => esc_html__('Product Description', 'divi-shop-builder'),
					'wc_ags_sort_select' => esc_html__('Sorting Dropdown', 'divi-shop-builder'),
					'wc_ags_results_count' => esc_html__('Results Count', 'divi-shop-builder'),
					'wc_ags_pagination' => esc_html__('Pagination', 'divi-shop-builder'),
					'button_view_cart' => esc_html__('View Cart Button', 'divi-shop-builder'),
					'grid_list_view' => esc_html__('Grid/List view button', 'divi-shop-builder')
				),
			),
		);

	}

	function get_fields() {

		$fields = array(


			'type'                => array(
				'label'            => esc_html__( 'Product View Type', 'divi-shop-builder' ),
				'type'             => 'select',
				'option_category'  => 'basic_option',
				'options'          => array(
					'default'          => esc_html__( 'Default (Menu ordering + name)', 'divi-shop-builder' ),
					'latest'           => esc_html__( 'Latest Products', 'divi-shop-builder' ),
					'featured'         => esc_html__( 'Featured Products', 'divi-shop-builder' ),
					'sale'             => esc_html__( 'Sale Products', 'divi-shop-builder' ),
					'best_selling'     => esc_html__( 'Best Selling Products', 'divi-shop-builder' ),
					'top_rated'        => esc_html__( 'Top Rated Products', 'divi-shop-builder' ),
					'product_category' => esc_html__( 'Product Category', 'divi-shop-builder' ),
				),
				'default_on_front' => 'default',
				'affects'          => array(
					'include_categories',
				),
				'description'      => esc_html__( 'Choose which type of product view you would like to display.', 'divi-shop-builder' ),
				'toggle_slug'      => 'wc_ags_archive',
				'computed_affects' => array(
					'__shop',
				),
			),

			// divi-woocommerce-customizer\includes\modules\WooShopGrid-child\WooShopGrid-child.php
			'child_order' => array(
				'label'        => '',
				'type'         => 'ags_wc_child_order',
				'childField'  => 'item',
				'toggle_slug'      => 'wc_ags_archive',
				'computed_affects' => array(
					'__shop',
				),
			),


			'use_current_loop'    => array(
				'label'            => esc_html__( 'Use Current Page', 'divi-shop-builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'divi-shop-builder' ),
					'off' => esc_html__( 'No', 'divi-shop-builder' ),
				),
				'description'      => esc_html__( 'Only include products for the current page. Useful on archive and index pages. For example let\'s say you used this module on a Theme Builder layout that is enabled for product categories. Selecting the "Sale Products" view type above and enabling this option would show only products that are on sale when viewing product categories.', 'divi-shop-builder' ),
				'toggle_slug'      => 'wc_ags_archive',
				'default'          => 'off',
				'show_if'          => array(
					'function.isTBLayout' => 'on',
				),
				'show_if_not'      => array(
					'type' => 'product_category',
				),
				'computed_affects' => array(
					'__shop',
				),
			),
			'posts_number'        => array(
				'default'          => '12',
				'label'            => esc_html__( 'Product Count', 'divi-shop-builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Define the number of products that should be displayed per page.', 'divi-shop-builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'wc_ags_archive',
			),
			'include_categories'  => array(
				'label'            => esc_html__( 'Included Categories', 'divi-shop-builder' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 'divi-shop-builder' ),
					'current' => esc_html__( 'Current Category', 'divi-shop-builder' ),
				),
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'product_cat',
				),
				'depends_show_if'  => 'product_category',
				'description'      => esc_html__( 'Choose which categories you would like to include.', 'divi-shop-builder' ),
				'taxonomy_name'    => 'product_cat',
				'toggle_slug'      => 'wc_ags_archive',
				'computed_affects' => array(
					'__shop',
				),
			),
			'orderby'             => array(
				'label'            => esc_html__( 'Order', 'divi-shop-builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'default'    => esc_html__( 'Default Sorting', 'divi-shop-builder' ),
					'menu_order' => esc_html__( 'Sort by Menu Order', 'divi-shop-builder' ),
					'popularity' => esc_html__( 'Sort By Popularity', 'divi-shop-builder' ),
					'rating'     => esc_html__( 'Sort By Rating', 'divi-shop-builder' ),
					'date'       => esc_html__( 'Sort By Date: Oldest To Newest', 'divi-shop-builder' ),
					'date-desc'  => esc_html__( 'Sort By Date: Newest To Oldest', 'divi-shop-builder' ),
					'price'      => esc_html__( 'Sort By Price: Low To High', 'divi-shop-builder' ),
					'price-desc' => esc_html__( 'Sort By Price: High To Low', 'divi-shop-builder' ),
				),
				'default_on_front' => 'default',
				'description'      => esc_html__( 'Choose how your products should be ordered.', 'divi-shop-builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'wc_ags_archive',
				'show_if_not'      => array(
					'type' => 'latest',
				),
			),
			'excerpt_length'  		=> array(
				'label' 	  		=> esc_html__( 'Product Description Length', 'divi-shop-builder' ),
				'description' 		=> esc_html__('Changes the length of products excerpt.', 'divi-shop-builder'),
				'default'      		=> 55,
				'type' 				=> 'number',
				'responsive' 		=> true,
				'toggle_slug'       => 'wc_ags_archive',
				'mobile_options'  	=> true,
//				'show_if'     		=> array(
//					'layout' => 'list',
//				),
			),
			'sale_badge_color'    => array(
				'label'          => esc_html__( 'Sale Badge Background Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Pick a color to use for the sales bade that appears on products that are on sale.', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'sale_badge',
				'hover'          => 'tabs',
				'mobile_options' => true,
				'sticky'         => true,
			),
			'icon_hover_color'    => array(
				'label'          => esc_html__( 'Overlay Icon Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Pick a color to use for the icon that appears when hovering over a product.', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
				'sticky'         => true,
			),
			'hover_overlay_color' => array(
				'label'          => esc_html__( 'Overlay Background Color', 'divi-shop-builder' ),
				'description'    => esc_html__( 'Here you can define a custom color for the overlay', 'divi-shop-builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
				'sticky'         => true,
			),
			'hover_icon'          => array(
				'label'           => esc_html__( 'Overlay Icon', 'divi-shop-builder' ),
				'description'     => esc_html__( 'Here you can define a custom icon for the overlay', 'divi-shop-builder' ),
				'type'            => 'select_icon',
				'option_category' => 'configuration',
				'class'           => array( 'et-pb-font-icon' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'mobile_options'  => true,
				'sticky'          => true,
			),
			'__shop'              => array(
				'type'                => 'computed',
				'computed_callback'   => array( __CLASS__, 'get_shop_html' ),
				'computed_depends_on' => array(
					'type',
					'include_categories',
					'posts_number',
					'orderby',
					//'__page',
					'use_current_loop',
					'child_order',
					'button_style_icon',
					'excerpt_length'
				),
				'computed_minimum'    => array(
					'posts_number',
					//'__page',
					'use_current_loop',
				),
			),
			/*
			'__page'              => array(
				'type'                => 'computed',
				'computed_callback'   => array( __CLASS__, 'get_shop_html' ),
				'computed_depends_on' => array(
					'type',
					'include_categories',
					'posts_number',
					'orderby',
					'columns_number',
					'show_pagination',
				),
				'computed_affects'    => array(
					'__shop',
				),
			),
			*/

			// woocommerce-carousel-for-divi\includes\modules\WoocommerceCarousel\WoocommerceCarousel.php
			'product_padding' => array(
				'label'           => esc_html__( 'Product Padding', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'responsive'      => true,
				//'default'         => $params['default_padding'],
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_product',
			),

			'product_margin' => array(
				'label'           => esc_html__( 'Product Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'responsive'      => true,
				'default'         => '0px|3.8%|2.992em|0px|false|false', // woocommerce-layout.css
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_product',
			),

			'product_description_padding' => array(
				'label'           => esc_html__( 'Product Description Padding', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'responsive'      => true,
				//'default'         => $params['default_padding'],
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_product_description',
			),

			'product_description_margin' => array(
				'label'           => esc_html__( 'Product Description Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'responsive'      => true,
				//'default'         => $params['default_margin'],
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_product_description',
			),
			'grid_view_icon' => array(
				'label'           => esc_html__( 'Grid View Icon', 'divi-shop-builder' ),
				'type'            => 'select_icon',
				'default'		  => '%%260%%',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'list_view_icon' => array(
				'label'           => esc_html__( 'List View Icon', 'divi-shop-builder' ),
				'type'            => 'select_icon',
				'default'		  => '%%67%%',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_icon_color' => array(
				'label'           => esc_html__( 'Icon Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => 'rgba(0,0,0)',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_hover_icon_color' => array(
				'label'           => esc_html__( 'Hover Icon Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => 'rgba(0,0,0)',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_active_icon_color' => array(
				'label'           => esc_html__( 'Active Icon Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => 'rgba(0,0,0)',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_bg'	=> array(
				'label'           => esc_html__( 'Icons Background Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => 'rgba(0,0,0,0)',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_hover_bg'	=> array(
				'label'           => esc_html__( 'Hover Icon Background Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => '#ededed',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_active_bg'	=> array(
				'label'           => esc_html__( 'Active Icon Background Color', 'divi-shop-builder' ),
				'type'            => 'color-alpha',
				'default'		  => '#ededed',
				'option_category' => 'basic_option',
				'mobile_options'  => false,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_padding'	=> array(
				'label'           => esc_html__( 'Icons Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'default' 		  => '3px|3px|3px|3px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'multiview_margin'	=> array(
				'label'           => esc_html__( 'Icons Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'default' 		  => '0|3px|0|0|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'grid_list_view',
			),
			'rating_text_color_non_active' => array(
				'label' 		  => 'Non-Active Star Rating Color',
				'description'	  => 'Pick a color to be used for the non-active Star Rating text.',
				'type'			  => 'color-alpha',
				'default' 		  => '#ccc',
				'tab_slug' 		  => 'advanced',
				'toggle_slug'	  => 'star',
				'priority'        => 25,
			),
			'new_badge_padding'	=> array(
				'label'           => esc_html__( 'New Badge Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'default' 		  => '6px|18px|6px|18px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_badge',
			),
			'new_badge_margin'	=> array(
				'label'           => esc_html__( 'New Badge Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'wc_ags_badge',
			),
			'sale_badge_padding'	=> array(
				'label'           => esc_html__( 'Sale Badge Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'default' 		  => '6px|18px|6px|18px|false|false',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'sale_badge',
			),
			'sale_badge_margin'	=> array(
				'label'           => esc_html__( 'Sale Badge Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'sale_badge',
			),
			'image_padding'	=> array(
				'label'           => esc_html__( 'Image Padding', 'divi-shop-builder' ),
				'type'            => 'custom_padding',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'image',
			),
			'image_margin'	=> array(
				'label'           => esc_html__( 'Image Margin', 'divi-shop-builder' ),
				'type'            => 'custom_margin',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'image',
			),
		);

		list ( $agsFields, $agsAdvancedFields, $additionalFieldIds ) = self::get_ags_settings_fields();

		$fields[ '__shop' ][ 'computed_depends_on' ] = array_merge( $fields[ '__shop' ][ 'computed_depends_on' ], array_keys( $agsFields ), $additionalFieldIds );

		foreach ( $agsAdvancedFields as $fieldsType => $advancedFields) {
			if ( empty( $this->advanced_fields[$fieldsType] ) ) {
				$this->advanced_fields[$fieldsType] = $advancedFields;
			} else {
				$this->advanced_fields[$fieldsType] = array_merge( $this->advanced_fields[$fieldsType], $advancedFields );
			}
		}

		return array_merge( $fields, $agsFields );
	}

	static function get_ags_settings_fields() {
		global $ags_divi_wc;

		$fields = [];
		$advanced_fields = [];
		$additionalFieldIds = [];
		$toggleTabs = [];

		foreach ( self::get_settings_modal_toggles_array() as $tabSlug => $tab ) {
			foreach ( $tab['toggles'] as $toggle => $title ) {
				$toggleTabs[$toggle] = $tabSlug;
			}
		}

		foreach ( $ags_divi_wc->get_settings('module') as $settingId => $setting ) {

			if ( empty($toggleTabs[$setting['section']]) ) {
				continue;
			}

			if ( !empty($setting['responsive']) ) {
				$additionalFieldIds[] = $settingId.'_tablet';
				$additionalFieldIds[] = $settingId.'_phone';
			}

			$field = [
				'label' => esc_html($setting['label']),
				'tab_slug' => $toggleTabs[$setting['section']],
				'toggle_slug' => $setting['section']
			];

			if (isset($setting['description'])) {
				$field['description'] = esc_html($setting['description']);
			}

			if (isset($setting['default'])) {
				$field['default'] = $setting['default'];
			}

			if (!empty($setting['responsive'])) {
				$field['mobile_options'] = true;
			}

			if (isset($setting['show_if'])) {
				$field['show_if'] = $setting['show_if'];
			}

			if (isset($setting['show_if_not'])) {
				$field['show_if_not'] = $setting['show_if_not'];
			}

			if( isset( $setting['priority'] ) ){
				$field['priority'] = $setting['priority'];
			}

			if( isset( $setting['options_priority'] ) ){
				$field['options_priority'] = $setting['options_priority'];
			}

			switch ( $setting['type'] ) {
				case 'select':
					$field['type'] = 'select';
					$field['options'] = $setting['choices'];
					break;

				case 'select_option':
					$field['type'] = 'select';
					$field['options'] = $setting['choices'];
					break;

				case 'checkbox':
					$field['type'] = 'yes_no_button';
					$field['options'] = [
						'on'  => esc_html__( 'Yes', 'divi-shop-builder' ),
						'off' => esc_html__( 'No', 'divi-shop-builder' ),
					];
					$field['default'] = empty($field['default']) ? 'off' : 'on';
					break;

				case 'alpha_color':
					$field['type'] = 'color-alpha';
					break;

				case 'text':
					$field['type'] = 'text';
					break;

				case 'range':
					$field['type'] = 'range';
					$field['range_settings'] = $setting['input_attrs'];
					if (isset($setting['unitless'])) {
						$field['unitless'] = $setting['unitless'];
					}
					break;

				case 'font_style':
					$field['type'] = 'fontstyle';
					$field['choices'] = $setting['choices'];
					break;

				case 'background_options':
					$field['type'] = 'color-alpha';
					$field['css'] = self::processCssSelectorArray($setting['css'], $setting['type']);
					$field['label'] = sprintf( esc_html__('%s Background', 'divi-shop-builder'), $field['label'] );
					break;

				case 'text_options':
					if ( !isset($advanced_fields['fonts']) ) {
						$advanced_fields['fonts'] = [];
					}
					$field['css'] = self::processCssSelectorArray($setting['css'], $setting['type']);

					if ( isset($setting['show_if']) ) {
						$showIf = [ 'show_if' => $setting['show_if'] ];
						$field['font'] = $showIf;
						$field['text_align'] = $showIf;
						$field['text_color'] = $showIf;
						$field['font_size'] = $showIf;
						$field['letter_spacing'] = $showIf;
						$field['line_height'] = $showIf;
						$field['text_shadow'] = $showIf;
					}

					$advanced_fields['fonts'][$settingId] = $field;


					continue 2;

				case 'border_options':
					if ( !isset($advanced_fields['borders']) ) {
						$advanced_fields['borders'] = [];
					}
					$field['css'] = self::processCssSelectorArray($setting['css'], $setting['type']);



					if ( isset($setting['show_if']) ) {
						/*
						$showIf = [ 'show_if' => $setting['show_if'] ];
						$field['border_radii'] = $showIf;
						$field['border_styles'] = $showIf;
						*/

						$field['depends_on'] = [ key($setting['show_if']) ];
						$field['depends_show_if'] = current($setting['show_if']);
					}

					if( isset( $setting['label'] ) ){
						$field['label_prefix'] = $setting['label'];
					}

					if( isset( $setting['default'] ) ){
						$field['defaults'] = $setting['default'];
						unset( $field['default'] );
					}

					$advanced_fields['borders'][$settingId] = $field;

					continue 2;

				case 'button_options':
					if ( !isset($advanced_fields['button']) ) {
						$advanced_fields['button'] = [];
					}

					if (isset($setting['use_alignment'])) {
						$field['use_alignment'] = $setting['use_alignment'];
					}

					$field['css'] = self::processCssSelectorArray($setting['css'], $setting['type']);

					if( isset( $setting['box_shadow'] ) ){
						$field['box_shadow']['css'] = self::processCssSelectorArray($setting['box_shadow']['css'], $setting['type']);
					}

					if( isset( $setting['margin_padding'] ) ){
						$field['margin_padding']['css'] = self::processCssSelectorArray($setting['margin_padding']['css'], $setting['type']);
					}

					if ( isset($setting['show_if']) ) {
						/*
						$showIf = [ 'show_if' => $setting['show_if'] ];
						$field['border_radii'] = $showIf;
						$field['border_styles'] = $showIf;
						*/

						$field['depends_on'] = [ key($setting['show_if']) ];
						$field['depends_show_if'] = current($setting['show_if']);
					}

					$advanced_fields['button'][$settingId] = $field;

					continue 2;

				case 'form_field_options':
					if ( !isset($advanced_fields['form_field']) ) {
						$advanced_fields['form_field'] = [];
					}
					$field['css'] = self::processCssSelectorArray($setting['css'], $setting['type']);

					$isAllImportant = isset($field['css']['important']) && $field['css']['important'] === 'all';

					$field['font_field'] = array(
						'css' => $field['css']
					);

					$borders = array(
						'css' => array('main' => array(
							'border_radii' => $field['css']['main'],
							'border_styles' => $field['css']['main']
						))
					);

					if ($isAllImportant) {
						$borders['css']['important'] = 'all';
					}

					$bordersFocus = $borders;
					$bordersFocus['css']['main']['border_radii'] .= ':focus';
					$bordersFocus['css']['main']['border_styles'] .= ':focus';



					$field['border_styles'] = array(
						$settingId => $borders,
						$settingId.'_focus' => $bordersFocus,
					);

					$field['box_shadow'] = array(
						'css' => $field['css']
					);

					if ($isAllImportant) {
						$field['css']['important'] = array(
							'background_color',
							'focus_background_color',
							'form_text_color',
							'form_focus_text_color'
						);
					}

					if ( isset($setting['show_if']) ) {
						/*
						$showIf = [ 'show_if' => $setting['show_if'] ];
						$field['border_radii'] = $showIf;
						$field['border_styles'] = $showIf;
						*/

						$field['depends_on'] = [ key($setting['show_if']) ];
						$field['depends_show_if'] = current($setting['show_if']);
					}

					$advanced_fields['form_field'][$settingId] = $field;

					continue 2;
			}

			$field['computed_affects'] = [ '__shop' ];

			$fields[ $settingId ] = $field;

		}

		return [$fields, $advanced_fields, $additionalFieldIds];
	}

	static function processCssSelectorArray($selectors, $settingType) {
		$selectorKeys = ['main', 'hover'];

		foreach ($selectors as $selectorKey => &$selector) {

			if ( in_array($selectorKey, $selectorKeys) ) {
				if (is_array($selector)) {
					foreach ($selector as &$subSelector) {
						$subSelector = self::MAIN_CSS_ELEMENT.' '.$subSelector;
					}
				} else {
					$selector = self::MAIN_CSS_ELEMENT.' '.$selector;

					switch ($settingType) {
						case 'border_options':
							$selector = [
								'border_radii' => $selector,
								'border_styles' => $selector
							];
							break;
					}

				}
			}

		}

		return $selectors;
	}

	/**
	 * @inheritdoc
	 *
	 * @since 4.0.6 Handle star rating letter spacing.
	 */
	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['sale_badge_color']      = array( 'background-color' => '%%order_class%% .ags-divi-wc-sale-badge span.onsale, %%order_class%% .woocommerce ul.products li.product .ags-divi-wc-sale-badge span.onsale' );
		$fields['rating_letter_spacing'] = array(
			'width'          => '%%order_class%% .star-rating',
			'letter-spacing' => '%%order_class%% .star-rating',
		);

		$is_hover_enabled = et_builder_is_hover_enabled( 'rating_letter_spacing', $this->props )
			|| et_builder_is_hover_enabled( 'rating_font_size', $this->props );

		if ( $is_hover_enabled && isset( $fields['rating_text_color'] ) ) {
			unset( $fields['rating_text_color'] );
		}

		return $fields;
	}

	function add_product_class_name( $classes ) {
		$classes[] = 'product';

		return $classes;
	}

	function get_shop( $args = array(), $conditional_tags = array(), $current_page = array() ) {



		foreach ( $args as $arg => $value ) {
			$this->props[ $arg ] = $value;
		}

		$props 			   = wp_parse_args( array( 'layout' => $this->props['layout'] === 'both' ? 'grid' : $this->props['layout']  ), $this->props );
		$agsImplementation = new AGS_Divi_WC_Implementation('module', $props, $this);
		$agsImplementation->implement();

		$post_id            = isset( $current_page['id'] ) ? (int) $current_page['id'] : 0;
		$type               = $this->props['type'];
		$layout             = empty($this->props['layout']) ? 'grid' : $this->props['layout'];
		$posts_number       = $this->props['posts_number'];
		$orderby            = 'default' === $type ? '' : $this->props['orderby'];
		$order              = 'default' === $type ? '' : 'ASC';
		$product_categories = array();
		$product_tags       = array();
		$use_current_loop   = 'on' === $this->prop( 'use_current_loop', 'off' );
		$use_current_loop   = $use_current_loop && ( is_post_type_archive( 'product' ) || is_search() || et_is_product_taxonomy() );
		$product_attribute  = '';
		$product_terms      = array();

		if ( $use_current_loop ) {
			$this->props['include_categories'] = 'all';

			if ( is_product_category() ) {
				$this->props['include_categories'] = (string) get_queried_object_id();
			} elseif ( is_product_tag() ) {
				$product_tags = array( get_queried_object()->slug );
			} elseif ( is_product_taxonomy() ) {
				$term = get_queried_object();

				// Product attribute taxonomy slugs start with pa_
				if ( et_()->starts_with( $term->taxonomy, 'pa_' ) ) {
					$product_attribute = $term->taxonomy;
					$product_terms[]   = $term->slug;
				}
			}
		}

		if ( 'product_category' === $type || ( $use_current_loop && ! empty( $this->props['include_categories'] ) ) ) {
			$all_shop_categories     = et_builder_get_shop_categories();
			$all_shop_categories_map = array();
			$raw_product_categories  = self::filter_include_categories( $this->props['include_categories'], $post_id, 'product_cat' );

			foreach ( $all_shop_categories as $term ) {
				if ( is_object( $term ) && is_a( $term, 'WP_Term' ) ) {
					$all_shop_categories_map[ $term->term_id ] = $term->slug;
				}
			}

			$product_categories = array_values( $all_shop_categories_map );

			if ( ! empty( $raw_product_categories ) ) {
				$product_categories = array_intersect_key(
					$all_shop_categories_map,
					array_flip( $raw_product_categories )
				);
			}
		}

		// Recent was the default option in Divi once, so it is added here for the websites created before the change
		if ( 'default' === $orderby && ( 'default' === $type || 'recent' === $type ) ) {
			// Leave the attribute empty to allow WooCommerce to take over and use the default sorting.
			$orderby = '';
		}

		if ( 'latest' === $type ) {
			$orderby = 'date-desc';
		}

		if ( in_array( $orderby, array( 'price-desc', 'date-desc' ) ) ) {
			// Supported orderby arguments (as defined by WC_Query->get_catalog_ordering_args() ):
			// rand | date | price | popularity | rating | title
			$orderby = str_replace( '-desc', '', $orderby );
			// Switch to descending order if orderby is 'price-desc' or 'date-desc'
			$order = 'DESC';
		}

		$ids             = array();
		$wc_custom_view  = '';
		$wc_custom_views = array(
			'sale'         => array( 'on_sale', 'true' ),
			'best_selling' => array( 'best_selling', 'true' ),
			'top_rated'    => array( 'top_rated', 'true' ),
			'featured'     => array( 'visibility', 'featured' ),
		);

		if ( et_()->includes( array_keys( $wc_custom_views ), $type ) ) {
			$custom_view_data = $wc_custom_views[ $type ];
			$wc_custom_view   = sprintf( '%1$s="%2$s"', esc_attr( $custom_view_data[0] ), esc_attr( $custom_view_data[1] ) );
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- reason wp_nonce is not required here as data from get requests go through something like "whitelisting" via `in_array` function.
		$request_orderby_value = et_()->array_get_sanitized( $_GET, 'orderby', '' );
		$shop_fields           = $this->get_fields();
		// Checking if there is an orderby parameter in the GET-request and is its value is defined in the options via $this->get_fields() and contains `price` value.
		$maybe_fields_has_orderby_options           = ! empty( $shop_fields ) && isset( $shop_fields['orderby']['options'] );
		$maybe_request_price_value_in_order_options = ! empty( $request_orderby_value ) && $maybe_fields_has_orderby_options && in_array( $request_orderby_value, array_keys( $shop_fields['orderby']['options'] ), true ) && false !== strpos( strtolower( $request_orderby_value ), 'price' );
		if ( $maybe_request_price_value_in_order_options ) {
			$orderby = 'price';
			$order   = false !== strpos( strtolower( $request_orderby_value ), 'desc' ) ? 'DESC' : 'ASC';
		}

		$classes = apply_filters('ags_divi_wc_module_shop_classes', []);

		$shortcode = sprintf(
			'[products %1$s limit="%2$s" orderby="%3$s" paginate="true" %4$s order="%5$s" %6$s %7$s %8$s %9$s %10$s %11$s]',
			et_core_intentionally_unescaped( $wc_custom_view, 'fixed_string' ),
			esc_attr( $posts_number ),
			esc_attr( $orderby ),
			$product_categories ? sprintf( 'category="%s"', esc_attr( implode( ',', $product_categories ) ) ) : '',
			esc_attr( $order ),
			$ids ? sprintf( 'ids="%s"', esc_attr( implode( ',', $ids ) ) ) : '',
			$product_tags ? sprintf( 'tag="%s"', esc_attr( implode( ',', $product_tags ) ) ) : '',
			$product_attribute ? sprintf( 'attribute="%s"', esc_attr( $product_attribute ) ) : '',
			$product_terms ? sprintf( 'terms="%s"', esc_attr( implode( ',', $product_terms ) ) ) : '',
			$classes ? sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) ) : '',
			$layout == 'list' ? ' columns="1"' : ''
		);

		$this->setup_pagination();

		do_action( 'et_pb_shop_before_print_shop' );

		global $wp_the_query;

		$query_backup = $wp_the_query;

		if ( $use_current_loop ) {
			add_filter( 'woocommerce_shortcode_products_query', array( $this, 'filter_products_query' ) );
			add_action( 'pre_get_posts', array( $this, 'apply_woo_widget_filters' ), 0 );
		}

		$shop = do_shortcode( $shortcode );

		if( $layout === 'both' ){

			$agsImplementation->deimplement();

			$agsImplementationNew = new AGS_Divi_WC_Implementation('module', wp_parse_args( [ 'layout' => 'list' ], $this->props ), $this);
			$agsImplementationNew->implement();

			$list_classes = apply_filters('ags_divi_wc_module_shop_classes', []);

			$listShortcode = sprintf(
				'[products %1$s limit="%2$s" orderby="%3$s" paginate="true" %4$s order="%5$s" %6$s %7$s %8$s %9$s %10$s %11$s]',
				et_core_intentionally_unescaped( $wc_custom_view, 'fixed_string' ),
				esc_attr( $posts_number ),
				esc_attr( $orderby ),
				$product_categories ? sprintf( 'category="%s"', esc_attr( implode( ',', $product_categories ) ) ) : '',
				esc_attr( $order ),
				$ids ? sprintf( 'ids="%s"', esc_attr( implode( ',', $ids ) ) ) : '',
				$product_tags ? sprintf( 'tag="%s"', esc_attr( implode( ',', $product_tags ) ) ) : '',
				$product_attribute ? sprintf( 'attribute="%s"', esc_attr( $product_attribute ) ) : '',
				$product_terms ? sprintf( 'terms="%s"', esc_attr( implode( ',', $product_terms ) ) ) : '',
				$list_classes ? sprintf( 'class="%s"', esc_attr( implode( ' ', $list_classes ) ) ) : '',
				' columns="1"'
			);

			$shop .= do_shortcode( $listShortcode );

			$shop = $this->get_multiview_actions() . $this->get_processed_shop($shop);

			$agsImplementationNew->deimplement();

			$agsImplementation->implement();
		}

		if ( $use_current_loop ) {
			remove_action( 'pre_get_posts', array( $this, 'apply_woo_widget_filters' ), 0 );
			remove_filter( 'woocommerce_shortcode_products_query', array( $this, 'filter_products_query' ) );
		}
		
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- intentional restoration of previous query state
		$wp_the_query = $query_backup;

		do_action( 'et_pb_shop_after_print_shop' );

		$this->unset_pagination();

		$is_shop_empty = preg_match( '/<div class="woocommerce columns-([0-9 ]+)"><\/div>+/', $shop );

		if ( $is_shop_empty || et_()->starts_with( $shop, $shortcode ) ) {
			$shop = self::get_no_results_template();
		}

		$agsImplementation->deimplement();

		return $shop;
	}

	/**
	 * Get shop HTML for shop module
	 *
	 * @param array   arguments that affect shop output
	 * @param array   passed conditional tag for update process
	 * @param array   passed current page params
	 * @return string HTML markup for shop module
	 */
	static function get_shop_html( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		$shop = new self();

		do_action( 'et_pb_get_shop_html_before' );

		$shop->props = $args;

		// Force product loop to have 'product' class name. It appears that 'product' class disappears
		// when $this->get_shop() is being called for update / from admin-ajax.php
		add_filter( 'post_class', array( $shop, 'add_product_class_name' ) );

		// Get product HTML
		$output = $shop->get_shop( array(), array(), $current_page );

		// Remove 'product' class addition to product loop's post class
		remove_filter( 'post_class', array( $shop, 'add_product_class_name' ) );

		do_action( 'et_pb_get_shop_html_after' );

		return $output;
	}


	// WooCommerce changed the title tag from h3 to h2 in 3.0.0
	function get_title_selector() {
		$title_selector = 'li.product h3';

		if ( class_exists( 'WooCommerce' ) ) {
			global $woocommerce;

			if ( version_compare( $woocommerce->version, '3.0.0', '>=' ) ) {
				$title_selector = 'li.product h2';
			}
		}

		return $title_selector;
	}

	function render( $attrs, $content, $render_slug ) {

		$sticky             = et_pb_sticky_options();
		$type               = $this->props['type'];
		$include_categories = $this->props['include_categories'];
		$posts_number       = $this->props['posts_number'];
		$orderby            = $this->props['orderby'];
		//$columns            = $this->props['columns_number'];

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$hover_icon        = $this->props['hover_icon'];
		$hover_icon_values = et_pb_responsive_options()->get_property_values( $this->props, 'hover_icon' );
		$hover_icon_tablet = isset( $hover_icon_values['tablet'] ) ? $hover_icon_values['tablet'] : '';
		$hover_icon_phone  = isset( $hover_icon_values['phone'] ) ? $hover_icon_values['phone'] : '';
		$hover_icon_sticky = $sticky->get_value( 'hover_icon', $this->props );

		$this->localized_scripts();

		// Sale Badge Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'sale_badge_color',
				'selector'       => '%%order_class%% .ags-divi-wc-sale-badge span.onsale, %%order_class%% .woocommerce ul.products li.product .ags-divi-wc-sale-badge span.onsale',
				'css_property'   => 'background-color',
				'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// New Badge Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'new_badge_background',
				'selector'       => 'div%%order_class%%.ags_woo_shop_plus .wc-new-badge',
				'css_property'   => 'background-color',
				'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// Page Number Background Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'pagination_background',
				'selector'       => '%%order_class%% .woocommerce-pagination .page-numbers',
				'css_property'   => 'background-color',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// Current Page Number Background Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'pagination_background_current',
				'selector'       => '%%order_class%% .woocommerce-pagination .page-numbers.current',
				'css_property'   => 'background-color',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// Current Page Number Text Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'pagination_active_text_color',
				'selector'       => '%%order_class%% .woocommerce-pagination .page-numbers li span.current',
				'css_property'   => 'color',
				'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// Product Background Color.
		$this->generate_styles(
			array(
				'base_attr_name' => 'product_background',
				'selector'       => '%%order_class%% li.product',
				'css_property'   => 'background-color',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		if ($this->props['product_padding']) {
			$value = explode( '|', $this->props['product_padding'] );
			$this->props['product_padding'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}

		// Product Padding.
		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'product_padding',
				'selector'       => '%%order_class%% ul.products li.product',
				'css_property'   => 'padding',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		if ($this->props['product_margin']) {
			$value = explode( '|', $this->props['product_margin'] );
			$this->props['product_margin'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}


		// Product Margin.
		$this->generate_styles(
			array(
				'base_attr_name' => 'product_margin',
				'selector'       => '%%order_class%% ul.products li.product',
				'css_property'   => 'margin',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		// Product Last Child Margin
		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% ul.products li.product.last',
			'declaration' => "margin-right: 0;"
		));


		// Product Description Padding.

		if ($this->props['product_description_padding']) {
			$value = explode( '|', $this->props['product_description_padding'] );
			$this->props['product_description_padding'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}

		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'product_description_padding',
				'selector'       => '%%order_class%% ul.products li.product .ags-divi-wc-product-excerpt',
				'css_property'   => 'padding',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		if ($this->props['product_description_margin']) {
			$value = explode( '|', $this->props['product_description_margin'] );
			$this->props['product_description_margin'] = ( $value[0] ? $value[0] : 0).' '.( $value[1] ? $value[1] : 0).' '.( $value[2] ? $value[2] : 0).' '.( $value[3] ? $value[3] : 0);
		}


		// Product Margin.
		$this->generate_styles(
			array(
				'base_attr_name' => 'product_description_margin',
				'selector'       => '%%order_class%% ul.products li.product .ags-divi-wc-product-excerpt',
				'css_property'   => 'margin',
				//'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'custom_margin',
			)
		);

		// Icon Hover Color.
		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'icon_hover_color',
				'selector'       => '%%order_class%% .et_overlay:before',
				'css_property'   => 'color',
				'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// Hover Overlay Color.
		$this->generate_styles(
			array(
				'hover'          => false,
				'base_attr_name' => 'hover_overlay_color',
				'selector'       => '%%order_class%% .et_overlay',
				'css_property'   => array( 'background-color', 'border-color' ),
				'important'      => true,
				'render_slug'    => $render_slug,
				'type'           => 'color',
			)
		);

		// For some reason hover padding is added to add to cart button
		$button_padding 	  = explode( '|', $this->props['button_style_custom_padding'], -2 );
		$button_padding_hover = isset( $this->props['button_style_custom_padding__hover'] ) ? explode( '|', $this->props['button_style_custom_padding__hover'], -2 ) : [];
		$corners = [ 'top' => 0, 'right' => 1, 'bottom' => 2, 'left' => 3 ];
		if( count( array_filter( $button_padding ) ) > 0 ){
			foreach( $corners as $corner => $key ){

				$value = !empty( $button_padding_hover[$key] ) ? $button_padding_hover[$key] : $button_padding[$key];

				if( !empty( $value ) ){

					self::set_style( $this->slug, array(
						'selector' 	  => '%%order_class%%.ags_woo_shop_plus .product .button:hover',
						'declaration' => "padding-{$corner}: {$value} !important;"
					));
				}

			}
		}

		$multiview_margin  = explode( '|', $this->props['multiview_margin'], -2 );
		$multiview_padding = explode( '|', $this->props['multiview_padding'], -2 );
		foreach( $corners as $corner => $key ){
			if( !empty( $multiview_padding[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview button',
					'declaration' => "padding-{$corner}: {$multiview_padding[$key]} !important;"
				));
			}

			if( !empty( $multiview_margin[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview button',
					'declaration' => "margin-{$corner}: {$multiview_margin[$key]} !important;"
				));
			}
		}

		$image_margin  = explode( '|', $this->props['image_margin'], -2 );
		$image_padding = explode( '|', $this->props['image_padding'], -2 );
		foreach( $corners as $corner => $key ){
			if( !empty( $image_padding[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.et_pb_module .woocommerce li.product span.et_shop_image',
					'declaration' => "padding-{$corner}: {$image_padding[$key]} !important;"
				));
			}

			if( !empty( $image_margin[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.et_pb_module .woocommerce li.product span.et_shop_image',
					'declaration' => "margin-{$corner}: {$image_margin[$key]} !important;"
				));
			}
		}

		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview button',
			'declaration' => "color: {$this->props['multiview_icon_color']} !important; background-color: {$this->props['multiview_bg']} !important;"
		));

		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview button.active',
			'declaration' => "color: {$this->props['multiview_active_icon_color']} !important; background-color: {$this->props['multiview_active_bg']} !important;"
		));

		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview button:hover, %%order_class%% .ags_woo_shop_plus_multiview button.active:hover',
			'declaration' => "color: {$this->props['multiview_hover_icon_color']} !important; background-color: {$this->props['multiview_hover_bg']} !important;"
		));


		$grid_icon = '\\' . str_replace( ';', '', str_replace( '&#x', '', html_entity_decode( et_pb_process_font_icon( $this->props['grid_view_icon'] ) ) ) );
		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview .grid-view::before',
			'declaration' => "content: '{$grid_icon}' !important;"
		));

		$list_icon = '\\' . str_replace( ';', '', str_replace( '&#x', '', html_entity_decode( et_pb_process_font_icon( $this->props['list_view_icon'] ) ) ) );
		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .ags_woo_shop_plus_multiview .list-view::before',
			'declaration' => "content: '{$list_icon}' !important;"
		));

		self::set_style( $this->slug, array(
			'selector' 	  => '%%order_class%% .star-rating::before',
			'declaration' => "color: {$this->props['rating_text_color_non_active']} !important;"
		));

		// Images: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname(
				$this->generate_css_filters(
					$render_slug,
					'child_',
					self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
				)
			);
		}


		$new_badge_margin  = explode( '|', $this->props['new_badge_margin'], -2 );
		$new_badge_padding = explode( '|', $this->props['new_badge_padding'], -2 );
		foreach( $corners as $corner => $key ){
			if( !empty( $new_badge_padding[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.ags_woo_shop_plus .wc-new-badge',
					'declaration' => "padding-{$corner}: {$new_badge_padding[$key]} !important;"
				));
			}

			if( !empty( $new_badge_margin[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.ags_woo_shop_plus .wc-new-badge',
					'declaration' => "margin-{$corner}: {$new_badge_margin[$key]} !important;"
				));
			}
		}

		$sale_badge_margin  = explode( '|', $this->props['sale_badge_margin'], -2 );
		$sale_badge_padding = explode( '|', $this->props['sale_badge_padding'], -2 );
		foreach( $corners as $corner => $key ){
			if( !empty( $sale_badge_padding[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.ags_woo_shop_plus .woocommerce ul.products li.product .onsale',
					'declaration' => "padding-{$corner}: {$sale_badge_padding[$key]} !important;"
				));
			}

			if( !empty( $sale_badge_margin[$key] ) ){
				self::set_style( $this->slug, array(
					'selector' 	  => '%%order_class%%.ags_woo_shop_plus .woocommerce ul.products li.product .onsale',
					'declaration' => "margin-{$corner}: {$sale_badge_margin[$key]} !important;"
				));
			}
		}

		$overlay_attributes = ET_Builder_Module_Helper_Overlay::render_attributes(
			array(
				'icon'        => $hover_icon,
				'icon_tablet' => $hover_icon_tablet,
				'icon_phone'  => $hover_icon_phone,
				'icon_sticky' => $hover_icon_sticky,
			)
		);

		if ( class_exists( 'ET_Builder_Module_Helper_Woocommerce_Modules' ) ) {
			ET_Builder_Module_Helper_Woocommerce_Modules::add_star_rating_style(
				$render_slug,
				$this->props,
				'%%order_class%% ul.products li.product .star-rating',
				'%%order_class%% ul.products li.product:hover .star-rating'
			);
		}

		if( !empty( $this->props['button_view_cart_icon'] ) ){
			$psuedo = $this->props['button_view_cart_icon_placement'] === 'left' ? "::before" : "::after";

			self::set_style( $this->slug, array(
				'selector' 	  => "%%order_class%% ul.products li.product .added_to_cart{$psuedo}",
				'declaration' => 'content: attr(data-icon) !important; font-family: "ETmodules" !important;'
			));


			if( $psuedo === '::before' ){
				self::set_style( $this->slug, array(
					'selector' 	  => "%%order_class%% ul.products li.product .added_to_cart:hover{$psuedo}",
					'declaration' => 'margin-left: 0 !important; margin-right: 0.3em !important;'
				));
			}
		}

		// Module classnames
		$this->add_classname(
			array(
				$this->get_text_orientation_classname(),
			)
		);

		/*
		if ( '0' === $columns ) {
			$this->add_classname( 'et_pb_shop_grid' );
		}
		*/

		$shop_order = self::_get_index( array( self::INDEX_MODULE_ORDER, $render_slug ) );

		$output = sprintf(
			'<div%2$s class="%3$s" %6$s data-shortcode_index="%7$s">
				%5$s
				%4$s
				%1$s
			</div>',
			$this->get_shop( array(), array(), array( 'id' => $this->get_the_ID() ) ),
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background,
			et_core_esc_previously( $overlay_attributes ),
			esc_attr( $shop_order )
		);

		return $output;
	}

	/**
	 * Filter the products query arguments.
	 *
	 * @since 4.0.5
	 *
	 * @param array $query_args
	 *
	 * @return array
	 */
	public function filter_products_query( $query_args ) {
		if ( is_search() ) {
			$query_args['s'] = get_search_query();
		}

		if ( function_exists( 'WC' ) ) {
			$query_args['meta_query'] = WC()->query->get_meta_query( et_()->array_get( $query_args, 'meta_query', array() ), true );
			$query_args['tax_query']  = WC()->query->get_tax_query( et_()->array_get( $query_args, 'tax_query', array() ), true );

			// Add fake cache-busting arguments as the filtering is actually done in self::apply_woo_widget_filters().
			// phpcs:ignore WordPress.Security.NonceVerification -- read-only query
			$query_args['et_builder_filter_min_price'] = sanitize_text_field( et_()->array_get( $_GET, 'min_price', '' ) );
			// phpcs:ignore WordPress.Security.NonceVerification -- read-only query
			$query_args['et_builder_filter_max_price'] = sanitize_text_field( et_()->array_get( $_GET, 'max_price', '' ) );
		}

		return $query_args;
	}

	/**
	 * Filter the products shortcode query so Woo widget filters apply.
	 *
	 * @since 4.0.8
	 *
	 * @param WP_Query $query
	 */
	public function apply_woo_widget_filters( $query ) {
		global $wp_the_query;

		// Trick Woo filters into thinking the products shortcode query is the
		// main page query as some widget filters have is_main_query checks.
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$wp_the_query = $query;

		// Set a flag to track that the main query is falsified.
		$wp_the_query->et_pb_shop_query = true;

		if ( function_exists( 'WC' ) ) {
			add_filter( 'posts_clauses', array( WC()->query, 'price_filter_post_clauses' ), 10, 2 );
		}
	}

	// Divi\includes\builder\class-et-builder-element.php
	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}


	/**
	 * Setup pagination overrides
	 *
	 */
	private function setup_pagination(){
		add_filter( 'woocommerce_pagination_args', array( $this, 'set_products_pagination_args' ), 99, 1 );
		add_filter( 'woocommerce_shortcode_products_query', array( $this, 'set_products_query' ), 99, 3 );
	}


	/**
	 * Remove pagination overrides
	 *
	 */
	private function unset_pagination(){
		remove_filter( 'woocommerce_pagination_args', array( $this, 'set_products_pagination_args' ), 99 );
		remove_filter( 'woocommerce_shortcode_products_query', array( $this, 'set_products_query' ), 99 );
	}


	/**
	 * Filter the pagination args based on instance
	 *
	 * @return Array
	 */
	public function set_products_pagination_args( $args ){

		global $wp_query;

		$query_array 		 = array();
		$index 				 = $this->render_count();
		
		// phpcs:disable WordPress.Security.NonceVerification -- read-only use of paging request info
		if( isset( $_GET['dsb-product-page'] ) ){
			
			// phpcs:ignore ET.Sniffs.ValidatedSanitizedInput.InputNotSanitized -- this loop sanitizes the input via (int) casts before it is used
			foreach ( $_GET['dsb-product-page'] as $moduleIndex => $pagination ) {
				$query_array[(int) $moduleIndex] = [ 'page' => isset($pagination['page']) ? (int) $pagination['page'] : 1 ];
				if ($moduleIndex == $index) {
					$args['current'] =  max( 1, (int) $pagination['page'] );
				}
			}
		}
		// phpcs:enable WordPress.Security.NonceVerification

		$query_array[$index] = array( 'page' => '%#%' );

		$args['base'] = esc_url_raw(
			add_query_arg(
				'dsb-product-page',
				$query_array,
				false
			)
		);

		return $args;
	}


	/**
	 * Filter the product query based on instance
	 *
	 * @return Array
	 */
	public function set_products_query( $query, $attributes, $type ){

		$index =  $this->render_count();
		
		// phpcs:disable WordPress.Security.NonceVerification -- read-only use of paging request info
		if( isset( $_GET['dsb-product-page'][$index]['page'] ) ){
			$query['paged'] =  max( 1, (int) $_GET['dsb-product-page'][$index]['page'] );
		}
		// phpcs:enable WordPress.Security.NonceVerification

		return $query;
	}


	private function localized_scripts(){
		add_action( 'wp_footer', array( $this, 'footer_scripts' ) );
	}

	public function footer_scripts(){

		$index = $this->render_count() > 0 ? $this->render_count() - 1 : 0 ;

		$data  = array(
			'view_cart_icon' => et_pb_process_font_icon( $this->props['button_view_cart_icon'] )
		);
		?>
		<script type="text/javascript">
		if( !window.ags_woo_shop_plus ){
			window.ags_woo_shop_plus = {};
		}
		window.ags_woo_shop_plus[<?php echo (int) $index; ?>] = <?php echo json_encode( $data ); ?>
		</script>
		<?php
	}


	private function get_multiview_actions(){
		$default_view = $this->get_default_multi_view();
		$views 		  = array( 'grid', 'list' );

		$actions = '<div class="ags_woo_shop_plus_multiview">';
		foreach( $views as $view ){
			$actions .= sprintf( '<button class="%s-view %s"></button>', $view, $view === $default_view ? 'active' : '' );
		}
		$actions .= '</div>';

		return $actions;
	}

	private function get_processed_shop( $shop ){
		$dom 		  = new HtmlDocument();
		$content_html = $dom->load( $shop );
		$default_view = $this->get_default_multi_view();

		foreach( $content_html->find('.ags-divi-wc-layout-grid, .ags-divi-wc-layout-list') as $view ){ //[class^='ags-divi-wc-layout-'] doesnt work here
			if( strpos( $view->getAttribute('class'), 'ags-divi-wc-layout-'.$default_view ) === false ){
				$view->setAttribute( 'style', 'display:none;' );
			}
		}

		return $content_html->outertext;
	}

	private function get_default_multi_view(){
		$post_id 	 = apply_filters( 'et_is_ab_testing_active_post_id', get_the_ID() ); // Divi page id
		$cookie_name = 'ags_woo_shop_plus_'.$post_id.'_'.( $this->render_count() );
		// phpcs:ignore ET.Sniffs.ValidatedSanitizedInput.InputNotSanitized -- sanitization occurs via in_array() check below
		$cookie 	 = !empty( $_COOKIE[$cookie_name] ) ? $_COOKIE[$cookie_name] : '';

		return in_array( $cookie, array( 'grid', 'list' ) ) ?
				$cookie :
				( !empty( $this->props['deafault_view'] ) ? $this->props['deafault_view'] : 'grid' );
	}

}

new AGS_Divi_WC_ModuleShopGrid();
