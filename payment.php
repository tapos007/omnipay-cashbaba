
<?php
require_once('vendor/autoload.php');
use Omnipay\Omnipay;

// Setup payment gateway
$gateway = Omnipay::create('Cashbaba');
$gateway->setMerchantID('990040191');
$gateway->setMerchantKey('%kTaip0uiu');

// Example form data
// $formData = [
//     'number' => '4000000000000077',
//     'expiryMonth' => '12',
//     'expiryYear' => '2018',
//     'cvv' => '123'
// ];

// Send purchase request
$response = $gateway->purchase(
    [
        'amount' => '10.00',
        'currency' => 'USD'
    ]
)->send();

// Process response
if ($response->isSuccessful()) {

    // Payment was successful
    print_r($response);

} elseif ($response->isRedirect()) {
    // Redirect to offsite payment gateway
    $response->redirect();

} else {

    // Payment failed
    echo $response->getMessage();
}
