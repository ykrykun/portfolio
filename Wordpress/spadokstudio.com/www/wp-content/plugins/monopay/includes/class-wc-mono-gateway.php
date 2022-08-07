<?php
use MonoGateway\Order;
use MonoGateway\Payment;

class WC_Gateway_Mono extends WC_Payment_Gateway
{
    private $token;
    //private $api_url;

    public function __construct()
    {
        loadMonoLibrary();

        $this->id = 'mono_gateway';
        $this->icon = apply_filters('woocommerce_mono_icon', '');
        $this->has_fields = true;
        $this->method_title = _x('Monobank Payment', 'womono');
        $this->method_description = __('Accept credit card payments on your website via Monobank payment gateway.', 'womono');
        $this->supports[] = 'refunds';

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description  = $this->get_option( 'description' );
        $this->token = $this->get_option('API_KEY');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_api_mono_gateway', array($this, 'callback_success'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title' => __( 'Enable/Disable', 'womono' ),
                'type' => 'checkbox',
                'label' => __( 'Enable MonoGateway Payment', 'womono' ),
                'default' => 'yes'
            ),
            'title' => array(
                'title' => __( 'Title', 'womono' ),
                'type' => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'womono' ),
                'default' => __( 'Mono pay', 'womono' ),
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => __( 'Description', 'womono' ),
                'type' => 'text',
                'desc_tip' => true,
                'description' => __( 'This controls the description which the user sees during checkout.', 'womono' ),
                'default' => __( "Оплата Банківською карткою (Visa,Mastercard).", 'womono' ),
            ),
            'API_KEY' => array(
                'title' => __( 'Api token', 'womono' ),
                'type' => 'text',
                'description' => __( 'You can find out your X-Token by the link: <a href="https://web.monobank.ua/" target="blank">web.monobank.ua</a>', 'womono' ),
                'default' => '',
            )
        );
    }

    public function get_icon() {
        /*$image_url =  MONOGATEWAY_PATH . 'assets/images/monobank.svg';
        $icon_html = '<img src="' . $image_url . '" alt="MonoGateway mark" />';
        return apply_filters( 'woocommerce_gateway_icon', $icon_html, $this->id );*/
    }

    public function process_payment( $order_id ) {

        $token = $this->getToken();

        global $woocommerce;

        $order = new WC_Order( $order_id );

        $cart_info = $woocommerce->cart->get_cart();
        $basket_info = [];

        foreach ($cart_info as $product) {

            $image_elem = $product['data']->get_image();
            $image = [];
            preg_match_all('/src="(.+)" class/', $image_elem, $image);

            $basket_info[] = [
                "name" => $product['data']->name,
                "qty"  => $product['quantity'],
                "sum"  => round($product['line_total']*100),
                "icon" => $image[1][0]
            ];
        }

        $monoOrder = new Order();
        $monoOrder->setId($order->get_id());
        //$monoOrder->setCurrency($order->get_currency());
        $monoOrder->setReference($order->get_id());
        //$monoOrder->setDestination('Test');
        $monoOrder->setAmount(round($order->get_total()*100));
        $monoOrder->setBasketOrder($basket_info);
        $monoOrder->setRedirectUrl('https://' . $_SERVER['HTTP_HOST'] . '/checkout/order-received');
        $monoOrder->setWebHookUrl('https://' . $_SERVER['HTTP_HOST'] . '/?wc-api=mono_gateway');

        $payment = new Payment($token);
        $payment->setOrder($monoOrder);

        try {
            $invoice = $payment->create();
            if ( !empty($invoice) ) {
                if ($order->get_status() != 'pending') {
                    $order->update_status('pending');
                }

            } else {
                throw new \Exception("Bad request");
            }
        } catch (\Exception $e) {
            wc_add_notice(  'Request error ('. $e->getMessage() . ')', 'error' );
            return false;
        }
        return [
            'result'   => 'success',
            'redirect' => $invoice->pageUrl,
        ];
    }

    public function callback_success() {

        $callback_json = @file_get_contents('php://input');

        $callback = json_decode($callback_json, true);

        $response = new \MonoGateway\Response($callback);

        if($response->isComplete()) {
            global $woocommerce;

            $order_id = (int)$response->getOrderId();
            $order = new WC_Order( $order_id );

            $woocommerce->cart->empty_cart();

            $order->payment_complete($response->getInvoiceId());
        }
    }

    public function can_refund_order( $order ) {

        $has_api_creds = $this->get_option( 'API_KEY' );
        return $order && $order->get_transaction_id() && $has_api_creds;

    }

    public function process_refund( $order_id, $amount = null, $reason = '' ) {

        $order = wc_get_order( $order_id );
        $transaction_id = $order->get_transaction_id();

        if ( ! $this->can_refund_order( $order ) ) {
            return new WP_Error( 'error', __( 'Refund failed.', 'womono' ) );
        }

        $token = $this->getToken();
        $payment = new Payment($token);
        $refund_order = array(
            "invoiceId" => $transaction_id,
            "amount" => $amount*100
        );
        $payment->setRefundOrder($refund_order);
        try {
            $result = $payment->cancel();
            if ( is_wp_error( $result ) ) {
                //$this->log( 'Refund Failed: ' . $result->get_error_message(), 'error' );
                return new WP_Error( 'error', $result->get_error_message() );
            }
            if ($result->stage == "c") {
                $order->add_order_note(
                    sprintf( __( 'Refunded %1$s - Refund ID: %2$s', 'womono' ), $amount, $result->cancelRef )
                );
                return true;
            }
        } catch (\Exception $e) {
            wc_add_notice('Request error (' . $e->getMessage() . ')', 'error');
            return false;
        }
        return false;
    }

    /*protected function getApiUrl() {
        return $this->api_url;
    }*/

    protected function getToken() {
        return $this->token;
    }

}
