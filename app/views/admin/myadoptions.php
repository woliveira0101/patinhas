<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Minhas Adoções</h1>
        <?php if (empty($adoptions)): ?>
            <p>Você ainda não fez nenhuma adoção.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome do Pet</th>
                        <th>Data do Pedido</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adoptions as $adoption): ?>
                        <tr>
                            <td>
                                <a href="/pet/show/<?= htmlspecialchars($adoption['pet_id']) ?>">
                                    <?= htmlspecialchars($adoption['pet_name']) ?>
                                </a>
                            </td>
                            <td><?= date('d/m/Y', strtotime($adoption['request_date'])) ?></td>
                            <td><?= htmlspecialchars($adoption['status']) ?></td>
                            <td>
                                <button class="btn btn-danger btn-cancel-adoption" data-adoption-id="<?= $adoption['adoption_id'] ?>">Cancelar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>