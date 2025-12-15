<?php
require 'logic/account.php';

$accountData = [
    'fname' => '',
    'lname' => '',
    'username' => $_POST['username'] ?? '',
    'passwd_hashed' => password_hash($_POST['passwd'], PASSWORD_DEFAULT) ?? '',
    'sessionId' => -1,
    'accountType' => ''
];

$isValid = check_account($_POST['username'], $accountData);

if ($isValid) {
    $isValid = validate_account($_POST['username'], $_POST['passwd']);
}

session_start();
$_SESSION['accountData'] = $accountData;
$_SESSION['valid'] = $isValid;

// passo lo stato alla view
require 'views/account.php';