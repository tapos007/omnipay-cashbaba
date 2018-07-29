<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/29/2018
 * Time: 10:54 AM
 */

namespace Omnipay\CashBaBa\Message;


use Omnipay\Common\Exception\InvalidRequestException;

class DeleteCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('customerReference');


        if($this->getCardReference() && $this->getCardReference()==""){
            $this->validate('cardReference');
        }

        return;
    }

    public function validate()
    {
        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (! isset($value)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
            if($value==""){
                throw new InvalidRequestException("The $key value is required");
            }
        }
    }
    public function getHttpMethod()
    {
        return 'DELETE';
    }
    public function getEndpoint()
    {
        if ($this->getCustomerReference() && $this->getCardReference()) {
            // Delete a card from a customer
            return $this->endpoint.'/customers/'.
                $this->getCustomerReference().'/cards/'.
                $this->getCardReference();
        }
        // Delete the customer.  Oops?
        return $this->endpoint.'/customers/'.$this->getCustomerReference();
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = array();
        return $headers;
    }
}