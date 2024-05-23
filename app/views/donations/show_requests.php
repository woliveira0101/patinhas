<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<section class="container">
    <div class="row">
        <div class="col-12 mt-2 mb-3 mx-auto py-3 px-md-5 border rounded bg-body-tertiary"
            style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.3);">
            <h1 class="fw-bolded fs-3 text-warning text-center">Solicitações de Adoção</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome do Usuário</th>
                        <th scope="col">Nome do Pet</th>
                        <th scope="col">Data da Solicitação</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= htmlspecialchars($request['user_name']) ?></td>
                                <td><a href="/pet/show/<?= htmlspecialchars($request['pet_id']) ?>"><?= htmlspecialchars($request['pet_name']) ?></a></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($request['request_date']))) ?></td>
                                <td><?= htmlspecialchars($request['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma solicitação encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>