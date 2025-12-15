<?php
    require "account.php";
    
    $id = $_POST['id'] ?? null;

    if ($id === null) {
        http_response_code(400);
        exit('ID mancante');
    }
    delete_account($id);
?>