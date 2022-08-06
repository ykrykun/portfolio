<?php
class  AGS_Divi_WC_ModuleShop_Child extends ET_Builder_Module {

	static $TYPES;

	public $slug       = 'ags_woo_shop_plus_child';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divi.space/',
		'author'     => 'Divi Space',
		'author_uri' => 'https://divi.space/',
	);

	public function init() {
		$this->name            = esc_html__( 'Woo Shop + Component', 'divi-shop-builder' );
		$this->type            = 'child';
		$this->child_title_var = 'item_title';

		// woocommerce-carousel-for-divi\includes\modules\WoocommerceCarousel-child\WoocommerceCarousel-child.php
		$this->advanced_fields = false;

		$this->custom_css_tab = false;

		/*
		$this->advanced_fields = array(
			'link_options' => false,
			'background' => false,
			'text' => false,
			'fonts' => false,
			'max_width' => false,
			'height' => false,
			'margin_padding' => false,
			'borders' => false,
			'box_shadow' => false,
			'filters' => false,
			'transform' => false,
			'overflow' => false,
		);
		*/



		self::$TYPES = array(
			'sale-badge'   => esc_html__( 'Sale Badge', 'divi-shop-builder' ),
			'new-badge'   => esc_html__( 'New Badge', 'divi-shop-builder' ),
			'image' => esc_html__( 'Featured Image', 'divi-shop-builder' ),
			'title'          => esc_html__( 'Title', 'divi-shop-builder' ),
			'ratings'        => esc_html__( 'Ratings', 'divi-shop-builder' ),
			'price'          => esc_html__( 'Price', 'divi-shop-builder' ),
			'quantity'           => esc_html__( 'Add to cart quantity', 'divi-shop-builder' ),
			'button'           => esc_html__( 'Add to cart', 'divi-shop-builder' ),
			'categories'           => esc_html__( 'Categories', 'divi-shop-builder' ),
			'stock'           => esc_html__( 'Stock', 'divi-shop-builder' ),
			'excerpt'           => esc_html__( 'Description', 'divi-shop-builder' ),
		);
	}

	function get_fields() {
		$fields = array(

			'item' => array(
				'label'       => esc_html__( 'Choose Item', 'divi-shop-builder' ),
				'type'        => 'select',

				// woocommerce-carousel-for-divi\includes\modules\WoocommerceCarousel-child\WoocommerceCarousel-child.php
				'default'     => 'none',
				'options'     =>  array_merge( array('none' => '-'), self::$TYPES ),

				'description' => esc_html__( 'Choose item to display.', 'divi-shop-builder' ),
			),

			'item_title' => array(
				'label'        => '',
				'type'         => 'ags_divi_wc_value_mapper',
				'sourceField'  => 'item',
				'valueMap'     => self::$TYPES,
			),
		);

		return $fields;
	}

	public function render( $attrs, $content, $render_slug ) {
		return '';
	}

	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
}

new AGS_Divi_WC_ModuleShop_Child();
