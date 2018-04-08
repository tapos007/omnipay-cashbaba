<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $request = $this->getMockRequest();
        $request->shouldReceive()->andReturn(false);

        $response = new Purchaseresponse($request);

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
        $this->assertSame($response->getRedirectUrl());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectData());
    }
}
