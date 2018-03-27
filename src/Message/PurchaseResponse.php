<?php

namespace Omnipay\CashBaba\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * CashBaba Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $endpoint = 'https://sanapi.cashbaba.com.bd/api/Payment/Sale';  // https://www.2checkout.com/checkout/purchase

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
		
		
		$query = http_build_query($this->data); 
		
		
		
		// create context
		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
				'content' => $query,
			),
		));
		
		$response = file_get_contents(
		$target = $this->endpoint,
		$use_include_path = false,
		$context);
		
		$receivedData = json_decode($response,true);
		$url = $receivedData['RedirectUrl'];
		
		$msg = $receivedData['Message'];
			 
			if($msg == 'Ok'){
				header('Location:'.$url);
				exit;
			}else{
				echo $msg ;
			}
		
//		echo "<pre>";
//		print_r($response);
//		echo "</pre>";
//		exit;
		
		//return $response;
		/*echo "<pre>";
		print_r($response);
		echo "</pre>";
		exit; */
		
		//return $response;
        //return $this->endpoint.'?'.http_build_query($this->data);
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return null;
    }
}
