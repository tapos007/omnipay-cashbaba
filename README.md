# Omnipay: Stripe

**CashBaBa Payment Gateway driver for the Omnipay PHP payment processing library**


[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements Stripe support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require `league/omnipay` and `omnipay/cashbaba` with Composer:

```
composer require league/omnipay omnipay/cashbaba
```

## Basic Usage

The following gateways are provided by this package:

* [CashBaBa](https://san.cashbaba.com.bd)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

### Stripe.js

The Cashbaba integration is fairly straight forward. Essentially you just pass
a `card token` field through to Cashbaba instead of the regular credit card data.


Add card System of this payment gateway need merchnat secret inside header and body portion send card data 

```php
        $gateway = Omnipay::create('CashBaBa');
        $gateway->setApiKey('c+h1cMVyy9');
		$new_card = new CreditCard(array(
					   'firstName'   => 'Example',
					   'lastName'     => 'Customer',
					   'number'       => '4321450000341686',
					   'expiryMonth'  => '01',
					   'expiryYear'   => '2020',
					   'cvv'          => '456',
					   'email'                 => 'customer@example.com',
					   'billingAddress1'       => '1 Lower Creek Road',
					   'billingCountry'        => 'AU',
					   'billingCity'           => 'Upper Swan',
					   'billingPostcode'       => '6999',
					   'billingState'          => 'WA',
		   ));
			try{
				$result = $gateway->createCard(array(
					 'card' => $new_card,
					 // 'customerReference' => "4",
					// 'cardReference' => "dfdf",
				))->send();

				if($result->isSuccessful()){
					$card_id = $result->getCardReference();
					$card_customer = $result->getCustomerReference();

					echo "card_id:".$card_id;
					echo "card_customer:".$card_customer;
				}else{
					echo $result->getMessage();
				}
			}catch (Exception $e){
				echo $e->getMessage();
			}
		
        
```


## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

