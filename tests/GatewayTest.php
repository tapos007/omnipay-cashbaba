<?php

namespace Omnipay\CashBaBa;
use Omnipay\Tests\GatewayTestCase;


class GatewayTest extends GatewayTestCase
{
     const MERCHANTID = '19800';
     const MERCHANTKEY = 'T6F%Hi34jv';
     const RETURNURL = 'https://www.example.com/return';
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
            'returnUrl' => GatewayTest::RETURNURL,
        );

    }

    public function testPurchase()
    {

        $request = $this->gateway->purchase($this->options);
        $this->assertInstanceOf( 'Omnipay\CashBaBa\Message\PurchaseRequest', $request );
        $this->assertSame( '100.00', $request->getAmount() );
        $this->assertSame( GatewayTest::RETURNURL, $request->getReturnUrl() );
    }



}
