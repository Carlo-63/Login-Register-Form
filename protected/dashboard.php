<?php
    require "../logic/account.php";

    session_start();
    $accountType = $_SESSION['accountData']['accountType'];
    $records = get_all_accounts();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utenti</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php if ($accountType === 'Admin'): ?>
        <h1>Dashboard Utenti</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Username</th>
                    <th>Tipo Account</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                 <?php while($record = $records->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $record['id'] ?></td>
                        <td><?php echo $record['fname'] ?></td>
                        <td><?php echo $record['lname'] ?></td>
                        <td><?php echo $record['username'] ?></td>
                        <td class="account-type-cell account-type-<?php echo strtolower($record['accountType']); ?>">
                            <span class="account-type-label"><?php echo $record['accountType']; ?></span>
                            <div class="account-type-dropdown">
                                <div class="account-type-dropdown-option" onclick="update_account_type(<?php echo $record['id'] ?>, 'User')">User</div>
                                <div class="account-type-dropdown-option" onclick="update_account_type(<?php echo $record['id'] ?>, 'Admin')">Admin</div>
                            </div>
                        </td>
                        <td><button class="delete-btn" onclick="eliminaUtente(<?php echo $record['id'] ?>)">Elimina</button></td>
                    </tr>
                 <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h1>Account non admin</h1>
    <?php endif; ?>
    </body>
    </html>
    <script>
    document.querySelectorAll('.account-type-cell').forEach(cell => {
        cell.addEventListener('click', function(e) {
            e.stopPropagation();
            // Chiudi altri menu
            document.querySelectorAll('.account-type-cell.open').forEach(c => {
                if (c !== cell) c.classList.remove('open');
            });
            cell.classList.toggle('open');
        });
    });
    document.addEventListener('click', function() {
        document.querySelectorAll('.account-type-cell.open').forEach(c => c.classList.remove('open'));
    });

    function update_account_type(id, accountType) {
        fetch('../logic/update_account_type.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                accountType: accountType,
            })
        })
        .then(response => response.text())
        .then(data => {
            alert('Utente aggiornato');
            location.reload();
        })
        .catch(error => {
            alert(`Errore: ${error}`);
        })
    }

    function eliminaUtente(id) {
        fetch('../logic/delete_account.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({id})
        })
        .then(response => response.text())
        .then(data => {
            alert('Utente eliminato');
            location.reload();
        })
        .catch(error => {
            alert(`Errore: ${error}`);
        })
    }
    </script>
</html>
