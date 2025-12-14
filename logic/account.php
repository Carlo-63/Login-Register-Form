<?php 

require 'db.php';

function check_account($username, &$accountData): bool {
    $conn = create_connection("127.0.0.1", "root", "", "social");

    $sql = $conn->prepare("SELECT id, fname, lname FROM accounts WHERE username = ? LIMIT 1");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    $record = $result->fetch_assoc();
    $conn->close();
    
    if ($result->num_rows === 1) {
        $accountData['fname'] = $record['fname'] ?? '';
        $accountData['lname'] = $record['lname'] ?? '';
        $accountData['sessionId'] = $record['id'] ?? -1;

        return true;
    }
    return false;
}

function validate_account($username, $passwd): bool {
    $conn = create_connection("127.0.0.1", "root", "", "social");

    $sql = $conn->prepare("SELECT id, passwd FROM accounts WHERE username = ? LIMIT 1");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    $conn->close();

    if ($result->num_rows !== 1) {
        return false;
    }
    $record = $result->fetch_assoc();

    return (password_verify($passwd, $record['passwd']));
}

function insert_data($fname, $lname, $username, $passwd_hashed, &$accountData): void {
    $conn = create_connection("127.0.0.1", "root", "", "social");

    $sql = $conn->prepare("INSERT INTO accounts (fname, lname, username, passwd) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $fname, $lname, $username, $passwd_hashed);
    $sql->execute();

    $accountData['sessionId'] = $conn->insert_id;

    $conn->close();
}