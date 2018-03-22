<?php
/**
 * Created by PhpStorm.
 * User: R041604014
 * Date: 3/22/2018
 * Time: 6:14 PM
 */

namespace Omnipay\CashBaBa;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{


    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'CashBaBa';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'merchantKey' => '',
            'testMode' => false,
        );
    }

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


    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaba\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaba\Message\CompletePurchaseRequest', $parameters);
    }
}