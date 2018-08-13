<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/21/2018
 * Time: 11:28 AM
 */

namespace Omnipay\CashBaBa;
use Omnipay\Common\AbstractGateway;


/**
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())


 */
class Gateway extends  AbstractGateway
{

    public function getName()
    {
        return 'CashBaBa';
    }

    /**
     * Get the gateway API Key.
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apikey');
    }

    /**
     * Set the gateway API Key.
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
     *
     * CashBaBa accounts have test-mode API keys as well as live-mode
     * API keys. These keys can be active at the same time. Data
     * created with test-mode credentials will never hit the credit
     * card networks and will never cost anyone money.
     *
     * Unlike some gateways, there is no test mode endpoint separate
     * to the live mode endpoint, the CashBaba API endpoint is the same
     * for test and for live.
     *
     * Setting the testMode flag on this gateway has no effect.  To
     * use test mode just use your test mode API key.
     *
     * @param string $value
     *
     * @return Gateway provides a fluent interface.
     */
    public function setApiKey($value){
        return $this->setParameter('apikey',$value);
    }




    /**
     * Create Card.
     *
     *
     * api call for new customer with card
     *
     *  <code>
     *      $gateway = Omnipay::create('CashBaBa');
     *      $gateway->setApiKey('c+h1cMVyy9');
     *
     *      $new_card = new CreditCard(array(
     *          'firstName'    => 'Example',
     *          'lastName'     => 'Customer',
     *          'number'       => '344014247053081',
     *          'expiryMonth'  => '01',
     *          'expiryYear'   => '2020',
     *          'cvv'          => '456',
     *          'email'                 => 'customer@example.com',
     *          'billingAddress1'       => '1 Lower Creek Road',
     *          'billingCountry'        => 'AU',
     *          'billingCity'           => 'Upper Swan',
     *          'billingPostcode'       => '6999',
     *          'billingState'          => 'WA',
     *      ));
     *
     *      try{
     *          $result = $gateway->createCard(array(
     *          'card' => $new_card,
     *          ))->send();
     *
     *          if($result->isSuccessful()){
     *
     *              $card_id = $result->getCardReference();
     *              $card_customer = $result->getCustomerReference();
     *              echo "card_id:".$card_id;
     *              echo "card_customer:".$card_customer;
     *
     *          }else{
     *
     *              echo $result->getMessage();
     *          }
     *      }catch (Exception $e){
     *
     *          echo $e->getMessage();
     *      }
     *
     * </code>
     *
     *
     * create card with existing customer
     *
     *
     *
     * api call for new customer with card
     *
     *  <code>
     *      $gateway = Omnipay::create('CashBaBa');
     *      $gateway->setApiKey('c+h1cMVyy9');
     *
     *      $new_card = new CreditCard(array(
     *          'firstName'    => 'Example',
     *          'lastName'     => 'Customer',
     *          'number'       => '344014247053081',
     *          'expiryMonth'  => '01',
     *          'expiryYear'   => '2020',
     *          'cvv'          => '456',
     *          'email'                 => 'customer@example.com',
     *          'billingAddress1'       => '1 Lower Creek Road',
     *          'billingCountry'        => 'AU',
     *          'billingCity'           => 'Upper Swan',
     *          'billingPostcode'       => '6999',
     *          'billingState'          => 'WA',
     *      ));
     *
     *      try{
     *          $result = $gateway->createCard(array(
     *          'card' => $new_card,
     *          'cardReference' => "2",
     *          ))->send();
     *
     *          if($result->isSuccessful()){
     *
     *              $card_id = $result->getCardReference();
     *              $card_customer = $result->getCustomerReference();
     *              echo "card_id:".$card_id;
     *              echo "card_customer:".$card_customer;
     *
     *          }else{
     *
     *              echo $result->getMessage();
     *          }
     *      }catch (Exception $e){
     *
     *          echo $e->getMessage();
     *      }
     *
     * </code>

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
     * the full card details. CashBaba also works directly with card networks
     * so that your customers can continue using your service without
     * interruption.
     * * api call for new customer with card
     *
     *  <code>
     *      $gateway = Omnipay::create('CashBaBa');
     *      $gateway->setApiKey('c+h1cMVyy9');
     *
     *      $new_card = new CreditCard(array(
     *          'firstName'    => // complete if you change it ,
     *          'lastName'     => '// complete if you change it,
     *          'number'       => // complete if you change it,
     *          'expiryMonth'  => // complete if you change it,
     *          'expiryYear'   => // complete if you change it,
     *          'cvv'          => // complete if you change it,
     *          'email'                 => // complete if you change it,
     *          'billingAddress1'       => // complete if you change it,
     *          'billingCountry'        => // complete if you change it
     *          'billingCity'           => // complete if you change it,
     *          'billingPostcode'       => '// complete if you change it,
     *          'billingState'          => // complete if you change it,
     *      ));
     *
     *      try{
     *          $result = $gateway->updateCard(array(
     *              'card' => $new_card,
     *              'customerReference' => "2",
     *              'cardReference' => "6acc8ff1-bcee-4526-908a-8a2bf5306a51",
     *          ))->send();
     *
     *          if($result->isSuccessful()){
     *
     *              $card_id = $result->getCardReference();
     *              $card_customer = $result->getCustomerReference();
     *              echo "card_id:".$card_id;
     *              echo "card_customer:".$card_customer;
     *
     *          }else{
     *
     *              echo $result->getMessage();
     *          }
     *      }catch (Exception $e){
     *
     *          echo $e->getMessage();
     *      }
     *
     * </code>
     * When you update a card, CashBaba will automatically validate the card.
     *
     * This requires both a customerReference and a cardReference.
     *

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
     * You can delete cards from a existing customer or you can delete your
     * existing customer
     *
     * Delete card API call
     * <code>
     * $gateway = Omnipay::create('CashBaBa');
     * $gateway->setApiKey('abc123');
     * try{
     *       $result = $gateway->deleteCard(array(
     *           'customerReference' => "2",
     *           'cardReference' => "6acc8ff1-bcee-4526-908a-8a2bf5306a51",
     *       ))->send();
     *      if($result->isSuccessful()){
     *           echo $result->getCardorCustomerDeleteResponse();
     *       }else{
     *           echo $result->getMessage();
     *       }
     *   }catch (Exception $e){
     *       echo $e->getMessage();
     *   }
     * </code>
     *
     *
     *
     * * Delete Customer API call
     * <code>
     * $gateway = Omnipay::create('CashBaBa');
     * $gateway->setApiKey('abc123');
     * try{
     *       $result = $gateway->deleteCard(array(
     *           'customerReference' => "2",
     *       ))->send();
     *      if($result->isSuccessful()){
     *           echo $result->getCardorCustomerDeleteResponse();
     *       }else{
     *           echo $result->getMessage();
     *       }
     *   }catch (Exception $e){
     *       echo $e->getMessage();
     *   }
     * </code>
     *
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\DeleteCardRequest
     */
    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\DeleteCardRequest', $parameters);
    }




    /**
     * Authorize Request.
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
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\AuthorizeRequest', $parameters);
    }



    /**
     * Capture Request.
     *
     * Use this request to capture and process a previously created authorization.
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\CaptureRequest', $parameters);
    }



    /**
     * Purchase request.
     *
     * To charge a credit card, you create a new charge object. If your API key
     * is in test mode, the supplied card won't actually be charged, though
     * everything else will occur as if in live mode. (CashBaba assumes that the
     * charge would have completed successfully).
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
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\PurchaseRequest', $parameters);
    }



    /**
     * Refund Request.
     *
     * When you create a new refund, you must specify a
     * charge to create it on.
     *
     * Creating a new refund will refund a charge that has
     * previously been created but not yet refunded. Funds will
     * be refunded to the credit or debit card that was originally
     * charged. The fees you were originally charged are also
     * refunded.
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\RefundRequest', $parameters);
    }



    /**
     * Fetch Transaction Request.
     *
     * @param array $parameters
     *
     * @return \Omnipay\CashBaBa\Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CashBaBa\Message\VoidRequest', $parameters);
    }






}