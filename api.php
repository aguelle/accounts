<?php

require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';

header('content-type:application/json');


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['action'])) {
    echo json_encode([
        'result' => false,
        'error' => 'Aucune action'
    ]);
    exit;
}

include 'includes/_dbCo.php';

// Start user session
session_start();

// Check for CSRF and redirect in case of invalid token or referer
checkCSRFAsync($data);

// Prevent XSS fault
checkXSS($data);

//ADD TRANSACTION
if ($data['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($data['name']) <= 0 || ($data['amount'])<=0) throwAsyncError('donnée manquant.');

    $query = $dbCo->prepare("INSERT INTO transaction (name, amount, date_transaction) VALUES (:name, :amount, :date_transaction);");
    $isQueryOk = $query->execute([
        'name' => $data['name'],
        'amount' => $data['amount'],
        'date_transaction' => $data['date_transaction']
        
    ]);

    if (!$isQueryOk || $query->rowCount() !== 1) throwAsyncError('Erreur lors de la création de la tâche');

    echo json_encode([
        'result' => true,
        'notification' => 'La transaciotn a bien été créée.',
        'idTask' => $dbCo->lastInsertId(),
        'name' => $data['name'],
        'amount' => $data['amount'],
        'date_transaction' => $data['date']
    ]);
    exit;
}