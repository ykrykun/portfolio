<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get cart table columns
 *
 * @return Array
 *
 */
function dswcp_get_cart_columns(){

	return apply_filters( 'dswcp_cart_columns', array(
		'remove' 	=> '',
		'thumbnail' => '',
		'name' 		=> esc_html__( 'Product', 'woocommerce' ),
		'price' 	=> esc_html__( 'Price', 'woocommerce' ),
		'quantity' 	=> esc_html__( 'Quantity', 'woocommerce' ),
		'subtotal' 	=> esc_html__( 'Subtotal', 'woocommerce' ),
	) );

}

/**
 * Get decoded icon character
 *
 * @return String
 *
 */
function dswcp_decoded_et_icon( $icon ){
	//return '\\'.str_replace( ';', '', str_replace( '&#x', '', html_entity_decode( et_pb_process_font_icon( $icon ) ) ) );
	return str_replace( ';', '', str_replace( '&#x', '', html_entity_decode( et_pb_process_font_icon( $icon ) ) ) );
}


/**
 * Get if the endpoint is valid accoount type
 *
 */
function dswcp_is_account_endpoint( $type = '' ){
	return ( ( !empty( $type ) && is_wc_endpoint_url( $type ) ) || ( $type === '' && is_account_page() ) ) && $type === WC()->query->get_current_endpoint();
}
