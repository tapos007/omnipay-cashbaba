<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    public function testConstruct()
    {
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->setMerchantId('990040129');
        $request->setMerchantKey('73ICB:M1Z9');
        $request->setQuantity('1');
        $request->setExpectedSettlementDate('03-27-2018');
        $request->setAmount('100.00');
        $request->setReturnUrl('http://example.com/return');
        $requestData = $request->getData();
        $this->assertEquals($requestData['MerchantId'], '990040129');
        $this->assertEquals($requestData['MerchantKey'], '73ICB:M1Z9');
        $this->assertEquals($requestData['NoOfItems'], '1');
        $this->assertEquals($requestData['OrderId'], '2');
        $this->assertEquals($requestData['OrderAmount'], '100.00');
        $this->assertEquals($requestData['ExpectedSettlementDate'], '03-27-2018');
        $this->assertEquals($requestData['ReturnUrl'], 'http://example.com/return');
    }
}
