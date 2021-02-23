<?php

$cpf = limpaCPF_CNPJ($cpf);


//Email Validation   

if (empty($email)) {
    $error[] = "Email is required";
} else {
    // check that the e-mail address is well-formed  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format";
    }
}

//String Validation  

if (empty($p_name)) {
    $error[] = "Name is required";
} else {
    // check if name only contains letters and whitespace  
    if (!preg_match("/^[a-zA-Z ]*$/", $p_name)) {
        $error[] = "Only alphabets and white space are allowed";
    }
}

if (empty($s_name)) {
    $error[] = "Second name is required";
} else {
    // check if name only contains letters and whitespace  
    if (!preg_match("/^[a-zA-Z ]*$/", $s_name)) {
        $error[] = "Only alphabets and white space are allowed on second name";
    }
}

if(strlen($telefone) > 11 || strlen($telefone) < 10){
    $error[] = "Número de telefone incorreto";
}



function limpaCPF_CNPJ($valor)
{
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}