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
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= htmlspecialchars($request['user_name']) ?></td>
                                <td><a href="/pet/show/<?= htmlspecialchars($request['pet_id']) ?>"><?= htmlspecialchars($request['pet_name']) ?></a></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($request['request_date']))) ?></td>
                                <td>
                                    <form action="/adoption/updateStatus" method="post" class="d-inline">
                                        <input type="hidden" name="adoption_id" value="<?= htmlspecialchars($request['adoption_id']) ?>">
                                        <select name="status" class="form-select">
                                            <option value="em analise" <?= $request['status'] == 'em analise' ? 'selected' : '' ?>>Em Análise</option>
                                            <option value="aprovado" <?= $request['status'] == 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
                                            <option value="reprovado" <?= $request['status'] == 'reprovado' ? 'selected' : '' ?>>Reprovado</option>
                                            <!-- <option value="cancelado" <?= $request['status'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option> -->
                                        </select>
                                </td>
                                <td>
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma solicitação encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>