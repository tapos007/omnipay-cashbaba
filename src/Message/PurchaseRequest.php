<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/29/2018
 * Time: 3:59 PM
 */

namespace Omnipay\CashBaBa\Message;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Stripe Purchase Request.
 *
 * To charge a credit card, you create a new charge object. If your API key
 * is in test mode, the supplied card won't actually be charged, though
 * everything else will occur as if in live mode. (Stripe assumes that the
 * charge would have completed successfully).
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the Stripe Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('Stripe');
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
 *   // Do a purchase transaction on the gateway
 *   $transaction = $gateway->purchase(array(
 *       'amount'                   => '10.00',
 *       'currency'                 => 'USD',
 *       'description'              => 'This is a test purchase transaction.',
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Purchase transaction was successful!\n";
 *       $sale_id = $response->getTransactionReference();
 *       echo "Transaction reference = " . $sale_id . "\n";
 *   }
 * </code>
 *
 * Because a purchase request in Stripe looks similar to an
 * Authorize request, this class simply extends the AuthorizeRequest
 * class and over-rides the getData method setting capture = true.
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#charges
 */

class PurchaseRequest extends AuthorizeRequest
{


    public function getEndpoint()
    {
        return $this->endpoint.'/purchase';
    }

    public function getData()
    {
        $this->validate('amount', 'currency','order_id','cardReference','customerReference','cvv');
        $data = array();
        $data['TransactionAmount'] = $this->getAmountInteger();
        $data['CurrencyCode'] = strtolower($this->getCurrency());
        $data['capture'] = 'true';
        if ($this->getOrderId()) {
            $data['OrderId'] = $this->getOrderId();
        }
        if ($this->getCustomerReference()) {
            $data['customerReference'] = $this->getCustomerReference();
        }
        if($this->getCardReference()){
            $data['CardToken'] = $this->getCardReference();
        }
        if($this->getCVV()){
            $data['CVV'] = $this->getCVV();
        }
        return $data;
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
}