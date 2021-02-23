<?php

function get_credencials()
{
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Basic ' . base64_encode("".CLI_ID.":".SECRET),
        "Accept: application/json",
        "Accept-Language: en_US",
        "Content-Type: application/x-www-form-urlencoded",
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => URL_BASE."v1/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    try {
        return  json_decode($response);
    } catch (\Throwable $th) {
        print_r($th);
    }
}
