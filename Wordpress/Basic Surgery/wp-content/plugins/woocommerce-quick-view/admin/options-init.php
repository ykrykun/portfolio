<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'weLaunch' ) && ! class_exists( 'Redux' ) ) {
        return;
    }


    if( class_exists( 'weLaunch' ) ) {
        $framework = new weLaunch();
    } else {
        $framework = new Redux();
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "woocommerce_quick_view_options";

    $args = array(
        'opt_name' => 'woocommerce_quick_view_options',
        'use_cdn' => TRUE,
        'dev_mode' => FALSE,
        'display_name' => 'WooCommerce Quick View',
        'display_version' => '1.2.8',
        'page_title' => 'WooCommerce Quick View',
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => '&copy; '.date('Y').' weLaunch',
        'admin_bar' => false,
        'menu_type' => 'submenu',
        'menu_title' => 'Quick View',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'woocommerce',
        'customizer' => FALSE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    global $weLaunchLicenses;
    if( (isset($weLaunchLicenses['woocommerce-quick-view']) && !empty($weLaunchLicenses['woocommerce-quick-view'])) || (isset($weLaunchLicenses['woocommerce-plugin-bundle']) && !empty($weLaunchLicenses['woocommerce-plugin-bundle'])) ) {
        $args['display_name'] = '<span class="dashicons dashicons-yes-alt" style="color: #9CCC65 !important;"></span> ' . $args['display_name'];
    } else {
        $args['display_name'] = '<span class="dashicons dashicons-dismiss" style="color: #EF5350 !important;"></span> ' . $args['display_name'];
    }

    $framework::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'help-tab',
            'title'   => __('Information', 'woocommerce-quick-view' ),
            'content' => __('<p>Need support? Please use the comment function on codecanyon.</p>', 'woocommerce-quick-view' )
        ),
    );
    $framework::setHelpTab( $opt_name, $tabs );

    $enabled = array(
            'im' => __('Image', 'woocommerce-quick-view'),
            'gl' => __('Gallery', 'woocommerce-quick-view'),
            'ti' => __('Title', 'woocommerce-quick-view'),
            're' => __('Reviews', 'woocommerce-quick-view'),
            'pr' => __('Price', 'woocommerce-quick-view'),
            'st' => __('Stock', 'woocommerce-quick-view'),
            'sk' => __('SKU', 'woocommerce-quick-view'),
            'tg' => __('Tags', 'woocommerce-quick-view'),
            'ct' => __('Categories', 'woocommerce-quick-view'),
            'sd' => __('Short Description', 'woocommerce-quick-view'),
            'ca' => __('Add to Cart', 'woocommerce-quick-view'),
    );

    $enabled = array_merge($enabled);
    $dataToShow = array(
        'enabled' => $enabled,
        'disabled' => array(
            'de' => __('Description', 'woocommerce-quick-view'),
            'at' => __('Attributes', 'woocommerce-quick-view'),
            'rm' => __('Read More', 'woocommerce-quick-view'),
        )
    );

    /*
     *
     * ---> START SECTIONS
     *
     */

    $framework::setSection( $opt_name, array(
        'title'  => __('Quick View', 'woocommerce-quick-view' ),
        'id'     => 'general',
        'desc'   => __('Need support? Please use the comment function on codecanyon.', 'woocommerce-quick-view' ),
        'icon'   => 'el el-home',
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('General', 'woocommerce-quick-view' ),
        'desc'       => __( 'To get auto updates please <a href="' . admin_url('tools.php?page=welaunch-framework') . '">register your License here</a>.', 'woocommerce-quick-view' ),
        'id'         => 'general-settings',
        'subsection' => true,
        'fields'     => array(           
            array(
                'id'       => 'enable',
                'type'     => 'checkbox',
                'title'    => __('Enable', 'woocommerce-quick-view' ),
                'subtitle' => __('Enable Quick View.', 'woocommerce-quick-view' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'shopLoopButtonPosition',
                'type'     => 'select',
                'title'    => __('Shop Loop Position', 'woocommerce-quick-view'),
                'subtitle' => __('Specify the positon of the quick view button in the shop loop.', 'woocommerce-quick-view'),
                'default'  => 'woocommerce_after_shop_loop_item',
                'options'  => array( 
                    'woocommerce_before_shop_loop_item' => __('before_shop_loop_item', 'woocommerce-quick-view'),
                    'woocommerce_before_shop_loop_item_title' => __('before_shop_loop_item_title', 'woocommerce-quick-view'),
                    'woocommerce_shop_loop_item_title' => __('shop_loop_item_title', 'woocommerce-quick-view'),
                    'woocommerce_after_shop_loop_item_title' => __('after_shop_loop_item_title', 'woocommerce-quick-view'),
                    'woocommerce_after_shop_loop_item' => __('after_shop_loop_item', 'woocommerce-quick-view'),
                ),
                'required' => array('enable', 'equals', '1'),
            ),
            array(
                'id'       => 'shopLoopButtonPriority',
                'type'     => 'spinner',
                'title'    => __( 'Hook Priority', 'woocommerce-quick-view' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '999',
                'default'  => '10',
                'required' => array('enable', 'equals', '1'),
            ),
            array(
                'id'       => 'shopLoopButtonText',
                'type'     => 'text',
                'title'    => __('Button Text', 'woocommerce-quick-view'),
                'subtitle' => __('e.g. Quick View'),
                'default'  => '<i class="fa fa-eye"></i> Quick View',
                'required' => array('enable', 'equals', '1'),
            ),
            array(
                'id'       => 'useDefaultTemplate',
                'type'     => 'checkbox',
                'title'    => __('Use Default Template', 'woocommerce-quick-view' ),
                'subtitle' => __('If Unchecked our plugin uses the built in template. This can be overwritten by copying the FILE public/templates/quick-view.php to your themes folder', 'woocommerce-quick-view' ),
                'default'  => '0',
                'required' => array('enable', 'equals', '1'),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('Styling', 'woocommerce-quick-view' ),
        'id'         => 'stylingSettings',
        'subsection' => true,
        'fields'     => array(
           array(
                'id'       => 'openEffect',
                'type'     => 'select',
                'title'    => __('Open Effect', 'woocommerce-quick-view'),
                'subtitle' => __('', 'woocommerce-quick-view'),
                'default'  => 'modal',
                'options'  => array( 
                    'modal' => __('Modal Window', 'woocommerce-quick-view'),
                    'inline' => __('Inline Cascading below the product', 'woocommerce-quick-view'),
                    'flyout-left' => __('Flyout Left', 'woocommerce-quick-view'),
                    'flyout-right' => __('Flyout Right', 'woocommerce-quick-view'),
                ),
            ), 
            array(
                'id'       => 'inlineScrollTo',
                'type'     => 'checkbox',
                'title'    => __('Scroll to Inline Product', 'woocommerce-quick-view' ),
                'default'  => '0',
                'required' => array('openEffect', 'equals', 'inline'),
            ),
            array(
                'id'       => 'modalArrows',
                'type'     => 'checkbox',
                'title'    => __('Show next / previous arrows', 'woocommerce-quick-view' ),
                'default'  => '1',
                'required' => array('openEffect', 'equals', 'modal'),
            ),
            array(
               'id' => 'section-modal-styles',
               'type' => 'section',
               'title' => __('Modal Styles', 'woocommerce-quick-view'),
               'subtitle' => __('Styles for the quick view modal.', 'woocommerce-quick-view'),
               'indent' => false,
            ),
            array(
                'id'       => 'modalHeightAuto',
                'type'     => 'checkbox',
                'title'    => __('Enable Content Auto Height', 'woocommerce-quick-view' ),
                'subtitle' => __('This enabled will take the product image height and set the content to this height.', 'woocommerce-quick-view' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'modalHeight',
                'type'     => 'spinner', 
                'title'    => __('Modal Max Height', 'woocommerce-quick-view'),
                'default'  => '320',
                'min'      => '1',
                'step'     => '10',
                'max'      => '1000',
                'required' => array('enable', 'equals', '0'),
            ),
            array(
                'id'       => 'modalImageWidth',
                'type'     => 'spinner', 
                'title'    => __('Modal Image Width (in %)', 'woocommerce-quick-view'),
                'default'  => '50',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
            ),
            array(
                'id'       => 'modalContentWidth',
                'type'     => 'spinner', 
                'title'    => __('Modal Content Width (in %)', 'woocommerce-quick-view'),
                'default'  => '50',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
            ),
            array(
                'id'             => 'modalPadding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px'),
                'units_extended' => 'false',
                'title'          => __('Modal Padding', 'woocommerce-pdf-catalog'),
                'subtitle'       => __('Choose the padding for the modal.', 'woocommerce-pdf-catalog'),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-right'   => '0px', 
                    'padding-bottom'  => '0px', 
                    'padding-left'    => '0px',
                    'units'          => 'px', 
                ),
            ),
            array(
                'id'        => 'modalTextColor',
                'type'      => 'color',
                'title'    => __('Modal Text Color', 'woocommerce-quick-view'), 
                'subtitle' => __('Text Color of the Modal', 'woocommerce-quick-view'),            
                'default'   => '#333333',  
            
            ),
            array(
                'id'        => 'modalBackgroundColor',
                'type'      => 'color',
                'title'    => __('Modal Background Color', 'woocommerce-quick-view'), 
                'subtitle' => __('Background Color of the Modal', 'woocommerce-quick-view'),            
                'default'   => '#FFFFFF',            
            ),
            array(
               'id' => 'section-backdrop-styles',
               'type' => 'section',
               'title' => __('Backdrop Styles', 'woocommerce-quick-view'),
               'subtitle' => __('Styles for the modal backdrop.', 'woocommerce-quick-view'),
               'indent' => false,
            ),
            array(
                'id'        => 'backdropBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Background Color', 'woocommerce-quick-view'),
                'default'   => array(
                    'color'     => '#000000',
                    'alpha'     => 0.9
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ), 
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('Data to Show', 'woocommerce-quick-view' ),
        // 'desc'       => __('Custom stylesheet / javascript.', 'woocommerce-quick-view' ),
        'id'         => 'data',
        'subsection' => true,
        'fields'     =>  array(
            array(
                'id'      => 'dataToShow',
                'type'    => 'sorter',
                'title'   => 'Data fields to Show',
                'subtitle'    => 'Reorder, enable or disable data fields.',
                'options' => $dataToShow
            ),
            array(
                'id'       => 'dataAJAXAddToCart',
                'type'     => 'checkbox',
                'title'    => __('Enable AJAX Add to Cart', 'woocommerce-quick-view'),
                'default'  => '1',
            ),
            array(
                'id'       => 'closeQuickViewAfterAddToCart',
                'type'     => 'checkbox',
                'title'    => __('Close Quick View After Add to Cart', 'woocommerce-quick-view'),
                'default'  => '0',
                'required' => array('dataAJAXAddToCart','equals','1'),
            ),
            
        )
    ) );


    $framework::setSection($opt_name, array(
        'title'      => __('Popup', 'woocommerce-quick-view'),
        'id'         => 'popup-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'popupEnable',
                'type'     => 'checkbox',
                'title'    => __('Enable Popup', 'woocommerce-quick-view'),
                'default'  => '0',
            ),
            array(
                'id'       => 'popupUseSimpleSearch',
                'type'     => 'checkbox',
                'title'    => __('Use Simple Search', 'woocommerce-quick-view'),
                'subtitle'    => __('This may speed up your site, but decreases the search matches.', 'woocommerce-quick-view'),
                'default'  => '0',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupText',
                'type'     => 'text',
                'title'    => __('Popup Text', 'woocommerce-quick-view'),
                'default'  => __('Enter SKU or Product Name ...', 'woocommerce-quick-view'),
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupBackgroundColor',
                'type' => 'color',
                'title' => __('Background Color', 'woocommerce-quick-view'), 
                'validate' => 'color',
                'default' => '#F44336',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupTextColor',
                'type' => 'color',
                'title' => __('Text Color', 'woocommerce-quick-view'), 
                'validate' => 'color',
                'default' => '#FFFFFF',
                'required' => array('popupEnable','equals','1'),
            ),
        )
    ));

    $framework::setSection( $opt_name, array(
        'title'      => __('Advanced settings', 'woocommerce-quick-view' ),
        'desc'       => __('Custom stylesheet / javascript.', 'woocommerce-quick-view' ),
        'id'         => 'advanced',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'performanceOnlyWooPages',
                'type'     => 'checkbox',
                'title'    => __('Performance: Scripts & Stylings', 'woocommerce-shop-look' ),
                'subtitle' => __('Only execute CSS & JS Files on category & shop pages. Disable when you use shortcodes.', 'woocommerce-shop-look' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'executeWooCommerceScripts',
                'type'     => 'checkbox',
                'title'    => __('Execute WooCommerce Scripts', 'woocommerce-quick-view' ),
                'subtitle' => __('Not all Themes execute the WooCommerce scripts on all pages, that are required for the add to cart. Enable that to avoid add to cart errors.', 'woocommerce-quick-view' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'customCSS',
                'type'     => 'ace_editor',
                'mode'     => 'css',
                'title'    => __('Custom CSS', 'woocommerce-quick-view' ),
                'subtitle' => __('Add some stylesheet if you want.', 'woocommerce-quick-view' ),
            ),
            array(
                'id'       => 'customJS',
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'title'    => __('Custom JS', 'woocommerce-quick-view' ),
                'subtitle' => __('Add some javascript if you want.', 'woocommerce-quick-view' ),
            ),           
        )
    ));


    /*
     * <--- END SECTIONS
     */
