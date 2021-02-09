<?php


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
    //echo json_encode($headers);
    //exit;

    $response = curl_exec($curl);

    curl_close($curl);
    return  json_decode($response);
}
