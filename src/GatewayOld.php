<?php

/**
 * CashBaBa Payments Gateway
 */

namespace Omnipay\CashBaBa;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{


    /**
     * @return string
     */
    public function getName()
    {
        return 'CashBaBa';
    }

    public function getDefaultParameters()
    {

        return array(
            'merchantId' => '19800',
            'merchantKey' => 'T6F%Hi34jv',
            'testMode' => false,
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function setExpectedSettlementDate($value)
    {
        return $this->setParameter('expectedSettlementDate', $value);
    }

    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function getExpectedSettlementDate()
    {
        return $this->getParameter('expectedSettlementDate');
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\CompletePurchaseRequest', $parameters);
    }


    // for requirement for strips


    /**
     * Create Card.
     *
     * This call can be used to create a new customer or add a card
     * to an existing customer.  If a customerReference is passed in then
     * a card is added to an existing customer.  If there is no
     * customerReference passed in then a new customer is created.  The
     * response in that case will then contain both a customer token
     * and a card token, and is essentially the same as CreateCustomerRequest
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\CreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\CreateCardRequest', $parameters);
    }
    /**
     * Update Card.
     *
     * If you need to update only some card details, like the billing
     * address or expiration date, you can do so without having to re-enter
     * the full card details. Stripe also works directly with card networks
     * so that your customers can continue using your service without
     * interruption.
     *
     * When you update a card, Stripe will automatically validate the card.
     *
     * This requires both a customerReference and a cardReference.
     *
     * @link https://stripe.com/docs/api#update_card
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\UpdateCardRequest
     */
    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\UpdateCardRequest', $parameters);
    }
    /**
     * Delete a card.
     *
     * This is normally used to delete a credit card from an existing
     * customer.
     *
     * You can delete cards from a customer or recipient. If you delete a
     * card that is currently the default card on a customer or recipient,
     * the most recently added card will be used as the new default. If you
     * delete the last remaining card on a customer or recipient, the
     * default_card attribute on the card's owner will become null.
     *
     * Note that for cards belonging to customers, you may want to prevent
     * customers on paid subscriptions from deleting all cards on file so
     * that there is at least one default card for the next invoice payment
     * attempt.
     *
     * In deference to the previous incarnation of this gateway, where
     * all CreateCard requests added a new customer and the customer ID
     * was used as the card ID, if a cardReference is passed in but no
     * customerReference then we assume that the cardReference is in fact
     * a customerReference and delete the customer.  This might be
     * dangerous but it's the best way to ensure backwards compatibility.
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\DeleteCardRequest
     */
    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\DeleteCardRequest', $parameters);
    }


}
