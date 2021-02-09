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
