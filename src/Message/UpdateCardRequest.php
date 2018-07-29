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
        return 'PUT';
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
                $data['exp_month'] = $card->getExpiryMonth();
            }
            if ($card->getExpiryYear()) {
                $data['exp_year'] = $card->getExpiryYear();
            }
            if ($card->getName()) {
                $data['name'] = $card->getName();
            }
            if ($card->getNumber()) {
                $data['number'] = $card->getNumber();
            }
            if ($card->getAddress1()) {
                $data['address_line1'] = $card->getAddress1();
            }
            if ($card->getAddress2()) {
                $data['address_line2'] = $card->getAddress2();
            }
            if ($card->getCity()) {
                $data['address_city'] = $card->getCity();
            }
            if ($card->getPostcode()) {
                $data['address_zip'] = $card->getPostcode();
            }
            if ($card->getState()) {
                $data['address_state'] = $card->getState();
            }
            if ($card->getCountry()) {
                $data['address_country'] = $card->getCountry();
            }
        }
        return $data;
    }
}