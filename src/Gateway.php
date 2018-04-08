<?php

/**
 * CashBaBa Payments Gateway
 */

namespace Omnipay\CashBaBa;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{


    /**
     * @return string
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\CompletePurchaseRequest', $parameters);
    }
}
