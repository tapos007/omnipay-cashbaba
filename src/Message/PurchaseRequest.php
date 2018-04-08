<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * CashBaba Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }


    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function setExpectedSettlementDate($value)
    {
        return $this->setParameter('expectedSettlementDate', $value);
    }


    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function getExpectedSettlementDate()
    {
        return $this->getParameter('expectedSettlementDate');
    }


    public function getData()
    {

        $this->validate('amount', 'returnUrl');

        $data = array();

        $data['MerchantId'] = $this->getMerchantId();
        $data['MerchantKey'] = $this->getMerchantKey();
        $data['NoOfItems'] = $this->getQuantity();
        $data['OrderId'] = $this->getOrderId();
        $data['OrderAmount'] = $this->getAmount();
        $data['ExpectedSettlementDate'] = $this->getExpectedSettlementDate();
        $data['ReturnUrl'] = $this->getReturnUrl();

        if ($this->getTestMode()) {
            $data['demo'] = 'Y';
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
