<?php

include_once 'constant.php';
include_once 'get_credencials.php';

function create_webhook($payload, $access_token)
{
    $payload = json_encode($payload);

    //echo $payload;exit;

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
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return  ($response);
}

if (isset($_REQUEST['event']) && !empty($_REQUEST['event'])) {

    $payload = new stdClass();
    $payload->url = $_REQUEST['url'];
    $payload->event_types = array();

    /*$payload = array (
        'url' => $_REQUEST['url'],
        'event_types' => array(),
    );*/

    foreach ($_REQUEST['event'] as $key => $value) {
        $payload->event_types[] = array('name' => $value);
    }

    $response_get_credencials = get_credencials();
    $access_token = $response_get_credencials->access_token;
    echo create_webhook($payload, $access_token);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhooks</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        h11 {
            color: red;
        }

        #logo {
            width: 50%;
            height: 50%;
        }

        .panel-heading {
            font-size: 150%;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row text-center text-black mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="">Criação de Webhook</h1>
            </div>
        </div>

        <div class="row">
            <h2><a href="https://developer.paypal.com/docs/api-basics/notifications/webhooks/event-names/">link de referência</a></h2>

            <form class="form-horizontal" action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Dados</div>

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-11 control-label">
                                    <p class="help-block">
                                        <h11>*</h11> Campo Obrigatório
                                    </p>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">URL<h11>*</h11></label>
                                <div class="col-md-8">
                                    <input id="Nome" name="url" placeholder="URL exata" value="" class="form-control input-md" required="" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">Registro de Eventos<h11>*</h11></label>
                                <div class="col-md-8">
                                    <h3>Authorized and captured payments</h3>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.AUTHORIZATION.CREATED">PAYMENT.AUTHORIZATION.CREATED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.AUTHORIZATION.VOIDED">PAYMENT.AUTHORIZATION.VOIDED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.CAPTURE.COMPLETED">PAYMENT.CAPTURE.COMPLETED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.CAPTURE.DENIED">PAYMENT.CAPTURE.DENIED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.CAPTURE.PENDING">PAYMENT.CAPTURE.PENDING </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.CAPTURE.REFUNDED">PAYMENT.CAPTURE.REFUNDED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="PAYMENT.CAPTURE.REVERSED">PAYMENT.CAPTURE.REVERSED </label>
                                    <h3>Billing plans and agreements</h3>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING_AGREEMENTS.AGREEMENT.CREATED">BILLING_AGREEMENTS.AGREEMENT.CREATED </label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING_AGREEMENTS.AGREEMENT.CANCELLED">BILLING_AGREEMENTS.AGREEMENT.CANCELLED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.PLAN.CREATED">BILLING.PLAN.CREATED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.PLAN.UPDATED">BILLING.PLAN.UPDATED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.SUBSCRIPTION.CANCELLED">BILLING.SUBSCRIPTION.CANCELLED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.SUBSCRIPTION.CREATED">BILLING.SUBSCRIPTION.CREATED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.SUBSCRIPTION.RE-ACTIVATED">BILLING.SUBSCRIPTION.RE-ACTIVATED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.SUBSCRIPTION.SUSPENDED">BILLING.SUBSCRIPTION.SUSPENDED</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="event[]" value="BILLING.SUBSCRIPTION.UPDATED">BILLING.SUBSCRIPTION.UPDATED</label>

                                </div>
                            </div>
                        </div>

                        <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Cadastrar"></label>
                            <div class="col-md-8">
                                <button id="Cadastrar" name="Avançar" class="btn btn-success" type="Submit">Avançar</button>
                                <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
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