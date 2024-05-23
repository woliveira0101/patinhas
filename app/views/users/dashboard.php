<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="container mt-4">
    <h1>Dashboard</h1>
    <div class="row">
        <!-- Últimas Doações -->
        <div class="col-md-4">
            <h2>Últimas Doações</h2>
            <ul class="list-group">
                <?php if (!empty($latestDonations)): ?>
                    <?php foreach ($latestDonations as $donation): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($donation['pet_name']) ?></strong>
                            <br>
                            Dono: <?= htmlspecialchars($donation['user_name']) ?>
                            <br>
                            Data: <?= date('d/m/Y', strtotime($donation['donation_date'])) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">Nenhuma doação encontrada.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Últimas Adoções -->
        <div class="col-md-4">
            <h2>Últimas Adoções</h2>
            <ul class="list-group">
                <?php if (!empty($latestAdoptions)): ?>
                    <?php foreach ($latestAdoptions as $adoption): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($adoption['pet_name']) ?></strong>
                            <br>
                            Adotante: <?= htmlspecialchars($adoption['user_name']) ?>
                            <br>
                            Data: <?= date('d/m/Y', strtotime($adoption['request_date'])) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">Nenhuma adoção encontrada.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Pedidos de Adoção Pendentes -->
        <div class="col-md-4">
            <h2>Pedidos Pendentes</h2>
            <ul class="list-group">
                <?php if (!empty($pendingRequests)): ?>
                    <?php foreach ($pendingRequests as $request): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($request['pet_name']) ?></strong>
                            <br>
                            Solicitante: <?= htmlspecialchars($request['user_name']) ?>
                            <br>
                            Data: <?= date('d/m/Y', strtotime($request['request_date'])) ?>
                            <br>
                            <a href="/adoption/show/<?= htmlspecialchars($request['adoption_id']) ?>" class="btn btn-primary btn-sm mt-2">Visualizar Pedido</a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">Nenhum pedido pendente encontrado.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>