<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://plugins.db-dzine.com
 * @since      1.0.0
 *
 * @package    WooCommerce_Quick_View
 * @subpackage WooCommerce_Quick_View/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooCommerce_Quick_View
 * @subpackage WooCommerce_Quick_View/public
 * @author     Daniel Barenkamp <support@db-dzine.com>
 */
class WooCommerce_Quick_View_Public extends WooCommerce_Quick_View {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Enqueue Styles
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://plugins.db-dzine.com
	 * @return  boolean
	 */
	public function enqueue_styles()
	{
		global $woocommerce_quick_view_options;

		$this->options = $woocommerce_quick_view_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('performanceOnlyWooPages') && (!is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy()) ){
			return;
		}

		wp_enqueue_style('jquery-quick-view-modal', plugin_dir_url(__FILE__).'vendor/jquery-modal-master/jquery.modal.min.css', array(), '0.9.1', 'all');
		wp_enqueue_style($this->plugin_name.'-public', plugin_dir_url(__FILE__).'css/woocommerce-quick-view-public.css', array('jquery-quick-view-modal'), $this->version, 'all');

		$css = "";
		$modalHeight = $this->get_option('modalHeight');
		$modalPadding = $this->get_option('modalPadding');
		$modalTextColor = $this->get_option('modalTextColor');
		$modalBackgroundColor = $this->get_option('modalBackgroundColor');
		$modalImageWidth = $this->get_option('modalImageWidth');
		$modalContentWidth = $this->get_option('modalContentWidth');

		$backdropBackgroundColor = $this->get_option('backdropBackgroundColor');
		if(!isset($backdropBackgroundColor['rgba'])) {
			$backdropBackgroundColor['rgba'] = 'rgba(0,0,0,0.88)';
		}

