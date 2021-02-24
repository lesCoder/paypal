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
    <style>
    .card-img-top {
    
    height: 205px;
}
</style>
</head>

<body>

    <div class="container py-5">
        <div class="row text-center text-black mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="">Integration Showcase</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="data:image/png;base64,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" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">PayPal Plus ShowCase</p>
                        <a href="./paypal_plus/" class="btn btn-primary center">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq_QZBdjDmWIGZYmXTMQvlRR-0ktPoY1vaUw&usqp=CAU" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">WebHook ShowCase</p>
                        <a href="./webhook/" class="btn btn-primary center">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.paypalobjects.com/marketing/web/fi/fi/home/Checkout_1000x1000_transparent.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">SPB ShowCase</p>
                        <a href="./spb/" class="btn btn-primary center">Go</a>
                    </div>
                </div>
            </div>
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