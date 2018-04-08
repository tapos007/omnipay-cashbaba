<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * cashBaBa Complete Purchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $orderNo = $this->httpRequest->request->get('order_number');


        if ($this->getTestMode()) {
            $orderNo = '1';
        }

        $key = md5($this->getMerchantKey() . $this->getMerchantId() . $orderNo . $this->getAmount());
        if (strtolower($this->httpRequest->request->get('key')) !== $key) {

            throw new InvalidResponseException('Invalid key');
        }

        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
