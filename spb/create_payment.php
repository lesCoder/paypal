<?php

include_once('get_credencials.php');
$invoice = sprintf("%06d", mt_rand(1, 999999));

//JSON RESPONSE
$tokens =  get_credencials();

$payload = array(
    'intent' => 'sale',
    'payer' =>
    array(
        'payment_method' => 'paypal',
    ),
    'transactions' =>
    array(
        0 =>
        array(
            'amount' =>
            array(
                'total' => '200.00',
                'currency' => 'BRL',                
            ),
            'description' => 'The payment transaction description.',
            'custom' => 'informacaocustomizada',
            'invoice_number' => $invoice,
            'payment_options' =>
            array(
                'allowed_payment_method' => 'IMMEDIATE_PAY',
            ),
            'item_list' =>
            array(
                'items' =>
                array(
                    0 =>
                    array(
                        'name' => 'Adds I',
                        'description' => 'Product description',
                        'quantity' => '1',
                        'price' => '100',
                        'sku' => 'product1',
                        'currency' => 'BRL',
                    ),
                    1 =>
                    array(
                        'name' => 'Adds II',
                        'description' => ' Product description II',
                        'quantity' => '1',
                        'price' => '100',
                        'sku' => 'product34',
                        'currency' => 'BRL',
                    ),
                ),
            ),
        ),
    ),
    'note_to_payer' => 'Contact us for any questions on your order.',
    'redirect_urls' =>
    array(
        'return_url' => 'http://localhost/paypal%20payments/spb/server/pp_return.php',
        'cancel_url' => 'http://localhost/paypal%20payments/spb/server/pp_return.php',
    ),
);


$data = create_payment($payload, $tokens->access_token);

echo json_encode($data);

function create_payment($payload, $access_token)
{
    $payload = json_encode($payload);
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $access_token,
        "Accept: application/json",
        "Accept-Language: en_US",
        "Content-Type: application/x-www-form-urlencoded",
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/payments/payment",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return  json_decode($response);
}