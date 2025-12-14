<?php
require 'logic/account.php';

$accountData = [
    'fname' => '',
    'lname' => '',
    'username' => $_POST['username'] ?? '',
    'passwd_hashed' => password_hash($_POST['passwd'], PASSWORD_DEFAULT) ?? '',
    'sessionId' => -1
];

$isValid = check_account($_POST['username'], $accountData);

if ($isValid) {
    $isValid = validate_account($_POST['username'], $_POST['passwd']);
}

// stato applicativo
$state = [
    'valid' => $isValid,
    'data'  => $accountData
];

// passo lo stato alla view
require 'views/account.php';