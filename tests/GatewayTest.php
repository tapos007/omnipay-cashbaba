<?php

namespace Omnipay\CashBaba;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $gateway->setMerchantId('128700');
        $gateway->setMerchantKey('RZ:Logvisc');

        $gateway->setQuantity('1');
        $gateway->setOrderId('2');
        $gateway->setExpectedSettlementDate('03-27-2018');

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

    /**
     * @expectedException Omnipay\Common\Exception\InvalidResponseException
     */
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
