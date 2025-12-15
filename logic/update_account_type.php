<?php
    require "account.php";
    
    $accountType = $_POST['accountType'] ?? null;
    $id = $_POST['id'] ?? null;

    if ($accountType === NULL || $id === null) {
        http_response_code(400);
        exit('AccountType e/o ID mancante');
    }

    var_dump($accountType);
    var_dump($id);

    update_account_type($accountType, $id);
?>