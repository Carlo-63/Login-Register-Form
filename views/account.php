<?php
$fname = htmlspecialchars($_SESSION['accountData']['fname']);
$lname = htmlspecialchars($_SESSION['accountData']['lname']);
$username = htmlspecialchars($_SESSION['accountData']['username']);
$sessionId = htmlspecialchars($_SESSION['accountData']['sessionId']);
$accountType = htmlspecialchars($_SESSION['accountData']['accountType']);
?>

<html>
<head>
    <link rel="stylesheet" href="/views/account.css">
</head>
<body>

<?php if ($_SESSION['valid']): ?>
    <div class="card">
        <h1>Account</h1>
        <p>First name: <b><?= $fname ?></b></p>
        <p>Last name: <b><?= $lname ?></b></p>
        <p>Username: <b><?= $username ?></b></p>
        <p>Session ID: <b><?= ($sessionId >= 0) ? $sessionId : "Id non valido" ?></b></p>
        <?php if ($accountType == 'Admin'): ?>
        <!-- REFER TO account.php -->
            <a class="user-link" href="/protected/dashboard.php">Vai alla dashboard Admin</a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="error">
        <p>Account non valido</p>
    </div>
<?php endif; ?>

</body>
</html>