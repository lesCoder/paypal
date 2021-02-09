<?php
include_once('get_credencials.php');
include_once('create_payment.php');
$client_id = 'ATGBAC7M6T7CndE0gA4gjqlhLMMPU4jUZCSpO2vyhCx0tE6INqPJMwZRTsw6MpOYoWivOCOPyx7DBMkz';
$client_secret = 'EOuZEMvtpNQagb-6ef1yGnAtAlV3z2wmxgvMC9lNgWdppBuJ6p-yVyzV2jX5xHnMj7ntNts4RBBQ4ybL';

//data from form

$p_name = $_REQUEST['p_name'];
$s_name = $_REQUEST['s_name'];
$cpf = $_REQUEST['cpf'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST['email'];
$forced_status = $_REQUEST['forced_status'];

//data sanitize
include_once('validacao.php');


//JSON RESPONSE
$tokens =  get_credencials($client_id, $client_secret);
//echo json_encode($tokens);
//exit;

$value_product = $_REQUEST['v'];

$rand = substr(uniqid('', true), -5);

$payload = array(
    'intent' => 'sale',
    'payer' =>
    array(
        'payment_method' => 'paypal',
    ),
    'application_context' =>
    array(
        'locale' => 'pt-BR',
        'brand_name' => 'sualoja',
        'shipping_preference' => 'NO_SHIPPING',
        'user_action' => 'continue',
    ),
    'transactions' =>
    array(
        0 =>
        array(
            'amount' =>
            array(
                'total' => $value_product,
                'currency' => 'BRL',
                'details' =>
                array(
                    'subtotal' => $value_product,
                ),
            ),
            'description' => 'The payment transaction description.',
            'custom' => 'informacaocustomizada',
            'invoice_number' => $rand,
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
                        'price' => number_format($value_product / 2, 2, '.', ''),
                        'sku' => 'product1',
                        'currency' => 'BRL',
                    ),
                    1 =>
                    array(
                        'name' => 'Adds II',
                        'description' => ' Product description II',
                        'quantity' => '1',
                        'price' => number_format($value_product / 2, 2, '.', ''),
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
        'return_url' => 'http://localhost/Paypal%20Payments/paypal_plus/return_url.php',
        'cancel_url' => 'http://localhost/Paypal%20Payments/paypal_plus/return_url.php',
    ),
);
//die(number_format($value_product/2, 2, '.', ''));

$data = create_payment($payload, $tokens->access_token);


if (isset($data->details[0]->issue)) {
    $error = $data->details[0]->issue;
}

//echo '<pre>';
//echo json_encode($data);
//echo '</pre>';
$payment_id = @$data->id;
$links = @$data->links;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PP +</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container">
        <div class="md-12">
            <div>
                <label>Gerou o Access TOKEN:</label>
                <div><b><?= $tokens->access_token ?></b></div>
            </div>
            <div>
                <label>Compra Criada com o ID:</label>
                <div><b><?= $payment_id ?></b></div>
            </div>

            <div>
                <label>Invoice Number (identificador customizado):</label>
                <div><b><?= $rand ?></b></div>
            </div>
        </div>

        <div class="col-md-12">
            <div id="ppplusDiv"> </div>

            <button type="submit" class="btn btn-danger" id="continueButton" onclick="ppp.doContinue(); return false;"> Checkout</button>
        </div>
    </div>

</body>

</html>




<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>


<script type="application/javascript">
    <?php if (isset($error)) { ?>
        Swal.fire({
            title: 'Error on create_payment!',
            text: '<?= $error[0] ?>',
            icon: 'error',
            confirmButtonText: 'Cool'
        });

    <?php } else { ?>

        /**/
        var ppp = PAYPAL.apps.PPP({
            "approvalUrl": "<?= $links[1]->href ?>",
            "placeholder": "ppplusDiv",
            "mode": "sandbox",
            "payerFirstName": "<?= $p_name ?>",
            "payerLastName": "<?= $s_name ?>",
            "payerPhone": "<?= $telefone ?>",
            "payerEmail": "<?= $email ?>",
            "payerTaxId": "<?= $cpf ?>",
            "payerTaxIdType": "BR_CPF",
            "language": "pt_BR",
            "country": "BR",
            /*Optional*/
            //"collectBillingAddress": true,
            //"rememberedCards": "customerRememberedCardHash",
            //'merchantInstallmentSelectionOptional': false,
            //'merchantInstallmentSelection': 5,
        });




        if (window.addEventListener) {
            window.addEventListener("message", receiveMessage, false);
            console.log("addEventListener successful", "debug");
        } else if (window.attachEvent) {
            window.attachEvent("onmessage", receiveMessage);
            console.log("attachEvent successful", "debug");
        } else {
            console.log("Could not attach message listener", "debug");
            throw new Error("Can't attach message listener");
        }

        function receiveMessage(event) {
            try {
                var message = JSON.parse(event.data);
                if (typeof message['cause'] !== 'undefined') { //iFrame error ndling
                    ppplusError = message['cause'].replace(/['"]+/g, ""); //log & attach this error into the order if possible

                    switch (ppplusError) {
                        case "INTERNAL_SERVICE_ERROR": //javascript fallthrough
                        case "SOCKET_HANG_UP": //javascript fallthrough
                        case "socket hang up": //javascript fallthrough
                        case "connect ECONNREFUSED": //javascript fallthrough
                        case "connect ETIMEDOUT": //javascript fallthrough
                        case "UNKNOWN_INTERNAL_ERROR": //javascript fallthrough
                        case "fiWalletLifecycle_unknown_error": //javascript fallthrough
                        case "Failed to decrypt term info": //javascript fallthrough
                        case "RESOURCE_NOT_FOUND": //javascript fallthrough


                        case "INTERNAL_SERVER_ERROR":
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.

                            break;
                        case "RISK_N_DECLINE": //javascript fallthrough
                        case "NO_VALID_FUNDING_SOURCE_OR_RISK_REFUSED": //javascript fallthrough
                        case "TRY_ANOTHER_CARD": //javascript fallthrough
                        case "NO_VALID_FUNDING_INSTRUMENT":
                            alert("Seu pagamento não foi aprovado. Por favor utilize outro cartão, caso o problema persista entre em contato com o PayPal (0800-047-4482)."); //pt_BR
                            //Risk denial, inform the customer to try again; generate a new approval_url and reload the iFrame.

                            break;
                        case "CARD_ATTEMPT_INVALID":
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //03 maximum payment attempts with error, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            break;
                        case "INVALID_OR_EXPIRED_TOKEN":
                            alert("A sua sessão expirou, por favor tente novamente."); //pt_BR
                            //User session is expired, inform the customer to try again; generate a new approval_url and reload the iFrame.

                            break;
                        case "CHECK_ENTRY":
                            alert("Por favor revise os dados de Cartão de Crédito inseridos."); //pt_BR
                            //Missing or invalid credit card information, inform your customer to check the inputs.

                            break;
                        default: //unknown error & reload payment flow
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.

                    }
                }

                if (message['action'] == 'checkout') { //PPPlus session approved, do logic here
                    var rememberedCard = null;
                    var payer_ID = null;
                    var payment_ID = null;
                    var installmentsValue = null;

                    console.log(message);

                    rememberedCard = message['result']['rememberedCards']; //save on user BD record
                    payer_ID = message['result']['payer']['payer_info']['payer_id'];
                    payment_ID = '<?= $payment_id ?>';
                    //$("#requestExecute").show().html("<pre>{ payer_id: " + payer_ID +" }</pre>");

                    if ("term" in message) {
                        installmentsValue = message['result']['term']['term']; //installments value
                    } else {
                        installmentsValue = 1; //no installments
                    }

                    //	var hostName = window.location.origin;
                    var pathExecute = 'http://localhost/Paypal%20Payments/paypal_plus/return_url.php?forced_status=<?=$forced_status?>';
                    //	var ExecutePaymentPath = hostName+pathExecute;
                    var ExecutePaymentPath = pathExecute;

                    var reqs = {
                        payerID: payer_ID,
                        paymentID: payment_ID
                    };

                    $.ajax({
                        url: ExecutePaymentPath,
                        type: 'POST',
                        dataType: 'json',
                        data: reqs,
                        success: function(response) {
                            if(typeof(response.transactions) != 'undefined'){

                                var state = response.transactions['0'].related_resources['0'].sale['state'];
                            if (state == "completed") {
                                alert("Pagamento feito com sucesso!");
                                console.log(response);
                                //window.location = "../../success.php";
                            }
                            $("#responseExecute").show().html("<pre>" + JSON.stringify(response, null, 2) + "</pre>");

                            }else if(response.message){
                                alert(response.message);
                            }else{
                                alert(response.details['0'].issue);
                            }

                            
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            } catch (e) { //treat exceptions here
                console.log(e);
            }
        }
    <?php } ?>
</script>