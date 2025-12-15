<?php
require 'logic/account.php';

$accountData = [
    'fname' => $_POST['fname'] ?? '',
    'lname' => $_POST['lname'] ?? '',
    'username' => $_POST['username'] ?? '',
    'passwd_hashed' => password_hash($_POST['passwd'], PASSWORD_DEFAULT) ?? '',
    'sessionId' => -1,
    'accountType' => 'User'
];

$isPresent = check_account($_POST['username'], $accountData);

session_start();

if (!$isPresent) {
    insert_data($_POST['fname'], $_POST['lname'], $_POST['username'], $accountData['passwd_hashed'], $accountData);

    $_SESSION['valid'] = true;
}
else {
    $_SESSION['valid'] = false;
}

$_SESSION['accountData'] = $accountData;

// passo lo stato alla view
require 'views/account.php';