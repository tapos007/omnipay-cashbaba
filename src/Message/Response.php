<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/28/2018
 * Time: 2:27 PM
 */

namespace Omnipay\CashBaBa\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;
    /**
     * @var array
     */
    protected $headers = [];
    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }
    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {

        return !isset($this->data['Error']) && !isset($this->data['Message']);
    }
    /**
     * Get the charge reference from the response of FetchChargeRequest.
     *
     * @see \Omnipay\cashbaba\Message\Response::getTransactionReference()
     * @return array|null
     */
    public function getChargeReference()
    {
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the outcome of a charge from the response
     *
     * @return array|null
     */
    public function getOutcome()
    {
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            if (isset($this->data['outcome']) && !empty($this->data['outcome'])) {
                return $this->data['outcome'];
            }
        }
        return null;
    }
    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            return $this->data['id'];
        }
        if (isset($this->data['error']) && isset($this->data['error']['charge'])) {
            return $this->data['error']['charge'];
        }
        return null;
    }
    /**
     * Get the balance transaction reference.
     *
     * @return string|null
     */
    public function getBalanceTransactionReference()
    {
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            return $this->data['balance_transaction'];
        }
        if (isset($this->data['object']) && 'balance_transaction' === $this->data['object']) {
            return $this->data['id'];
        }
        if (isset($this->data['error']) && isset($this->data['error']['charge'])) {
            return $this->data['error']['charge'];
        }
        return null;
    }
    /**
     * Get a customer reference, for createCustomer requests.
     *
     * @return string|null
     */
    public function getCustomerReference()
    {
        if (isset($this->data['Object']) && 'customer' === $this->data['Object']) {
            return $this->data['id'];
        }
        if (isset($this->data['Object']) && 'card' === $this->data['Object']) {
            if (!empty($this->data['Customer'])) {
                return $this->data['Customer'];
            }
        }
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            if (!empty($this->data['Customer'])) {
                return $this->data['Customer'];
            }
        }
        return null;
    }
    /**
     * Get a card reference, for createCard or createCustomer requests.
     *
     * @return string|null
     */
    public function getCardReference()
    {
        if (isset($this->data['object']) && 'customer' === $this->data['object']) {
            if (isset($this->data['default_source']) && !empty($this->data['default_source'])) {
                return $this->data['default_source'];
            }
            if (isset($this->data['default_card']) && !empty($this->data['default_card'])) {
                return $this->data['default_card'];
            }

            if (!empty($this->data['id'])) {
                return $this->data['id'];
            }
        }
        if (isset($this->data['Object']) && 'card' === $this->data['Object']) {
            if (!empty($this->data['CardToken'])) {
                return $this->data['CardToken'];
            }
        }
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            if (! empty($this->data['source'])) {
                if (! empty($this->data['source']['id'])) {
                    return $this->data['source']['id'];
                }
            }
        }
        return null;
    }
    /**
     * Get a token, for createCard requests.
     *
     * @return string|null
     */
    public function getToken()
    {
        if (isset($this->data['object']) && 'token' === $this->data['object']) {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the card data from the response.
     *
     * @return array|null
     */
    public function getCard()
    {
        if (isset($this->data['card'])) {
            return $this->data['card'];
        }
        return null;
    }
    /**
     * Get the card data from the response of purchaseRequest.
     *
     * @return array|null
     */
    public function getSource()
    {
        if (isset($this->data['source']) && $this->data['source']['object'] == 'card') {
            return $this->data['source'];
        }
        return null;
    }
    /**
     * Get the subscription reference from the response of CreateSubscriptionRequest.
     *
     * @return array|null
     */
    public function getSubscriptionReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'subscription') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the event reference from the response of FetchEventRequest.
     *
     * @return array|null
     */
    public function getEventReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'event') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the invoice reference from the response of FetchInvoiceRequest.
     *
     * @return array|null
     */
    public function getInvoiceReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'invoice') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the transfer reference from the response of CreateTransferRequest,
     * UpdateTransferRequest, and FetchTransferRequest.
     *
     * @return array|null
     */
    public function getTransferReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'transfer') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the transfer reference from the response of CreateTransferReversalRequest,
     * UpdateTransferReversalRequest, and FetchTransferReversalRequest.
     *
     * @return array|null
     */
    public function getTransferReversalReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'transfer_reversal') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the list object from a result
     *
     * @return array|null
     */
    public function getList()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'list') {
            return $this->data['data'];
        }
        return null;
    }
    /**
     * Get the subscription plan from the response of CreateSubscriptionRequest.
     *
     * @return array|null
     */
    public function getPlan()
    {
        if (isset($this->data['plan'])) {
            return $this->data['plan'];
        } elseif (array_key_exists('object', $this->data) && $this->data['object'] == 'plan') {
            return $this->data;
        }
        return null;
    }
    /**
     * Get plan id
     *
     * @return string|null
     */
    public function getPlanId()
    {
        $plan = $this->getPlan();
        if ($plan && array_key_exists('id', $plan)) {
            return $plan['id'];
        }
        return null;
    }
    /**
     * Get invoice-item reference
     *
     * @return string|null
     */
    public function getInvoiceItemReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'invoiceitem') {
            return $this->data['id'];
        }
        return null;
    }
    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful() && ((isset($this->data['Error']) && isset($this->data['Error']['Message'])) || isset($this->data['Message']))) {

           if(isset($this->data['Error'])){
               return $this->data['Error']['Message'];
           }

           if(isset($this->data['Message'])){
               return $this->data['Message'];
           }

        }
        return null;
    }
    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getCode()
    {

        if (!$this->isSuccessful() && isset($this->data['Error']) && isset($this->data['Error']['Code'])) {
            return $this->data['Error']['code'];
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getRequestId()
    {
        if (isset($this->headers['Request-Id'])) {
            return $this->headers['Request-Id'][0];
        }
        return null;
    }


    /**
     * Get the response of delete card.
     *
     * @return string|null
     */
    public function getCardorCustomerDeleteResponse()
    {
        if (isset($this->data['Object']) && $this->data['Object'] == 'deletecard') {
            return $this->data['Information'];
        }
        if (isset($this->data['Object']) && $this->data['Object'] == 'deletecustomer') {
            return $this->data['Information'];
        }
        return null;
    }
}