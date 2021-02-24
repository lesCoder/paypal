<?php
$forced_status = $_REQUEST['forced_status'];
$custom_color = $_REQUEST['custom_color'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="http://www.paypalobjects.com/api/checkout.js"></script>

    <div id="paypal-button"></div>

    <script>
        paypal.Button.render({
            locale: 'pt_BR',
            style: {
                size: 'small',
                color: '<?= $custom_color ?>',
                shape: 'pill',
                label: 'checkout',
                tagline: 'true'
            },
            env: 'sandbox', // Or 'production'
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('./create_payment.php')
                    .then(function(res) {
                        // 3. Return res.id from the response          
                        return res.id;
                    });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('./execute.php?forced_status=<?= $forced_status ?>', {
                        paymentID: data.paymentID,
                        payerID: data.payerID
                    })
                    .then(function(res) {
                        // 3. Show the buyer a confirmation message.
                        console.log(res);
                        if (res.hasOwnProperty('message')) {
                            alert('Houve um erro no processamento da TRN:');
                            alert('Erro:' + res.message);
                        } else if (res.hasOwnProperty('state') && res.state == 'approved') {
                            alert('TRN processada com sucesso, redirecione o user para o fluxo de conclusao de compra');
                        } else {
                            alert('issue to review');
                        }
                    });
            }
        }, '#paypal-button');
    </script>
</body>

</html>