<?php
namespace MonoGateway;

class Response {
    protected $order_id;
    protected $status;
    protected $invoiceId;

    public function __construct($data)
    {
        $this->order_id = $data['reference'];
        $this->status = $data['status'];
        $this->invoiceId = $data['invoiceId'];
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getInvoiceId() {
        return $this->invoiceId;
    }

    public function isComplete () {

        return $this->status == "success";
    }

    /*public function isRefundable () {

        return $this->is_refundable;
    }*/
}