		$css .= '.quickviewmodal { 
			padding-top: ' . $modalPadding['padding-top'] . '; 
			padding-right: ' . $modalPadding['padding-right'] . '; 
			padding-bottom: ' . $modalPadding['padding-bottom'] . '; 
			padding-left: ' . $modalPadding['padding-left'] . '; 
			background-color: ' . $modalBackgroundColor . ';
		}

		.woocommerce-quick-view-content {
			color: ' . $modalTextColor . ';
			max-height: ' . $modalHeight . 'px;
		}

		.jquery-quickviewmodal.blocker  {
			background-color: ' . $backdropBackgroundColor['rgba'] . ';
		}

		@media (min-width: 768px) { 
			.woocommerce-quick-view-image  {
				width: ' . $modalImageWidth . '%;
			}
			.woocommerce-quick-view-content  {
				width: ' . $modalContentWidth . '%;
			}
		}';

		$customCSS = $this->get_option('customCSS');
		$css = $css . $customCSS;

		file_put_contents( dirname(__FILE__)  . '/css/woocommerce-quick-view-custom.css', $css);

		wp_enqueue_style( $this->plugin_name.'-custom', plugin_dir_url( __FILE__ ) . 'css/woocommerce-quick-view-custom.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://plugins.db-dzine.com
	 * @return  boolean
	 */
	public function enqueue_scripts()
	{
		global $woocommerce_quick_view_options;

		$this->options = $woocommerce_quick_view_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('performanceOnlyWooPages') && (!is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy()) ){
			return;
		}

		global $woocommerce;

		if ($this->get_option('executeWooCommerceScripts')) {
			wp_enqueue_script( 'wc-add-to-cart-variation', $woocommerce->plugin_url() . '/assets/js/frontend/add-to-cart-variation.js', array('jquery'), WC_VERSION, true );
			wp_enqueue_script( 'wc-add-to-cart', $woocommerce->plugin_url() . '/assets/js/frontend/add-to-cart.js', array('jquery'), WC_VERSION, true );
			wp_enqueue_script( 'wc-single-product', $woocommerce->plugin_url() . '/assets/js/frontend/single-product.js', array('jquery'), WC_VERSION, true );
		}

		wp_enqueue_script('jquery-quick-view-modal', plugin_dir_url(__FILE__).'vendor/jquery-modal-master/jquery.modal.min.js', array('jquery'), '0.9.1', true);
		wp_enqueue_script(
			$this->plugin_name . '-public', 
			plugin_dir_url(__FILE__).'js/woocommerce-quick-view-public.js', 
			array('jquery', 'jquery-quick-view-modal'), 
			$this->version, 
			true
		);

        $forJS['ajax_url'] = admin_url('admin-ajax.php');
        $forJS['modalHeightAuto'] = $this->get_option('modalHeightAuto');
        $forJS['openEffect'] = $this->get_option('openEffect');
        $forJS['inlineScrollTo'] = $this->get_option('inlineScrollTo');
        $forJS['dataAJAXAddToCart'] = $this->get_option('dataAJAXAddToCart');
        $forJS['closeQuickViewAfterAddToCart'] = $this->get_option('closeQuickViewAfterAddToCart');
        $forJS['trans'] = array(
        	'btnText' => $this->get_option('shopLoopButtonText'),
    	);
    	$forJS = apply_filters('woocommerce_quick_view_js_settings', $forJS);
        wp_localize_script($this->plugin_name . '-public', 'woocommerce_quick_view_options', $forJS);
	}

    /**
     * Init the Bought together
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.db-dzine.com
     * @return  [type]                       [description]
     */
    public function init()
    {
        global $woocommerce_quick_view_options;
        $this->options = $woocommerce_quick_view_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		$shopLoopButtonPosition = $this->get_option('shopLoopButtonPosition');
		!empty($shopLoopButtonPosition) ? $shopLoopButtonPosition = $shopLoopButtonPosition : $shopLoopButtonPosition = 'woocommerce_after_shop_loop_item';

		$shopLoopButtonPriority = $this->get_option('shopLoopButtonPriority');

		add_action($shopLoopButtonPosition, array($this, 'quick_view_button'), $shopLoopButtonPriority);
		add_action('wp_footer', array($this, 'quick_view_modal'), 20);
    }

    public function quick_view_button_shortcode($atts)
    {
    	global $product;

    	$productID = "";

    	if($product) {
    		$productID = $product->get_id();
    	}

	    $args = shortcode_atts( array(
	        'product' => '',
	    ), $atts );

		$productIDCheck = intval( $args['product'] );
		if(!empty($productIDCheck)) {
			$productID = $productIDCheck;
		}

		if(empty($productID) || !is_int($productID)) {
			return;
		}

		$btn_text = $this->get_option('shopLoopButtonText');

		$html = '<a href="#" class="button quick-view-button btn button btn-default theme-button theme-btn" data-product-id="' . $productID . '" rel="nofollow">' . $btn_text . '</a>';
		
		return $html;
    }

	public function quick_view_button()
	{
		global $product;

		if(!is_object($product)) {
			return;
		}

		$btn_text = $this->get_option('shopLoopButtonText');

		$html = '<a href="#" class="button quick-view-button btn button btn-default theme-button theme-btn" data-product-id="' . $product->get_id() . '" rel="nofollow">' . $btn_text . '</a>';
		
		echo $html;
	}

	public function quick_view_modal()
	{
		$openEffect = $this->get_option('openEffect');
		echo '<div class="quick-view-modal quick-view-' . $openEffect . '"></div>';
	}

    public function get_product()
    {
    	global $post, $product;

        if (!defined('DOING_AJAX') || !DOING_AJAX) {
        	header('HTTP/1.1 400 No AJAX call', true, 400);
            die();
        }

        if (!isset($_POST['product'])) {
            header('HTTP/1.1 400 No product ID', true, 400);
            die();
        }

		if(class_exists('WPBMap')) {
			WPBMap::addAllMappedShortcodes();
		}

        $product_id = intval($_POST['product']);
        $product = wc_get_product($product_id);
        
    	$isVariation = $product->get_parent_id();
    	if($isVariation > 0){
        	$product = wc_get_product($isVariation);
        	$product_id = $isVariation;
        }

        if(!$product) {
        	header('HTTP/1.1 400 No Product found', true, 400);
        	die();
        }

		$post = get_post($product_id);
		
		setup_postdata( $product_id ); 

		ob_start();

		if($this->get_option('useDefaultTemplate')) {
			wc_get_template_part( 'content', 'single-product' );
		} else {
			wc_get_template( 'quick-view.php', array(), '', plugin_dir_path(__FILE__) . 'templates/' );
		}
		$html = ob_get_clean();
		echo $html;
		die();
        
	}

    public function add_popup()
    {
        $popupEnable = $this->get_option('popupEnable');
        if(!$popupEnable) {
            return false;
        }

        $popupText = $this->get_option('popupText');
        $popupBackgroundColor = $this->get_option('popupBackgroundColor');
        $popupTextColor = $this->get_option('popupTextColor');

        ?>
        <div class="woocommerce-quick-view-popup" style="background-color: <?php echo $popupBackgroundColor ?>; color: <?php echo $popupTextColor ?>;">
            <div class="woocommerce-quick-view-popup-icon">
            	<i class="fa fa-eye"></i>
            	<div class="woocommerce-quick-view-popup-message">
            		<?php echo __('Press Enter to Search', 'woocommerce-quick-view') ?>
            	</div>
            </div>
            <div class="woocommerce-quick-view-popup-input">
				<input type="text" name="woocommerce-quick-view-popup-input-field" class="woocommerce-quick-view-popup-input-field" placeholder="<?php echo $popupText ?>">
            </div>
		</div>
		<?php
   	}

   	public function check_product()
   	{
   		$response = array(
   			'message' => __('No Product found ...', 'woocommerce-quick-view'),
   			'product' => '',
   		);

   		$skuOrProduct = $_POST['skuOrProduct'];

   		if(empty($skuOrProduct)) {
   			die(json_encode($response));
   		}

   		$bySKU = wc_get_product_id_by_sku($skuOrProduct);

   		if(!empty($bySKU)) {
   			$response['message'] = __('Product found!', 'woocommerce-quick-view');
   			$response['product'] = $bySKU;
   		} else {
   			if($this->get_option('popupUseSimpleSearch')) {
	   			$skuOrProduct = sanitize_title_for_query( $skuOrProduct );
		   		$byName = get_page_by_path($skuOrProduct, OBJECT, 'product' );

	   		} else {
	   			$byName = $this->search_product_by_name($skuOrProduct);
	   		}
	   		if(!empty($byName)) {
	   			$response['message'] = __('Product found!', 'woocommerce-quick-view');
	   			$response['product'] = $byName->ID;
	   		}
   		}
   		
   		die(json_encode($response));
   	}

   	protected function search_product_by_name($title)
   	{
	    global $wpdb;
	    $title = esc_sql($title);

	    if(!$title) return;
	    
	    $product = $wpdb->get_results("
	        SELECT * 
	        FROM $wpdb->posts
	        WHERE post_title LIKE '%$title%'
	        AND post_type = 'product' 
	        AND post_status = 'publish'
	        LIMIT 1
	    ");
	    if(isset($product[0])) {
	    	return $product[0];
	    } else {
	    	return false;
	    }
   	}


	public function ajax_add_to_cart()
	{
		ob_start();

		$cart_item_data = array();
		

	    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	    $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
	    $variation_id      = isset( $_POST['variation_id'] ) ? $_POST['variation_id'] : '';

	    $variation 		   = array();
	    foreach ($_POST as $postKey => $postValue) {
	    	if(in_array($postKey, array('product_id', 'quantity', 'variation_id', 'action', 'possible_variations') ) ) {
	    		continue;
	    	}
	    	$variation[$postKey] = $postValue;
	    }

	    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation, $cart_item_data );

		if ( $passed_validation) {
			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation );
		}

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );

        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }

        // Return fragments
        WC_AJAX::get_refreshed_fragments();

	    die();
	}
    
}