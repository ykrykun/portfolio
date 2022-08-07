// External Dependencies
import React, { Component, Fragment } from 'react';
import $ from 'jquery';

import DSWCP_Modules from '../../loader';
import DSWCP_WooAccountContentItem from './../WooAccountContentItem/WooAccountContentItem';
import './style.scss';
import {generateStyles} from "../../module_dependencies/styles";

class DSWCP_WooAccountContent extends Component {

	static slug = 'ags_woo_account_content';

	constructor(props) {
		super(props);
		this.processFontIcon = DSWCP_Modules.builderApi.Utils.processFontIcon;
		this.state = {
			view: this.props.current_view
		};
	}

	static css(props) {

		const additionalCss = [];
		let address = props.address;
		/**
		 * Module internal style.
		 */
		// Mark Background Color.
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			name: 'mark_background',
			selector: '%%order_class%% mark',
			cssProperty: 'background-color'
		}));

		// Open Dropdowns Option Hover Background
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			name: 'dropdowns_hover_bg_item',
			selector: '.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]',
			cssProperty: 'background-color'
		}));

		// Open Dropdowns Option Hover Color
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			name: 'dropdowns_hover_color_item',
			selector: '.select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]',
			cssProperty: 'color'
		}));

		// Tables Heading Background
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			name: 'tables_th_bg_color',
			selector: '%%order_class%% .woocommerce-MyAccount-content table th',
			cssProperty: 'background-color'
		}));

		// Tables Columns Background
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			name: 'tables_td_bg_color',
			selector: '%%order_class%% .woocommerce-MyAccount-content table td',
			cssProperty: 'background-color'
		}));

		// Fix for buttons paddings CSS in visual builder getting overwritten
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			type: 'padding',
			name: 'buttons_custom_padding',
			selector: '.et_button_no_icon.woocommerce-page .woocommerce-MyAccount-content a.button, .et_button_icon_visible.woocommerce-page .woocommerce-MyAccount-content a.button, .et_button_no_icon.woocommerce-page .woocommerce-MyAccount-content  button.button',
			cssProperty: 'padding',
			important: true
		}));

		// button padding hover
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			type: 'padding',
			name: 'buttons_custom_padding__hover',
			selector: '.et_button_no_icon.woocommerce-page .woocommerce-MyAccount-content a.button:hover, .et_button_icon_visible.woocommerce-page .woocommerce-MyAccount-content a.button:hover',
			cssProperty: 'padding',
			important: true
		}));

		// table td padding
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			type: 'padding',
			name: 'tables_td_padding',
			selector: '%%order_class%% .woocommerce-MyAccount-content table td',
			cssProperty: 'padding',
			important: true
		}));


		// table th padding
		additionalCss.push(generateStyles({
			address,
			attrs: props,
			type: 'padding',
			name: 'tables_th_padding',
			selector: '%%order_class%% .woocommerce-MyAccount-content table th',
			cssProperty: 'padding',
			important: true
		}));

		if( props.buttons_icon ){
			const icon = DSWCP_Modules.builderApi.Utils.processFontIcon(props.buttons_icon);
			const position = props.buttons_icon_placement ? props.buttons_icon_placement : 'right';
			additionalCss.push([{				
				selector:    `%%order_class%% .woocommerce-MyAccount-content .button:${position === 'left' ? 'before' : 'after'}`,
				//selector:    `%%order_class%% .woocommerce-MyAccount-content .button::after`,
				declaration: `content:  '${icon}' !important;`
			}]);
		}

		if( props.min_height ) {
			additionalCss.push([{
				selector: '%%order_class%% .woocommerce-MyAccount-content',
				declaration: `min-height:  ${props.min_height} ;`
			}])
		}


		return additionalCss;
	}


	render() {
		const content = Array.isArray( this.props.content ) ? this.props.content.map(content => {
			const newContent = Object.assign({}, content);
			newContent.props = Object.assign({}, content.props);
			newContent.props.attrs = Object.assign({}, {...content.props.attrs, current_view: this.state.view ? this.state.view : 'dashboard' });

			return newContent;
		}) : this.props.content;

		return (
			<div className="woocommerce">{content}</div>
		)
  	}

	componentDidMount(){
		const topDocument = window.ET_Builder.Frames.top.document;
		$( topDocument.body ).on('click', '.et-fb-settings-module-item-button--edit', this.onEditItem.bind(this));
	}

	componentWillUnmount(){
		const topDocument = window.ET_Builder.Frames.top.document;
		$( topDocument.body ).off('click', '.et-fb-settings-module-item-button--edit', this.onEditItem);
	}

	componentDidUpdate( prevProps ){
		if( prevProps.current_view !== this.props.current_view ){
			this.setState({view: this.props.current_view});
		}
	}

	onEditItem(e){
		const index = $(e.target).parents('div[draggable]').index();
		if( index >= 0 && Array.isArray( this.props.content ) && this.props.content[index] ){
			let view = this.props.content[index].props.attrs.item;
			if( [ 'edit-billing', 'edit-shipping', 'view-order' ].includes( this.props.current_view ) ){
				view = this.props.current_view;
			}
			this.setState({ view: view });
		}
	}
}

export default DSWCP_WooAccountContent;
