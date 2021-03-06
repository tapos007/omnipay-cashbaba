<?php
/**
 * Created by PhpStorm.
 * User: R041705033
 * Date: 7/29/2018
 * Time: 3:56 PM
 */

namespace Omnipay\CashBaBa\Message;

/**
 * CashBaBa Capture Request.
 *
 * Use this request to capture and process a previously created authorization.
 *
 * Example -- note this example assumes that the authorization has been successful
 * and that the authorization ID returned from the authorization is held in $auth_id.
 * See AuthorizeRequest for the first part of this example transaction:
 *
 * <code>
 *   // Once the transaction has been authorized, we can capture it for final payment.
 *   $transaction = $gateway->capture(array(
 *       'amount'        => '10.00',
 *       'currency'      => 'AUD',
 *   ));
 *   $transaction->setTransactionReference($auth_id);
 *   $response = $transaction->send();
 * </code>
 *
 * @see AuthorizeRequest
 */
class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        $data = array();
        // $data['amount'] = $this->getAmountInteger();
        if ($this->getTransactionReference()) {
            $data['transactionId'] = $this->getTransactionReference();
        }
//        if ($this->getReverseTransfer()) {
//            $data['reverse_transfer'] = 'true';
//        }
        return $data;
    }
    public function getHttpMethod()
    {
        return 'GET';
    }
    public function getEndpoint()
    {
        return $this->endpoint.'/transactions/'.$this->getTransactionReference().'/capture';
    }
}