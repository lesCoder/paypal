<?php

function persist($message)
{
    if( !is_string($message) ){
        $message = json_encode($message);    
    }
    

    $user = 'freedbtech_adminedu';
    $pass = 'passedu';

    $pdo = new PDO('mysql:host=freedb.tech;dbname=freedbtech_dbppedutest', $user, $pass);

    try {
        //$message = 'test eduardo1';
        $sql = "INSERT INTO incoming (message) VALUES (?)";
        $stmt = $pdo->prepare($sql);


        if (!$stmt->execute([$message])) {
            $arr = $stmt->errorInfo();
            echo 'error on database insert';
            print_r($arr);
        }
    } catch (Exception $e) {
        //throw $th;
        throw $e;
    }
}

persist(file_get_contents('php://input'));