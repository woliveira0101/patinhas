<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="text-success text-center"><?= isset($message) ? htmlspecialchars($message) : 'Operação realizada com sucesso!' ?></h1>
                <div class="text-center mt-4">
                    <button onclick="history.back()" class="btn btn-warning">Voltar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>