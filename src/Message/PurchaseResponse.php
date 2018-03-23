<?php
/**
 * Created by PhpStorm.
 * User: R041604014
 * Date: 3/22/2018
 * Time: 6:54 PM
 */

namespace Omnipay\CashBaBa\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;


class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $endpoint = 'https://sanapi.cashbaba.com.bd/api/Payment/Sale';

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->endpoint.'?'.http_build_query($this->data);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }
}
