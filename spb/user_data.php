<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPB</title>


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
    <div class="container">
        <form class="form-horizontal" action="./spb.php?v=<?= $_REQUEST['v'] ?>" method="POST">
            <fieldset>
                <div class="panel panel-primary">
                    <div class="panel-heading">Dados do Cliente</div>

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
                            <label class="col-md-2 control-label" for="Nome">Primeiro Nome <h11>*</h11></label>
                            <div class="col-md-8">
                                <input id="Nome" name="p_name" placeholder="" value="customerFirstName" class="form-control input-md" required="" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Nome">Segundo Nome <h11>*</h11></label>
                            <div class="col-md-8">
                                <input id="Nome" name="s_name" value="customerLastName" class="form-control input-md" required="" type="text">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Nome">CPF <h11>*</h11></label>
                            <div class="col-md-2">
                                <input id="cpf" name="cpf" value="07925558059" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
                            </div>


                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext">Telefone <h11>*</h11></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input id="prependedtext" name="telefone" class="form-control" value="11979895799" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$" onkeypress="formatar('## #####-####', this)">
                            </div>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="prependedtext" name="email" class="form-control" value="email_@email.com" placeholder="email@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                        </div>
                    </div>


                    <!-- Prepended text-->
                    <div class="form-group">

                        <label class="col-md-2 control-label" for="prependedtext">Status test <h11>*</h11></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="" checked>NONE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="INSTRUMENT_DECLINED">INSTRUMENT_DECLINED
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="INVALID_RESOURCE_ID">INVALID_RESOURCE_ID
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="PAYMENT_ALREADY_DONE">PAYMENT_ALREADY_DONE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="DUPLICATE_REQUEST_ID">DUPLICATE_REQUEST_ID
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="VALIDATION_ERROR">VALIDATION_ERROR
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forced_status" value="INTERNAL_SERVICE_ERROR">INTERNAL_SERVICE_ERROR
                            </label>
                        </div>
                    </div>
                    <a href="https://developer.paypal.com/docs/api-basics/sandbox/request-headers" target="_blank">
                        <legend><label>https://developer.paypal.com/docs/api-basics/sandbox/request-headers/</label></legend>
                    </a>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext">Customização do BTN <h11>*</h11></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input type="radio" name="custom_color" value="gold" checked>gold
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="custom_color" value="blue">blue
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="custom_color" value="silver">silver
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="custom_color" value="white">white
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="custom_color" value="black">black
                            </label>                            
                        </div>
                    </div>

                    <a href="https://developer.paypal.com/docs/archive/checkout/how-to/customize-button/" target="_blank">
                        <legend><label>https://developer.paypal.com/docs/archive/checkout/how-to/customize-button/</label></legend>
                    </a>
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
</body>

</html>

<script type="application/javascript">
    Swal.fire({
        title: 'Atenção',
        text: 'Confirme os dados a serem enviados',
        icon: 'warning',
        confirmButtonText: 'Cool'
    });



    function limpa_formulario_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('estado').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('estado').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulario_cep();
            alert("CEP não encontrado.");
            document.getElementById('cep').value = ("");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep !== "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('estado').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulario_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulario_cep();
        }
    }

    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i);

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }

    }

    function idade() {
        var data = document.getElementById("dtnasc").value;
        var dia = data.substr(0, 2);
        var mes = data.substr(3, 2);
        var ano = data.substr(6, 4);
        var d = new Date();
        var ano_atual = d.getFullYear(),
            mes_atual = d.getMonth() + 1,
            dia_atual = d.getDate();

        ano = +ano,
            mes = +mes,
            dia = +dia;

        var idade = ano_atual - ano;

        if (mes_atual < mes || mes_atual == mes_aniversario && dia_atual < dia) {
            idade--;
        }
        return idade;
    }


    function exibe(i) {



        document.getElementById(i).readOnly = true;




    }

    function desabilita(i) {

        document.getElementById(i).disabled = true;
    }

    function habilita(i) {
        document.getElementById(i).disabled = false;
    }


    function showhide() {
        var div = document.getElementById("newpost");

        if (idade() >= 18) {

            div.style.display = "none";
        } else if (idade() < 18) {
            div.style.display = "inline";
        }

    }
</script>