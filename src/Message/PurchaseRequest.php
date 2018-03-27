<?php

namespace Omnipay\CashBaba\Message;

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
		
        $data['MerchantId'] 			= $this->getMerchantId();
        $data['MerchantKey'] 			= $this->getMerchantKey();
        $data['NoOfItems'] 				= $this->getQuantity();
        $data['OrderId'] 				= $this->getOrderId();
        $data['OrderAmount'] 			= $this->getAmount();
        $data['ExpectedSettlementDate'] = $this->getExpectedSettlementDate();
        $data['ReturnUrl'] 				= $this->getReturnUrl();
		
		
        /*$data['cart_order_id'] = $this->getTransactionId();
        $data['merchant_order_id'] = $this->getTransactionId();
        $data['total'] = $this->getAmount();
        $data['tco_currency'] = $this->getCurrency();
		
        $data['quantity'] = $this->getQuantity();
        $data['orderId'] = $this->getOrderId();
        $data['expectedSettlementDate'] = $this->getExpectedSettlementDate();
		
        $data['fixed'] = 'Y';
        $data['skip_landing'] = 1; */
       

		
		
        if ($this->getCard()) {
            $data['card_holder_name'] = $this->getCard()->getName();
            $data['street_address'] = $this->getCard()->getAddress1();
            $data['street_address2'] = $this->getCard()->getAddress2();
            $data['city'] = $this->getCard()->getCity();
            $data['state'] = $this->getCard()->getState();
            $data['zip'] = $this->getCard()->getPostcode();
            $data['country'] = $this->getCard()->getCountry();
            $data['phone'] = $this->getCard()->getPhone();
            $data['email'] = $this->getCard()->getEmail();
        }

        if ($this->getTestMode()) {
            $data['demo'] = 'Y';
        }
		
		/*echo "<pre>";
			print_r($data);
		echo "</pre>";
		exit; */

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
