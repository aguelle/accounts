<?php
include_once 'includes/_head.php'
?>

<!-- <div class="container-fluid">
    <header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
        <a href="index.html" class="col-1">
            <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
        </a>
        <nav class="col-11 col-md-7">
            <ul class="nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link link-secondary" aria-current="page">Opérations</a>
                </li>
                <li class="nav-item">
                    <a href="summary.php" class="nav-link link-body-emphasis">Synthèses</a>
                </li>
                <li class="nav-item">
                    <a href="categories.html" class="nav-link link-body-emphasis">Catégories</a>
                </li>
                <li class="nav-item">
                    <a href="import.html" class="nav-link link-body-emphasis">Importer</a>
                </li>
            </ul>
        </nav>
        <form id="search" action="" class="col-12 col-md-4" role="search">
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
            <h1 class="my-0 fw-normal fs-4">Ajouter une opération</h1>
        </div>
        <div class="card-body">
            <form id="formAdd" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'opération *</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Facture d'électricité" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date *</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="amount" id="amount" required>
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-select" name="category" id="category">
                        <option value="" selected>Aucune catégorie</option>
                        <option value="1">Nourriture</option>
                        <option value="2">Loisir</option>
                        <option value="3">Travail</option>
                        <option value="4">Voyage</option>
                        <option value="5">Sport</option>
                        <option value="6">Habitat</option>
                        <option value="7">Cadeaux</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Ajouter</button>
                </div>
                <input id="tokenField" type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="add">
            </form>
        </div>
    </section>
</div>

<div class="position-fixed bottom-0 end-0 m-3">
    <a href="add.html" class="btn btn-primary btn-lg rounded-circle">
        <i class="bi bi-plus fs-1"></i>
    </a>
</div>

<?php
include_once 'includes/_footer.php'
?>