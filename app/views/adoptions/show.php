<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Detalhes do Pedido de Adoção</h1>
        <p><strong>Pet:</strong> <?= isset($pet['pet_name']) ? htmlspecialchars($pet['pet_name']) : 'N/A' ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($adoption['status']) ?></p>
        <p><strong>Data da Solicitação:</strong> <?= isset($adoption['request_date']) ? date('d/m/Y', strtotime($adoption['request_date'])) : 'N/A' ?></p>
        
        <h2>Respostas ao Questionário</h2>
        <?php if (isset($answers) && is_array($answers)): ?>
            <ul style="list-style-type: none; padding: 0;">
                <?php foreach ($answers as $answer): ?>
                    <li style="margin-bottom: 15px;">
                        <strong><?= htmlspecialchars($answer['question_number']) ?>) <?= htmlspecialchars($answer['question_content']) ?>:</strong><br>
                        <span><?= htmlspecialchars($answer['answer_content']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma resposta encontrada.</p>
        <?php endif; ?>

        <!-- Botões de Aprovar e Reprovar -->
        <div class="mt-4">
            <form action="/adoption/updateStatus" method="post">
                <input type="hidden" name="adoption_id" value="<?= htmlspecialchars($adoption['adoption_id']) ?>">
                <button type="submit" name="status" value="aprovado" class="btn btn-success me-2">Aprovar</button>
                <button type="submit" name="status" value="reprovado" class="btn btn-danger">Reprovar</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>