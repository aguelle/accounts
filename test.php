<?php
require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';
include 'includes/_dbCo.php';

session_start();
generateToken();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opérations de Juillet 2023 - Mes Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <?php
$query = $dbCo->prepare("SELECT  `name`, `amount` 
                            FROM `transaction` 
                            ;");

$result = $query->fetchall();
?><ul><?php
foreach ($result as $transaction) {

    echo '<li class="nav-item"' . $transaction['name'] . '' . $transaction['amount'] . '</li>';

    var_dump($result);
}
?>
    </ul>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>