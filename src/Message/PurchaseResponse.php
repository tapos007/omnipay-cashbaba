<?php

namespace Omnipay\CashBaBa\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * CashBaBa Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $endpoint = 'https://sanapi.cashbaba.com.bd/api/Payment/Sale';

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {

        $query = http_build_query($this->data);

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => $query,
            ),
        ));

        $response = file_get_contents(
            $target = $this->endpoint,
            $use_include_path = false,
            $context
        );

        $receivedData = json_decode($response, true);


        $url = $receivedData['RedirectUrl'];

        $msg = $receivedData['Message'];

        if ($msg == 'Ok') {
            header('Location:' . $url);

        } else {
            echo $msg;
        }
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return null;
    }
}
