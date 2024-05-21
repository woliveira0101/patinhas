<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="container mt-5">
    <h1>Detalhes do Pedido de Adoção</h1>
    <p>ID: <?= htmlspecialchars($adoption['adoption_id']) ?></p>
    <p>Pet: <?= htmlspecialchars($adoption['pet_name']) ?></p>
    <p>Status: <?= htmlspecialchars($adoption['status']) ?></p>
    <p>Data: <?= htmlspecialchars($adoption['adoption_date']) ?></p>
    <h2>Respostas ao Questionário</h2>
    <ul>
        <?php foreach ($adoption['answers'] as $answer): ?>
        <li><strong><?= htmlspecialchars($answer['question_content']) ?>:</strong> <?= htmlspecialchars($answer['answer_content']) ?></li>
        <?php endforeach; ?>
    </ul>
    <form action="/adoptions/update/<?= htmlspecialchars($adoption['adoption_id']) ?>" method="post">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="pendente" <?= ($adoption['status'] == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                <option value="aprovado" <?= ($adoption['status'] == 'aprovado') ? 'selected' : '' ?>>Aprovado</option>
                <option value="rejeitado" <?= ($adoption['status'] == 'rejeitado') ? 'selected' : '' ?>>Rejeitado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Status</button>
    </form>
</div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
