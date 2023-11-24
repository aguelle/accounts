<?php
require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';

if (!isset($_REQUEST['action'])) addErrorAndExit('Aucune action');

include 'includes/_dbCo.php';

// Start user session
session_start();

// Check for CSRF and redirect in case of invalid token or referer
checkCSRF('index.php');

// Prevent XSS fault
checkXSS($_REQUEST);
if ($_REQUEST['action'] === 'delete') {

$id = intval($_REQUEST['id']);

if (is_int($id)) {
    try {
        $dbCo->beginTransaction();



        // Delete the selected task.
        $queryUpdate = $dbCo->prepare("DELETE FROM transaction WHERE id_transaction = :id;");
        $queryUpdate->execute(['id' => $id]);

        if ($queryUpdate->rowCount() !== 1) {
            throw new Exception('Nombre incohérent de lignes affectées par la suppression.');
        }
        
  

        if ($dbCo->commit()) {
            $_SESSION['notif'] = 'Tâche supprimée avec succès.';
        }
    } catch (Exception $e) {
        $dbCo->rollBack();
        $_SESSION['error'] = 'Erreur lors de la suppression de la tâche.';
    }

} else {
    $_SESSION['error'] = 'La tâche n\'a pas été supprimée.';
}
}
?>