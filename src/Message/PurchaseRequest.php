<?php
/**
 * Created by PhpStorm.
 * User: R041604014
 * Date: 3/22/2018
 * Time: 6:37 PM
 */

namespace Omnipay\CashBaBa\Message;


use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }
}