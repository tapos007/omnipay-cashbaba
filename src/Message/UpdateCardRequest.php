<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/29/2018
 * Time: 12:04 PM
 */

namespace Omnipay\CashBaBa\Message;


use Omnipay\Common\Exception\InvalidRequestException;

class UpdateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('cardReference');
        $this->validate('customerReference');
        if ($this->getCard()) {
            return $this->getCardData();
        } else {
            return array();
        }
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
        return 'POST';
    }


    public function getEndpoint()
    {
        return $this->endpoint.'/customers/'.$this->getCustomerReference().
            '/cards/'.$this->getCardReference();
    }
    /**
     * Get the card data.
     *
     * This request uses a slightly different format for card data to
     * the other requests and does not require the card data to be
     * complete in full (or valid).
     *
     * @return array
     */
    protected function getCardData()
    {
        $data = array();
        $card = $this->getCard();
        if (!empty($card)) {
            if ($card->getExpiryMonth()) {
                $data['ExpiryMonth'] = $card->getExpiryMonth();
            }
            if ($card->getExpiryYear()) {
                $data['ExpiryYear'] = $card->getExpiryYear();
            }
            if ($card->getFirstName()) {
                $data['FirstName'] = $card->getFirstName();
            }
            if ($card->getLastName()) {
                $data['LastName'] = $card->getLastName();
            }
            if ($card->getNumber()) {
                $data['number'] = $card->getNumber();
            }
            if ($card->getAddress1()) {
                $data['BillingAddress'] = $card->getAddress1();
            }
            if ($card->getCity()) {
                $data['BillingCity'] = $card->getCity();
            }
            if ($card->getPostcode()) {
                $data['BillingPostalCode'] = $card->getPostcode();
            }
            if ($card->getState()) {
                $data['BillingState'] = $card->getState();
            }
            if ($card->getCountry()) {
                $data['BillingCountry'] = $card->getCountry();
            }
        }
        return $data;
    }
}