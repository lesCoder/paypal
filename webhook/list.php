<?php

include_once 'constant.php';
include_once 'get_credencials.php';


$response_get_credencials = get_credencials();
$access_token = $response_get_credencials->access_token;

function list_webhook($access_token)
{
    //$payload = json_encode($payload);
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $access_token,
        "Accept: application/json",
        "Accept-Language: en_US",
        "Content-Type: application/x-www-form-urlencoded",
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => URL_BASE . "v1/notifications/webhooks",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    $response = json_decode($response);
    $response = json_encode($response,JSON_PRETTY_PRINT);
    curl_close($curl);
    return ($response);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhooks</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>

</head>

<body>

    <div class="container py-5">
        <div class="row text-center text-black mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="">List Webhooks</h1>
            </div>
        </div>

        <div class="row">
            <pre class="prettyprint"><?= list_webhook($access_token); ?></pre>
        </div>

    </div>




</body>
<script>
    /*
    Swal.fire({
        title: 'Aviso!',
        text: 'Selecione um item para avançar',
        icon: 'warning',
        confirmButtonText: 'Cool'
    })
    */
</script>

</html>