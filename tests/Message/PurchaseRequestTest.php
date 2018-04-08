<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    const MERCHANTID = '19800';
    const MERCHANTKEY = 'T6F%Hi34jv';
    const RETURNURL = 'https://www.example.com/return';
    public function testConstruct()
    {
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->setMerchantId(PurchaseRequestTest::MERCHANTID);
        $request->setMerchantKey(PurchaseRequestTest::MERCHANTKEY);
        $request->setQuantity('1');
        $request->setExpectedSettlementDate('03-27-2018');
        $request->setAmount('100.00');
        $request->setReturnUrl('http://example.com/return');
        $requestData = $request->getData();
        $this->assertEquals($requestData['MerchantId'], PurchaseRequestTest::MERCHANTID);
        $this->assertEquals($requestData['MerchantKey'], PurchaseRequestTest::MERCHANTKEY);
        $this->assertEquals($requestData['NoOfItems'], '1');
        $this->assertEquals($requestData['OrderId'], null);
        $this->assertEquals($requestData['OrderAmount'], '100.00');
        $this->assertEquals($requestData['ExpectedSettlementDate'], '03-27-2018');
        $this->assertEquals($requestData['ReturnUrl'], 'http://example.com/return');
    }
}
