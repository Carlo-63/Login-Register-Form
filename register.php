<?php
require 'logic/account.php';

$accountData = [
    'fname' => $_POST['fname'] ?? '',
    'lname' => $_POST['lname'] ?? '',
    'username' => $_POST['username'] ?? '',
    'passwd_hashed' => password_hash($_POST['passwd'], PASSWORD_DEFAULT) ?? '',
    'sessionId' => -1
];

$isPresent = check_account($_POST['username'], $accountData);

if (!$isPresent) {
    insert_data($_POST['fname'], $_POST['lname'], $_POST['username'], $accountData['passwd_hashed'], $accountData);
    // stato applicativo
    $state = [
        'valid' => true,
        'data'  => $accountData
    ];
}
else {
    // stato applicativo
    $state = [
        'valid' => false,
        'data'  => $accountData
    ];
}

// passo lo stato alla view
require 'views/account.php';