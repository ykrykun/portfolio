<?php

namespace Qodax\CheckoutManager\Modules;

use Qodax\CheckoutManager\DB\Repositories\CheckoutFieldRepository;
use Qodax\CheckoutManager\Factories\FieldFactory;

if ( ! defined('ABSPATH')) {
    exit;
}

class Checkout extends AbstractModule
{
    /**
     * @var CheckoutFieldRepository
     */
    private $checkoutFieldRepository;

    public function __construct(CheckoutFieldRepository $checkoutFieldRepository)
    {
        $this->checkoutFieldRepository = $checkoutFieldRepository;
    }

    public function boot(): void
    {
        add_filter('woocommerce_checkout_fields' , [ $this, 'overrideCheckoutFields' ]);
        add_filter('woocommerce_default_address_fields' , [ $this, 'overrideDefaultFields' ]);
        add_action('woocommerce_checkout_update_order_meta', [ $this, 'updateOrderMeta' ]);
        add_action('woocommerce_admin_order_data_after_billing_address', [ $this, 'displayBillingOrderMeta' ]);
        add_action('woocommerce_admin_order_data_after_shipping_address', [ $this, 'displayShippingOrderMeta' ]);
        add_action('wp_head', [ $this, 'injectCheckoutStyles' ]);
    }

    public function overrideCheckoutFields(array $fields)
    {
        $dbFields = $this->checkoutFieldRepository->all();

        foreach ($dbFields as $dbField) {
            $checkoutField = FieldFactory::fromDB($dbField);

            if ($checkoutField->isActive()) {
                $fields[$dbField['section']][$dbField['field_name']] = $checkoutField->toWooCommerce();
            }
            else {
                unset($fields[$dbField['section']][$dbField['field_name']]);
            }
        }

        return $fields;
    }

    public function updateOrderMeta($orderId)
    {
        $fields = $this->checkoutFieldRepository->getCustomFields();

        foreach ($fields as $field) {
            $key = $field['field_name'];

            if ( ! empty($_POST[$key])) {
                update_post_meta($orderId, $key, sanitize_text_field($_POST[$key]));
            }
        }
    }

    public function displayBillingOrderMeta(\WC_Order $order)
    {
        $this->displayAdminOrderMeta($order, 'billing');
    }

    public function displayShippingOrderMeta(\WC_Order $order)
    {
        $this->displayAdminOrderMeta($order, 'shipping');
    }

    public function overrideDefaultFields($fields)
    {
        // todo: provide method to disable default fields validation

        return $fields;
    }

    public function injectCheckoutStyles()
    {
        if (get_option('qxcm_column_layout') === '1-column') {
            ?>
            <style>
                .woocommerce .woocommerce-checkout .col2-set .col-1,
                .woocommerce .woocommerce-checkout .col2-set .col-2 {
                    width: 100% !important;
                }

                .woocommerce .woocommerce-checkout .col2-set .col-1 {
                    margin-bottom: 30px;
                }
            </style>
            <?php
        }
    }

    private function displayAdminOrderMeta(\WC_Order $order, string $section)
    {
        $fields = $this->checkoutFieldRepository->findBySection($section);

        foreach ($fields as $field) {
            if ((int)$field['native']) {
                continue;
            }

            $checkoutField = FieldFactory::fromDB($field);
            $label = $checkoutField->getMeta('label', $checkoutField->name);
            $metaValue = get_post_meta($order->get_id(), $checkoutField->name, true);

            if ($metaValue) {
                echo '<p><strong>' . esc_html($label) . ':</strong> ' . esc_html($metaValue) . '</p>';
            }
        }
    }
}