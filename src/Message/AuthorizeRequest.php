<?php

namespace Omnipay\CashBaBa\Message;
use Money\Formatter\DecimalMoneyFormatter;

/**
 * CashBaBa Authorize Request.
 *
 * An Authorize request is similar to a purchase request but the
 * charge issues an authorization (or pre-authorization), and no money
 * is transferred.  The transaction will need to be captured later
 * in order to effect payment. Uncaptured charges expire in 7 days.
 *
 * Either a customerReference or a card is required.  If a customerReference
 * is passed in then the cardReference must be the reference of a card
 * assigned to the customer.  Otherwise, if you do not pass a customer ID,
 * the card you provide must either be a token, like the ones returned by
 * CashBaba.js, or a dictionary containing a user's credit card details.
 *
 * IN OTHER WORDS: You cannot just pass a card reference into this request,
 * you must also provide a customer reference if you want to use a stored
 * card.
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the CashBaBa Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('CashBaBa');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'apiKey' => 'MyApiKey',
 *   ));
 *
 *   // Create a credit card object
 *   // This card can be used for testing.
 *   $card = new CreditCard(array(
 *               'firstName'    => 'Example',
 *               'lastName'     => 'Customer',
 *               'number'       => '4242424242424242',
 *               'expiryMonth'  => '01',
 *               'expiryYear'   => '2020',
 *               'cvv'          => '123',
 *               'email'                 => 'customer@example.com',
 *               'billingAddress1'       => '1 Scrubby Creek Road',
 *               'billingCountry'        => 'AU',
 *               'billingCity'           => 'Scrubby Creek',
 *               'billingPostcode'       => '4999',
 *               'billingState'          => 'QLD',
 *   ));
 *
 *   // Do an authorize transaction on the gateway
 *   $transaction = $gateway->authorize(array(
 *       'amount'                   => '10.00',
 *       'currency'                 => 'USD',
 *       'description'              => 'This is a test authorize transaction.',
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Authorize transaction was successful!\n";
 *       $sale_id = $response->getTransactionReference();
 *       echo "Transaction reference = " . $sale_id . "\n";
 *   }
 * </code>
 *
 */
class AuthorizeRequest extends AbstractRequest
{

    protected $endpoint = 'http://localhost:62048/api/transactions';
    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->getParameter('destination');
    }
    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setDestination($value)
    {
        return $this->setParameter('destination', $value);
    }
    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->getParameter('source');
    }
    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setSource($value)
    {
        return $this->setParameter('source', $value);
    }
    /**
     * Connect only
     *
     * @return mixed
     */
    public function getTransferGroup()
    {
        return $this->getParameter('transferGroup');
    }
    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setTransferGroup($value)
    {
        return $this->setParameter('transferGroup', $value);
    }
    /**
     * Connect only
     *
     * @return mixed
     */
    public function getOnBehalfOf()
    {
        return $this->getParameter('onBehalfOf');
    }


    /**
     * Connect only
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('order_id');
    }


    public function setOrderId($value)
    {
        return $this->setParameter('order_id',$value);
    }


    /**
     * Connect only
     *
     * @return mixed
     */
    public function getCVV()
    {
        return $this->getParameter('cvv');
    }


    public function setCVV($value)
    {
        return $this->setParameter('cvv',$value);
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setOnBehalfOf($value)
    {
        return $this->setParameter('onBehalfOf', $value);
    }
    /**
     * @return string
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFee()
    {
        $money = $this->getMoney('applicationFee');
        if ($money !== null) {
            $moneyFormatter = new DecimalMoneyFormatter($this->getCurrencies());
            return $moneyFormatter->format($money);
        }
        return '';
    }
    /**
     * Get the payment amount as an integer.
     *
     * @return integer
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFeeInteger()
    {
        $money = $this->getMoney('applicationFee');
        if ($money !== null) {
            return (integer) $money->getAmount();
        }
        return 0;
    }
    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApplicationFee($value)
    {
        return $this->setParameter('applicationFee', $value);
    }
    public function getStatementDescriptor()
    {
        return $this->getParameter('statementDescriptor');
    }
    public function setStatementDescriptor($value)
    {
        $value = str_replace(array('<', '>', '"', '\''), '', $value);
        return $this->setParameter('statementDescriptor', $value);
    }
    /**
     * @return mixed
     */
    public function getReceiptEmail()
    {
        return $this->getParameter('receipt_email');
    }
    /**
     * @param mixed $email
     * @return $this
     */
    public function setReceiptEmail($email)
    {
        $this->setParameter('receipt_email', $email);
        return $this;
    }
    public function getData()
    {
        $this->validate('amount', 'currency');
        $data = array();
        $data['amount'] = $this->getAmountInteger();
        $data['currency'] = strtolower($this->getCurrency());
        $data['description'] = $this->getDescription();
        $data['metadata'] = $this->getMetadata();
        $data['capture'] = 'false';
        if ($this->getStatementDescriptor()) {
            $data['statement_descriptor'] = $this->getStatementDescriptor();
        }
        if ($this->getDestination()) {
            $data['destination'] = $this->getDestination();
        }
        if ($this->getOnBehalfOf()) {
            $data['on_behalf_of'] = $this->getOnBehalfOf();
        }
        if ($this->getApplicationFee()) {
            $data['application_fee'] = $this->getApplicationFeeInteger();
        }
        if ($this->getTransferGroup()) {
            $data['transfer_group'] = $this->getTransferGroup();
        }
        if ($this->getReceiptEmail()) {
            $data['receipt_email'] = $this->getReceiptEmail();
        }
        if ($this->getSource()) {
            $data['source'] = $this->getSource();
        } elseif ($this->getCardReference()) {
            $data['source'] = $this->getCardReference();
            if ($this->getCustomerReference()) {
                $data['customer'] = $this->getCustomerReference();
            }
        } elseif ($this->getToken()) {
            $data['source'] = $this->getToken();
            if ($this->getCustomerReference()) {
                $data['customer'] = $this->getCustomerReference();
            }
        } elseif ($this->getCard()) {
            $data['source'] = $this->getCardData();
        } elseif ($this->getCustomerReference()) {
            $data['customer'] = $this->getCustomerReference();
        } else {
            // one of cardReference, token, or card is required
            $this->validate('source');
        }
        return $data;
    }
    public function getEndpoint()
    {
        return $this->endpoint.'/charges';
    }
}