<?php
$fname = htmlspecialchars($state['data']['fname']);
$lname = htmlspecialchars($state['data']['lname']);
$username = htmlspecialchars($state['data']['username']);
$sessionId = htmlspecialchars($state['data']['sessionId']);
?>

<html>
<head>
    <link rel="stylesheet" href="/views/account.css">
</head>
<body>

<?php if ($state['valid']): ?>
    <div class="card">
        <h1>Account</h1>
        <p>First name: <b><?= $fname ?></b></p>
        <p>Last name: <b><?= $lname ?></b></p>
        <p>Username: <b><?= $username ?></b></p>
        <p>Session ID: <b><?= ($sessionId >= 0) ? $sessionId : "Id non valido" ?></b></p>
    </div>
<?php else: ?>
    <div class="error">
        <p>Account non valido</p>
    </div>
<?php endif; ?>

</body>
</html>