<?php
/**
 * Created by PhpStorm.
 * User: R041604014
 * Date: 3/22/2018
 * Time: 6:50 PM
 */

namespace Omnipay\CashBaBa\Message;
use Omnipay\Common\Message\AbstractResponse;


class CompletePurchaseResponse  extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }

    public function getTransactionReference()
    {
        return isset($this->data['order_number']) ? $this->data['order_number'] : null;
    }
}