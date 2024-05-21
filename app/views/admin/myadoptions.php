<?php include __DIR__ . '/../include/header.php'; ?>

<div class="container mt-5">
    <h1>Minhas Adoções</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pet</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adoptions as $adoption): ?>
            <tr>
                <td><?= htmlspecialchars($adoption['adoption_id']) ?></td>
                <td><?= htmlspecialchars($adoption['pet_name']) ?></td>
                <td><?= htmlspecialchars($adoption['status']) ?></td>
                <td><?= htmlspecialchars($adoption['adoption_date']) ?></td>
                <td>
                    <a href="/adoptions/show/<?= htmlspecialchars($adoption['adoption_id']) ?>" class="btn btn-info">Ver</a>
                    <form action="/adoptions/delete/<?= htmlspecialchars($adoption['adoption_id']) ?>" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
