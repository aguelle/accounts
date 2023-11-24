<?php
include_once './includes/_head.php'
?>

<!-- <div class="container-fluid">
    <header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
        <a href="index.html" class="col-1">
            <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
        </a>
        <nav class="col-11 col-md-7"> -->
<!-- <ul class="nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link link-secondary" aria-current="page">Opérations</a>
                </li>
                <li class="nav-item">
                    <a href="summary.php" class="nav-link link-body-emphasis">Synthèses</a>
                </li>
                <li class="nav-item">
                    <a href="categories.php" class="nav-link link-body-emphasis">Catégories</a>
                </li>
                <li class="nav-item">
                    <a href="import.php" class="nav-link link-body-emphasis">Importer</a>
                </li>
            </ul> -->
<!-- </nav>
        <form action="" class="col-12 col-md-4" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher..." aria-describedby="button-search">
                <button class="btn btn-primary" type="submit" id="button-search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </header>
</div> -->

<div class="container">
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
        </div>
        <div class="card-body">
            <?php $query = $dbCo->prepare("SELECT SUM(`amount`) AS `sold`
                FROM `transaction`;");
            $query->execute();
            $result = $query->fetchall();
            foreach ($result as $sold) {
                
            ?>
            <p class="card-title pricing-card-title text-center fs-1"><?= $sold['sold'] ?></p>
    <?php
}
?>    </div>
    </section>

    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h1 class="my-0 fw-normal fs-4">Opérations de Juillet 2023</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Opération</th>
                        <th scope="col" class="text-end">Montant</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $dbCo->prepare("SELECT `id_transaction`,`date_transaction`, `name`, `amount` 
                            FROM `transaction` 
                            WHERE `date_transaction` LIKE \"2023-07%\"
                            ORDER BY date_transaction DESC;");
                    $query->execute();

                    $result = $query->fetchall();
                    foreach ($result as $transaction) {
                    ?>
                        <tr>
                            <td width="50" class="ps-3">
                            </td>
                            <td>
                                <time class="d-block fst-italic fw-light"> <?= $transaction['date_transaction'] ?></time> <?= $transaction['name'] ?>
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2"><?= $transaction['amount'] ?>

                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="action.php?action=edit&id=<?= $transaction['id_transaction'] ?>&token=<?= $_SESSION['token'] ?>" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="action.php?action=delete&id=<?= $transaction['id_transaction'] ?>&token=<?= $_SESSION['token'] ?>" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php
                    } ?>
                    <td class="text-end text-nowrap">
                        <a href="action.php?action=edit&id=<?= $transaction['id_transaction'] ?>&token=<?= $_SESSION['token'] ?>" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="action.php?action=delete&id=<?= $transaction['id_transaction'] ?>&token=<?= $_SESSION['token'] ?>" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav class="text-center">
                <ul class="pagination d-flex justify-content-center m-2">
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">Juillet 2023</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.html">Juin 2023</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.html">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>

<div class="position-fixed bottom-0 end-0 m-3">
    <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
        <i class="bi bi-plus fs-1"></i>
    </a>
</div>
<?php
include_once 'includes/_footer.php'
?>