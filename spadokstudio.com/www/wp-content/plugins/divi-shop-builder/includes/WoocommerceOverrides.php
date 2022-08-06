<?php

defined( 'ABSPATH' ) || exit;

use simplehtmldom\HtmlDocument;

/**
 * Override/Setup woocommerce cart and checkout
 *
 */
class DSWCP_WoocomemrceOverrides {

	const WRAP_BY_SECTION = 'section';
	const WRAP_BY_ROW 	  = 'row';

	protected $cart_modules 	= [
		'ags_woo_cart_list' // modules/WooCartList
	];

	protected $checkout_modules = [
		'ags_woo_checkout_coupon', 	   	 // modules/WooCheckoutCoupon
		'ags_woo_checkout_billing_info', // modules/WooCheckoutBillingInfo
		'ags_woo_checkout_shipping_info',// modules/WooCheckoutBillingInfo
		'ags_woo_checkout_order_review'  // modules/WooCheckoutOrderReview
	];

	public function __construct() {

		$this->init_hooks();
	}

	public function init_hooks(){
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 99 );
		add_filter( 'et_builder_inner_content_class', array( $this, 'inner_content_woocommrece_class' ) );
		add_filter( 'the_content', array( $this, 'checkout_output' ), 99, 1 );
		add_filter( 'et_builder_render_layout', array( $this, 'checkout_output' ), 99, 1 );
		add_action( 'template_redirect', array( $this, 'thankyou_page_redirect' ), 1); // has to validate if this is correct way
	}

	public function body_classes( $classes ){

		if( $this->has_shortcode( $this->cart_modules ) ){
			$classes[] = 'woocommerce-cart';
			$classes[] = 'woocommerce-page';
		}

		if( $this->has_shortcode( $this->checkout_modules ) ){
			$classes[] = 'woocommerce-checkout';
			$classes[] = 'woocommerce-page';
		}

		return $classes;
	}

	public function enqueue_scripts(){

		global $dswcp;

		$is_fb_active = function_exists( 'et_fb_is_enabled' ) && et_fb_is_enabled();

		if( $this->has_shortcode( $this->cart_modules ) || $is_fb_active ){
			wp_enqueue_script( 'wc-cart' );
		}

		if( $this->has_shortcode( $this->checkout_modules ) || $is_fb_active ){
			wp_enqueue_style('select2');

			wp_enqueue_script( 'selectWoo' );
			wp_enqueue_script( 'wc-checkout' );
		}

		if( $this->has_shortcode( $this->checkout_modules ) && wp_script_is( 'wc-address-i18n' ) ){
			wp_deregister_script( 'wc-address-i18n' );
			wp_dequeue_script( 'wc-address-i18n' );
			wp_enqueue_script( 'wc-address-i18n', $dswcp->plugin_dir_url . 'includes/js/wc-override/address-i18n.js', array( 'jquery', 'wc-country-select' ), WC_VERSION, true );
		}

		// woo quick view plugin conflict
		if( et_fb_is_enabled() ){
			wp_dequeue_script( 'wc-add-to-cart-variation' );
		}

	}

	private function has_shortcode( $shortcodes ){

		$available = array_filter( $shortcodes, function( $shortcode ){
			return has_shortcode( get_the_content(), $shortcode );
		});

		return count( $available ) > 0;
	}


	public function inner_content_woocommrece_class( $classes ){

		if( et_fb_is_enabled() ){
			return $classes;
		}

		if( $this->has_shortcode( $this->cart_modules ) || $this->has_shortcode( $this->checkout_modules ) ){
			$classes[] = "woocommerce";
		}

		return $classes;
	}


	/**
	 * Process content of woocommerce checkout
	 *
	 */
	public function checkout_output( $content ){

		global $wp;

		if( !$this->has_shortcode( $this->checkout_modules ) ){
			return $content;
		}

		if ( is_null( WC()->cart ) ) {
			return;
		}
		
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- just testing flags
		$is_woo_checkout = ( isset( $_GET['order'] ) && isset( $_GET['key'] ) ) || ! empty( $wp->query_vars['order-pay'] ) || isset( $wp->query_vars['order-received'] );

		/**
		 * if order-pay or order-received url
		 * process woocommerce checkout shortcode
		 *
		 */
		if( $is_woo_checkout ){

			// global $wp_current_filter;

			// $page_id = wc_get_page_id('thankyou');

			// if( !empty( $page_id ) && $page_id > 0 ){

			// 	if ( in_array( 'the_content', $wp_current_filter, true ) ) {

			// 		$count 		 = 0;
			// 		$call_counts = array_count_values( $wp_current_filter );

			// 		if ( $call_counts['the_content'] > 1 ) {
			// 			$count = $call_counts['the_content'];
			// 		}
			// 	}

			// 	/**
			// 	 * @todo page module styles missing
			// 	 */
			// 	return $count < 1 ? apply_filters( 'the_content', get_the_content( null, false, $page_id ) ) : $content;
			// }

			return do_shortcode( '[et_pb_section][et_pb_row][et_pb_column][et_pb_text][woocommerce_checkout][/et_pb_text][/et_pb_column][/et_pb_row][/et_pb_section]' );
		}

		return $this->inject_checkout_form_wrapper( $content );
	}


	/**
	 * Wrap checkout modules with forms
	 *
	 * @return HTML
	 */
	protected function inject_checkout_form_wrapper( $content ){

		$dom 		  = new HtmlDocument();
		$content_html = $dom->load( $content );

		$modules_selector =  '.' . implode( ', .', array_slice( $this->checkout_modules, 1 ) );
		$modules 		  = $content_html->find( $modules_selector );

		// bail out if no modules found in content
		if( !count( $modules ) ){
			return $content;
		}

		$first_index = $last_index = $first_row_index = $last_row_index = -1;
		$wrap_by 	 = self::WRAP_BY_SECTION;
		$new_content = '';

		foreach( $content_html->find( '.et_pb_section' ) as $index => $section  ){

			// found a form? process row or break to previous section
			if( count( $section->find( 'form' ) ) ){

				// previous section had modules? process with previous sections
				if( $first_index > -1 ){
					$wrap_by = self::WRAP_BY_SECTION;
					break;
				}

				// this is the first section? process with row
				foreach( $section->find( '.et_pb_row' ) as $r_index => $row ){

					if( count( $row->find( 'form' ) ) ){

						if( $r_index < 1 ){
							continue;
						}

						$wrap_by = self::WRAP_BY_ROW;
						break;
					}

					// no forms found in between rows? put to basket and go to next
					if( count( $row->find( $modules_selector ) ) ){
						if( $first_row_index < 0 ){
							$first_row_index = $r_index;
						}
						$last_row_index = $r_index;
					}

				}

				// still no modules found we skip to next section
				if( $first_index < 0 && $first_row_index < 0 ){
					continue;
				}

				$first_index = $index;
				$wrap_by 	 = self::WRAP_BY_ROW;
				break;
			}

			// no forms and only modules ? put to basket and go to next section
			if( count( $section->find( $modules_selector ) ) ){
				if( $first_index < 0 ){
					$first_index = $index;
				}
				$last_index = $index;
			}
		}

		// new content based on wrapper type
		$new_content = $wrap_by === self::WRAP_BY_SECTION ?
			$this->get_form_wrapped_content( $content_html, $first_index, $last_index ) :
			$this->get_form_wrapped_content( $content_html, $first_row_index, $last_row_index, $wrap_by, $first_index );

		return !empty( $new_content ) ? $new_content : $content;
	}


	/**
	 * Checkout form tag to be wrapped by sections or rows
	 *
	 * @return HTML
	 */
	public function get_form_wrapped_content( $html, $index, $index_last, $wrap_by = self::WRAP_BY_SECTION , $parent_index = null ){

		// bail out if no section or row found
		if( $index < 0 || $index_last < 0 || ( !is_null( $parent_index ) && $parent_index < 0 )  ){
			return false;
		}

		$sections = $html->find( '.et_pb_section' );

		if( $wrap_by === self::WRAP_BY_ROW ){

			$rows 						  = $sections[$parent_index]->find( '.et_pb_row' );

			$rows[$index]->outertext 	  = $this->get_wrapper_start() . $rows[$index]->outertext;
			$rows[$index_last]->outertext = $rows[$index_last]->outertext . $this->get_wrapper_end();
		}else{

			$sections[$index]->outertext 	  = $this->get_wrapper_start() . $sections[$index]->outertext;
			$sections[$index_last]->outertext = $sections[$index_last]->outertext . $this->get_wrapper_end();
		}

		return $html->outertext;
	}

	/**
	 * Form wrapper start
	 *
	 */
	private function get_wrapper_start(){
		ob_start();
		echo '<form name="checkout" method="post" class="checkout woocommerce-checkout" action="'. esc_url( wc_get_checkout_url() ) .'" enctype="multipart/form-data">';
		return ob_get_clean();
	}

	/**
	 * Form wrapper end
	 *
	 */
	private function get_wrapper_end(){
		ob_start();
		echo '</form>';
		do_action( 'woocommerce_after_checkout_form', WC()->checkout() );
		return ob_get_clean();
	}


	public function thankyou_page_redirect(){
		global $wp;

		$page_id  = wc_get_page_id('thankyou');
		$order_id = get_query_var( 'order-received' );

		if( intval( $page_id ) > 0 && !empty( $order_id ) && !empty( $_GET['key'] ) ){

			$url = add_query_arg( array(
				'order_id' => $order_id,
				'key'	   => sanitize_text_field($_GET['key'])
			), get_permalink( $page_id ) );

			wp_safe_redirect( $url );
			die();
		}
	}

}
new DSWCP_WoocomemrceOverrides;