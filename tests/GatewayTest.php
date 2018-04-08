<?php

namespace Omnipay\CashBaBa;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
     const MERCHANTID = '19800';
     const MERCHANTKEY = 'T6F%Hi34jv';
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setMerchantId(GatewayTest::MERCHANTID);
        $this->gateway->setMerchantKey(GatewayTest::MERCHANTKEY);

        $this->gateway->setQuantity('1');
        $this->gateway->setOrderId('2');
        $this->gateway->setExpectedSettlementDate('03-27-2018');

        $this->options = array(
            'amount' => '100.00',
            'returnUrl' => 'https://www.example.com/return',
        );
    }

    public function testPurchase()
    {
        $source = new CreditCard;
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
        $this->assertContains($response->getRedirectUrl());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectData());
    }


    public function testCompletePurchaseError()
    {
        $this->getHttpRequest()->request->replace(array('order_number' => '5', 'key' => 'SSS'));

        $response = $this->gateway->completePurchase($this->options)->send();
    }

    public function testCompletePurchaseSuccess()
    {
        $this->getHttpRequest()->request->replace(
            array(
                'order_number' => '5',
                'key' => md5('ss123456510.00'),
            )
        );

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('5', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
