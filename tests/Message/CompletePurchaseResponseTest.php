<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new CompletePurchaseresponse($this->getMockRequest(), array('order_number' => '2'));

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('2', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
