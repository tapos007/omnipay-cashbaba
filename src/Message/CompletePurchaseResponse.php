<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * CashBaba Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return true;
    }

    public function getTransactionReference()
    {
        return isset($this->data['order_number']) ? $this->data['order_number'] : null;
    }
}
