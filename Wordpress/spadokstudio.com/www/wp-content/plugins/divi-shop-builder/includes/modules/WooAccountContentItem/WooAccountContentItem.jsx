// External Dependencies
import React, { Component } from 'react';
import parse from 'html-react-parser';

import DSWCP_Modules from '../../loader';
import DSWCP_WooAccountViewOrder from './../WooAccountViewOrder/WooAccountViewOrder';
import DSWCP_WooAccountOrders from './../WooAccountOrders/WooAccountOrders';
import DSWCP_WooAccountDownloads from './../WooAccountDownloads/WooAccountDownloads';
import './style.scss';
import {generateStyles} from "../../module_dependencies/styles";

class DSWCP_WooAccountContentItem extends Component {

	static slug = 'ags_woo_account_content_item';

	static css(props) {

		const additionalCss = [];
		let address = props.address;

		// table td padding
		if( props.view_order_text_margin ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'margin',
				name: 'view_order_text_margin',
				selector: '%%order_class%% .view-order-wrapper > p:first-of-type',
				cssProperty: 'margin',
				important: true
			}));
		}

		// billing padding
		if( props.billing_address_padding ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'padding',
				name: 'billing_address_padding',
				selector: '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address',
				cssProperty: 'padding',
				important: true
			}));
		}

		// billing margin
		if( props.billing_address_margin ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'margin',
				name: 'billing_address_margin',
				selector: '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address',
				cssProperty: 'margin',
				important: true
			}));
		}

		// billing background
		if( props.billing_address_background ){
			additionalCss.push([{
				selector:    '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--billing-address address',
				declaration: `background-color:  ${props.billing_address_background};`
			}]);
		}


		// shipping padding
		if( props.shipping_address_padding ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'padding',
				name: 'shipping_address_padding',
				selector: '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address',
				cssProperty: 'padding',
				important: true
			}));
		}

		// shipping margin
		if( props.shipping_address_margin ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'margin',
				name: 'shipping_address_margin',
				selector: '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address',
				cssProperty: 'margin',
				important: true
			}));
		}

		// shipping background
		if( props.shipping_address_background ){
			additionalCss.push([{
				selector:    '%%order_class%% .woocommerce-MyAccount-content .view-order-wrapper .woocommerce-customer-details .woocommerce-column--shipping-address address',
				declaration: `background-color:  ${props.shipping_address_background};`
			}]);
		}

		// address padding
		if( props.address_billing_shipping_padding ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'padding',
				name: 'address_billing_shipping_padding',
				selector: '%%order_class%% .woocommerce-MyAccount-content .edit-address-wrapper .woocommerce-Address',
				cssProperty: 'padding',
				important: true
			}));
		}

		// address margin
		if( props.address_billing_shipping_margin ) {
			additionalCss.push(generateStyles({
				address,
				attrs: props,
				type: 'margin',
				name: 'address_billing_shipping_margin',
				selector: '%%order_class%% .woocommerce-MyAccount-content .edit-address-wrapper .woocommerce-Address',
				cssProperty: 'margin',
				important: true
			}));
		}

		// address background
		if( props.address_billing_shipping_background ){
			additionalCss.push([{
				selector:    '%%order_class%% .woocommerce-MyAccount-content .edit-address-wrapper .woocommerce-Address',
				declaration: `background-color:  ${props.address_billing_shipping_background};`
			}]);
		}


		if( props.orders_button_view_use_icon && props.orders_button_view_use_icon === 'on' && props.orders_button_view_icon ){
			const icon = DSWCP_Modules.builderApi.Utils.processFontIcon(props.orders_button_view_icon);
			const position = props.orders_button_view_icon_placement ? props.orders_button_view_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .orders-wrapper table.woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button:${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.orders_button_browse_use_icon && props.orders_button_browse_use_icon === 'on' && props.orders_button_browse_icon ){
			const icon = DSWCP_Modules.builderApi.Utils.processFontIcon(props.orders_button_browse_icon);
			const position = props.orders_button_browse_icon_placement ? props.orders_button_browse_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .orders-wrapper .woocommerce-Message.woocommerce-Message--info .button:${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.orders_no_items_bg_color  ){
			additionalCss.push([{
				selector:    '%%order_class%% .woocommerce-MyAccount-content .orders-wrapper .woocommerce-Message.woocommerce-Message--info',
				declaration: `background-color:  ${props.orders_no_items_bg_color} !important;`
			}]);
		}


		if( props.downloads_button_view_use_icon && props.downloads_button_view_use_icon === 'on' && props.downloads_button_view_icon ){
			const icon = DSWCP_Modules.builderApi.Utils.processFontIcon(props.downloads_button_view_icon);
			const position = props.downloads_button_view_icon_placement ? props.downloads_button_view_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .downloads-wrapper table.woocommerce-table--order-downloads td.download-file .button:${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.downloads_button_browse_use_icon && props.downloads_button_browse_use_icon === 'on' && props.downloads_button_browse_icon ){
			const icon = DSWCP_Modules.builderApi.Utils.processFontIcon(props.downloads_button_browse_icon);
			const position = props.downloads_button_browse_icon_placement ? props.downloads_button_browse_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .downloads-wrapper .woocommerce-Message.woocommerce-Message--info .button:${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.downloads_no_items_bg_color  ){
			additionalCss.push([{
				selector:    '%%order_class%% .woocommerce-MyAccount-content .downloads-wrapper .woocommerce-Message.woocommerce-Message--info',
				declaration: `background-color:  ${props.downloads_no_items_bg_color} !important;`
			}]);
		}

		if( props.account_details_submit_use_icon && props.account_details_submit_use_icon === 'on' && props.account_details_submit_icon ){
			const icon 		= DSWCP_Modules.builderApi.Utils.processFontIcon(props.account_details_submit_icon);
			const position  = props.account_details_submit_icon_placement ? props.account_details_submit_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .edit-account-wrapper .woocommerce-EditAccountForm.edit-account p button[type='submit']:${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.address_button_edit_use_icon && props.address_button_edit_use_icon === 'on' && props.address_button_edit_icon ){
			const icon	   = DSWCP_Modules.builderApi.Utils.processFontIcon(props.address_button_edit_icon);
			const position = props.address_button_edit_icon_placement ? props.address_button_edit_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .edit-address-wrapper .woocommerce-Address .woocommerce-Address-title a.edit::${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.address_billing_button_save_use_icon && props.address_billing_button_save_use_icon === 'on' && props.address_billing_button_save_icon ){
			const icon	   = DSWCP_Modules.builderApi.Utils.processFontIcon(props.address_billing_button_save_icon);
			const position = props.address_billing_button_save_icon_placement ? props.address_billing_button_save_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .edit-billing-wrapper .woocommerce-address-fields p button[type='submit']::${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.address_shipping_button_save_use_icon && props.address_shipping_button_save_use_icon === 'on' && props.address_shipping_button_save_icon ){
			const icon	   = DSWCP_Modules.builderApi.Utils.processFontIcon(props.address_shipping_button_save_icon);
			const position = props.address_shipping_button_save_icon_placement ? props.address_shipping_button_save_icon_placement : 'right';
			additionalCss.push([{
				selector:    `%%order_class%% .woocommerce-MyAccount-content .edit-shipping-wrapper .woocommerce-address-fields p button[type='submit']::${position === 'left' ? 'before' : 'after'}`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		return additionalCss;
	}

	render() {
		const currentItem = this.props.item ? this.props.item : 'dashboard';
		return (
			( 'edit-address' === this.props.current_view && currentItem ==='edit-address' && <div dangerouslySetInnerHTML={{ __html: this.getHTMLByType('edit-address') }}></div> ) ||
			( 'dashboard' === this.props.current_view && currentItem ==='dashboard' && <div dangerouslySetInnerHTML={{ __html: this.getHTMLByType('dashboard') }}></div> ) ||
			( 'subscriptions' === this.props.current_view && currentItem ==='subscriptions' && <div dangerouslySetInnerHTML={{ __html: this.getHTMLByType('subscriptions') }}></div> ) ||
			( 'edit-account' === this.props.current_view && currentItem ==='edit-account' && <div dangerouslySetInnerHTML={{ __html: this.getHTMLByType('edit-account') }}></div> ) ||
			( ['edit-billing', 'edit-shipping'].includes( this.props.current_view ) && currentItem === 'edit-address' && <div dangerouslySetInnerHTML={{ __html: this.getHTMLByType(this.props.current_view) }}></div> ) ||
			( 'view-order' === this.props.current_view && currentItem === 'orders' && this.getViewOrderHTML() ) ||
			( 'orders' === this.props.current_view && currentItem ==='orders' && this.getOrdersHTML() ) ||
			( 'downloads' === this.props.current_view && currentItem ==='downloads' && this.getDownloadsHTML() )

		);
  	}

	getHTMLByType( type = 'dashboard' ){
		const item = `${type}_html`;
		return window.DiviWoocommercePagesBuilderData.account_contents[item] ? window.DiviWoocommercePagesBuilderData.account_contents[item] : '';
	}

	getViewOrderHTML(){
		const props = this.props;
		return (
			<DSWCP_WooAccountViewOrder {...props}></DSWCP_WooAccountViewOrder>
		)
	}

	getOrdersHTML(){
		const props = this.props;
		return (
			<DSWCP_WooAccountOrders {...props}></DSWCP_WooAccountOrders>
		)
	}
	getDownloadsHTML(){
		const props = this.props;
		return (
			<DSWCP_WooAccountDownloads {...props}></DSWCP_WooAccountDownloads>
		)
	}
}

export default DSWCP_WooAccountContentItem;
