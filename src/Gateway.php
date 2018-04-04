<?php

namespace Omnipay\CashBaba;

use Omnipay\Common\AbstractGateway;
use Omnipay\CashBaba\Message\CompletePurchaseRequest;
use Omnipay\CashBaba\Message\PurchaseRequest;



/**
 * Cashbaba Gateway.
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the Cashbaba Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('CashBaba');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'merchantId' => 'MymerchantId',
 *       'merchantKey' => 'MymerchantKey',
 *       'quantity' => 'Quantity',
 *       'orderId' => 'OrderId',
 *       'expectedSettlementDate' => 'ExpectedSettlementDate'
 *   ));
 *
 *
 *   // Do a purchase transaction on the gateway
 *   $transaction = $gateway->purchase(array(
 *       'amount'                   => '100.00',
 *       'currency'                 => 'USD',
 *       'returnUrl'                => 'http://omnipay-cashbaba.test/success.php'
 *   ));
 *   $response = $transaction->send();
 *
 * Then your given link 'http://omnipay-cashbaba.test/success.php' (success.php)
 *   <pre>
 *      print_r($_POST);
 *   </pre>
 *
 * </code>
 *
 */




class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'cashbaba';
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
        return $this->createRequest('\Omnipay\CashBaba\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaba\Message\CompletePurchaseRequest', $parameters);
    }
}
