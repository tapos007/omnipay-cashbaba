<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\CashBaBa\GatewayTest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    public function testConstruct()
    {
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->setMerchantId(GatewayTest::MERCHANTID);
        $request->setMerchantKey(GatewayTest::MERCHANTKEY);
        $request->setQuantity('1');
        $request->setExpectedSettlementDate('03-27-2018');
        $request->setAmount('100.00');
        $request->setReturnUrl('http://example.com/return');
        $requestData = $request->getData();
        $this->assertEquals($requestData['MerchantId'], GatewayTest::MERCHANTID);
        $this->assertEquals($requestData['MerchantKey'], GatewayTest::MERCHANTKEY);
        $this->assertEquals($requestData['NoOfItems'], '1');
        $this->assertEquals($requestData['OrderId'], '2');
        $this->assertEquals($requestData['OrderAmount'], '100.00');
        $this->assertEquals($requestData['ExpectedSettlementDate'], '03-27-2018');
        $this->assertEquals($requestData['ReturnUrl'], 'http://example.com/return');
    }
}
