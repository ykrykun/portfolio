<?php
namespace MonoGateway;

class Payment {

    private $token;
    protected $order;
    protected $refund_order = null;

    const API_URL = "https://api.monobank.ua/api/merchant";

    public function __construct($token) {
        $this->token = $token;
    }

    protected function _apiRequest($endpoint, $post_fields, $invoice_id = null) {

        $url = self::API_URL . $endpoint;
        if ($endpoint == "/invoice/status" && $invoice_id) {
            $url .= "/$invoice_id";
        }

        $headers = array(
            'Content-type'  => 'application/json',
            'X-Token' => $this->token,
        );

        $body = apply_filters('convertkit-call-args', $post_fields);

        $args = array(
            'method'      => ($endpoint == "/invoice/status") ? 'GET' : 'POST',
            'body'        => json_encode($body),
            'headers'     => $headers,
            'user-agent'  => 'WooCommerce/' . WC()->version,
        );

        $request = wp_safe_remote_post($url, $args);

        if ($request === false) {
            throw new \Exception("Connection error");
        }

        return json_decode($request['body']);
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function create() {
        $body = array(
            'amount' => $this->order->getAmount(),
            'ccy' => $this->order->getCurrency(),
            'merchantPaymInfo' => array(
                'reference' => $this->order->getReference(),
                'destination' => $this->order->getDestination(),
                'basketOrder' => $this->order->getBasketOrder(),
            ),
            'redirectUrl' => $this->order->getRedirectUrl(),
            'webHookUrl' => $this->order->getWebHookUrl()
        );
        $response = $this->_apiRequest("/invoice/create", $body);
        return $response;
    }

    public function getStatus() {}

    public function setRefundOrder($refund_order) {
        $this->refund_order = $refund_order;
    }

    public function cancel() {
        $response = $this->_apiRequest("/cancel", $this->refund_order);
        return $response;
    }

}