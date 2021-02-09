<?php
$pay_id = $_REQUEST['paymentID'];
$forced_status = $_REQUEST['forced_status'];
$payer_id = $_REQUEST['payerID'];


$client_id = 'ATGBAC7M6T7CndE0gA4gjqlhLMMPU4jUZCSpO2vyhCx0tE6INqPJMwZRTsw6MpOYoWivOCOPyx7DBMkz';
$client_secret = 'EOuZEMvtpNQagb-6ef1yGnAtAlV3z2wmxgvMC9lNgWdppBuJ6p-yVyzV2jX5xHnMj7ntNts4RBBQ4ybL';

include_once('get_credencials.php');

//JSON RESPONSE
$tokens =  get_credencials($client_id, $client_secret);


echo execute_payment($pay_id,$payer_id,$tokens->access_token,$forced_status);

function execute_payment($pay_id,$payer_id,$access_token,$forced_status)
{

    $post_field = array(
        'payer_id' => $payer_id
    );
    $post_field = json_encode($post_field);
    $curl = curl_init();

    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $access_token,
    );

    if ($forced_status != "" && !is_null($forced_status)) {

        $headers = array(
            'Content-Type:application/json',
            'Authorization: Bearer ' . $access_token,
            'PayPal-Mock-Response: {"mock_application_codes": "'.$forced_status.'"}',
        );

    }else{
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Bearer ' . $access_token,
        );  
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/payments/payment/$pay_id/execute",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$post_field,
        //CURLOPT_POSTFIELDS =>"{\n\t\"payer_id\":\"$payer_id\"\n}",
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}


